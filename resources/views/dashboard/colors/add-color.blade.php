@extends('dashboard.master')

@section('title')



@section('content')

    <div class="col-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Colors</h4>
                @if (session()->has('success'))
                    <div class="alert alert-success text-center ">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="{{ route('dashboard.colors.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name"class="form-control" id="name" placeholder="Name"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="ColorCode">Color Code</label>
                        <div class="color-picker">
                            <input type="color" name="color_picker" class="form-control" id="ColorCode">
                            <input type="text" name="hex_code" class="form-control" id="HexCode"
                                value="{{ old('hex_code') }}" readonly>
                        </div>
                    </div>
                    @error('hex_code')
                        <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                    @enderror
            <div class="text-end mt-5">
                <button type="submit" class="btn btn-lg btn-inverse-danger me-2">Create</button>
                <a href="{{ route('dashboard.colors.index') }}" class="btn btn-lg btn-inverse-light text-dark">Cancel</a>
            </div>
            </form>
        </div>
    </div>
    </div>


@endsection

@push('js')
    <script>
        document.getElementById('ColorCode').addEventListener('input', function() {
            document.getElementById('HexCode').value = this.value;
        });
    </script>
@endpush
