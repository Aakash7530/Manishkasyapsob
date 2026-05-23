<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminLoginOtp;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::validate($credentials)) {
            $user = Auth::getProvider()->retrieveByCredentials($credentials);

            if ($user && $user->isAdmin()) {
                $otp = str_pad((string)rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $request->session()->put('login_admin_id', $user->_id);
                $request->session()->put('login_admin_remember', $request->boolean('remember'));
                $request->session()->put('login_admin_otp', $otp);
                $request->session()->put('login_admin_otp_expires', now()->addMinutes(5));

                // Always log the OTP so you can still log in locally even if SMTP fails
                \Illuminate\Support\Facades\Log::info("Admin Login OTP generated: " . $otp);

                try {
                    Mail::to('contactmanishkasyap@gmail.com')->send(new AdminLoginOtp($otp));
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('SMTP Error during OTP: ' . $e->getMessage());
                }

                return redirect()->route('login.otp');
            } else {
                return back()->withErrors([
                    'email' => 'You do not have access to the admin area.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showOtpForm(Request $request)
    {
        if (!$request->session()->has('login_admin_id')) {
            return redirect()->route('login');
        }
        return view('auth.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        if (!$request->session()->has('login_admin_id')) {
            return redirect()->route('login');
        }

        $sessionOtp = $request->session()->get('login_admin_otp');
        $expiresAt = $request->session()->get('login_admin_otp_expires');

        if (now()->greaterThan($expiresAt)) {
            return back()->withErrors(['otp' => 'OTP has expired. Please login again.']);
        }

        if ($request->otp === $sessionOtp) {
            $userId = $request->session()->get('login_admin_id');
            $remember = $request->session()->get('login_admin_remember');

            Auth::loginUsingId($userId, $remember);
            
            $request->session()->forget(['login_admin_id', 'login_admin_otp', 'login_admin_otp_expires', 'login_admin_remember']);
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors(['otp' => 'Invalid OTP code.']);
    }

    public function resendOtp(Request $request)
    {
        if (!$request->session()->has('login_admin_id')) {
            return redirect()->route('login');
        }

        $otp = str_pad((string)rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $request->session()->put('login_admin_otp', $otp);
        $request->session()->put('login_admin_otp_expires', now()->addMinutes(5));

        \Illuminate\Support\Facades\Log::info("Admin Login OTP Resent: " . $otp);

        try {
            Mail::to('contactmanishkasyap@gmail.com')->send(new AdminLoginOtp($otp));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('SMTP Error during OTP Resend: ' . $e->getMessage());
            return back()->withErrors(['otp' => 'Failed to resend OTP. Please try again.']);
        }

        return back()->with('success', 'OTP has been resent to your email.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
