<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Problem;
use Livewire\WithPagination;

class ProblemManager extends Component
{
    use WithPagination;

    public $title, $description, $test_cases, $problemId;
    public $isEdit = false;

    public function render()
    {
        return view('livewire.admin.problem-manager', [
            'problems' => Problem::paginate(10)
        ])->layout('layouts.app');
    }

    public function resetFields()
    {
        $this->title = '';
        $this->description = '';
        $this->test_cases = '';
        $this->problemId = null;
        $this->isEdit = false;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($this->isEdit) {
            $problem = Problem::find($this->problemId);
            $problem->update([
                'title' => $this->title,
                'description' => $this->description,
                'test_cases' => $this->test_cases,
            ]);
        } else {
            Problem::create([
                'title' => $this->title,
                'description' => $this->description,
                'test_cases' => $this->test_cases,
            ]);
        }

        $this->resetFields();
    }

    public function edit($id)
    {
        $problem = Problem::find($id);
        $this->title = $problem->title;
        $this->description = $problem->description;
        $this->test_cases = $problem->test_cases;
        $this->problemId = $problem->id;
        $this->isEdit = true;
    }

    public function delete($id)
    {
        Problem::find($id)->delete();
    }
}
