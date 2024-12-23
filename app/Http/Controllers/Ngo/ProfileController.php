<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Ngo\ProfileRequest;
use App\Models\Ngo;
use App\Traits\FilesManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use FilesManager;

    public function showProfile()
    {
        $ngo = Auth::guard('ngo')->user();
        return view('Ngo.Profile.profile', compact('ngo'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $request->validated();
        $ngo = Ngo::findOrFail(auth('ngo')->user()->id);
        //Delete Old Logo From Local
        $this->deleteFile($request, $ngo, 'logo', 'Ngos', 'uploads');

        $ngo->update($request->only([
            'name',
            'description',
            'email',
            'address',
            'phone'
        ]));
        //Update Logo In Local and Database
        $this->uploadFile($request, $ngo, 'logo', 'Ngos', 'uploads');

        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }

    public function showChangePassword()
    {
        return view('Ngo.Profile.changePassword');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $request->validated();
        $ngo = Ngo::findOrFail(auth('ngo')->user()->id);

        if (!Hash::check($request->old_password, $ngo->password)) {
            return redirect()->back()->with('error', 'Enter Your Old Password Correctly');
        }

        $ngo->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect()->back()->with('success', 'Password Updated Successfully');
    }
}