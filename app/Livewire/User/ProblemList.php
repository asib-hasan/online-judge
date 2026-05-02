<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Problem;
use App\Models\Submission;
use Livewire\WithPagination;

class ProblemList extends Component
{
    use WithPagination;

    public $userStatuses = [];

    public function loadUserStatuses($problems)
    {
        if (auth()->check()) {
            $problemIds = $problems->pluck('id');
            $submissions = Submission::where('user_id', auth()->id())
                ->whereIn('problem_id', $problemIds)
                ->get();
                
            foreach ($problemIds as $pid) {
                $probSubs = $submissions->where('problem_id', $pid);
                if ($probSubs->isEmpty()) {
                    $this->userStatuses[$pid] = 'unattempted';
                } elseif ($probSubs->contains('status', 'Accepted')) {
                    $this->userStatuses[$pid] = 'solved';
                } else {
                    $this->userStatuses[$pid] = 'tried';
                }
            }
        }
    }

    public function render()
    {
        $problems = Problem::whereDoesntHave('contests', function ($query) {
            $query->where('end_time', '>', now())->orWhereNull('end_time');
        })->paginate(15);
        $this->loadUserStatuses($problems->getCollection());

        return view('livewire.user.problem-list', [
            'problems' => $problems
        ])->layout('layouts.app');
    }
}
