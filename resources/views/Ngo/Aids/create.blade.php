@extends('Layouts.app')

@section('title')
    Create Aid
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Create New Aid</h2>

        <form action="{{ route('ngo.aids.store') }}" method="POST">
            @csrf
            <input type="hidden" name="ngo_id" value="{{ $ngo->id }}">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input id="name" class="form-control border-primary" placeholder="Enter Name" type="text"
                    name="name" required>
                @error('name')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea class="form-control border-primary" name="description" id="description" rows="5" required></textarea>
                @error('description')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="type" class="form-label fw-bold">Type</label>
                <select name="type" id="type" class="form-control border-primary" required>
                    <option selected disabled>Select Aid Type</option>
                    <option value="{{ App\Models\Aid::NUTRITIONAL }}">NUTRITIONAL</option>
                    <option value="{{ App\Models\Aid::CASH }}">CASH</option>
                    <option value="{{ App\Models\Aid::MEDICAL }}">MEDICAL</option>
                </select>
                @error('type')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label fw-bold">Quantity</label>
                <input id="quantity" class="form-control border-primary" placeholder="Enter Quantity" type="text"
                    name="quantity" required>
                @error('quantity')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="from" class="form-label fw-bold">From</label>
                        <input id="from" class="form-control border-primary" placeholder="Enter Start Date"
                            type="date" name="from" required>
                        @error('from')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="due" class="form-label fw-bold">Due</label>
                        <input id="due" class="form-control border-primary" placeholder="Enter End Date"
                            type="date" name="due" required>
                        @error('due')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="locations" class="form-label fw-bold">Choose Locations</label>
                <div class="p-3 border rounded bg-light">
                    <div class="row">
                        @foreach ($ngo->locations as $location)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="location{{ $location->id }}"
                                        name="locations[]" value="{{ $location->id }}">
                                    <label class="form-check-label" for="location{{ $location->id }}">
                                        {{ $location->name }}
                                    </label>
                                </div>
                            </div>
                            @if (($loop->iteration % 3) == 0)
                                </div><div class="row">
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a class="btn btn-danger" href="{{ route('ngo.aids.index') }}">Back to Aids</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
