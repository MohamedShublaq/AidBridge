<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ngo\LocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $query = Location::where('ngo_id' , auth('ngo')->user()->id);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $locations = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Ngo.Locations.list', compact('locations'))->render());
        }
        return view('Ngo.Locations.index' , compact('locations'));
    }

    public function store(LocationRequest $request)
    {
        $request->validated();
        $location = Location::create($request->only(['name','ngo_id']));
        if(!$location){
            return redirect()->back()->with('error' , 'There is a problem, try again.');
        }
        return redirect()->back()->with('success' , 'Location Created Successfully');
    }

    public function update(LocationRequest $request, $id)
    {
        $request->validated();
        $location = Location::findOrFail($id);
        $location->update($request->only(['name','ngo_id']));
        return redirect()->back()->with('success' , 'Location Updated Successfully');
    }

    public function destroy(Request $request)
    {
        Location::destroy($request->location_id);
        return redirect()->back()->with('success' , 'Location Deleted Successfully');
    }
}