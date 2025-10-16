@extends('dashboard.master')

@section('title')

@section('content')

    <div class="col-lg-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <h4 class="card-title">Sizes</h4>
                    </div>
                    <div class="col-3 text-end">
                        <a href="{{ route('dashboard.sizes.create') }}" class="btn btn-lg btn-inverse-danger mb-5">Add new Size</a>
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
                            <th> Size </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($sizes->isNotEmpty())
                            @foreach ($sizes as $size)
                                <tr class="text-center">
                                    <td> {{ $size->id }} </td>
                                    <td> {{ $size->name }} </td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <a href="{{ route('dashboard.sizes.edit', $size->id) }}" class="mx-2 text-primary">
                                            <i class="mdi mdi-pencil text-primary"></i>
                                        </a>
                                        <form method="POST" action="{{ route('dashboard.sizes.destroy', $size->id) }}" class="">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md">
                                                <i class="mdi mdi-delete text-danger"></i>
                                            </button
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">No Sizes are currently here</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
