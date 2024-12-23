<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Civilian\ProfileRequest;
use App\Models\Country;
use App\Models\User;
use App\Traits\FilesManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use FilesManager;

    public function showProfile()
    {
        $civ = Auth::guard('web')->user();
        $countries = Country::select('id', 'name')->get();
        return view('Civilian.Profile.profile', compact('civ', 'countries'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $request->validated();
        $civ = User::findOrFail(auth()->user()->id);
        $civ->update($request->only([
            'name',
            'email',
            'id_number',
            'country_id',
            'city',
            'street',
            'phone'
        ]));

        $this->uploadFile($request, $civ, 'id_photo', 'Civilians', 'uploads');

        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }

    public function showChangePassword()
    {
        return view('Civilian.Profile.changePassword');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $request->validated();
        $civilian = User::findOrFail(auth()->user()->id);

        if (!Hash::check($request->old_password, $civilian->password)) {
            return redirect()->back()->with('error', 'Enter Your Old Password Correctly');
        }

        $civilian->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect()->back()->with('success', 'Password Updated Successfully');
    }
}