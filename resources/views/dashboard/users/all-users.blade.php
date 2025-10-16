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
                        <h4 class="card-title">Users</h4>
                    </div>
                    <div class="col-3 text-end">
                        <a href="{{ route('dashboard.users.create') }}" class="btn btn-lg btn-inverse-danger mb-4">Add new User</a>
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
                            <th> Name </th>
                            <th> Role </th>
                            <th> Status </th>
                            <th> Created at </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users->isNotEmpty())
                            @foreach ($users as $user)
                                <tr class="text-center">
                                    <td> {{ $user->id }} </td>
                                    <td> {{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td> {{ $user->role }} </td>
                                    <td> {{ $user->status }} </td>
                                    <td> {{ date('d-m-Y', strtotime($user->created_at ))}} </td>
                                    <td class="d-flex justify-content-evenly">
                                        <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-md "><i class="mdi mdi-pencil text-primary"></i></a>
                                        <form method="POST" action="{{ route('dashboard.users.destroy', $user->id) }}">
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
                            <td colspan="7" class="text-center">No categories are currently here</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
