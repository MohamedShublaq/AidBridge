@extends('Layouts.app')

@section('title')
    Setting
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Update Setting</h2>
        <form action="{{ route('admin.updateSetting') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input id="email" class="form-control border-primary" value="{{ $settings->email ?? '' }}"
                            placeholder="Enter Email" type="email" name="email" required>
                        @error('email')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-bold">Phone</label>
                        <input id="phone" class="form-control border-primary" value="{{ $settings->phone ?? '' }}"
                            placeholder="Enter Phone" type="text" name="phone" required>
                        @error('phone')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="mb-3">
                        <label for="country" class="form-label fw-bold">Country</label>
                        <input id="country" class="form-control border-primary" value="{{ $settings->country ?? '' }}"
                            placeholder="Enter Country" type="text" name="country" required>
                        @error('country')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="city" class="form-label fw-bold">City</label>
                        <input id="city" class="form-control border-primary" value="{{ $settings->city ?? '' }}"
                            placeholder="Enter City" type="text" name="city" required>
                        @error('city')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="street" class="form-label fw-bold">Street</label>
                        <input id="street" class="form-control border-primary" value="{{ $settings->street ?? '' }}"
                            placeholder="Enter Street" type="text" name="street" required>
                        @error('street')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="facebook" class="form-label fw-bold">Facebook</label>
                        <input id="facebook" class="form-control border-primary" value="{{ $settings->facebook ?? '' }}"
                            placeholder="Enter Facebook Url" type="text" name="facebook" required>
                        @error('facebook')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="twitter" class="form-label fw-bold">Twitter</label>
                        <input id="twitter" class="form-control border-primary" value="{{ $settings->twitter ?? '' }}"
                            placeholder="Enter Twitter Url" type="text" name="twitter" required>
                        @error('twitter')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="instagram" class="form-label fw-bold">Instagram</label>
                        <input id="instagram" class="form-control border-primary" value="{{ $settings->instagram ?? '' }}"
                            placeholder="Enter Instagram Url" type="text" name="instagram" required>
                        @error('instagram')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="linkedin" class="form-label fw-bold">Linkedin</label>
                        <input id="linkedin" class="form-control border-primary"
                            value="{{ $settings->linkedin ?? '' }}" placeholder="Enter Linkedin Url" type="text"
                            name="linkedin" required>
                        @error('linkedin')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div><br>
@endsection
