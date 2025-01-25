<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Country</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($donors as $donor)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $donor->name }}</td>
                            <td>{{ $donor->email }}</td>
                            <td>{{ $donor->phone }}</td>
                            <td>{{ $donor->country->name }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <a href="{{ route('admin.donors.show', $donor->id) }}"
                                        class="btn btn-success btn-sm" title="Show">
                                        Show
                                    </a>
                                    @php
                                        $pendingDeletionDonor = App\Models\DeletionRequest::where(
                                            'deletable_type',
                                            App\Models\Donor::class,
                                        )
                                            ->where('deletable_id', $donor->id)
                                            ->where('status', App\Models\DeletionRequest::PENDING)
                                            ->first();
                                    @endphp
                                    @if (!$pendingDeletionDonor)
                                        <button type="button" class="btn btn-danger btn-sm" title="Delete"
                                            data-toggle="modal" data-target="#deleteDonor_{{ $donor->id }}">
                                            Delete
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-warning btn-sm">
                                            Deletion is pending
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @include('Admin.Donors.delete')
                    @empty
                        <tr>
                            <td colspan="6" class="text-center alert alert-info">
                                No Donors found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination with search parameters -->
            <div class="mt-3">
                {{ $donors->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
