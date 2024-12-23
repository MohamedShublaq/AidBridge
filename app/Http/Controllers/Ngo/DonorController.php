<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DonorRequest;
use App\Models\Country;
use App\Models\Donor;
use App\Models\NgosDonors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DonorController extends Controller
{
    public function index(Request $request,$status)
    {
        $ngoId = Auth::guard('ngo')->user()->id;

        $query = NgosDonors::with(['donor','donor.country'])
            ->where('ngo_id', $ngoId)
            ->where('status', $status);

        // Apply filters
        if ($request->filled('name')) {
            $query->whereHas('donor', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('email')) {
            $query->whereHas('donor', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            });
        }

        if ($request->filled('country_id')) {
            $query->whereHas('donor.country', function ($q) use ($request) {
                $q->where('id', $request->country_id);
            });
        }

        $donors = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Ngo.Donors.list', compact('donors'))->render());
        }

        $countries = Country::select('id','name')->get();
        return view('Ngo.Donors.index', compact('donors','countries','status'));
    }

    public function create()
    {
        $countries = Country::select('id','name')->get();
        return view('Ngo.Donors.create' , compact('countries'));
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

        $donor->ngos()->attach(Auth::guard('ngo')->user()->id, ['status' =>NgosDonors::APPROVED ]);

        return redirect()->route('ngo.donors.index' , NgosDonors::APPROVED )->with('success' , 'Donor Created Successfully');
    }

    public function approve(Request $request)
    {
        $ngoId = Auth::guard('ngo')->user()->id;
        $row = NgosDonors::where('ngo_id',$ngoId)->where('donor_id',$request->donor_id)->first();
        $row->update(['status' => NgosDonors::APPROVED]);
        return redirect()->back()->with('success','Donor Approved Successfully');
    }

    public function reject(Request $request)
    {
        $ngoId = Auth::guard('ngo')->user()->id;
        $row = NgosDonors::where('ngo_id',$ngoId)->where('donor_id',$request->donor_id)->first();
        $row->update([
            'status' => NgosDonors::REJECTED,
            'rejected_at' => now(),
        ]);
        return redirect()->back()->with('success','Donor Rejected Successfully');
    }

    public function show($id)
    {
        $donor = Donor::findOrFail($id);
        $countries = Country::select('id','name')->get();
        return view('Ngo.Donors.show' , compact('donor' , 'countries'));
    }

    public function destroy(Request $request)
    {
        NgosDonors::findOrFail($request->donor_id)->delete();
        return redirect()->back()->with('success','Donor Deleted Successfully');
    }

    public function showTrashed(Request $request)
    {
        $ngoId = Auth::guard('ngo')->user()->id;

        $query = NgosDonors::onlyTrashed()->with(['donor','donor.country'])->where('ngo_id', $ngoId);

        // Apply filters
        if ($request->filled('name')) {
            $query->whereHas('donor', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('email')) {
            $query->whereHas('donor', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            });
        }

        if ($request->filled('country_id')) {
            $query->whereHas('donor.country', function ($q) use ($request) {
                $q->where('id', $request->country_id);
            });
        }

        $donors = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Ngo.Donors.listTrashed', compact('donors'))->render());
        }

        $countries = Country::select('id','name')->get();
        return view('Ngo.Donors.trashed', compact('donors','countries'));
    }

    public function restore(Request $request)
    {
        NgosDonors::onlyTrashed()->findOrFail($request->donor_id)->restore();
        $donor = NgosDonors::findOrFail($request->donor_id);
        $donor->update(['status' => NgosDonors::PENDING]);
        return redirect()->back()->with('success','Donor Restored Successfully');
    }
}