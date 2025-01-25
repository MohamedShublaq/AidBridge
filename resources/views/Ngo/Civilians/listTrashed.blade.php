<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-primary text-white">

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">ID Num</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Age</th>
                        <th scope="col">Marital Status</th>
                        <th scope="col">Childrens</th>
                        <th scope="col">Country</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($civilians as $civ)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $civ->user->name }}</td>
                            <td>{{ $civ->user->email }}</td>
                            <td>{{ $civ->user->id_number }}</td>
                            <td>{{ $civ->user->phone }}</td>
                            <td>
                                @if ($civ->user->gender == App\Models\User::MALE)
                                    Male
                                @else
                                    Female
                                @endif
                            </td>
                            <td>{{ $civ->user->age }}</td>
                            <td>
                                @if ($civ->user->marital_status == App\Models\User::SINGLE)
                                    Single
                                @elseif ($civ->user->marital_status == App\Models\User::MARRIED)
                                    Married
                                @elseif ($civ->user->marital_status == App\Models\User::DIVORCED)
                                    Divorced
                                @else
                                    Widowed
                                @endif
                            </td>
                            <td>{{ $civ->user->childrens }}</td>
                            <td>{{ $civ->user->country->name ?? 'Not Selected' }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <button type="button" class="btn btn-success btn-sm" title="Restore"
                                        data-toggle="modal" data-target="#restoreCiv_{{ $civ->id }}">
                                        Restore
                                    </button>
                                    <a href="{{ route('ngo.civilians.show', $civ->user->id) }}"
                                        class="btn btn-info btn-sm" title="Show">
                                        Show
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @include('Ngo.Civilians.restore')
                    @empty
                        <tr>
                            <td colspan="11" class="text-center alert alert-info">
                                No civilians found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination with search parameters -->
            <div class="mt-3">
                {{ $civilians->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
