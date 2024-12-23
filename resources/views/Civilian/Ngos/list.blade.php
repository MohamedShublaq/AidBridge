<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-primary text-white">

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ngos as $ngo)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <img class="img-circle img-bordered-sm"
                                    src="{{ asset('uploads/Ngos/' . $ngo->ngo->logo) }}" width="60"
                                    height="60" alt="Ngo Logo" style="border-radius: 50%;">
                            </td>
                            <td>{{ $ngo->ngo->name }}</td>
                            <td>{{ $ngo->ngo->description }}</td>
                            <td>{{ $ngo->ngo->address }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center alert alert-info">
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
