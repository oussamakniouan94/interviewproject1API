<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        if (!$user) {
            return redirect('/login')->withErrors('Facebook authentication failed.');
        }

        $authUser = User::where('facebook_id', $user->facebook_id)->first();

        if (!$authUser) {
            $authUser = User::create([
                'facebook_id' => $user->id,
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
