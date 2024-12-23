<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Num of Aids</th>
                        <th scope="col">Num of Civilians</th>
                        <th scope="col">Num of Donors</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ngos as $ngo)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $ngo->name }}</td>
                            <td>{{ $ngo->email }}</td>
                            <td>{{ $ngo->address }}</td>
                            <td>{{ $ngo->phone }}</td>
                            <td>{{ $ngo->aids_count }}</td>
                            <td>
                                {{ $ngo->users()->where('status', App\Models\NgosUsers::APPROVED)->count() }}
                            </td>
                            <td>
                                {{ $ngo->donors()->where('status', App\Models\NgosDonors::APPROVED)->count() }}
                            </td>
                            <td class="text-center">
                                <div class="dropdown mr-1">
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false" data-offset="10,20">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu">
                                        @can('donors')
                                            <a class="dropdown-item text-secondary"
                                                href="{{ route('admin.ngos.showDonors', $ngo->id) }}" title="View Donors">
                                                <i class="fas fa-users mr-2"></i> Donors
                                            </a>
                                        @endcan
                                        @can('civilians')
                                            <a class="dropdown-item text-secondary"
                                                href="{{ route('admin.ngos.showCivilians', $ngo->id) }}"
                                                title="View Civilians">
                                                <i class="fas fa-users mr-2"></i> Civilians
                                            </a>
                                        @endcan
                                        @can('providers')
                                            <a class="dropdown-item text-secondary"
                                                href="{{ route('admin.ngos.showProviders', $ngo->id) }}"
                                                title="View Providers">
                                                <i class="fas fa-users mr-2"></i> Providers
                                            </a>
                                        @endcan
                                        @can('aids')
                                            <a class="dropdown-item text-primary"
                                                href="{{ route('admin.ngos.showAids', $ngo->id) }}" title="View Aids">
                                                <i class="fas fa-hand-holding-heart mr-2"></i> Aids
                                            </a>
                                        @endcan
                                        <a class="dropdown-item text-success"
                                            href="{{ route('admin.ngos.show', $ngo->id) }}" title="More Info">
                                            <i class="fas fa-eye mr-2"></i> More Info
                                        </a>
                                        @php
                                            $pendingDeletionNgo = App\Models\DeletionRequest::where(
                                                'deletable_type',
                                                App\Models\Ngo::class,
                                            )
                                                ->where('deletable_id', $ngo->id)
                                                ->where('status', App\Models\DeletionRequest::PENDING)
                                                ->first();
                                        @endphp
                                        @if (!$pendingDeletionNgo)
                                            <button class="dropdown-item text-danger" type="button" data-toggle="modal"
                                                data-target="#deleteNgo_{{ $ngo->id }}" title="Delete">
                                                <i class="fas fa-trash-alt mr-2"></i> Delete
                                            </button>
                                        @else
                                            <button class="dropdown-item text-warning" type="button">
                                                <i class="fas fa-hourglass-half mr-2"></i> Deletion is pending
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </td>


                        </tr>
                        @include('Admin.Ngos.delete')
                    @empty
                        <tr>
                            <td colspan="9" class="text-center alert alert-info">
                                No Ngos found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination with search parameters -->
            <div class="mt-3">
                {{ $ngos->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
