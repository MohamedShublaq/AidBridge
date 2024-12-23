@extends('Layouts.app')

@section('title')
    Profile
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Update Profile</h2>

        <form action="{{ route('donor.updateProfile') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input id="name" class="form-control border-primary" value="{{ $donor->name }}" placeholder="Enter Name"
                    type="text" name="name" required>
                @error('name')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input id="email" class="form-control border-primary" value="{{ $donor->email }}"
                    placeholder="Enter Email" type="email" name="email" required>
                @error('name')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="country_id" class="form-label fw-bold">Country</label>
                <select name="country_id" id="country_id" class="form-control border-primary" required>
                    @foreach ($countries as $country)
                        <option @if ($country->id == $donor->country_id) selected @endif value="{{ $country->id }}">
                            {{ $country->name }}</option>
                    @endforeach
                </select>
                @error('country_id')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label fw-bold">Phone</label>
                <input id="phone" class="form-control border-primary" value="{{ $donor->phone }}"
                    placeholder="Enter Phone" type="text" name="phone" required>
                @error('phone')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <br>
@endsection
