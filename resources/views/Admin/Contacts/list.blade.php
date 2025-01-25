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
                        <th scope="col">Body</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $contact)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($contact->body, 20, '...') }}</td>
                            <td>
                                <span
                                    class="badge {{ $contact->status == App\Models\Contact::READ ? 'bg-success' : 'bg-danger' }} text-white">
                                    {{ $contact->status == App\Models\Contact::READ ? 'Read' : 'Unread' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <a href="{{ route('admin.contacts.show', $contact->id) }}"
                                        class="btn btn-success btn-sm" title="Show">
                                        Show
                                    </a>
                                    @php
                                        $pendingDeletionContact = App\Models\DeletionRequest::where(
                                            'deletable_type',
                                            App\Models\Contact::class,
                                        )
                                            ->where('deletable_id', $contact->id)
                                            ->where('status', App\Models\DeletionRequest::PENDING)
                                            ->first();
                                    @endphp
                                    @if (!$pendingDeletionContact)
                                        <button type="button" class="btn btn-danger btn-sm" title="Delete"
                                            data-toggle="modal" data-target="#deleteContact_{{ $contact->id }}">
                                            Delete
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-warning btn-sm">
                                            Deletion is pending
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @include('Admin.Contacts.delete')
                    @empty
                        <tr>
                            <td colspan="7" class="text-center alert alert-info">
                                No Contacts found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination with search parameters -->
            <div class="mt-3">
                {{ $contacts->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
