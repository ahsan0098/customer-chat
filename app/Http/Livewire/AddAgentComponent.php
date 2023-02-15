<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AddAgentComponent extends Component
{
    public $users;
    public function mount()
    {
        $this->users = User::all();
    }
    public function makeAgent($id)
    {
        $role = User::where('id', $id)->first();
        $role->type = "AGT";
        $role->save();
    }
    public function makeUser($id)
    {
        $role = User::where('id', $id)->first();
        $role->type = "USR";
        $role->save();
    }
    public function makeAdmin($id)
    {
        $role = User::where('id', $id)->first();
        $role->type = "ADM";
        $role->save();
    }
    public function booted()
    {
        $this->users = User::all();
    }
    public function render()
    {
        return view('livewire.add-agent-component')->layout('layouts.base');
    }
}
