@extends('dashboard.master')

@section('title')

@section('content')

    <div class="col-lg-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <h4 class="card-title">Colors</h4>
                    </div>
                    <div class="col-3 text-end">
                        <a href="{{ route('dashboard.colors.create') }}" class="btn btn-lg btn-inverse-danger mb-5">Add new color</a>
                    </div>
                </div>
                @if (session()->has('success'))
                <div class="alert alert-success text-center ">
                    {{ session('success') }}
                </div>
                @endif
                <table class="table table-bordered col-12">
                    <thead>
                        <tr class="text-center">
                            <th> ID </th>
                            <th> Color </th>
                            <th> Code </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($colors->isNotEmpty())
                            @foreach ($colors as $color)
                                <tr class="text-center">
                                    <td> {{ $color->id }} </td>
                                    <td> {{ $color->name }} </td>
                                    <td> {{ $color->hex_code }} </td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <a href="{{ route('dashboard.colors.edit', $color->id) }}" class="mx-2 text-primary">
                                            <i class="mdi mdi-pencil text-primary"></i>
                                        </a>
                                        <form method="POST" action="{{ route('dashboard.colors.destroy', $color->id) }}" class="">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                            class="btn btn-md">
                                            <i class="mdi mdi-delete text-danger"></i>
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">No Colors are currently here</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
