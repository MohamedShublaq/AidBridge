@extends('Layouts.app')

@section('title')
    Contacts
@endsection

@section('content')
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-gray-800">Contacts Management</h1>
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
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">Select Status</option>
                            <option value="{{ App\Models\Contact::READ }}">Read</option>
                            <option value="{{ App\Models\Contact::UNREAD }}">Unread</option>
                        </select>
                    </div>
                </form>
            </div>

        <!-- Contacts List -->
        <div id="contactsList">
            @include('Admin.Contacts.list', compact('contacts'))
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
    function fetchContacts(url) {
        const formData = {
            name: $('#name').val(),
            email: $('#email').val(),
            status: $('#status').val(),
        };

        $.ajax({
            url: url,
            type: 'GET',
            data: formData,
            success: function (response) {
                $('#contactsList').html(response);
            },
            error: function () {
                alert('Something went wrong! Please try again.');
            }
        });
    }

    // Trigger AJAX search on input change
    $('#searchForm').on('input change', function () {
        fetchContacts('{{ route('admin.contacts.index') }}');
    });

    // Handle pagination links dynamically
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        fetchContacts(url);
    });
});
</script>
@endpush
