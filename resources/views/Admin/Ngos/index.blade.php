@extends('Layouts.app')

@section('title')
    NGOs
@endsection

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-gray-800">NGOs Management</h1>
                    <a class="btn btn-primary" href="{{ route('admin.ngos.create') }}">
                        <i class="fas fa-plus-circle"></i> Create New NGO
                    </a>
                </div>

                <!-- Search Form -->
                <div class="card-body">
                    <form id="searchForm" class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Search by name">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Search by email">
                        </div>
                    </form>
                </div>

                <!-- NGOs List -->
                <div id="ngosList">
                    @include('Admin.Ngos.listIndex', compact('ngos'))
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
    function fetchCivilians(url) {
        const formData = {
            name: $('#name').val(),
            email: $('#email').val(),
        };

        $.ajax({
            url: url,
            type: 'GET',
            data: formData,
            success: function (response) {
                $('#ngosList').html(response);
            },
            error: function () {
                alert('Something went wrong! Please try again.');
            }
        });
    }

    // Trigger AJAX search on input change
    $('#searchForm').on('input change', function () {
        fetchCivilians('{{ route('admin.ngos.index') }}');
    });

    // Handle pagination links dynamically
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        fetchCivilians(url);
    });
});
</script>
@endpush
