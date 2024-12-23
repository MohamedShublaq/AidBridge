{{-- Edit modal --}}
<div class="modal fade" id="editProvider_{{ $provider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Provider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ngo.providers.update' , $provider->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="ngo_id" value="{{ auth('ngo')->user()->id }}">
                    <input class="form-control" type="text" name="name" value="{{ $provider->name }}" required><br>
                    @error('name')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                    <input class="form-control" type="text" name="phone" value="{{ $provider->phone }}" required>
                    @error('phone')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Edi modal --}}
