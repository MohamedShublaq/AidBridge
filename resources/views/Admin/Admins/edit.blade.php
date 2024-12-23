@extends('Layouts.app')

@section('title')
    Edit Admin
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Edit Admin</h2>

        <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input id="name" class="form-control border-primary" value="{{ $admin->name }}" placeholder="Enter Name" type="text" name="name" required>
                @error('name')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input id="email" class="form-control border-primary" value="{{ $admin->email }}" placeholder="Enter Email" type="email" name="email" required>
                @error('name')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role_id" class="form-label fw-bold">Role</label>
                <select name="role_id" id="role_id" class="form-control border-primary" required>
                    @foreach ($roles as $role)
                        <option @if($role->id == $admin->role_id) selected @endif value="{{ $role->id }}">{{ $role->role }}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a class="btn btn-danger" href="{{ route('admin.admins.index') }}">Back to Admins</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
