@extends('Layouts.app')

@section('title')
    Show Aid
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">New Aid From {{ $aid->ngo->name }}</h2>
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Name</label>
            <input id="name" class="form-control border-primary" value="{{ $aid->name }}" type="text"
                name="name" disabled>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea class="form-control border-primary" name="description" id="description" rows="5" disabled>{{ $aid->description }}</textarea>
        </div>
        <form action="{{ route('civilian.aids.response') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::guard('web')->user()->id }}">
            <input type="hidden" name="aid_id" value="{{ $aid->id }}">
            <button type="submit" class="btn btn-success" name="response" value="1">Apply</button>
            <button type="submit" class="btn btn-danger" name="response" value="0">Decline</button>
        </form>
    </div>
@endsection
