@extends('dashboard.master')

@section('title')

@section('content')

    <div class="col-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Brand</h4>
                @if (session()->has('success'))
                    <div class="alert alert-success text-center ">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="{{ route('dashboard.update-brand', $brand->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputName1">Brand Name</label>
                        <input type="text" name="name"class="form-control" id="exampleInputName1" placeholder="Name"
                            value="{{ $brand->name }}">
                        @error('name')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group position-relative">

                        <label for="image">Image</label>
                        <div class="input-group col-12">
                            <input type="file" name="image" id="image" class="form-control file-upload-info">
                        </div>
                        <img id ="imgPreview" class="mt-4" src="{{ asset('store_assets/images/brands/' . $brand->image) }}"
                            alt="" width="300px" height="200px">

                        @error('image')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleSelectStatus">Status</label>
                        <select class="form-control p-3" name="status"id="exampleSelectStatus">
                            <option @selected($brand->status === 'Available') value="Available">Available</option>
                            <option @selected($brand->status === 'Not available') value="Not available">Not available</option>
                        </select>
                    </div>


                    <div class="text-end mt-5">
                        <button type="submit" class="btn btn-lg btn-inverse-danger me-2">Update</button>
                        <button class="btn btn-lg btn-inverse-dark"><a class="text-decoration-none"
                                href="{{ route('dashboard.all-brands') }}">Cancel</a></button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#image").change(function() {
                if (this.files && this.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#imgPreview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endpush
