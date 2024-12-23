@extends('Auth.parent')
@section('title', 'Forget Password')
@section('content')
    <div class="login-container">
        <img src="{{ asset('img/logo.jpg') }}" alt="logo" class="login-image">
        <h2 class="login-title">Enter Your Email</h2>
        <form method="POST" action="{{ route('sendOtp') }}">
            @csrf
            <input type="hidden" value="{{ $type }}" name="type" required>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
                @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-login w-100 mt-3">Submit</button>
        </form>
    </div>
@endsection
