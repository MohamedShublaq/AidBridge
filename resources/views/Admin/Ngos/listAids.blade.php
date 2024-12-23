<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Type</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Since</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($aids as $aid)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $aid->name }}</td>
                            <td>{{ $aid->description }}</td>
                            <td>
                                @if ($aid->type == App\Models\Aid::NUTRITIONAL)
                                    NUTRITIONAL
                                @elseif ($aid->type == App\Models\Aid::CASH)
                                    CASH
                                @else
                                    MEDICAL
                                @endif
                            </td>
                            <td>{{ $aid->quantity }}</td>
                            <td>{{ $aid->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                @php
                                    $pendingDeletionAid = App\Models\DeletionRequest::where(
                                        'deletable_type',
                                        App\Models\Aid::class,
                                    )
                                        ->where('deletable_id', $aid->id)
                                        ->where('status', App\Models\DeletionRequest::PENDING)
                                        ->first();
                                @endphp
                                @if (!$pendingDeletionAid)
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete"
                                        data-toggle="modal" data-target="#deleteAid_{{ $aid->id }}">
                                        Delete
                                    </button>
                                @else
                                    <button type="button" class="btn btn-warning btn-sm">
                                        Deletion is pending
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @include('Admin.Ngos.deleteAid')
                    @empty
                        <tr>
                            <td colspan="7" class="text-center alert alert-info">
                                No Aids found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination with search parameters -->
            <div class="mt-3">
                {{ $aids->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
