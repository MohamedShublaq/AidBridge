<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use App\Models\NgosDonors;
use Illuminate\Http\Request;

class NgoController extends Controller
{
    public function index(Request $request,$status)
    {
        $donorId = auth('donor')->user()->id;
        $query = NgosDonors::with('ngo')
            ->where('donor_id', $donorId)
            ->where('status', $status);

        // Apply filters
        if ($request->filled('name')) {
            $query->whereHas('ngo', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('email')) {
            $query->whereHas('ngo', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            });
        }

        if ($request->filled('description')) {
            $query->whereHas('ngo', function ($q) use ($request) {
                $q->where('description', 'like', '%' . $request->description . '%');
            });
        }

        $ngos = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Donor.Ngos.list', compact('ngos'))->render());
        }
        return view('Donor.Ngos.index', compact('ngos','status'));
    }
}