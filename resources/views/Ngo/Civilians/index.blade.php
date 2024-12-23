@extends('Layouts.app')

@section('title')
    @if ($status == App\Models\NgosUsers::PENDING)
        Pending Civilians
    @endif
    @if ($status == App\Models\NgosUsers::APPROVED)
        Approved Civilians
    @endif
    @if ($status == App\Models\NgosUsers::REJECTED)
        Rejected Civilians
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

                    <h1 class="h3 text-gray-800">
                        @if ($status == App\Models\NgosUsers::PENDING)
                            Pending Civilians Management
                        @elseif ($status == App\Models\NgosUsers::APPROVED)
                            Approved Civilians Management
                        @elseif ($status == App\Models\NgosUsers::REJECTED)
                            Rejected Civilians Management
                        @endif
                    </h1>

                    <button id="exportBtn" class="btn btn-success">Export to Excel</button>

                </div>

                <!-- Search Form -->
                <div class="card-body">
                    <form id="searchForm" data-status="{{ $status }}">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Search by name">
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" id="email" name="email" class="form-control"
                                    placeholder="Search by email">
                            </div>
                            <div class="col-md-4">
                                <label for="id_number" class="form-label">ID Num</label>
                                <input type="text" id="id_number" name="id_number" class="form-control"
                                    placeholder="Search by id number">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="age" class="form-label">Age</label>
                                <input type="text" id="age" name="age" class="form-control"
                                    placeholder="Search by age">
                            </div>
                            <div class="col-md-2">
                                <label for="gender" class="form-label">Gender</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="{{ App\Models\User::MALE }}">Male</option>
                                    <option value="{{ App\Models\User::FEMALE }}">Female</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="marital_status" class="form-label">Marital Status</label>
                                <select id="marital_status" name="marital_status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="{{ App\Models\User::SINGLE }}">Single</option>
                                    <option value="{{ App\Models\User::MARRIED }}">Married</option>
                                    <option value="{{ App\Models\User::DIVORCED }}">Divorced</option>
                                    <option value="{{ App\Models\User::WIDOWED }}">Widowed</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="childrens" class="form-label">Num of Childrens</label>
                                <select id="childrens" name="childrens" class="form-control">
                                    <option value="">Select Number</option>
                                    @foreach (range(0, 15) as $number)
                                        <option value="{{ $number }}">{{ $number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="country_id" class="form-label">Country</label>
                                <select id="country_id" name="country_id" class="form-control">
                                    <option value="">All Countries</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="provider_id" class="form-label">By Provider</label>
                                <select id="provider_id" name="provider_id" class="form-control">
                                    <option value="">All Providers</option>
                                    @foreach ($providers as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Civilians List -->
                <div id="civiliansList">
                    @include('Ngo.Civilians.list', compact('civilians'))
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
            const baseUrl = '{{ route('ngo.civilians.index', [':status']) }}'.replace(':status',
                '{{ $status }}');
            const exportUrl = '{{ route('ngo.civilians.exportFile', [':status']) }}'.replace(':status',
                '{{ $status }}');

            function getFormData() {
                return {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    id_number: $('#id_number').val(),
                    marital_status: $('#marital_status').val(),
                    childrens: $('#childrens').val(),
                    country_id: $('#country_id').val(),
                    gender: $('#gender').val(),
                    age: $('#age').val(),
                    provider_id: $('#provider_id').val(),
                };
            }

            function fetchCivilians(url, formData = {}) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: formData,
                    success: function(response) {
                        $('#civiliansList').html(response);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        alert('Something went wrong! Please try again.');
                    }
                });
            }

            function exportToExcel() {
                const formData = getFormData();

                const form = $('<form>', {
                    method: 'POST',
                    action: exportUrl,
                });

                form.append($('<input>', {
                    type: 'hidden',
                    name: '_token',
                    value: '{{ csrf_token() }}',
                }));

                $.each(formData, function(key, value) {
                    form.append($('<input>', {
                        type: 'hidden',
                        name: key,
                        value: value,
                    }));
                });

                // Submit form for export
                $('body').append(form);
                form.submit();
                form.remove();

                // Reset the form after export, but preserve the search filters for the next request
                $('#searchForm')[0].reset();

                // Re-fetch civilians without filters, so all data is loaded (full list)
                fetchCivilians(baseUrl);
            }

            // Trigger search on form input or change
            $('#searchForm').on('input change', function() {
                const formData = getFormData();
                fetchCivilians(baseUrl, formData);
            });

            // Handle pagination click event
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                const pageUrl = $(this).attr('href');
                const formData = getFormData();
                fetchCivilians(pageUrl, formData);
            });

            // Export button click handler
            $('#exportBtn').on('click', exportToExcel);
        });
    </script>
@endpush
