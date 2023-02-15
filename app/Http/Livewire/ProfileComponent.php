<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class ProfileComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $username;
    public $email;
    public $image;
    public $newimage;
    public $address;

    public function mount()
    {
        $user = User::where('email', session('user_email'))->first();
        $this->name = $user->name;
        $this->username = $user->username;
        $this->address = $user->address;
        $this->image = $user->image;
    }
    public function profile()
    {
        $data = $this->validate([
            'name' => 'required',
            'username' => 'required',
        ]);

        $user = User::where('email', session('user_email'))->first();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->address = $this->address;
        $imagename = Carbon::now()->timestamp . '.' . $this->newimage->extension();
        $this->newimage->storeAs('user', $imagename);
        $user->image = $imagename;
        if ($user->save()) {
            session()->flash('message', "Profile Updated");
            session()->put('user_image', $imagename);
        }
        return back();
    }
    public function render()
    {
        return view('livewire.profile-component')->layout('layouts.base');
    }
}
