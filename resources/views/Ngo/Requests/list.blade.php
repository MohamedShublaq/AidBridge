@if ($status == App\Models\Request::APPROVED)
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
                            <th scope="col">City</th>
                            <th scope="col">Street</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Pending/Received</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($requests as $req)
                            @php $aidDistribution = $req->aidDistributions()->first(); @endphp
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    <a href="{{ route('ngo.civilians.show', $req->user->id) }}">
                                        {{ $req->user->name }}
                                    </a>
                                </td>
                                <td>{{ $req->user->email }}</td>
                                <td>{{ $req->user->id_number }}</td>
                                <td>{{ $req->user->phone }}</td>
                                <td>
                                    @if ($req->user->gender == App\Models\User::MALE)
                                        Male
                                    @else
                                        Female
                                    @endif
                                </td>
                                <td>{{ $req->user->age }}</td>
                                <td>
                                    @if ($req->user->marital_status == App\Models\User::SINGLE)
                                        Single
                                    @elseif ($req->user->marital_status == App\Models\User::MARRIED)
                                        Married
                                    @elseif ($req->user->marital_status == App\Models\User::DIVORCED)
                                        Divorced
                                    @else
                                        Widowed
                                    @endif
                                </td>
                                <td>{{ $req->user->childrens }}</td>
                                <td>{{ $req->user->country->name }}</td>
                                <td>{{ $req->user->city }}</td>
                                <td>{{ $req->user->street }}</td>
                                <td>
                                    <span
                                        class="badge {{ $aidDistribution->status == App\Models\AidDistribution::RECEIVED ? 'bg-success' : 'bg-danger' }} text-white">
                                        {{ $aidDistribution->status == App\Models\AidDistribution::RECEIVED ? 'Received' : 'Not Received' }}
                                    </span>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="status-toggle"
                                            data-id="{{ $aidDistribution->id }}"
                                            @if ($aidDistribution->status == App\Models\AidDistribution::RECEIVED) checked @endif>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <form id="statusForm-{{ $aidDistribution->id }}"
                                    action="{{ route('ngo.aidDistrbutions.changeStatus') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="distribution_id" value="{{ $aidDistribution->id }}">
                                </form>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="14" class="text-center alert alert-info">
                                    No requests found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination with search parameters -->
                <div class="mt-3">
                    {{ $requests->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
@else
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            @if ($status == App\Models\Request::PENDING)
                                <th scope="col"><input type="checkbox" id="select-all-approve"></th>
                            @endif
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
                            <th scope="col">City</th>
                            <th scope="col">Street</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($requests as $req)
                            <tr>
                                @if ($status == App\Models\Request::PENDING)
                                    <td>
                                        <input type="checkbox" class="approved-checkbox" value="{{ $req->id }}">
                                    </td>
                                @endif
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $req->user->name }}</td>
                                <td>{{ $req->user->email }}</td>
                                <td>{{ $req->user->id_number }}</td>
                                <td>{{ $req->user->phone }}</td>
                                <td>
                                    @if ($req->user->gender == App\Models\User::MALE)
                                        Male
                                    @else
                                        Female
                                    @endif
                                </td>
                                <td>{{ $req->user->age }}</td>
                                <td>
                                    @if ($req->user->marital_status == App\Models\User::SINGLE)
                                        Single
                                    @elseif ($req->user->marital_status == App\Models\User::MARRIED)
                                        Married
                                    @elseif ($req->user->marital_status == App\Models\User::DIVORCED)
                                        Divorced
                                    @else
                                        Widowed
                                    @endif
                                </td>
                                <td>{{ $req->user->childrens }}</td>
                                <td>{{ $req->user->country->name }}</td>
                                <td>{{ $req->user->city }}</td>
                                <td>{{ $req->user->street }}</td>
                                <td class="text-center">
                                    @if ($status == App\Models\Request::PENDING)
                                        <button type="button" class="btn btn-success btn-sm" title="Approve"
                                            data-toggle="modal" data-target="#approve_{{ $req->id }}">
                                            Approve
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" title="Reject"
                                            data-toggle="modal" data-target="#reject_{{ $req->id }}">
                                            Reject
                                        </button>
                                    @endif
                                    <a href="{{ route('ngo.civilians.show', $req->user->id) }}"
                                        class="btn btn-info btn-sm" title="Show">
                                        Show
                                    </a>
                                </td>
                            </tr>
                            @if ($status == App\Models\Request::PENDING)
                                @include('Ngo.Requests.approve')
                                @include('Ngo.Requests.reject')
                            @endif
                        @empty
                            <tr>
                                <td colspan="{{ $status == App\Models\Request::PENDING ? '14' : '13' }}"
                                    class="text-center alert alert-info">
                                    No requests found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination with search parameters -->
                <div class="mt-3">
                    {{ $requests->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
@endif
@push('js')
    <script>
        document.querySelectorAll('.status-toggle').forEach(toggle => {
            toggle.addEventListener('change', function() {
                toggleStatus(this);
            });
        });

        function toggleStatus(toggle) {
            const form = document.getElementById('statusForm-' + toggle.dataset.id);
            form.submit();
        }
    </script>
@endpush

<style>
    /* Basic styling for the toggle switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 30px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 30px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        border-radius: 50%;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: 0.4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:checked+.slider:before {
        transform: translateX(20px);
    }
</style>
