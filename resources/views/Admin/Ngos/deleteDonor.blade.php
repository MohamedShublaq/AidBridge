{{-- Delete modal --}}
<div class="modal fade" id="deleteDonor_{{ $donor->id }}" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Donor</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.donors.destroy' , $donor->donor_id) }}"
                method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" name="donor_id"
                        value="{{ $donor->donor_id }}">
                    <h5>Are you sure of the deleting process?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Delete modal --}}
