{{-- Reject modal --}}
<div class="modal fade" id="reject_{{ $donor->id }}" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reject Donor</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ngo.donors.reject') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="donor_id"
                        value="{{ $donor->donor_id }}">
                    <h5>{{ $donor->donor->name }} can apply agin after one month!</h5>
                    <h5>Are you sure of the rejection process?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Reject modal --}}
