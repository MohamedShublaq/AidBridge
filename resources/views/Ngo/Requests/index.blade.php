@extends('Layouts.app')

@section('title')
    @if ($status == App\Models\Request::PENDING)
        Pending Requests
    @endif
    @if ($status == App\Models\Request::APPROVED)
        Approved Requests
    @endif
    @if ($status == App\Models\Request::REJECTED)
        Rejected Requests
    @endif
    @if ($status == App\Models\Request::UNAVAILABLE)
        Unavailable Requests
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
                        @if ($status == App\Models\Request::PENDING)
                            Pending Requests Management
                        @elseif ($status == App\Models\Request::APPROVED)
                            Approved Requests Management
                        @elseif ($status == App\Models\Request::REJECTED)
                            Rejected Requests Management
                        @elseif ($status == App\Models\Request::UNAVAILABLE)
                            Unavailable Requests Management
                        @endif
                    </h1>
                    <div class="d-flex">
                        @if($status == App\Models\Request::APPROVED)
                            <button type="button" class="btn btn-primary mr-2" title="Import" data-toggle="modal"
                                data-target="#importFile"><i class="fas fa-file-import"></i>
                                Import File
                            </button>
                        @endif
                        <button id="exportBtn" class="btn btn-success"><i class="fas fa-download"></i>
                            Export to Excel
                        </button>
                    </div>
                </div>

                <!-- Search Form -->
                @if($status != App\Models\Request::APPROVED)
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
                @endif

                @if($status == App\Models\Request::APPROVED)
                    <div class="card-body">
                        <form id="searchForm" data-status="{{ $status }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Search by name">
                                </div>
                                <div class="col-md-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" id="email" name="email" class="form-control"
                                        placeholder="Search by email">
                                </div>
                                <div class="col-md-3">
                                    <label for="id_number" class="form-label">ID Num</label>
                                    <input type="text" id="id_number" name="id_number" class="form-control"
                                        placeholder="Search by id number">
                                </div>
                                <div class="col-md-3">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="text" id="age" name="age" class="form-control"
                                        placeholder="Search by age">
                                </div>
                            </div>
                            <br>
                            <div class="row">
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
                                <div class="col-md-2">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="{{ App\Models\AidDistribution::NOT_RECEIVED }}">Pending</option>
                                        <option value="{{ App\Models\AidDistribution::RECEIVED }}">Received</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif

                @if ($status == App\Models\Request::PENDING)
                    <button type="button" id="approveButton" class="btn btn-success" data-toggle="modal"
                        data-target="#multiApprove">
                        Approve Selected Requests
                    </button><br><br>
                @endif

                <!-- Requests List -->
                <div id="requestsList">
                    @include('Ngo.Requests.list', compact('requests'))
                </div>

                @if ($status == App\Models\Request::PENDING)
                    @include('Ngo.Requests.multiApprove')
                @endif
                @if ($status == App\Models\Request::APPROVED)
                    @include('Ngo.Requests.import')
                @endif
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
@endsection
@push('js')
    {{-- For Multiple Approve --}}
    <script>
        document.getElementById('select-all-approve').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.approved-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        document.getElementById('approveButton').addEventListener('click', function(event) {
            const selectedRequests = Array.from(document.querySelectorAll('.approved-checkbox:checked'));

            if (selectedRequests.length === 0) {
                event.preventDefault();

                this.removeAttribute('data-toggle');
                this.removeAttribute('data-target');

            } else {
                this.setAttribute('data-toggle', 'modal');
                this.setAttribute('data-target', '#multiApprove');

                const requestIds = selectedRequests.map(checkbox => checkbox.value).join(',');
                document.getElementById('requestIdsInput').value = requestIds;
            }
        });
    </script>

    {{-- For Search and Excel --}}
    <script>
        $(document).ready(function() {
            const baseUrl = '{{ route('ngo.requests.show', [':aid_id', ':status']) }}'
                .replace(':aid_id', '{{ $aid->id }}')
                .replace(':status', '{{ $status }}');
            const exportUrl = '{{ route('ngo.requests.exportFile', [':aid_id', ':status']) }}'
                .replace(':aid_id', '{{ $aid->id }}')
                .replace(':status', '{{ $status }}');

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
                    status: $('#status').val(),
                };
            }

            function fetchRequests(url, formData = {}) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: formData,
                    success: function(response) {
                        $('#requestsList').html(response);
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

                // Re-fetch requests without filters, so all data is loaded (full list)
                fetchRequests(baseUrl);
            }

            // Trigger search on form input or change
            $('#searchForm').on('input change', function() {
                const formData = getFormData();
                fetchRequests(baseUrl, formData);
            });

            // Handle pagination click event
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                const pageUrl = $(this).attr('href');
                const formData = getFormData();
                fetchRequests(pageUrl, formData);
            });

            // Export button click handler
            $('#exportBtn').on('click', exportToExcel);
        });
    </script>
@endpush
