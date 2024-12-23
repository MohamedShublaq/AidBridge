@extends('Layouts.app')

@section('title')
    Import Civilians
@endsection

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Import Civilians</h2>
        <a href="{{ route('ngo.civilians.downloadTemplate') }}" class="btn btn-success">
            <i class="fas fa-download"></i> Click Here to Download Template
        </a><br>
        <form action="{{ route('ngo.civilians.importFile') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control dropify"><br>
            <select class="form-control" name="provider_id" required>
                <option selected disabled value="">Select Provider</option>
                @foreach ($providers as $provider)
                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                @endforeach
            </select><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <br>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
            'default': 'Drop a file here',
            'replace': 'Drag and drop or click to replace',
            'remove':  'Remove',
            'error':   'Ooops, something wrong happended.'
            }
        });
</script>
@endpush
