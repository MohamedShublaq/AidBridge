<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Traits\DeletionRequest;
use Illuminate\Http\Request;

class CivilianController extends Controller
{
    use DeletionRequest;

    public function __construct()
    {
        $this->middleware('can:civilians');
    }

    public function index(Request $request)
    {
        $query = User::with('country');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('id_number')) {
            $query->where('id_number', 'like', '%' . $request->id_number . '%');
        }

        if ($request->filled('marital_status')) {
            $query->where('marital_status', $request->marital_status);
        }

        if ($request->filled('childrens')) {
            $query->where('childrens', $request->childrens);
        }

        if ($request->filled('country_id')) {
            $query->where('country_id', $request->country_id);
        }

        if ($request->filled('age')) {
            $query->where('age', $request->age);
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        
        if ($request->filled('joining_way')) {
            $query->where('joining_way', $request->joining_way);
        }

        $civilians = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Admin.Civilians.list', compact('civilians'))->render());
        }

        $countries = Country::select('id', 'name')->get();
        return view('Admin.Civilians.index', compact('civilians', 'countries'));
    }


    public function show($id)
    {
        $civ = User::findOrFail($id);
        $countries = Country::select('id', 'name')->get();
        return view('Admin.Civilians.show', compact('civ', 'countries'));
    }

    public function destroy(Request $request)
    {
        return $this->deletionRequest($request, 'civ_id', User::class);
    }
}
