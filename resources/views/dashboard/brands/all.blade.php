@extends('dashboard.master')

@section('title', 'Brands')



@section('content')

    <div class="col-lg-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <h4 class="card-title">Brands</h4>
                    </div>
                    <div class="col-3 text-end mb-3">
                        <a href="{{ route('dashboard.add-brand') }}" class="btn btn-lg btn-inverse-danger">Add new brand</a>
                    </div>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success text-center ">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th> Image </th>
                            <th> Name </th>
                            <th> Status </th>
                            <th> Created at </th>
                            <th> Created by</th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($brands->isNotEmpty())
                            @foreach ($brands as $brand)
                                <tr>
                                    <td> <img width="320" height="150"
                                            src="{{ asset('store_assets/images/brands/' . $brand->image) }}"> </td>
                                    <td> {{ $brand->name }} </td>
                                    <td>
                                      {{ $brand->status }}
                                    </td>
                                    <td> {{ date('d-m-Y', strtotime($brand->created_at)) }} </td>
                                    <td> {{ $brand->created_by }}</td>
                                    <td>
                                        <div class="d-flex justify-content-evenly">
                                            <a href="{{ route('dashboard.update-brand', $brand->id) }}"
                                                class="btn btn-md"> <i class="mdi mdi-pencil text-primary"></i></a>
                                            <form method="POST" action="{{ route('dashboard.delete-brand', $brand->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-md">
                                                    <i class="mdi mdi-delete text-danger"></i>
                                                </button>
                                            </form>

                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">No Brands are currently here</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
