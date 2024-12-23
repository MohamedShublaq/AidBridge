@extends('Layouts.app')

@section('title')
    Show Contact
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Contact From {{ $contact->name }}</h2>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input id="name" class="form-control border-primary" value="{{ $contact->name }}" disabled type="text"
                    name="name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input id="email" class="form-control border-primary" value="{{ $contact->email }}" disabled type="email"
                    name="email">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label fw-bold">Phone</label>
                <input id="phone" class="form-control border-primary" value="{{ $contact->phone }}" disabled
                    type="text" name="phone">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label fw-bold">Message</label>
                <textarea class="form-control border-primary" name="body" id="" cols="30" rows="10" disabled>{{ $contact->body }}</textarea>
            </div>

        </form>
    </div>
@endsection
