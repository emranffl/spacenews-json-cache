<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function githubLogin()
    {
        return Socialite::driver('github')->redirect();
    }
    
    public function githubRedirect()
    {
        $user = Socialite::driver('github')->user();
        dd($user);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
