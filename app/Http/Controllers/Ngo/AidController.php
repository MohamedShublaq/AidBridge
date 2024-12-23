<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ngo\AidRequest;
use App\Models\Aid;
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
        return view('Ngo.Aids.create');
    }


    public function store(AidRequest $request)
    {
        $request->validated();

        $aid = Aid::create($request->only(['name', 'description', 'type', 'quantity', 'ngo_id']));

        if (!$aid) {
            return redirect()->back()->with('error', 'There was a problem');
        }

        foreach ($request->locations as $location) {
            $aid->locations()->create([
                'name' => $location,
            ]);
        }
        $civiliansIds = NgosUsers::where('ngo_id' , auth('ngo')->user()->id)->where('status' , NgosUsers::APPROVED)->pluck('user_id');
        $civilians = User::whereIn('id' , $civiliansIds)->get();
        Notification::send($civilians , new NewAidNotification($aid));
        return redirect()->route('ngo.aids.index')->with('success', 'Aid Created Successfully');
    }


    public function edit($id)
    {
        $aid = Aid::findOrFail($id);
        return view('Ngo.Aids.edit', compact('aid'));
    }


    public function update(AidRequest $request, $id)
    {
        $request->validated();

        $aid = Aid::findOrFail($id);
        $aid->update($request->only(['name', 'description', 'type', 'quantity', 'ngo_id']));

        // Update locations
        $existingLocationIds = $aid->locations->pluck('id')->toArray();
        $newLocations = $request->locations;
        $newLocationIds = [];

        foreach ($newLocations as $locationName) {
            // Find existing location or create a new one
            $location = $aid->locations()->updateOrCreate(
                ['name' => $locationName],
                ['name' => $locationName]
            );
            $newLocationIds[] = $location->id;
        }

        // Remove old locations that are no longer attached to this aid
        $locationsToDetach = array_diff($existingLocationIds, $newLocationIds);
        $aid->locations()->whereIn('id', $locationsToDetach)->delete();

        return redirect()->route('ngo.aids.index')->with('success', 'Aid Updated Successfully');
    }


    public function destroy(Request $request)
    {
        Aid::destroy($request->aid_id);
        return redirect()->back()->with('success', 'Aid Deleted Successfully');
    }
}