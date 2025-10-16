@extends('dashboard.master')

@section('title')

@push('css')
<style>
   .color-picker {
    display: flex;
    align-items: center;
}

.color-preview {
    width: 100%;
    height: 50px;
    padding: 0.94rem 1.375rem;
    border: 1px solid #ccc;
    position: relative;
}

input[type="color"] {
    position:absolute;
    width: 50px; /* Adjust the width as needed */
    height: 50px; /* Adjust the height as needed */
    margin-left: 5px;
    border: none;
    padding: 0;
}


</style>

@endpush

@section('content')

    <div class="col-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Sizes</h4>
                @if (session()->has('success'))
                    <div class="alert alert-success text-center ">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="{{ route('dashboard.sizes.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="SizeName">Size</label>
                        <input type="text" name="name"class="form-control" id="SizeName"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-end mt-5">
                        <button type="submit" class="btn btn-lg btn-inverse-danger me-2">Create</button>
                        <a href="{{ route('dashboard.sizes.index') }}" class="btn btn-lg btn-inverse-light text-dark">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('js')
{{--
<script src="ntc.js"></script>
<script>

$(document).ready(function() {
    $('#ColorCode').on('input', function() {
        const colorCode = $(this).val();
        const n_match = ntc.name(colorCode);
        const colorName = n_match[1]; // Get the name of the color
        $('#colorName').val(colorName);

        // Update the color preview background color
        $('#colorPreview').css('background-color', colorCode);
    });

    $('#createButton').on('click', function() {
        const colorName = $('#colorName').val();
        const colorCode = $('#ColorCode').val();
        // Do something with the color name and color code, e.g., save it or display it.
        alert(`Color Name: ${colorName}\nColor Code: ${colorCode}`);
    });
});


</script>
 --}}


@endpush
