<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use App\Models\Ngo;
use App\Models\NgosDonors;
use App\Models\NgosUsers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $ngos = Ngo::whereHas('donors', function ($query) {
            $query->where('donors.id', auth('donor')->user()->id)
                ->whereNull('ngos_donors.deleted_at');
        })
        ->orWhereDoesntHave('donors', function ($query) {
            $query->where('donors.id', auth('donor')->user()->id);
        })
        ->select('id', 'name', 'logo')
        ->latest()
        ->paginate(12);

        return view('Donor.dashboard' , compact('ngos'));
    }

    public function apply(Request $request)
    {
        $donor = Donor::findOrFail(auth('donor')->user()->id);
        $rejectedBefore = NgosDonors::where('donor_id', $donor->id)->where('ngo_id', $request->ngo_id)->where('rejected_at', '!=', null)->first();
        if ($rejectedBefore) {
            $rejectedBefore->update([
                'status' => NgosDonors::PENDING,
                'rejected_at' => null,
            ]);
        } else {
            $donor->ngos()->attach($request->ngo_id, ['status' => NgosUsers::PENDING]);
        }
        return redirect()->back()->with('success', 'Wait For Approval');
    }
}
