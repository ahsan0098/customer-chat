<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class HomeComponent extends Component
{

    public function render()
    {
        return view('livewire.home-component')->layout('layouts.base');
    }
}
