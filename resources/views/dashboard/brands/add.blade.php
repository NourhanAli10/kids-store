@extends('dashboard.master')

@section('title')

@section('content')

    <div class="col-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Brand</h4>
                @if (session()->has('success'))
                    <div class="alert alert-success text-center ">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="{{ route('dashboard.add-brand') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" name="name"class="form-control" id="exampleInputName1" placeholder="Name"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group position-relative">
                        <label for="image">Image</label>
                        <div class="input-group col-12">
                            <input type="file" name="image" id="image" class="form-control file-upload-info" placeholder="Upload Image">

                        </div>
                        @error('image')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label for="exampleSelectStatus">Status</label>
                        <select class="form-control p-3" name="status"id="exampleSelectStatus">
                            <option>Select</option>
                            <option @selected(old('status') === 'available') value="available">Available</option>
                            <option @selected(old('status') === 'unavailable') value="unavailable">Unavailable</option>
                        </select>
                        @error('status')
                        <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-end mt-5">
                        <button type="submit" class="btn btn-lg btn-inverse-danger me-2">Create</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


@endsection
