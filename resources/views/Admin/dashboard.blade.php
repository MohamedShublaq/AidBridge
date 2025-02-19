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

    <div class="row">
        <!-- Civilians -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Civilians
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $civCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donors -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Donors
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $donCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hands-helping fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NGOs -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                NGOs
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $ngoCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-globe fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aids -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Aids
                            </div>
                            <div class="h4 font-weight-bold text-gray-800">{{ $aidCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-heartbeat fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <!-- Civilians Chart -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center font-weight-bold">
                    {{ $civiliansChart->options['chart_title'] }}
                </div>
                <div class="card-body">
                    {!! $civiliansChart->renderHtml() !!}
                </div>
            </div>
        </div>

        <!-- Donors Chart -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center font-weight-bold">
                    {{ $donorsChart->options['chart_title'] }}
                </div>
                <div class="card-body">
                    {!! $donorsChart->renderHtml() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- NGOs Chart -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-info text-white text-center font-weight-bold">
                    {{ $ngosChart->options['chart_title'] }}
                </div>
                <div class="card-body">
                    {!! $ngosChart->renderHtml() !!}
                </div>
            </div>
        </div>

        <!-- Aids Chart -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-warning text-white text-center font-weight-bold">
                    {{ $aidsChart->options['chart_title'] }}
                </div>
                <div class="card-body">
                    {!! $aidsChart->renderHtml() !!}
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
{!! $civiliansChart->renderChartJsLibrary() !!}
{!! $civiliansChart->renderJs() !!}
{!! $donorsChart->renderJs() !!}
{!! $ngosChart->renderJs() !!}
{!! $aidsChart->renderJs() !!}
@endpush
