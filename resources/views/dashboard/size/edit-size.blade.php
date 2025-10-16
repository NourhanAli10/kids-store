@extends('dashboard.master')

@section('title')

@section('content')

    <div class="col-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Size</h4>
                @if (session()->has('success'))
                    <div class="alert alert-success text-center ">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="forms-sample" method="POST" action="{{ route('dashboard.sizes.update', $size->id  ) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Size</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                            value="{{ $size->name}}">
                        @error('name')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-end mt-5">
                        <button type="submit" class="btn button btn-lg btn-inverse-danger me-2">Update</button>
                        <a href="{{ route('dashboard.sizes.index') }}" class="btn btn-lg btn-inverse-light text-dark">Cancel</a>

                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
