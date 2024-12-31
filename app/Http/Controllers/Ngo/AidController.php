<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ngo\AidRequest;
use App\Models\Aid;
use App\Models\Ngo;
use App\Models\NgosUsers;
use App\Models\User;
use App\Notifications\NewAidNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AidController extends Controller
{

    public function index(Request $request)
    {
        $query = Aid::where('ngo_id', Auth::guard('ngo')->user()->id);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('description')) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $aids = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Ngo.Aids.list', compact('aids'))->render());
        }
        return view('Ngo.Aids.index', compact('aids'));
    }


    public function create()
    {
        $ngo = Ngo::findOrFail(auth('ngo')->user()->id);
        return view('Ngo.Aids.create' , compact('ngo'));
    }


    public function store(AidRequest $request)
    {
        $request->validated();

        $aid = Aid::create($request->only(['name', 'description', 'type', 'quantity', 'from', 'due', 'ngo_id']));

        if (!$aid) {
            return redirect()->back()->with('error', 'There was a problem');
        }

        //Store in aid_locations table
        $aid->locations()->attach($request->locations);

        $civiliansIds = NgosUsers::where('ngo_id' , auth('ngo')->user()->id)->where('status' , NgosUsers::APPROVED)->pluck('user_id');
        $civilians = User::whereIn('id' , $civiliansIds)->get();
        Notification::send($civilians , new NewAidNotification($aid));
        return redirect()->route('ngo.aids.index')->with('success', 'Aid Created Successfully');
    }


    public function edit($id)
    {
        $aid = Aid::findOrFail($id);
        $ngo = Ngo::findOrFail(auth('ngo')->user()->id);
        $locationsIds = $aid->aidLocations()->pluck('location_id')->toArray();
        return view('Ngo.Aids.edit', compact('aid','ngo','locationsIds'));
    }


    public function update(AidRequest $request, $id)
    {
        $request->validated();

        $aid = Aid::findOrFail($id);
        $aid->update($request->only(['name', 'description', 'type', 'quantity', 'from', 'due', 'ngo_id']));

        // update aid_locations table
        if (isset($request->locations)) {
            $aid->locations()->sync($request->locations);
        } else {
            $aid->locations()->sync(array());
        }

        return redirect()->route('ngo.aids.index')->with('success', 'Aid Updated Successfully');
    }


    public function destroy(Request $request)
    {
        Aid::destroy($request->aid_id);
        return redirect()->back()->with('success', 'Aid Deleted Successfully');
    }
}