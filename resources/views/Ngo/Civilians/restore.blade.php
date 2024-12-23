{{-- Restore modal --}}
<div class="modal fade" id="restoreCiv_{{ $civ->id }}" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Restore Civilian</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ngo.civilians.restore') }}"
                method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="civ_id"
                        value="{{ $civ->id }}">
                    <h5>{{ $civ->user->name }} status will be pending.</h5>
                    <h5>Are you sure of the restoring process?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Restore</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Restore modal --}}
