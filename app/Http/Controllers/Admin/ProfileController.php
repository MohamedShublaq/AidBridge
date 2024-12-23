<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\Admin;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $admin = Auth::guard('admin')->user();
        $countries = Country::select('id','name')->get();
        return view('Admin.Profile.profile' , compact('admin','countries'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $request->validated();
        $admin = Admin::findOrFail(auth('admin')->user()->id);
        $admin->update($request->only([
            'name','email'
        ]));
        return redirect()->back()->with('success','Profile Updated Successfully');
    }

    public function showChangePassword()
    {
        return view('Admin.Profile.changePassword');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $request->validated();
        $admin = Admin::findOrFail(auth('admin')->user()->id);

        if (!Hash::check($request->old_password, $admin->password)) {
            return redirect()->back()->with('error', 'Enter Your Old Password Correctly');
        }

        $admin->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect()->back()->with('success', 'Password Updated Successfully');
    }
}