<?php

namespace App\Http\Livewire;

use Throwable;
use App\Models\User;
use Livewire\Component;
use Laravel\Socialite\Facades\Socialite;

class LoginComponent extends Component
{
    public $email;
    public $password;
    public function Login()
    {
        $data = $this->validate([
            'email' => 'required',
            'password' => 'required|min:6',
        ]);
        $encpass = md5($data['password']);
        $user = User::where('email', $data['email'])->where('password', $encpass)->first();
        if ($user != null) {
            session()->put('user_email', $user->email);
            session()->put('user_image', $user->image);
            session()->put('user_type', $user->type);
            return redirect()->to('home');
        } else {
            session()->flash('message', 'Credentials did not matched!');
        }
    }
    public function updatedEmail()
    {
        $this->validate(['email' => 'exists:users']);
    }
    // public function loginWithGoogle()
    // {
    //     return Socialite::driver('google')->redirect();
    // }
    // public function callbackFromGoogle()
    // {

    //     try {

    //         $user = Socialite::driver('google')->user();
    //         $is_user = User::where('email', $user->getEmail())->first();
    //         if(!$is_user){
    //             $userCreate = new User;
    //             $userCreate->email= $user->getEmail();
    //             $userCreate->google_id=$user->getId();
    //             if($userCreate->save()){

    //             }
    //         }
    //     } catch (Throwable $th) {
    //         throw $th;
    //     }
    // }
    public function render()
    {
        return view('livewire.login-component')->layout('layouts.app');
    }
}
