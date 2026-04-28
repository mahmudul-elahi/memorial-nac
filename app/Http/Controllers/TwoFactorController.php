<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TwoFactorController extends Controller
{
    // Enable 2FA for the user
    public function enable(Request $request)
    {
        $user = Auth::user();

        if ($user->email_verified_at != null) {
            $otp = Str::random(6);
            $user->two_factor_code = Hash::make($otp);
            $user->two_factor_code_sent_at = Carbon::now();
            $user->two_factor_enabled = true;
            $user->save();

            return redirect()->back()->with('success', '2 Factor Authentication is enabled');
        }

        return redirect()->back()->with('success', 'Please verify your email address');
    }

    public function disable()
    {
        $user = Auth::user();
        $user->two_factor_enabled = false;
        $user->two_factor_code = null;
        $user->two_factor_code_sent_at = null;
        $user->save();

        return redirect()->back()->with('success', 'Two-factor authentication disabled.');
    }

    // Display OTP verification form
    public function showVerificationForm()
    {
        if (!Auth::check() || !Auth::user()->two_factor_enabled || !session()->has('otp_verified')) {
            return redirect()->route('login');
        }

        return view('frontend.auth.two_factor');
    }


    // Verify the OTP entered by the user
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6'
        ]);

        $user = Auth::user();

        if ($user->two_factor_code && Hash::check($request->otp, $user->two_factor_code) && Carbon::now()->diffInMinutes($user->two_factor_code_sent_at) <= 10) {
            session(['otp_verified' => true]);

            return redirect()->route('dashboard');
        }

        Auth::logout();

        return redirect()->route('login')->withErrors(['otp' => 'Invalid or expired OTP. Please try again.']);
    }
}
