@extends('Layouts.app')

@section('title')
    Show Civilian
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Data for {{ $civ->name }}@if (!$civ->id_photo)
                <p class="text-danger">ID photo has not been uploaded yet.</p>
            @endif
        </h2>

        <form>
            @if ($civ->id_photo)
                <div class="row d-flex justify-content-center">
                    <img width="1000px" height="700px" src="{{ asset('uploads/Civilians/' . $civ->id_photo) }}" alt="Id_Photo">
                </div>
            @endif
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input id="name" class="form-control border-primary" value="{{ $civ->name }}" disabled
                    type="text" name="name" required>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input id="email" class="form-control border-primary" value="{{ $civ->email }}" disabled
                            type="email" name="email" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="id_number" class="form-label fw-bold">ID Number</label>
                        <input id="id_number" class="form-control border-primary" value="{{ $civ->id_number }}" disabled
                            type="text" name="id_number" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="gender" class="form-label fw-bold">Gender</label>
                        <select name="gender" id="gender" disabled class="form-control border-primary"
                            required>
                            <option @if ($civ->gender == App\Models\User::MALE) selected @endif value="">Male</option>
                            <option @if ($civ->gender == App\Models\User::FEMALE) selected @endif value="">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="age" class="form-label fw-bold">Age</label>
                        <input id="age" class="form-control border-primary" value="{{ $civ->age }}" disabled
                            type="text" name="age" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="marital_status" class="form-label fw-bold">Marital Status</label>
                        <select name="marital_status" id="marital_status" disabled class="form-control border-primary"
                            required>
                            <option @if ($civ->marital_status == App\Models\User::SINGLE) selected @endif value="">Single</option>
                            <option @if ($civ->marital_status == App\Models\User::MARRIED) selected @endif value="">Married</option>
                            <option @if ($civ->marital_status == App\Models\User::DIVORCED) selected @endif value="">Divorced</option>
                            <option @if ($civ->marital_status == App\Models\User::WIDOWED) selected @endif value="">Widowed</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="childrens" class="form-label fw-bold">Num of Childrens</label>
                        <input id="childrens" class="form-control border-primary" value="{{ $civ->childrens }}" disabled
                            type="text" name="childrens" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="country_id" class="form-label fw-bold">Country</label>
                        <select name="country_id" id="country_id" disabled class="form-control border-primary" required>
                            @foreach ($countries as $country)
                                <option @if ($country->id == $civ->country_id) disabled selected @endif
                                    value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="city" class="form-label fw-bold">City</label>
                        <input id="city" class="form-control border-primary" value="{{ $civ->city }}" disabled
                            type="text" name="city" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="street" class="form-label fw-bold">Street</label>
                        <input id="street" class="form-control border-primary" value="{{ $civ->street }}" disabled
                            type="text" name="street" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-bold">Phone</label>
                        <input id="phone" class="form-control border-primary" value="{{ $civ->phone }}" disabled
                            type="text" name="phone" required>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>
@endsection
