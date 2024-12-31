{{-- Import modal --}}
<div class="modal fade" id="importFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mark Requests As Received</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ngo.requests.importFile') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <a href="{{ route('ngo.requests.downloadTemplate') }}" class="btn btn-success btn-block d-flex align-items-center justify-content-center p-2">
                        <i class="fas fa-download"></i> Click Here to Download Template
                    </a><br>
                    <input type="hidden" name="aid_id" value="{{ $aid->id }}">
                    <input class="form-control" type="file" placeholder="Choose File" name="file" required>
                    @error('file')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Import modal --}}
