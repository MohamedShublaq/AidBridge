@extends('Layouts.app')

@section('title')
    Donors
@endsection

@section('content')
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-gray-800">Donors Management</h1>
                <a class="btn btn-primary" href="{{ route('admin.donors.create') }}">
                    <i class="fas fa-plus-circle"></i> Create New Donor
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
                        <label for="country_id" class="form-label">Country</label>
                        <select id="country_id" name="country_id" class="form-control">
                            <option value="">All Countries</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

        <!-- Donors List -->
        <div id="donorsList">
            @include('Admin.Donors.list', compact('donors'))
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
    function fetchDonors(url) {
        const formData = {
            name: $('#name').val(),
            email: $('#email').val(),
            country_id: $('#country_id').val(),
        };

        $.ajax({
            url: url,
            type: 'GET',
            data: formData,
            success: function (response) {
                $('#donorsList').html(response);
            },
            error: function () {
                alert('Something went wrong! Please try again.');
            }
        });
    }

    // Trigger AJAX search on input change
    $('#searchForm').on('input change', function () {
        fetchDonors('{{ route('admin.donors.index') }}');
    });

    // Handle pagination links dynamically
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        fetchDonors(url);
    });
});
</script>
@endpush

