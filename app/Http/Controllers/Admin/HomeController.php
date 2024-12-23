<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aid;
use App\Models\Donor;
use App\Models\Ngo;
use App\Models\User;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    public function index()
    {
        $civCount = User::count();
        $donCount = Donor::count();
        $ngoCount = Ngo::count();
        $aidCount = Aid::count();

        //Civilians Chart
        $chart_civilians_options = [
            'chart_title' => 'Civilians by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 365,
        ];
        $civiliansChart = new LaravelChart($chart_civilians_options);

        //Donors Chart
        $chart_donors_options = [
            'chart_title' => 'Donors by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Donor',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 365,
        ];
        $donorsChart = new LaravelChart($chart_donors_options);

        //Ngos Charts
        $chart_ngos_options = [
            'chart_title' => 'NGOs by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Ngo',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_days' => 365,
        ];
        $ngosChart = new LaravelChart($chart_ngos_options);

        //Aids Charts
        $chart_aids_options = [
            'chart_title' => 'Aids by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Aid',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_days' => 365,
        ];
        $aidsChart = new LaravelChart($chart_aids_options);

        return view('Admin.dashboard', compact('civCount', 'donCount', 'ngoCount', 'aidCount', 'civiliansChart', 'donorsChart', 'ngosChart', 'aidsChart'));
    }
}