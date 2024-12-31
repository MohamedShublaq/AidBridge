@extends('Layouts.app')

@section('title')
    Show Distribution Aid
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">{{ $distribution->request->aid->ngo->name }}</h2>
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Aid Name</label>
            <input id="name" class="form-control border-primary" value="{{ $distribution->request->aid->name }}" type="text"
                name="name" disabled>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea class="form-control border-primary" name="description" id="description" rows="5" disabled>{{ $distribution->request->aid->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label fw-bold">Location</label>
            <input id="location" class="form-control border-primary" value="{{ $distribution->location->name }}" type="text"
                name="location" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">From Date</label>
            <input class="form-control border-primary" value="{{ $distribution->request->aid->from }}" type="text"
                name="from" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Due Date</label>
            <input class="form-control border-primary" value="{{ $distribution->request->aid->due }}" type="text"
                name="due" disabled>
        </div>
    </div>
@endsection
