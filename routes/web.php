<?php

use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\LoginComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SignupComponent;
use App\Http\Livewire\ProfileComponent;
use App\Http\Controllers\MainController;
use App\Http\Livewire\AddAgentComponent;
use App\Http\Livewire\AdminDashboard;
use App\Http\Livewire\AgentDashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('welcome');

route::get('/', LoginComponent::class)->name('login');
route::get('/signup', SignupComponent::class)->name('signup');
route::get('/auth/google', [mainController::class, 'loginWithGoogle'])->name('google-login');
route::any('/auth/google/callback', [mainController::class, 'callbackFromGoogle'])->name('google-callback');

Route::group(['middleware' => ['logedUser']], function () {
    Route::get('user-profile', ProfileComponent::class)->name('user-profile');
    Route::get('/logout', [MainController::class, 'logout'])->name('logout');
    Route::get('/home', HomeComponent::class)->name('home');
});

Route::group(['middleware' => ['logedAdm']], function () {
    Route::get('/admin-dashboard', AdminDashboard::class)->name('admin-dashboard');
    Route::get('/add-agent', AddAgentComponent::class)->name('add-agent');
});

Route::group(['middleware' => ['logedAgt']], function () {
    Route::get('/agent-dashboard', AgentDashboard::class)->name('agent-dashboard');
});
