@extends('dashboard.master')

@section('title')





@section('content')

    <div class="col-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Color</h4>
                @if (session()->has('success'))
                <div class="alert alert-success text-center ">
                    {{ session('success') }}
                </div>
                @endif
                <form class="forms-sample" method="POST" action="{{ route('dashboard.colors.update', $color->id  ) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Name"
                            value="{{ $color->name}}">
                        @error('name')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ColorCode">Color Code</label>
                        <div class="color-picker">
                            <input type="color" name="color_picker" class="form-control" id="ColorCode">
                            <input type="text" name="hex_code" class="form-control" id="HexCode"
                                value="{{ $color->hex_code }}" readonly>
                        </div>
                    </div>

                    <div class="text-end mt-5">
                        <button type="submit" class="btn button btn-lg btn-inverse-danger me-2">Update</button>
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
