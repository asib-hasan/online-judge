<?php

namespace App\Livewire\User;

use Livewire\Component;

class ContestList extends Component
{
    public function render()
    {
        $contests = \App\Models\Contest::latest()->get();
        return view('livewire.user.contest-list', compact('contests'))->layout('layouts.app');
    }
}
