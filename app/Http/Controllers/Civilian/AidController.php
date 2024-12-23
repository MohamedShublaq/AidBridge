<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Civilian\AidRequest;
use App\Models\Aid;
use App\Models\AidDistribution;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class AidController extends Controller
{
    public function show($id)
    {
        $aid = Aid::findOrFail($id);
        return view('Civilian.Aids.show' , compact('aid'));
    }

    public function response(AidRequest $request)
    {
        $request->validated();

        $notification = auth('web')->user()->unreadNotifications()
            ->where('type','NewAidNotification')
            ->where('data->showAidLink', route('civilian.aids.show', $request->aid_id))
            ->first();

        if ($notification) {
            $notification->markAsRead();
        }

        if($request->response == 0){
            return redirect()->route('civilian.home')->with('success' , 'You Declined Aid!');
        }

        $req = ModelsRequest::create($request->only(['aid_id','user_id']));
        if(!$req){
            return redirect()->back()->with('error' , 'There is error, try again');
        }
        return redirect()->route('civilian.home')->with('success' , 'You Request Submitted Successfully');
    }

    public function showDistribution($id)
    {
        $distribution = AidDistribution::with('location')->findOrFail($id);
        return view('Civilian.Aids.showDistribution' , compact('distribution'));
    }
}