@extends('dashboard.master')

@section('title', 'add product')

@push('css')
    <style>
 .variation-row {
    display: flex;
    align-items: flex-start;
    gap: 10px; /* Add spacing between columns */
}

.variation-row .col-4 {
    flex: 1; /* Equal width for all columns */
}

.variation-row label {
    display: block; /* Labels above inputs */
    margin-bottom: 5px; /* Add spacing between label and input */
}

.variation-row select,
.variation-row input {
    width: 100%; /* Full width for inputs/selects */
}

.add-variation {
    margin-top: 21px;
}
    </style>
@endpush
@section('content')
    <div class="col-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Product</h4>
                <div class="alert alert-success text-center" id="success" style="display: none;">
                </div>
                @session("success")
                <div class="alert alert-success text-center ">
                    {{ session("success") }}
                </div>
                @endsession
                <form class="forms-sample" id="add-product" method="post" action="{{ route('dashboard.products.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group mb-3">
                            <label for="ProductName" class="mb-2">Name</label>
                            <input id="ProductName" name="name" type="text" class="form-control"
                                value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger font-weight-bold my-2"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="ProductPrice" class="mb-2">Price</label>
                            <input id="ProductPrice" name="price" type="number" step="0.01" class="form-control"
                                value="{{ old('price') }}">
                            @error('price')
                                <p class="text-danger font-weight-bold my-2"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="ProductCategory">Category</label>
                            <select class="form-control" id="ProductCategory" name="category_id">
                                <option value="">select</option>
                                @foreach ($categories as $category)
                                    <option @selected(old('category_id') == $category->id) value="{{ $category->id }}">{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-danger font-weight-bold my-2"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="ProductBrand">Brand</label>
                            <select class="form-control" id="ProductBrand" name="brand_id">
                                <option value="">select</option>
                                @foreach ($brands as $brand)
                                    <option @selected(old('brand_id') == $brand->id) value="{{ $brand->id }}" required>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <p class="text-danger font-weight-bold my-2"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label for="exampleSelectStatus">status</label>
                        <select class="form-control" id="exampleSelectStatus" name="status">
                            <option value="">Select</option>
                            <option @selected(old('status') === 'available') value="available">Available</option>
                            <option @selected(old('status') === 'unavailable') value="unavailable">Not Available</option>
                        </select>
                        @error('status')
                            <p class="text-danger font-weight-bold my-2"> {{ $message }} </p>
                        @enderror
                    </div>

                    {{-- <div class="form-group ">
                        <label for="ProductSizes">Sizes</label>
                        <select name="sizes[]" class="sizes form-control" id="ProductSizes" multiple="multiple">
                            <option value="">Select</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}" @selected(in_array($size->id, old('sizes', []))) >{{ $size->name }}</option>
                            @endforeach
                        </select>
                        @error('sizes')
                            <p class="text-danger font-weight-bold my-2"> {{ $message }} </p>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="ProductColors">Colors</label>
                        <select name="colors[]" multiple="multiple" class="colors form-control" id="ProductColors">
                            <option value="">Select</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}" @selected(in_array($color->id, old('colors', [])))>{{ $color->name }}</option>
                            @endforeach
                        </select>
                        @error('colors')
                            <p class="text-danger font-weight-bold my-2"> {{ $message }} </p>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="ProductQuantity" class="mb-2">Quantity</label>
                        <input id="ProductQuantity" name="stock" type="number" step="1" class="form-control"
                            value="{{ old('stock') }}">
                        @error('stock')
                            <p class="text-danger font-weight-bold my-2"> {{ $message }} </p>
                        @enderror
                    </div> --}}

                    <!-- Variations Section -->
                    <h3>Variations</h3>
                    <div id="variations-container">
                        <!-- Dynamic fields for variations -->
                        <div class="variation-row d-flex justify-content-between align-items-center">
                            <div class="col-4">
                                <label>Color</label>
                                <select class=" form-control col-12" name="colors[]" required>
                                    <option value="">Select Color</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label>Sizes</label>
                                <select class=" form-control col-12" name="sizes[]" required>
                                    <option value="">Select Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label>Quantity</label>
                                <input class="form-control col-12" type="number" name="stock[]" required>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-lg btn-inverse-danger me-2 add-variation">Add Variation</button>


                            </div>
                        </div>
                    </div>


                    <div class="form-group mt-4">
                        <label for="exampleTextarea1">Description</label>
                        <textarea class="form-control" name="description" id="exampleTextarea1" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-danger font-weight-bold my-2"> {{ $message }} </p>
                        @enderror
                    </div>
                    <div class="form-group position-relative">
                        <label for="image">Image</label>
                        <div class="input-group col-12">
                            <input type="file" name="images[]" id="image" class="form-control file-upload-info"
                                placeholder="Upload Image" multiple="multiple">
                        </div>
                        @error('images')
                            <p class="text-danger font-weight-bold my-2"> {{ $message }} </p>
                        @enderror
                    </div>
                    <div class="row mt-4" id="imagePreviewContainer"></div>

                    <div class="mt-5 d-flex justify-content-end">
                        <button type="submit" class="btn btn-lg btn-inverse-danger me-2">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        $(document).ready(function() {
            $('.colors').select2({

                tags: true,
            });

            $('.sizes').select2({
                tags: true,
            });
        });

        // $('#add-product').on('submit', function(event) {
        //     event.preventDefault();
        //     var formData = new FormData($('#add-product')[0]);
        //     $.ajax({
        //         type: 'post',
        //         enctype: 'multipart/form-data',
        //         url: "",
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         cache: false,
        //         success: function(data) {
        //             if (data.status == true) {
        //                 var successElement = $('#success');
        //                 successElement.text(data.message).show();
        //             }
        //     },
        // });



        $(document).ready(function() {
            $("#image").change(function() {
                var files = this.files;
                $('#imagePreviewContainer').empty(); // Clear previous previews

                if (files.length > 0) {
                    $.each(files, function(index, file) {
                        if (file.type.match('image.*')) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var imgHtml = `
                                    <div class="col-3">
                                        <img src="${e.target.result}" class="img-thumbnail" alt="Preview">
                                    </div>
                                `;
                                $('#imagePreviewContainer').append(imgHtml);
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const variationsContainer = document.getElementById('variations-container');

            // Add a new variation row
            variationsContainer.addEventListener('click', function (event) {
                if (event.target.classList.contains('add-variation')) {
                    // Clone the first variation row
                    const newRow = variationsContainer.querySelector('.variation-row').cloneNode(true);

                    // Clear the values of the cloned row
                    newRow.querySelectorAll('select, input').forEach(function (element) {
                        element.value = '';
                    });

                    // Append the cloned row to the container
                    variationsContainer.appendChild(newRow);
                }
            });
        });
    </script>
@endpush
