@extends('Layouts.app')

@section('title')
    Change Password
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Change Your Password</h2>

        <form action="{{ route('civilian.changePassword') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="old_password" class="form-label fw-bold">Old Password</label>
                <input id="old_password" class="form-control border-primary" placeholder="Enter Old Password" type="password" name="old_password" required>
                @error('old_password')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-bold">New Password</label>
                <input id="password" class="form-control border-primary" placeholder="Enter New Password" type="password" name="password" required>
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
