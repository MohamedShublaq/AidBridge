@extends('Layouts.app')
@section('title')
    Home
@endsection
@section('content')
    <div class="row">
        @foreach ($ngos as $ngo)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('uploads/Ngos/' . $ngo->logo) }}" alt="{{ $ngo->name }} Logo" class="card-img-top"
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $ngo->name }}</h5>

                        @php
                            $beneficiar = App\Models\NgosUsers::where('user_id', auth()->user()->id)
                                ->where('ngo_id', $ngo->id)
                                ->first();
                            $canReapply = !$beneficiar || ($beneficiar->rejected_at && now()->diffInMonths($beneficiar->rejected_at) >= 1);
                        @endphp

                        @if ($beneficiar)
                            @if ($beneficiar->status == App\Models\NgosUsers::PENDING)
                                <button class="btn btn-warning" disabled>Pending</button>
                            @elseif ($beneficiar->status == App\Models\NgosUsers::APPROVED)
                                <button class="btn btn-success" disabled>Approved</button>
                            @elseif ($beneficiar->status == App\Models\NgosUsers::REJECTED)
                                @if ($canReapply)
                                    <a href="javascript:void(0)"
                                        onclick="document.getElementById('applyForm_{{ $ngo->id }}').submit();"
                                        class="btn btn-primary">Apply Again</a>
                                @else
                                    <button class="btn btn-danger" disabled>Rejected (Try After 1 Month)</button>
                                @endif
                            @endif

                        @else
                            <a href="javascript:void(0)"
                                onclick="document.getElementById('applyForm_{{ $ngo->id }}').submit();"
                                class="btn btn-primary">Apply Now</a>
                        @endif
                        <a href="" class="btn btn-info">Show Details</a>
                        {{-- Apply Form  --}}
                        <form id="applyForm_{{ $ngo->id }}" action="{{ route('civilian.apply') }}" method="post">
                            @csrf
                            <input type="hidden" name="ngo_id" value="{{ $ngo->id }}" required>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        {{$ngos->links()}}
    </div>
@endsection
