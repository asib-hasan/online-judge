<?php

namespace App\Livewire\User;

use Livewire\Component;

class ContestShow extends Component
{
    public \App\Models\Contest $contest;

    public $userStatuses = [];

    public function mount(\App\Models\Contest $contest)
    {
        $this->contest = $contest->load('problems');
        
        if (auth()->check()) {
            $problemIds = $this->contest->problems->pluck('id');
            $submissions = \App\Models\Submission::where('user_id', auth()->id())
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
        return view('livewire.user.contest-show')->layout('layouts.app');
    }
}
