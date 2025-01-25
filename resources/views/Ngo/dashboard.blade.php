@extends('Layouts.app')
@section('title')
    Home
@endsection
@section('content')
<div class="container-fluid">
    <!-- Statistics Section -->
    <div class="statistics-section mb-5">
        <h2 class="text-center text-primary font-weight-bold">Statistics Overview</h2>
    </div>

    <!-- Civilians -->
    <div class="row">
        <!-- Pending -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pending Civilians
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $civPending }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approved -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Approved Civilians
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $civApproved }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rejected -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Rejected Civilians
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $civRejected }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deleted -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Deleted Civilians
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $civDeleted }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Donors -->
    <div class="row">
        <!-- Pending -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pending Donors
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $donorPending }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hands-helping fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approved -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Approved Donors
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $donorApproved }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hands-helping fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rejected -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Rejected Donors
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $donorRejected }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hands-helping fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deleted -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Deleted Donors
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $donorDeleted }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hands-helping fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <!-- Aids -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Aids
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $aids }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-heartbeat fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Received Aids -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Received Aids
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $receivedAids }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box-open fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Locations -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Locations
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $locations }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-map-marker-alt fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Providers -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Providers
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $providers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <!-- Aids Chart -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center font-weight-bold">
                    {{ $aidsChart->options['chart_title'] }}
                </div>
                <div class="card-body">
                    {!! $aidsChart->renderHtml() !!}
                </div>
            </div>
        </div>
        <!-- Civilians Chart -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center font-weight-bold">
                    {{ $civiliansChart->options['chart_title'] }}
                </div>
                <div class="card-body">
                    {!! $civiliansChart->renderHtml() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('style')
<style>
    .card {
        border-radius: 10px;
    }
    .card-header {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .statistics-section h2 {
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }
    .chart-title {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
</style>
@endpush

@push('js')
{!! $aidsChart->renderChartJsLibrary() !!}
{!! $aidsChart->renderJs() !!}
{!! $civiliansChart->renderJs() !!}
@endpush
