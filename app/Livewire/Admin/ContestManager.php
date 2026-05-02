<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Contest;
use App\Models\Problem;
use Livewire\WithPagination;

class ContestManager extends Component
{
    use WithPagination;

    public $title, $description, $start_time, $end_time, $contestId;
    public $selectedProblems = [];
    public $isEdit = false;

    public function render()
    {
        return view('livewire.admin.contest-manager', [
            'contests' => Contest::with('problems')->paginate(10),
            'allProblems' => Problem::all(),
        ])->layout('layouts.app');
    }

    public function resetFields()
    {
        $this->title = '';
        $this->description = '';
        $this->start_time = '';
        $this->end_time = '';
        $this->selectedProblems = [];
        $this->contestId = null;
        $this->isEdit = false;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        if ($this->isEdit) {
            $contest = Contest::find($this->contestId);
            $contest->update([
                'title' => $this->title,
                'description' => $this->description,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
            ]);
            $contest->problems()->sync($this->selectedProblems);
        } else {
            $contest = Contest::create([
                'title' => $this->title,
                'description' => $this->description,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
            ]);
            $contest->problems()->sync($this->selectedProblems);
        }

        $this->resetFields();
    }

    public function edit($id)
    {
        $contest = Contest::find($id);
        $this->title = $contest->title;
        $this->description = $contest->description;
        $this->start_time = $contest->start_time->format('Y-m-d\TH:i');
        $this->end_time = $contest->end_time->format('Y-m-d\TH:i');
        $this->selectedProblems = $contest->problems->pluck('id')->toArray();
        $this->contestId = $contest->id;
        $this->isEdit = true;
    }

    public function delete($id)
    {
        Contest::find($id)->delete();
    }
}
