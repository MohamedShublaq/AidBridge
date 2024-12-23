{{-- Delete modal --}}
<div class="modal fade" id="deleteCiv_{{ $civ->id }}" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Civilian</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ngo.civilians.delete') }}"
                method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="civ_id"
                        value="{{ $civ->id }}">
                    <h5>{{ $civ->user->name }} can not apply agin for us!</h5>
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
