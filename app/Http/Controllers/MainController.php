<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Google\Service\ServiceControl\Auth;
use Laravel\Socialite\Facades\Socialite;
use Google\Service\ArtifactRegistry\Hash;

class MainController extends Controller
{
    public function logout()
    {
        // return Socialite::driver('google')->user();
        // session()->forget('user_email');
        // session()->forget('user_');
        // session()->forget('user_email');
        session()->flush();
        return redirect('/');
    }
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callbackFromGoogle()
    {

        try {

            $user = Socialite::driver('google')->user();
            $is_user = User::where('email', $user->getEmail())->first();
            if (!$is_user) {
                $userCreate = User::UpdateOrCreate([
                    'google_id' => $user->getId()
                ], [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => md5($user->getId()),
                    'google_id' => $user->getId(),
                ]);
            } else {
                $userCreate = User::where('email', $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
            }
            // Auth::loginUsingId($is_user->id);
            if ($userCreate) {
                $usr = User::where('email', $user->getEmail())->first();
                session()->put('user_email', $usr->email);
                session()->put('user_image', $usr->image);
                session()->put('user_type', $usr->type);
                return redirect()->route('home');
            }
        } catch (Throwable $th) {
            throw $th;
        }
    }
}
