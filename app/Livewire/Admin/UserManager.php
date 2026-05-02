<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManager extends Component
{
    use WithPagination;

    public $name, $email, $password, $type = 'user';
    public $userId;
    public $isEdit = false;

    public function render()
    {
        return view('livewire.admin.user-manager', [
            'users' => User::orderBy('id', 'desc')->paginate(10)
        ])->layout('layouts.app');
    }

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->type = 'user';
        $this->userId = null;
        $this->isEdit = false;
        $this->resetErrorBag();
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->userId)],
            'type' => 'required|in:admin,user',
        ];

        if (!$this->isEdit) {
            $rules['password'] = 'required|string|min:8';
        } else {
            $rules['password'] = 'nullable|string|min:8';
        }

        $this->validate($rules);

        if ($this->isEdit) {
            $user = User::find($this->userId);
            $user->name = $this->name;
            $user->email = $this->email;
            $user->type = $this->type;
            if ($this->password) {
                $user->password = Hash::make($this->password);
            }
            $user->save();
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'type' => $this->type,
                'password' => Hash::make($this->password),
            ]);
        }

        $this->resetFields();
    }

    public function edit($id)
    {
        $user = User::find($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->type = $user->type;
        $this->password = ''; // Keep empty on edit
        $this->isEdit = true;
    }

    public function delete($id)
    {
        if ($id === auth()->id()) {
            return; // prevent self-deletion
        }
        User::find($id)->delete();
    }
}
