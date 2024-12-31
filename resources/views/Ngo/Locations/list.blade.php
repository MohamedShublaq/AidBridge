<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-primary text-white">

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($locations as $location)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $location->name }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning btn-sm" title="Edit"
                                    data-toggle="modal" data-target="#editLocation_{{ $location->id }}">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" title="Delete"
                                    data-toggle="modal" data-target="#deleteLocation_{{ $location->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @include('Ngo.Locations.edit')
                        @include('Ngo.Locations.delete')
                    @empty
                        <tr>
                            <td colspan="3" class="text-center alert alert-info">
                                No Locations found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination with search parameters -->
            <div class="mt-3">
                {{ $locations->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
