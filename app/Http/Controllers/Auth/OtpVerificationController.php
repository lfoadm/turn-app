<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Auth\UserRegisteredMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OtpVerificationController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|string',
        ]);

        $user = Auth::user();

        if ($user->otp_code === $request->otp_code) {
            $user->email_verified_at = now();
            $user->otp_code = null; // limpa o código após uso
            $user->save();

            return redirect()->route('dashboard')->with('success', 'otp-verified');
        }

        return back()->with('status', 'otp-invalid');
    }

    public function resend(Request $request)
    {
        $user = Auth::user();

        // gerar novo código OTP
        $user->otp_code = rand(100000, 999999);
        $user->save();

        // reenviar e-mail
        Mail::to($user->email)->queue(new UserRegisteredMail($user));

        return back()->with('status', 'verification-link-sent');
    }
}
