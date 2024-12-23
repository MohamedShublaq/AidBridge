<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use App\Models\AidDistribution;
use Illuminate\Http\Request;

class AidDistributionController extends Controller
{
    public function changeStatus(Request $request)
    {
        $request->validate([
            'distribution_id' => ['required','exists:aid_distributions,id'],
        ]);
        $aidDistribution = AidDistribution::findOrFail($request->distribution_id);

        $aidDistribution->update([
            'status' => $aidDistribution->status == AidDistribution::RECEIVED
                ? AidDistribution::NOT_RECEIVED
                : AidDistribution::RECEIVED,
        ]);

        return redirect()->back()->with('success', 'Status Was Changed Successfully');
    }
}