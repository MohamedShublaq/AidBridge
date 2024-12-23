@extends('Layouts.app')

@section('title')
    Profile
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Update Profile</h2>

        <form action="{{ route('civilian.updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($civ->id_photo)
                <div class="row d-flex justify-content-center">
                    <img width="1000px" height="700px" src="{{ asset('uploads/Civilians/' . $civ->id_photo) }}" alt="Id_Photo">
                </div>
            @endif
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input id="name" class="form-control border-primary" value="{{ $civ->name }}" type="text"
                    name="name" required>
                @error('name')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input id="email" class="form-control border-primary" value="{{ $civ->email }}" type="email"
                    name="email" required>
                @error('name')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="id_number" class="form-label fw-bold">Id Number</label>
                <input id="id_number" class="form-control border-primary" value="{{ $civ->id_number }}" type="text"
                    name="id_number" required>
                @error('id_number')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="country_id" class="form-label fw-bold">Country</label>
                <select name="country_id" id="country_id" class="form-control border-primary" required>
                    @foreach ($countries as $country)
                        <option @if ($country->id == $civ->country_id) selected @endif value="{{ $country->id }}">
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
                <label for="city" class="form-label fw-bold">City</label>
                <input id="city" class="form-control border-primary" value="{{ $civ->city }}"
                    placeholder="Enter City" type="text" name="city" required>
                @error('city')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="street" class="form-label fw-bold">Street</label>
                <input id="street" class="form-control border-primary" value="{{ $civ->street }}"
                    placeholder="Enter Street" type="text" name="street" required>
                @error('street')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label fw-bold">Phone</label>
                <input id="phone" class="form-control border-primary" value="{{ $civ->phone }}"
                    placeholder="Enter Phone" type="text" name="phone" required>
                @error('phone')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            @if (!$civ->id_photo)
                <div class="mb-3">
                    <label for="id_photo" class="form-label fw-bold">Id Photo</label>
                    <input id="id_photo" class="form-control border-primary" type="file" name="id_photo" required>
                    @error('id_photo')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <br>
@endsection
