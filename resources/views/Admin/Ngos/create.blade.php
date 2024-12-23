@extends('Layouts.app')

@section('title')
    Create Ngo
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Create New Ngo</h2>

        <form action="{{ route('admin.ngos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input id="name" class="form-control border-primary" placeholder="Enter Name" type="text" name="name" required>
                @error('name')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input id="email" class="form-control border-primary" placeholder="Enter Email" type="email" name="email" required>
                @error('email')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea class="form-control border-primary" name="description" id="description" rows="5" required></textarea>
                @error('description')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label fw-bold">Address</label>
                <input id="address" class="form-control border-primary" placeholder="Enter Address" type="text" name="address" required>
                @error('address')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label fw-bold">Phone</label>
                <input id="phone" class="form-control border-primary" placeholder="Enter Phone" type="text" name="phone" required>
                @error('phone')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label fw-bold">Logo</label>
                <input type="file" id="logo" name="logo" class="form-control border-primary" required>
                @error('logo')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password</label>
                <input id="password" class="form-control border-primary" placeholder="Enter Password" type="password" name="password" required>
                @error('password')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                <input id="password_confirmation" class="form-control border-primary" placeholder="Enter Password Confirmation" type="password" name="password_confirmation" required>
                @error('password_confirmation')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a class="btn btn-danger" href="{{ route('admin.ngos.index') }}">Back to Ngos</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <br>
@endsection
