@extends('dashboard.master')

@section('title')

    @push('css')
        <style>
            .category-btn {
                background-color: #ee6394;
                color: #ffffff;
                padding: 20px 20px !important;

            }

            .delete-btn {

                width:127px;
            }
        </style>
    @endpush

@section('content')

    <div class="col-lg-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <h4 class="card-title">Categories</h4>
                    </div>
                    <div class="col-3 text-end mb-3">
                        <a href="{{ route('dashboard.add-category') }}" class="btn btn-lg btn-inverse-danger">Add new category</a>
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
                            <th> ID </th>
                            <th> Image </th>
                            <th> Name </th>
                            <th> Status </th>
                            <th> Creation date </th>
                            <th> Created By </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($categories->isNotEmpty())
                            @foreach ($categories as $category)
                                <tr class="text-center">
                                    <td> {{ $category->id }} </td>
                                    <td> <img width="320" height="150"
                                        src="{{ asset('store_assets/images/categories/' . $category->image) }}"> </td>
                                    <td> {{ $category->name }} </td>
                                    <td> {{ $category->status }} </td>
                                    <td> {{ date('d-m-Y', strtotime($category->created_at ))}} </td>
                                    <td> {{ $category->created_by }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-evenly">
                                        <a href="{{ route('dashboard.update-category', $category->id) }}"
                                            class="btn btn-md">
                                            <i class="mdi mdi-pencil text-primary"></i></a>
                                        <form method="POST" action="{{ route('dashboard.delete-category', $category->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md"><i class="mdi mdi-delete text-danger"></i></button>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">No categories are currently here</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
