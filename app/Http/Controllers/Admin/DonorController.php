<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DonorRequest;
use App\Models\Country;
use App\Models\Donor;
use App\Traits\DeletionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DonorController extends Controller
{
    use DeletionRequest;

    public function __construct()
    {
        $this->middleware('can:donors');
    }

    public function index(Request $request)
    {
        $query = Donor::with('country');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('country_id')) {
            $query->where('country_id', $request->country_id);
        }

        $donors = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Admin.Donors.list', compact('donors'))->render());
        }

        $countries = Country::select('id', 'name')->get();
        return view('Admin.Donors.index', compact('donors', 'countries'));
    }

    public function create()
    {
        $countries = Country::select('id', 'name')->get();
        return view('Admin.Donors.create', compact('countries'));
    }

    public function store(DonorRequest $request)
    {
        $request->validated();

        $donor = Donor::create(array_merge(
            $request->only(['name', 'email', 'country_id', 'phone']),
            [
                'password' => Hash::make($request->password),
            ]
        ));

        return redirect()->route('admin.donors.index')->with('success', 'Donor Created Successfully');
    }

    public function show($id)
    {
        $donor = Donor::findOrFail($id);
        $countries = Country::select('id', 'name')->get();
        return view('Admin.Donors.show', compact('donor', 'countries'));
    }

    public function destroy(Request $request)
    {
        return $this->deletionRequest($request, 'donor_id', Donor::class);
    }
}