<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Num of Received Aids</th>
                        <th scope="col" class="text-center">Actions</th>
                        <th scope="col" class="text-center">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($locations as $location)
                        <!-- Main Row -->
                        <tr class="location-row">
                            <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                            <td class="text-center">{{ $location->name }}</td>
                            <td class="text-center">
                                {{ $location->aidDistributions()->where('status', App\Models\AidDistribution::RECEIVED)->count() }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <button type="button" class="btn btn-warning btn-sm" title="Edit"
                                        data-toggle="modal" data-target="#editLocation_{{ $location->id }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete"
                                        data-toggle="modal" data-target="#deleteLocation_{{ $location->id }}">
                                        Delete
                                    </button>
                                </div>
                            </td>
                            <td class="text-center">
                                @if ($location->aids->count() > 0)
                                    <i class="toggle-icon fas fa-plus-circle text-primary"
                                        style="cursor: pointer; font-size: 1.2rem;" data-row-id="{{ $location->id }}"
                                        title="Show Details"></i>
                                @else
                                    <span class="bg-danger text-white">There is no aids here</span>
                                @endif
                            </td>
                        </tr>

                        <!-- Hidden Inner Rows -->
                        <tr class="details-row d-none bg-light" id="details-row-{{ $location->id }}">
                            <td colspan="5">
                                <div class="p-3 border rounded">
                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle">
                                            <thead class="bg-success text-white">
                                                <tr>
                                                    <th scope="col" class="text-center">#</th>
                                                    <th scope="col" class="text-center">Aid Name</th>
                                                    <th scope="col" class="text-center">Type</th>
                                                    <th scope="col" class="text-center">Total Quantity</th>
                                                    <th scope="col" class="text-center">Received Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($location->aids as $aid)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">{{ $aid->name }}</td>
                                                        <td class="text-center">
                                                            @if ($aid->type == App\Models\Aid::NUTRITIONAL)
                                                                NUTRITIONAL
                                                            @elseif ($aid->type == App\Models\Aid::CASH)
                                                                CASH
                                                            @else
                                                                MEDICAL
                                                            @endif
                                                        </td>
                                                        <td class="text-center">{{ $aid->quantity }}</td>
                                                        <td class="text-center">
                                                            {{ $aid->requests->sum(fn($request) => $request->aidDistributions()->where('status', App\Models\AidDistribution::RECEIVED)->where('location_id', $location->id)->count()) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @include('Ngo.Locations.edit')
                        @include('Ngo.Locations.delete')
                    @empty
                        <tr>
                            <td colspan="5" class="text-center alert alert-info">
                                No Locations found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="mt-3">
                {{ $locations->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggles = document.querySelectorAll('.toggle-icon');

            toggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const rowId = this.getAttribute('data-row-id');
                    const detailsRow = document.getElementById(`details-row-${rowId}`);
                    if (detailsRow) {
                        detailsRow.classList.toggle('d-none');

                        // Toggle the icon between plus and minus
                        const isCollapsed = this.classList.contains('fa-plus-circle');
                        this.classList.toggle('fa-plus-circle', !isCollapsed);
                        this.classList.toggle('fa-minus-circle', isCollapsed);

                        // Change icon color
                        this.classList.toggle('text-primary', !isCollapsed);
                        this.classList.toggle('text-danger', isCollapsed);

                        // Update the tooltip title
                        this.setAttribute(
                            'title',
                            !isCollapsed ? 'Show Details' : 'Hide Details'
                        );
                    }
                });
            });
        });
    </script>
@endpush
