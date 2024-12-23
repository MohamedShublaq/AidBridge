@extends('Layouts.app')

@section('title')
    Aids
@endsection

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-gray-800">Aid Provided by {{ $ngo->name }}</h1>
                </div>

                <!-- Search Form -->
                <div class="card-body">
                    <form id="searchForm" class="row g-3">
                        <div class="col-md-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Search by name">
                        </div>
                        <div class="col-md-4">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" id="description" name="description" class="form-control"
                                placeholder="Search by description">
                        </div>
                        <div class="col-md-4">
                            <label for="type" class="form-label">Type</label>
                            <select id="type" name="type" class="form-control">
                                <option selected value="">All Types</option>
                                <option value="{{ App\Models\Aid::NUTRITIONAL }}">NUTRITIONAL</option>
                                <option value="{{ App\Models\Aid::CASH }}">CASH</option>
                                <option value="{{ App\Models\Aid::MEDICAL }}">MEDICAL</option>
                            </select>
                        </div>
                    </form>
                </div>

                <!-- Aids List -->
                <div id="aidsList">
                    @include('Admin.Ngos.listAids', compact('aids'))
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
    function fetchAids(url) {
        const formData = {
            name: $('#name').val(),
            description: $('#description').val(),
            type: $('#type').val(),
        };

        $.ajax({
            url: url,
            type: 'GET',
            data: formData,
            success: function (response) {
                $('#aidsList').html(response);
            },
            error: function () {
                alert('Something went wrong! Please try again.');
            }
        });
    }

    // Trigger AJAX search on input change
    $('#searchForm').on('input change', function () {
        fetchAids('{{ route('admin.ngos.showAids' , $ngo->id) }}');
    });

    // Handle pagination links dynamically
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        fetchAids(url);
    });
});
</script>
@endpush
