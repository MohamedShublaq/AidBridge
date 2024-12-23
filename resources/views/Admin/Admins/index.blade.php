@extends('Layouts.app')

@section('title')
    Admins
@endsection

@section('content')
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-gray-800">Admins Management</h1>
                <a class="btn btn-primary" href="{{ route('admin.admins.create') }}">
                    <i class="fas fa-plus-circle"></i> Create New Admin
                </a>
            </div>

            <!-- Search Form -->
            <div class="card-body">
                <form id="searchForm" class="row g-3">
                    <div class="col-md-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Search by name">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Search by email">
                    </div>
                    <div class="col-md-4">
                        <label for="role_id" class="form-label">Role</label>
                        <select id="role_id" name="role_id" class="form-control">
                            <option value="">All Roles</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

        <!-- Admins List -->
        <div id="adminsList">
            @include('Admin.Admins.list', compact('admins'))
        </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
</div>
@endsection
@push('js')
<script>
$(document).ready(function () {
    function fetchAdmins(url) {
        const formData = {
            name: $('#name').val(),
            email: $('#email').val(),
            role_id: $('#role_id').val(),
        };

        $.ajax({
            url: url,
            type: 'GET',
            data: formData,
            success: function (response) {
                $('#adminsList').html(response);
            },
            error: function () {
                alert('Something went wrong! Please try again.');
            }
        });
    }

    // Trigger AJAX search on input change
    $('#searchForm').on('input change', function () {
        fetchAdmins('{{ route('admin.admins.index') }}');
    });

    // Handle pagination links dynamically
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        fetchAdmins(url);
    });
});
</script>
@endpush
