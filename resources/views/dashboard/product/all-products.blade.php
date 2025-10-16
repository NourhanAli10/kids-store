@extends('dashboard.master')

@section('content')
    <div class="col-lg-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <h4 class="card-title">Products</h4>
                    </div>
                    <div class="col-3 text-end">
                        <a href="{{ route('dashboard.products.create') }}" class="btn btn-lg btn-inverse-danger mb-5">Add new
                            Product</a>
                    </div>
                </div>

                <table class="table table-bordered w-100">
                    <thead>
                        <tr class="text-center">
                            <th> Name </th>
                            <th> Brand </th>
                            <th> Category </th>
                            <th> Quantity </th>
                            <th> Colors </th>
                            <th> Sizes </th>
                            <th> Price </th>
                            <th> Status </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products->IsNotEmpty())
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>
                                        @foreach ($product->variants as $variant)
                                            Colors : {{ $variant->color->name }}<br> <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($product->variants as $variant)
                                            Sizes: {{ $variant->size->name }}<br> <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($product->variants as $variant)
                                            Stock: {{ $variant->stock }}<br> <br>
                                        @endforeach
                                    </td>
                                    <td>{{ $product->price }} EGP</td>
                                    <td>
                                        @if ($product->status === 'in_stock')
                                            <span class="badge bg-success">in stock</span>
                                        @else
                                            <span class="badge bg-danger">Out of stock</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-evenly">
                                            <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                class="btn btn-md"> <i class="mdi mdi-pencil text-primary"></i></a>
                                            <form method="POST"
                                                action="{{ route('dashboard.products.destroy', $product->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-md">
                                                    <i class="mdi mdi-delete text-danger"></i>
                                                </button>
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">No Products are currently here</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
