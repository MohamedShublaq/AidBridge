@extends('Layouts.app')

@section('title')
    Profile
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Update Profile</h2>

        <form action="{{ route('ngo.updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-center mb-4">
                <img src="{{ asset('uploads/Ngos/'. $ngo->logo) }}" alt="NGO Logo" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input id="name" class="form-control border-primary" value="{{ $ngo->name }}" placeholder="Enter Name"
                    type="text" name="name" required>
                @error('name')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input id="email" class="form-control border-primary" value="{{ $ngo->email }}"
                    placeholder="Enter Email" type="email" name="email" required>
                @error('name')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea class="form-control border-primary" name="description" id="description" rows="5" required>{{ $ngo->description }}</textarea>
                @error('description')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label fw-bold">Address</label>
                <input id="address" class="form-control border-primary" value="{{ $ngo->address }}"
                    placeholder="Enter Address" type="text" name="address" required>
                @error('address')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label fw-bold">Phone</label>
                <input id="phone" class="form-control border-primary" value="{{ $ngo->phone }}"
                    placeholder="Enter Phone" type="text" name="phone" required>
                @error('phone')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label fw-bold">Logo</label>
                <input class="form-control border-primary" type="file" name="logo" id="logo" required>
                @error('logo')
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
