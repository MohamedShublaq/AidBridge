@extends('Layouts.app')

@section('title')
    Civilians
@endsection

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-gray-800">Civilians Management</h1>
                </div>

                <!-- Search Form -->
                <div class="card-body">
                    <form id="searchForm">
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
                                <label for="joining_way" class="form-label">Joining By</label>
                                <select id="joining_way" name="joining_way" class="form-control">
                                    <option value="">Select Way</option>
                                    <option value="{{ App\Models\User::REGISTER }}">Registration</option>
                                    <option value="{{ App\Models\User::EXCEL }}">NGO</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Civilians List -->
                <div id="civiliansList">
                    @include('Admin.Civilians.list', compact('civilians'))
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
            function fetchCivilians(url) {
                const formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    id_number: $('#id_number').val(),
                    marital_status: $('#marital_status').val(),
                    childrens: $('#childrens').val(),
                    country_id: $('#country_id').val(),
                    age: $('#age').val(),
                    gender: $('#gender').val(),
                    joining_way: $('#joining_way').val(),
                };

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: formData,
                    success: function(response) {
                        $('#civiliansList').html(response);
                    },
                    error: function() {
                        alert('Something went wrong! Please try again.');
                    }
                });
            }

            // Trigger AJAX search on input change
            $('#searchForm').on('input change', function() {
                fetchCivilians('{{ route('admin.civilians.index') }}');
            });

            // Handle pagination links dynamically
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                fetchCivilians(url);
            });
        });
    </script>
@endpush
