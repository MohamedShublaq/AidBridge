{{-- Delete modal --}}
<div class="modal fade" id="deleteAdmin_{{ $admin->id }}" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Admin</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.admins.destroy' , $admin->id) }}"
                method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" name="admin_id"
                        value="{{ $admin->id }}">
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
