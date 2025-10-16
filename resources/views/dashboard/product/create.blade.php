@extends('dashboard.master')

@section('title', 'add product')

@push('css')
    {{-- <style>
        .colors::placeholder {
            color: #6c757d;
            size: 15px;


        }

        .select2-search__field {
            width: 0 !important;
        }

        .select2-selection__choice {
            font-size: 18px !important;
            background-color: transparent !important;
            color: #0e0404000b00 !important;
        }

        .select2-selection__choice__display {

            color: #000000 !important;
            border: 1px solid #000000;

        }

        .img-thumbnail {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        .col-3 {
            flex: 0 0 25%;
            max-width: 25%;
            padding: 0.5rem;
        }
    </style> --}}
@endpush

@section('content')
<div class="container">
    <h1>Add Product</h1>
    <form action="{{ route('dashboard.products.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>

        <h2>Variations</h2>
        <div id="variations-container">
            <div class="variation-group">
                <div class="form-group">
                    <label for="color">Color</label>
                    <select name="variations[0][color_id]" class="form-control" required>
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="size">Size</label>
                    <select name="variations[0][size_id]" class="form-control" required>
                        @foreach($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="variations[0][stock]" class="form-control" required>
                </div>
            </div>
        </div>
        <button type="button" id="add-variation" class="btn btn-secondary">Add Variation</button>
        <button type="submit" class="btn btn-primary">Save Product</button>
    </form>
</div>

@endsection




@push('js')

<script>
    document.getElementById('add-variation').addEventListener('click', function() {
        const variationsContainer = document.getElementById('variations-container');
        const variationGroup = document.querySelector('.variation-group').cloneNode(true);
        const variationIndex = variationsContainer.childElementCount;

        variationGroup.querySelectorAll('select, input').forEach(element => {
            element.name = element.name.replace('[0]', `[${variationIndex}]`);
        });

        variationsContainer.appendChild(variationGroup);
    });
</script>
@endpush
