<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SignupComponent extends Component
{
    public $name;
    public $email;
    public $username;
    public $password;
    public $confirm_password;
    public function SignUp()
    {
        $data = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required',
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required'
        ]);
        $encpass = md5($data['password']);
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->username = $data['username'];
        $user->password = $encpass;
        if ($user->save()) {
            session()->put('user_email', $this->email);
            session()->put('user_image', $user->image);
            session()->put('user_type', "USR");
            return redirect()->to('home');
            // session()->flash('message', 'Account created!');
        } else {
            session()->flash('message', 'Signup failed');
        }
    }
    public function updated()
    {
        $this->validate(['email' => 'unique:users']);
    }
    public function render()
    {
        return view('livewire.signup-component')->layout('layouts.app');
    }
}
