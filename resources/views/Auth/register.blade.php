@extends('Auth.parent')
@section('title', 'Register')
@section('content')
    <div class="register-container">
        <img src="{{ asset('img/logo.jpg') }}" alt="logo" class="login-image">
        <h2 class="login-title">Register</h2>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                        @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                        @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="id_number">Id Number</label>
                        <input type="text" id="id_number" name="id_number" class="form-control" required>
                        @error('id_number')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="id_photo">ID photo</label>
                        <input type="file" id="id_photo" name="id_photo" class="form-control" required>
                        @error('id_photo')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control" required>
                            <option selected disabled value="">Select Your Gender</option>
                            <option value="{{ App\Models\User::MALE }}">Male</option>
                            <option value="{{ App\Models\User::FEMALE }}">Female</option>
                        </select>
                        @error('gender')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" id="age" name="age" class="form-control" required>
                        @error('age')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="marital_status">Marital Status</label>
                        <select name="marital_status" id="marital_status" class="form-control" required>
                            <option selected disabled value="">Select Your Status</option>
                            <option value="{{ App\Models\User::SINGLE }}">Single</option>
                            <option value="{{ App\Models\User::MARRIED }}">Married</option>
                            <option value="{{ App\Models\User::DIVORCED }}">Divorced</option>
                            <option value="{{ App\Models\User::WIDOWED }}">Widowed</option>
                        </select>
                        @error('marital_status')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6" id="childrens-container" style="display: none;">
                    <div class="form-group">
                        <label for="childrens">Num of Childrens</label>
                        <select name="childrens" id="childrens" class="form-control">
                            <option selected disabled value="">Select The Number</option>
                            @foreach (range(0, 15) as $number)
                                <option value="{{ $number }}">{{ $number }}</option>
                            @endforeach
                        </select>
                        @error('childrens')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="country_id">Country</label>
                        <select name="country_id" id="country_id" class="form-control" required>
                            <option selected disabled value="">Select Your Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" class="form-control" required>
                        @error('city')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" id="street" name="street" class="form-control" required>
                        @error('street')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control" required>
                        @error('phone')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                        @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="password_confirmation">Confirm password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control" required>
                        @error('password_confirmation')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-login w-100 mt-3">Register</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const maritalStatus = document.getElementById('marital_status');
            const childrensContainer = document.getElementById('childrens-container');

            maritalStatus.addEventListener('change', function() {
                if (this.value != '{{ App\Models\User::SINGLE }}') {
                    childrensContainer.style.display = 'block';
                } else {
                    childrensContainer.style.display = 'none';
                    document.getElementById('childrens').value = '';
                }
            });
        });
    </script>
@endsection
