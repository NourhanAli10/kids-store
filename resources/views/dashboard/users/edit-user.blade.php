@extends('dashboard.master')

@section('title')

@section('content')

    <div class="col-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit User</h4>
                @if (session()->has('success'))
                <div class="alert alert-success text-center ">
                    {{ session('success') }}
                </div>
                @endif
                <form class="forms-sample" method="POST" action="{{ route('dashboard.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="first_name">First name</label>
                        <input type="text" name="first_name"class="form-control" id="first_name" placeholder="first name"
                            value="{{ $user->first_name}}">
                        @error('first_name')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name</label>
                        <input type="text" name="last_name"class="form-control" id="last_name" placeholder="last name"
                            value="{{ $user->last_name}}">
                        @error('last_name')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" name="phone"class="form-control" id="phone" placeholder="phone number"
                            value="{{ $user->phone}}">
                        @error('phone')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email"class="form-control" id="email" placeholder="Email"
                            value="{{ $user->email }}">
                        @error('email')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control p-3" name="role" id="role">
                            <option value="">Select Role</option>
                            <option @selected($user->role === 'user') value="user">User</option>
                            <option @selected($user->role === 'admin') value="admin">Admin</option>
                        </select>
                        @error('role')
                        <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="text-end mt-5">
                        <button type="submit" class="btn btn-lg btn-inverse-danger me-2">Update</button>
                        <a href="{{ route('dashboard.users.index') }}" class="btn btn-lg btn-light">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>


@endsection
