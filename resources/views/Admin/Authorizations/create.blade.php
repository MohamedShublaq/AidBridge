@extends('Layouts.app')

@section('title')
    Create Role
@endsection

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Create New Role</h2>

        <form action="{{ route('admin.authorizations.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="role" class="form-label fw-bold">Role Name</label>
                <input id="role" class="form-control border-primary" placeholder="Enter Role" type="text" name="role" required>
                @error('role')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="permissions" class="form-label fw-bold">Assign Permissions</label>
                <div class="p-3 border rounded bg-light">
                    @foreach (config('authorizations.Permissions') as $key => $value)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permission_{{ $key }}" name="permissions[]" value="{{ $key }}">
                            <label class="form-check-label" for="permission_{{ $key }}">
                                {{ $value }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('permissions')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a class="btn btn-danger" href="{{ route('admin.authorizations.index') }}">Back to Roles</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
