<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Donor\ProfileRequest;
use App\Models\Country;
use App\Models\Donor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $donor = Auth::guard('donor')->user();
        $countries = Country::select('id', 'name')->get();
        return view('Donor.Profile.profile', compact('donor', 'countries'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $request->validated();
        $donor = Donor::findOrFail(auth('donor')->user()->id);
        $donor->update($request->only([
            'name',
            'email',
            'country_id',
            'phone'
        ]));
        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }

    public function showChangePassword()
    {
        return view('Donor.Profile.changePassword');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $request->validated();
        $donor = Donor::findOrFail(auth('donor')->user()->id);

        if (!Hash::check($request->old_password, $donor->password)) {
            return redirect()->back()->with('error', 'Enter Your Old Password Correctly');
        }

        $donor->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect()->back()->with('success', 'Password Updated Successfully');
    }
}