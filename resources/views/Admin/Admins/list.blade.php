<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->authorization->role }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    Edit
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" title="Delete" data-toggle="modal" data-target="#deleteAdmin_{{ $admin->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @include('Admin.Admins.delete')
                    @empty
                        <tr>
                            <td colspan="5" class="text-center alert alert-info">
                                No Admins found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination with search parameters -->
            <div class="mt-3">
                {{ $admins->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
