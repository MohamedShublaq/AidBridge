@extends('Layouts.app')

@section('title')
    Roles
@endsection

@section('content')
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-gray-800">Roles Management</h1>
                <a class="btn btn-primary" href="{{ route('admin.authorizations.create') }}">
                    <i class="fas fa-plus-circle"></i> Create New Role
                </a>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Permissions</th>
                                    <th scope="col">Number of Admins</th>
                                    <th scope="col">Created Since</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($authorizations as $authorization)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $authorization->role }}</td>
                                        <td>
                                            @foreach ($authorization->permissions as $key => $permission)
                                                {{ $permission }}{{ $key == sizeof($authorization->permissions) - 1 ? '' : ', ' }}
                                            @endforeach
                                        </td>
                                        <td>{{ $authorization->admins_count }}</td>
                                        <td>{{ $authorization->created_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.authorizations.edit', $authorization->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                Edit
                                            </a>
                                            @if($authorization->id != '1')
                                                <button type="button" class="btn btn-danger btn-sm" title="Delete" data-toggle="modal" data-target="#deleteRole_{{ $authorization->id }}">
                                                    Delete
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @include('Admin.Authorizations.delete')
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center alert alert-info">
                                            No Roles found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- Pagination with search parameters -->
                        <div class="mt-3">
                            {{ $authorizations->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
</div>
@endsection
