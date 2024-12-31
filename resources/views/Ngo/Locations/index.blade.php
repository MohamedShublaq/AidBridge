@extends('Layouts.app')

@section('title')
    Locations
@endsection

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-gray-800">
                        Locations Management
                    </h1>
                    <button type="button" class="btn btn-primary" title="Create" data-toggle="modal"
                        data-target="#addLocation"><i class="fas fa-plus-circle"></i>
                        Create New Location
                    </button>
                </div>

                <!-- Search Form -->
                <div class="card-body">
                    <form id="searchForm" class="row g-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="Search by name">
                    </form>
                </div>

                <!-- Locations List -->
                <div id="locationsList">
                    @include('Ngo.Locations.list', compact('locations'))
                </div>

                @include('Ngo.Locations.create')

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
@endsection
@push('js')
<script>
$(document).ready(function () {
    function fetchLocations(url) {
        const formData = {
            name: $('#name').val(),
        };

        $.ajax({
            url: url,
            type: 'GET',
            data: formData,
            success: function (response) {
                $('#locationsList').html(response);
            },
            error: function () {
                alert('Something went wrong! Please try again.');
            }
        });
    }

    // Trigger AJAX search on input change
    $('#searchForm').on('input change', function () {
        fetchLocations('{{ route('ngo.locations.index') }}');
    });

    // Handle pagination links dynamically
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        fetchLocations(url);
    });
});
</script>
@endpush
