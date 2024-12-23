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
                        <th scope="col">Locations</th>
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
                                @if($aid->type == App\Models\Aid::NUTRITIONAL)
                                    NUTRITIONAL
                                @elseif ($aid->type == App\Models\Aid::CASH)
                                    CASH
                                @else
                                    MEDICAL
                                @endif
                            </td>
                            <td>
                                @foreach ($aid->locations as $key => $location)
                                    {{ $location->name }}{{ $key == sizeof($aid->locations) - 1 ? '' : ', ' }}
                                @endforeach
                            </td>
                            <td>{{ $aid->quantity }}</td>
                            <td>{{ $aid->created_at->diffForHumans() }}</td>


                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Actions">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('ngo.aids.edit', $aid->id) }}" class="dropdown-item text-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <button type="button" class="dropdown-item text-danger" data-toggle="modal" data-target="#deleteAid_{{ $aid->id }}">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                        <a href="{{ route('ngo.requests.show', ['aid_id' => $aid->id, 'status' => App\Models\Request::PENDING]) }}" class="dropdown-item text-info">
                                            <i class="fas fa-hourglass-start"></i> Pending Requests
                                        </a>
                                        <a href="{{ route('ngo.requests.show', ['aid_id' => $aid->id, 'status' => App\Models\Request::APPROVED]) }}" class="dropdown-item text-success">
                                            <i class="fas fa-check"></i> Approved Requests
                                        </a>
                                        <a href="{{ route('ngo.requests.show', ['aid_id' => $aid->id, 'status' => App\Models\Request::REJECTED]) }}" class="dropdown-item text-danger">
                                            <i class="fas fa-times"></i> Rejected Requests
                                        </a>
                                        <a href="{{ route('ngo.requests.show', ['aid_id' => $aid->id, 'status' => App\Models\Request::UNAVAILABLE]) }}" class="dropdown-item text-secondary">
                                            <i class="fas fa-box"></i> Unavailable Requests
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @include('Ngo.Aids.delete')
                    @empty
                        <tr>
                            <td colspan="8" class="text-center alert alert-info">
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
