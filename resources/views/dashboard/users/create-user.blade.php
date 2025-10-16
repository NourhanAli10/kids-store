@extends('dashboard.master')

@section('title')

@section('content')

    <div class="col-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add User</h4>
                @if (session()->has('success'))
                    <div class="alert alert-success text-center ">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="{{ route('dashboard.users.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">First name</label>
                        <input type="text" name="first_name"class="form-control" id="first_name" placeholder="First name"
                            value="{{ old('first_name') }}">
                        @error('first_name')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name</label>
                        <input type="text" name="last_name"class="form-control" id="last_name" placeholder="last name"
                            value="{{ old('last_name') }}">
                        @error('last_name')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" name="phone"class="form-control" id="phone" placeholder="phone number"
                            value="{{ old('phone') }}">
                        @error('phone')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email"class="form-control" id="email" placeholder="Email"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password"class="form-control" id="password" placeholder="password"
                            value="{{ old('password') }}">
                        @error('password')
                            <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control p-3" name="role" id="role">
                            <option value="">Select Role</option>
                            <option @selected(old('role') === 'user') value="user">User</option>
                            <option @selected(old('role') === 'admin') value="admin">Admin</option>
                        </select>
                        @error('role')
                        <div class="text-danger font-weight-bold my-2">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="text-end mt-5">
                        <button type="submit" class="btn btn-lg btn-inverse-danger me-2">Submit</button>
                        <a href="{{ route('dashboard.users.index') }}" class="btn btn-lg btn-inverse-light text-dark">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>


@endsection
