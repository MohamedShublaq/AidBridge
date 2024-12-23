<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin($type)
    {
        return view('Auth.login', compact('type'));
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        $type = $request->type;
        $credentials = ['password' => $request->password];
        $remember = $request->has('remember');

        switch ($type) {
            case 'civilian':

                $credentials['email'] = $request->email;
                if (Auth::guard('web')->attempt($credentials, $remember)) {
                    return redirect(RouteServiceProvider::CIVILIAN);
                }

                unset($credentials['email']);
                $credentials['id_number'] = $request->email;
                if (Auth::guard('web')->attempt($credentials, $remember)) {
                    return redirect(RouteServiceProvider::CIVILIAN);
                }
                break;

            case 'donor':
                $credentials['email'] = $request->email;
                if (Auth::guard('donor')->attempt($credentials, $remember)) {
                    return redirect(RouteServiceProvider::DONOR);
                }
                break;

            case 'admin':
                $credentials['email'] = $request->email;
                if (Auth::guard('admin')->attempt($credentials, $remember)) {
                    return redirect(RouteServiceProvider::ADMIN);
                }
                break;

            case 'ngo':
                $credentials['email'] = $request->email;
                if (Auth::guard('ngo')->attempt($credentials, $remember)) {
                    return redirect(RouteServiceProvider::NGO);
                }
                break;
        }
        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            return redirect()->route('showLogin', 'civilian');
        }
        if (Auth::guard('donor')->check()) {
            Auth::guard('donor')->logout();
            return redirect()->route('showLogin', 'donor');
        }
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect()->route('showLogin', 'admin');
        }
        if (Auth::guard('ngo')->check()) {
            Auth::guard('ngo')->logout();
            return redirect()->route('showLogin', 'ngo');
        }
    }
}