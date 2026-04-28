<?php

// Redirect to the provider

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

Route::get('auth/{provider}', function ($provider) {
    return Socialite::driver($provider)->redirect();
})->name('socialite.redirect');

Route::get('auth/{provider}/callback', function (Request $request, $provider) {

    if (!$request->has('code')) {
        return redirect()->route('login')->with('error', 'Login with Google was canceled.');
    }

    try {

        $socialUser = Socialite::driver($provider)->user();

        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            $user->update([
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
            ]);
        } else {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'email_verified_at' => now(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'password' => bcrypt(Str::random(16)),
            ]);
        }

        // Assign the 'user' role after creation or update
        $user->assignRole('user');

        Auth::login($user);

        return redirect()->route('index');
    } catch (\Exception $e) {
        return redirect()->route('login')->with('error', 'There was an error logging in with Google.');
    }
})->name('socialite.callback');
