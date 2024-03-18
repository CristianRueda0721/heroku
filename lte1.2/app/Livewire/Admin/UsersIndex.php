<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class UsersIndex extends Component
{
    public $search;

    public function render()
    {
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
            ->get();

        return view('livewire.admin.users-index', compact('users'));
    }
}
