<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-primary text-white">

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Num of Added Civilians</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($providers as $provider)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $provider->name }}</td>
                            <td>{{ $provider->phone }}</td>
                            <td>{{ $provider->users_count }}</td>
                            <td class="text-center">
                                @php
                                    $pendingDeletionProvider = App\Models\DeletionRequest::where(
                                        'deletable_type',
                                        App\Models\Provider::class,
                                    )
                                        ->where('deletable_id', $provider->id)
                                        ->where('status', App\Models\DeletionRequest::PENDING)
                                        ->first();
                                @endphp
                                @if (!$pendingDeletionProvider)
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete"
                                        data-toggle="modal"
                                        data-target="#deleteProvider_{{ $provider->id }}">
                                        Delete
                                    </button>
                                @else
                                    <button type="button" class="btn btn-warning btn-sm">
                                        Deletion is pending
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @include('Admin.Providers.delete')
                    @empty
                        <tr>
                            <td colspan="5" class="text-center alert alert-info">
                                No providers found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination with search parameters -->
            <div class="mt-3">
                {{ $providers->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
