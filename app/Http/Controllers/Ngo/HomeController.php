<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use App\Models\Aid;
use App\Models\AidDistribution;
use App\Models\Location;
use App\Models\NgosDonors;
use App\Models\NgosUsers;
use App\Models\Provider;
use App\Models\Request as ModelsRequest;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    public function index()
    {
        $ngoId = Auth::guard('ngo')->user()->id;

        $civPending = NgosUsers::where('ngo_id',$ngoId)->where('status',NgosUsers::PENDING)->count();
        $civApproved = NgosUsers::where('ngo_id',$ngoId)->where('status',NgosUsers::APPROVED)->count();
        $civRejected = NgosUsers::where('ngo_id',$ngoId)->where('status',NgosUsers::REJECTED)->count();
        $civDeleted = NgosUsers::where('ngo_id',$ngoId)->onlyTrashed()->count();
        $civiliansData = compact('civPending', 'civApproved', 'civRejected', 'civDeleted');

        $donorPending = NgosDonors::where('ngo_id',$ngoId)->where('status',NgosDonors::PENDING)->count();
        $donorApproved = NgosDonors::where('ngo_id',$ngoId)->where('status',NgosDonors::APPROVED)->count();
        $donorRejected = NgosDonors::where('ngo_id',$ngoId)->where('status',NgosDonors::REJECTED)->count();
        $donorDeleted = NgosDonors::where('ngo_id',$ngoId)->onlyTrashed()->count();
        $donorsData = compact('donorPending', 'donorApproved', 'donorRejected', 'donorDeleted');

        $aids = Aid::where('ngo_id',$ngoId)->count();
        $locations = Location::where('ngo_id',$ngoId)->count();
        $providers = Provider::where('ngo_id',$ngoId)->count();
        $receivedAids = ModelsRequest::whereHas('aid' , function($q) use ($ngoId){
                            $q->where('ngo_id',$ngoId);
                        })
                        ->whereHas('aidDistributions' , function($q){
                            $q->where('status',AidDistribution::RECEIVED);
                        })->count();
        $otherData = compact('aids', 'locations', 'providers', 'receivedAids');

        //Aids Charts
        $chart_aids_options = [
            'chart_title' => 'Aids by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Aid',
            'where_raw' => 'ngo_id = ' . $ngoId,
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 365,
        ];
        $aidsChart = new LaravelChart($chart_aids_options);

        // Civilians Charts
        $chart_civilians_options = [
            'chart_title' => 'Civilians by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\NgosUsers',
            'where_raw' => 'ngo_id = ' . $ngoId . ' AND status = ' . \App\Models\NgosUsers::APPROVED,
            'group_by_field' => 'updated_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'updated_at',
            'filter_days' => 365,
        ];
        $civiliansChart = new LaravelChart($chart_civilians_options);
        $chartsData = compact('aidsChart', 'civiliansChart');
        return view('Ngo.dashboard', array_merge($civiliansData, $donorsData, $chartsData, $otherData));
    }
}
