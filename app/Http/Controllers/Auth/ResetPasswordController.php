<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Donor;
use App\Models\Ngo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showResetPassword($email, $type)
    {
        return view('Auth.Reset.password', compact('email', 'type'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'type' => ['required', 'in:admin,civilian,donor,ngo'],
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required'],
        ]);

        if ($request->type == 'ngo') {
            $ngo = Ngo::where('email', $request->email)->first();

            if (!$ngo) {
                return redirect()->back()->with('error','Try again!');
            }
            $ngo->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('showLogin',$request->type);
        }
        if ($request->type == 'civilian') {
            $civ = User::where('email', $request->email)->first();

            if (!$civ) {
                return redirect()->back()->with('error','Try again!');
            }
            $civ->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('showLogin',$request->type);
        }
        if ($request->type == 'donor') {
            $donor = Donor::where('email', $request->email)->first();

            if (!$donor) {
                return redirect()->back()->with('error','Try again!');
            }
            $donor->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('showLogin',$request->type);
        }
        if ($request->type == 'admin') {
            $admin = Admin::where('email', $request->email)->first();

            if (!$admin) {
                return redirect()->back()->with('error','Try again!');
            }
            $admin->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('showLogin',$request->type);
        }
    }
}