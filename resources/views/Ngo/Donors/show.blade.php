@extends('Layouts.app')

@section('title')
    Show Donor
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Data for {{ $donor->name }}</h2>

        <form>
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input id="name" class="form-control border-primary" value="{{ $donor->name }}" disabled
                    placeholder="Enter Name" type="text" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input id="email" class="form-control border-primary" value="{{ $donor->email }}" disabled
                    placeholder="Enter Email" type="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="country_id" class="form-label fw-bold">Country</label>
                <select name="country_id" id="country_id" disabled class="form-control border-primary" required>
                    @foreach ($countries as $country)
                        <option @if ($country->id == $donor->country_id) disabled selected @endif value="{{ $country->id }}">
                            {{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label fw-bold">Phone</label>
                <input id="phone" class="form-control border-primary" value="{{ $donor->phone }}" disabled
                    placeholder="Enter Phone" type="text" name="phone" required>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a class="btn btn-danger" href="{{ route('ngo.donors.index', App\Models\NgosDonors::APPROVED) }}">Back to
                    Donors</a>
            </div>
        </form>
    </div>
@endsection
