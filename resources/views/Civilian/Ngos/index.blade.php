@extends('Layouts.app')

@section('title')
    @if ($status == App\Models\NgosUsers::PENDING)
        Pending Ngos
    @endif
    @if ($status == App\Models\NgosUsers::APPROVED)
        Ngos approve me
    @endif
    @if ($status == App\Models\NgosUsers::REJECTED)
        Ngos Reject me
    @endif
@endsection

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    @if ($status == App\Models\NgosUsers::PENDING)
                        <h1 class="h3 text-gray-800">Ngos whose response I am waiting for</h1>
                    @endif
                    @if ($status == App\Models\NgosUsers::APPROVED)
                        <h1 class="h3 text-gray-800">Ngos that Approved me</h1>
                    @endif
                    @if ($status == App\Models\NgosUsers::REJECTED)
                        <h1 class="h3 text-gray-800">Ngos that rejected me</h1>
                    @endif
                </div>

                <!-- Search Form -->
                <div class="card-body">
                    <form id="searchForm" data-status="{{ $status }}" class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Search by name">
                        </div>
                        <div class="col-md-6">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" id="description" name="description" class="form-control"
                                placeholder="Search by description">
                        </div>
                    </form>
                </div>

                <!-- Civilians List -->
                <div id="ngosList">
                    @include('Civilian.Ngos.list', compact('ngos'))
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            function fetchNgos(url) {
                const status = $('#searchForm').data('status');
                const formData = {
                    name: $('#name').val(),
                    description: $('#description').val(),
                };

                $.ajax({
                    url: url.replace(':status', status),
                    type: 'GET',
                    data: formData,
                    success: function(response) {
                        $('#ngosList').html(response);
                    },
                    error: function() {
                        alert('Something went wrong! Please try again.');
                    }
                });
            }

            // Trigger AJAX search on input change
            $('#searchForm').on('input change', function() {
                fetchNgos('{{ route('civilian.ngos.index', [':status']) }}');
            });

            // Handle pagination links dynamically
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                fetchNgos(url);
            });
        });
    </script>
@endpush
