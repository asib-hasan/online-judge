<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Models\Contest;
use App\Models\Submission;
use Livewire\WithPagination;

class ContestSummary extends Component
{
    use WithPagination;

    public $contest;
    public $viewingSubmission = null;

    public function mount(Contest $contest)
    {
        $this->contest = $contest;
    }

    public function viewCode($submissionId)
    {
        $this->viewingSubmission = Submission::with('user', 'problem')->find($submissionId);
    }

    public function closeCode()
    {
        $this->viewingSubmission = null;
    }

    public function render()
    {
        $problemIds = $this->contest->problems()->pluck('problems.id');

        $query = Submission::with(['user', 'problem'])
            ->whereIn('problem_id', $problemIds)
            ->orderBy('created_at', 'desc');

        if ($this->contest->start_time) {
            $query->where('created_at', '>=', $this->contest->start_time);
        }
        if ($this->contest->end_time) {
            $query->where('created_at', '<=', $this->contest->end_time);
        }

        $submissions = $query->paginate(20);

        return view('livewire.admin.contest-summary', [
            'submissions' => $submissions
        ])->layout('layouts.app');
    }
}
