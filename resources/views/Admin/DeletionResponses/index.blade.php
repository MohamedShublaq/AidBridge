@extends('Layouts.app')

@section('title')
    Responses
@endsection

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-gray-800">Deletion Responses</h1>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Admin</th>
                                        <th scope="col">Response</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($responses as $res)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $res->admin->name }}</td>
                                            <td>
                                                <span class="badge {{ $res->status == 1 ? 'bg-success' : 'bg-danger' }} text-white">
                                                    {{ $res->status == 1 ? 'Approve' : 'Reject' }}
                                                </span>
                                            </td>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center alert alert-info">
                                                No Responses found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $responses->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
@endsection
