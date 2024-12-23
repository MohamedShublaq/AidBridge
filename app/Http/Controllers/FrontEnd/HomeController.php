<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\ContactRequest;
use App\Models\Admin;
use App\Models\Aid;
use App\Models\Authorization;
use App\Models\Contact;
use App\Models\Donor;
use App\Models\Ngo;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\ContactNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function home()
    {
        $civiliansCount = User::count();
        $donorsCount = Donor::count();
        $ngosCount = Ngo::count();
        $aidsCount = Aid::count();
        $setting = Setting::first();
        return view('FrontEnd.home' , compact('civiliansCount','donorsCount','ngosCount','aidsCount','setting'));
    }

    public function contact(ContactRequest $request)
    {
        $request->validated();

        $contact = Contact::create($request->only(['name','email','phone','body']));

        if(!$contact){
            return redirect()->back()->with('error' , 'There was a problem, try again!');
        }

        $rolesIds = Authorization::whereJsonContains('permissions', 'contacts')->pluck('id');
        $admins = Admin::whereIn('role_id', $rolesIds)->get();
        Notification::send($admins , new ContactNotification($contact));

        return redirect()->back()->with('success' , 'Contact Submitted Successfully');
    }
}