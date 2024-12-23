@extends('Auth.parent')
@section('title', 'Login')
@section('content')
    <div class="login-container">
        <img src="{{ asset('img/logo.jpg') }}" alt="logo" class="login-image">
        <h2 class="login-title">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" value="{{ $type }}" name="type">
            @if($type == 'civilian')
                <div class="form-group">
                    <label for="email">Email or ID Number</label>
                    <input type="text" id="email" name="email" class="form-control" required>
                    @error('email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @else
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                    @error('email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" name="remember"> Remember Me
                </label>
                <a href="{{ route('showEnterEmail',$type) }}" class="forgot-password">Forgot Password?</a>
            </div>
            <button type="submit" class="btn btn-login w-100 mt-3">Login</button>
        </form>

        @if($type == 'civilian')
            <div class="register-link">
                <p>Don't have an account?</p>
                <a href="{{ route('showRegister') }}" class="btn btn-register w-100">Register</a>
            </div>
        @endif
    </div>
@endsection
