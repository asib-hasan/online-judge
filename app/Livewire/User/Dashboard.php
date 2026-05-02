<?php

namespace App\Livewire\User;

use Livewire\Component;

use App\Models\Contest;
use App\Models\Submission;

class Dashboard extends Component
{
    public function render()
    {
        $now = now();
        $activeContests = Contest::where('end_time', '>', $now)
            ->orWhereNull('end_time')
            ->orderBy('start_time', 'asc')
            ->take(5)
            ->get();
            
        $userId = auth()->id();
        $submissions = Submission::where('user_id', $userId)->get();
        
        $stats = [
            'total_submissions' => $submissions->count(),
            'unique_solved' => $submissions->where('status', 'Accepted')->unique('problem_id')->count(),
            'ac' => $submissions->where('status', 'Accepted')->count(),
            'wa' => $submissions->where('status', 'Wrong Answer')->count(),
            're' => $submissions->where('status', 'Runtime Error')->count(),
            'ce' => $submissions->where('status', 'Compilation Error')->count(),
            'tle' => $submissions->where('status', 'Time Limit Exceeded')->count(),
            'pending' => $submissions->where('status', 'Pending')->count(),
        ];

        return view('livewire.user.dashboard', compact('activeContests', 'stats'))->layout('layouts.app');
    }
}
