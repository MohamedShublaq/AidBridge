{{-- Approve modal --}}
<div class="modal fade" id="approve_{{ $req->id }}" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approve Request</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ngo.requests.approve') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="request_id"
                        value="{{ $req->id }}">
                    <select class="form-control" name="location_id" id="location_id" required>
                        <option selected disabled value="">Choose location</option>
                        @foreach ($req->aid->locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select><br>
                    <input type="date" class="form-control" name="distribution_date" required><br>
                    <h5>Are you sure of the approving process?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Approve modal --}}
