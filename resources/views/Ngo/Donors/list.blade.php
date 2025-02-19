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
                            <td>{{ $donor->donor->name }}</td>
                            <td>{{ $donor->donor->email }}</td>
                            <td>{{ $donor->donor->phone }}</td>
                            <td>{{ $donor->donor->country->name }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    @if ($donor->status == App\Models\NgosDonors::PENDING)
                                        <button type="button" class="btn btn-success btn-sm" title="Approve"
                                            data-toggle="modal" data-target="#approve_{{ $donor->id }}">
                                            Approve
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" title="Reject"
                                            data-toggle="modal" data-target="#reject_{{ $donor->id }}">
                                            Reject
                                        </button>
                                    @endif
                                    {{-- <a href="{{ route('ngo.donors.show', $donor->donor->id) }}"
                                        class="btn btn-info btn-sm" title="Show">
                                        Show
                                    </a> --}}
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete"
                                        data-toggle="modal" data-target="#deleteDonor_{{ $donor->id }}">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('Ngo.Donors.approve')
                        @include('Ngo.Donors.reject')
                        @include('Ngo.Donors.delete')
                    @empty
                        <tr>
                            <td colspan="6" class="text-center alert alert-info">
                                No donors found
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
