<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Problem;
use App\Models\Submission;

class ProblemShow extends Component
{
    public Problem $problem;
    public $code;
    public $language = 'python';
    public $message = '';
    public $contest = null;

    public function mount(Problem $problem)
    {
        $this->problem = $problem;
        
        $contestId = request()->query('contest');
        if ($contestId) {
            try {
                $id = \Illuminate\Support\Facades\Crypt::decryptString($contestId);
                $this->contest = \App\Models\Contest::find($id);
            } catch (\Exception $e) {
                // invalid or tampered contest ID
            }
        }
    }

    public function submit()
    {
        if ($this->contest) {
            $now = now();
            if ($this->contest->start_time && $now->lt($this->contest->start_time)) {
                $this->message = "You cannot submit yet. The contest has not started.";
                return;
            }
            if ($this->contest->end_time && $now->gt($this->contest->end_time)) {
                $this->message = "You cannot submit. The contest has already ended.";
                return;
            }
        }

        $this->validate([
            'code' => 'required',
            'language' => 'required',
        ]);

        $submission = Submission::create([
            'user_id' => auth()->id(),
            'problem_id' => $this->problem->id,
            'code' => $this->code,
            'language' => $this->language,
            'status' => 'Pending',
        ]);

        $this->message = "Your submission is in queue. Judging in progress...";
        $this->dispatch('start-judging', submissionId: $submission->id);
    }

    #[On('start-judging')]
    public function processJudging($submissionId)
    {
        $submission = Submission::find($submissionId);
        if (!$submission) return;

        $status = $this->judge($submission);
        $submission->update(['status' => $status]);

        $this->message = "Your submission was evaluated: {$status}";
    }

    private function getLanguageId($lang)
    {
        return match($lang) {
            'php' => 98,
            'python' => 92,
            'c' => 103,
            'cpp' => 105,
            'java' => 91,
            default => 92,
        };
    }

    private function judge(Submission $submission)
    {
        $testCases = json_decode($this->problem->test_cases, true);
        if (!$testCases) {
            return 'Accepted'; // No test cases means pass
        }

        $languageId = $this->getLanguageId($this->language);
        $status = 'Accepted';

        foreach ($testCases as $tc) {
            $input = $tc['input'] ?? '';
            $expectedOutput = trim($tc['output'] ?? '');

            $response = \Illuminate\Support\Facades\Http::post('https://ce.judge0.com/submissions?base64_encoded=false&wait=true', [
                'source_code' => $this->code,
                'language_id' => $languageId,
                'stdin' => $input,
                'expected_output' => $expectedOutput,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $statusCode = $result['status']['id'] ?? 0;

                if ($statusCode === 3) { // Accepted
                    continue;
                } elseif ($statusCode === 4) { // Wrong Answer
                    $status = 'Wrong Answer';
                    break;
                } elseif ($statusCode === 5) { // Time Limit Exceeded
                    $status = 'Time Limit Exceeded';
                    break;
                } elseif ($statusCode === 6) { // Compilation Error
                    $status = 'Compilation Error';
                    break;
                } else {
                    $status = 'Runtime Error';
                    break;
                }
            } else {
                $status = 'Judge Error';
                break;
            }
        }

        return $status;
    }

    public function render()
    {
        $submissions = Submission::where('user_id', auth()->id())
            ->where('problem_id', $this->problem->id)
            ->latest()
            ->get();

        return view('livewire.user.problem-show', [
            'submissions' => $submissions
        ])->layout('layouts.app');
    }
}
