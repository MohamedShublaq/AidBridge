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
                        <th scope="col">Location</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($receivedAids as $request)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $request->aid->name }}</td>
                            <td>{{ $request->aid->description }}</td>
                            <td>
                                @if ($request->aid->type == App\Models\Aid::NUTRITIONAL)
                                    NUTRITIONAL
                                @elseif ($request->aid->type == App\Models\Aid::CASH)
                                    CASH
                                @else
                                    MEDICAL
                                @endif
                            </td>
                            @php
                                $distribution = $request->aidDistributions->first();
                            @endphp
                            <td>{{ $distribution->location->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center alert alert-info">
                                No Aids found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination with search parameters -->
            <div class="mt-3">
                {{ $receivedAids->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
