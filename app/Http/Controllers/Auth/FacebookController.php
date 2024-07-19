<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class FacebookController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        if (!$user) {
            return redirect('/login')->withErrors('Google authentication failed.');
        }

        $authUser = User::where('google_id', $user->google_id)->first();

        if (!$authUser) {
            $authUser = User::create([
                'google_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'token' => $user->token
            ]);
        } else {
            $authUser->update([
                'token' => $user->token
            ]);
        }

        Auth::login($authUser);

        return redirect()->to(env('FRONTEND_URL') . '/checkout?token=' . $user->token);
    }
}
