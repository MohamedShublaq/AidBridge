<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use App\Models\Aid;
use App\Models\NgosDonors;
use App\Models\NgosUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $ngoId = Auth::guard('ngo')->user()->id;

        $civPending = NgosUsers::where('ngo_id',$ngoId)->where('status',NgosUsers::PENDING)->count();
        $civApproved = NgosUsers::where('ngo_id',$ngoId)->where('status',NgosUsers::APPROVED)->count();
        $civRejected = NgosUsers::where('ngo_id',$ngoId)->where('status',NgosUsers::REJECTED)->count();
        $civDeleted = NgosUsers::where('ngo_id',$ngoId)->onlyTrashed()->count();

        $donorPending = NgosDonors::where('ngo_id',$ngoId)->where('status',NgosDonors::PENDING)->count();
        $donorApproved = NgosDonors::where('ngo_id',$ngoId)->where('status',NgosDonors::APPROVED)->count();
        $donorRejected = NgosDonors::where('ngo_id',$ngoId)->where('status',NgosDonors::REJECTED)->count();
        $donorDeleted = NgosDonors::where('ngo_id',$ngoId)->onlyTrashed()->count();

        $aids = Aid::where('ngo_id',$ngoId)->count();

        return view('Ngo.dashboard' , compact('civPending','civApproved','civRejected','civDeleted','donorPending','donorApproved','donorRejected','donorDeleted','aids'));
    }
}