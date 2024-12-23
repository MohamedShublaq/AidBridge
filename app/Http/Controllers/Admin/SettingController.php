<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:settings');
    }
    
    public function index()
    {
        $settings = Setting::first();
        return view('Admin.Settings.index' , compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::firstOrNew();

        $settings->email = $request->email;
        $settings->phone = $request->phone;
        $settings->street = $request->street;
        $settings->city = $request->city;
        $settings->country = $request->country;
        $settings->facebook = $request->facebook;
        $settings->twitter = $request->twitter;
        $settings->instagram = $request->instagram;
        $settings->linkedin = $request->linkedin;
        $settings->save();
        return redirect()->back()->with('success' , 'Setting Updated Successfully');
    }
}