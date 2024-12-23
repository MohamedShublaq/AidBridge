@extends('Auth.parent')
@section('title', 'Reset Password')
@section('content')
    <div class="login-container">
        <img src="{{ asset('img/logo.jpg') }}" alt="logo" class="login-image">
        <h2 class="login-title">Reset Your Password</h2>
        <form method="POST" action="{{ route('resetPassword') }}">
            @csrf
            <input type="hidden" value="{{ $type }}" name="type" required>
            <div class="form-group">
                <input hidden type="email" id="email" name="email" value="{{ $email }}" class="form-control" required>
                @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                @error('password_confirmation')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-login w-100 mt-3">Reset</button>
        </form>
    </div>
@endsection
