@extends('Layouts.app')

@section('title')
    Show Ngo
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Data for {{ $ngo->name }}</h2>

        <form>
            <div class="text-center mb-4">
                <img src="{{ asset('uploads/Ngos/'. $ngo->logo) }}" alt="NGO Logo" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input id="name" class="form-control border-primary" value="{{ $ngo->name }}" disabled placeholder="Enter Name" type="text" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input id="email" class="form-control border-primary" value="{{ $ngo->email }}" disabled placeholder="Enter Email" type="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea class="form-control border-primary" name="description" id="description" rows="5" disabled required>{{ $ngo->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label fw-bold">Address</label>
                <input id="address" class="form-control border-primary" value="{{ $ngo->address }}" disabled placeholder="Enter Address" type="text" name="address" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label fw-bold">Phone</label>
                <input id="phone" class="form-control border-primary" value="{{ $ngo->phone }}" disabled placeholder="Enter Phone" type="text" name="phone" required>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a class="btn btn-danger" href="{{ route('admin.ngos.index') }}">Back to Ngos</a>
            </div>
        </form>
    </div>
    <br>
@endsection
