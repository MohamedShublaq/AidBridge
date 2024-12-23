@extends('Layouts.app')

@section('title')
    Edit Aid
@endsection

@push('style')
    <style>
        .location-input {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .location-input input {
            flex: 1;
        }

        .location-input button {
            padding: 6px 12px;
            cursor: pointer;
        }

        .location-input .add-location {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        .location-input .remove-location {
            background-color: #f44336;
            color: white;
            border: none;
        }
    </style>
@endpush

@section('content')
    <div class="card shadow-lg p-4 col-10 mx-auto">
        <h2 class="text-center mb-4">Edit Aid</h2>

        <form action="{{ route('ngo.aids.update' , $aid->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="ngo_id" value="{{ Auth::guard('ngo')->user()->id }}">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input id="name" class="form-control border-primary" value="{{ $aid->name }}" placeholder="Enter Name" type="text"
                    name="name" required>
                @error('name')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea class="form-control border-primary" name="description" id="description" rows="5" required>{{ $aid->description }}</textarea>
                @error('description')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="type" class="form-label fw-bold">Type</label>
                <select name="type" id="type" class="form-control border-primary" required>
                    <option @if($aid->type == App\Models\Aid::NUTRITIONAL) selected @endif value="{{ App\Models\Aid::NUTRITIONAL }}">NUTRITIONAL</option>
                    <option @if($aid->type == App\Models\Aid::CASH) selected @endif value="{{ App\Models\Aid::CASH }}">CASH</option>
                    <option @if($aid->type == App\Models\Aid::MEDICAL) selected @endif value="{{ App\Models\Aid::MEDICAL }}">MEDICAL</option>
                </select>
                @error('type')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label fw-bold">Quantity</label>
                <input id="quantity" class="form-control border-primary" value="{{ $aid->quantity }}" placeholder="Enter Quantity" type="text"
                    name="quantity" required>
                @error('quantity')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Locations</label>
                <div id="locations-wrapper">
                    @foreach($aid->locations as $location)
                        <div class="location-input">
                            <input type="text" class="form-control border-primary" name="locations[]" value="{{ $location->name }}" placeholder="Enter Location" required>
                            <button type="button" class="remove-location">-</button>
                            <button type="button" class="add-location">+</button>
                        </div>
                    @endforeach
                </div>
                @error('locations')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a class="btn btn-danger" href="{{ route('ngo.aids.index') }}">Back to Aids</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const locationsWrapper = document.getElementById('locations-wrapper');

        const updateButtons = () => {
            const allInputs = locationsWrapper.querySelectorAll('.location-input');

            allInputs.forEach((input, index) => {
                const addButton = input.querySelector('.add-location');
                const removeButton = input.querySelector('.remove-location');

                // Show the add button only on the last input
                addButton.style.display = index === allInputs.length - 1 ? 'inline-block' : 'none';

                // Show the remove button only if there are more than one input
                removeButton.style.display = allInputs.length > 1 ? 'inline-block' : 'none';
            });
        };

        locationsWrapper.addEventListener('click', (e) => {
            if (e.target.classList.contains('add-location')) {
                e.preventDefault();

                const newLocationDiv = document.createElement('div');
                newLocationDiv.classList.add('location-input');

                newLocationDiv.innerHTML = `
                <input type="text" class="form-control border-primary" name="locations[]" placeholder="Enter Location" required>
                <button type="button" class="remove-location">-</button>
                <button type="button" class="add-location">+</button>
                `;

                locationsWrapper.appendChild(newLocationDiv);

                updateButtons();
            }

            if (e.target.classList.contains('remove-location')) {
                e.preventDefault();

                e.target.parentElement.remove();

                updateButtons();
            }
        });

        updateButtons();
    });
</script>
@endpush

