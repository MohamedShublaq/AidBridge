<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Donor;
use App\Models\Ngo;
use App\Models\User;
use App\Notifications\SendOtpNotify;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    public function showEnterEmail($type)
    {
        return view('Auth.Reset.email', compact('type'));
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'type' => ['required', 'in:admin,civilian,donor,ngo']
        ]);

        if ($request->type == 'ngo') {
            $ngo = Ngo::where('email', $request->email)->first();
            if (!$ngo) {
                return redirect()->back()->withErrors(['email' => 'Enter your email correctly']);
            }
            $ngo->notify(new SendOtpNotify());
            return redirect()->route('showEnterOtp', ['email' => $ngo->email , 'type' => $request->type]);
        }
        if ($request->type == 'civilian') {
            $civ = User::where('email', $request->email)->first();
            if (!$civ) {
                return redirect()->back()->withErrors(['email' => 'Enter your email correctly']);
            }
            $civ->notify(new SendOtpNotify());
            return redirect()->route('showEnterOtp', ['email' => $civ->email , 'type' => $request->type]);
        }
        if ($request->type == 'donor') {
            $donor = Donor::where('email', $request->email)->first();
            if (!$donor) {
                return redirect()->back()->withErrors(['email' => 'Enter your email correctly']);
            }
            $donor->notify(new SendOtpNotify());
            return redirect()->route('showEnterOtp', ['email' => $donor->email , 'type' => $request->type]);
        }
        if ($request->type == 'admin') {
            $admin = Admin::where('email', $request->email)->first();
            if (!$admin) {
                return redirect()->back()->withErrors(['email' => 'Enter your email correctly']);
            }
            $admin->notify(new SendOtpNotify());
            return redirect()->route('showEnterOtp', ['email' => $admin->email , 'type' => $request->type]);
        }
    }

    public function showEnterOtp($email,$type)
    {
        return view('Auth.Reset.code', compact('email','type'));
    }

    public function checkOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'token' => ['required', 'min:5'],
            'type' => ['required', 'in:admin,civilian,donor,ngo']
        ]);

        $otp = (new Otp)->validate($request->email, $request->token);
        if ($otp->status == false) {
            return redirect()->back()->withErrors(['token' => 'Invalid code']);
        }

        return redirect()->route('showResetPassword', ['email' => $request->email , 'type' => $request->type]);
    }
}