@extends('Layouts.app')

@section('title')
    Providers
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
                        Providers Management
                    </h1>
                    <button type="button" class="btn btn-primary" title="Create" data-toggle="modal"
                        data-target="#addProvider"><i class="fas fa-plus-circle"></i>
                        Create New Provider
                    </button>
                </div>

                <!-- Search Form -->
                <div class="card-body">
                    <form id="searchForm" class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Search by name">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                placeholder="Search by phone">
                        </div>
                    </form>
                </div>

                <!-- Providers List -->
                <div id="providersList">
                    @include('Ngo.Providers.list', compact('providers'))
                </div>

                @include('Ngo.Providers.create')

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
@endsection
@push('js')
<script>
$(document).ready(function () {
    function fetchProviders(url) {
        const formData = {
            name: $('#name').val(),
            phone: $('#phone').val(),
        };

        $.ajax({
            url: url,
            type: 'GET',
            data: formData,
            success: function (response) {
                $('#providersList').html(response);
            },
            error: function () {
                alert('Something went wrong! Please try again.');
            }
        });
    }

    // Trigger AJAX search on input change
    $('#searchForm').on('input change', function () {
        fetchProviders('{{ route('ngo.providers.index') }}');
    });

    // Handle pagination links dynamically
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        fetchProviders(url);
    });
});
</script>
@endpush
