@extends('Auth.parent')
@section('title', 'Forget Password')
@section('content')
    <div class="login-container">
        <img src="{{ asset('img/logo.jpg') }}" alt="logo" class="login-image">
        <h2 class="login-title">Enter Your Code</h2>
        <form method="POST" action="{{ route('checkOtp') }}">
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
                <label for="token">Code</label>
                <input  type="text" id="token" name="token" class="form-control" required>
                @error('token')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-login w-100 mt-3">Submit</button>
        </form>
    </div>
@endsection
