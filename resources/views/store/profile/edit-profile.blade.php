@extends('store.master')

@section('content')
    <!--====== App Content ======-->
    <div class="app-content">

        <!--====== Section 1 ======-->
        <div class="u-s-p-y-60">

            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="breadcrumb">
                        <div class="breadcrumb__wrap">
                            <ul class="breadcrumb__list">
                                <li class="has-separator">

                                    <a href="index.html">Home</a>
                                </li>
                                <li class="is-marked">

                                    <a href="dash-edit-profile.html">My Account</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section 1 ======-->


        <!--====== Section 2 ======-->
        <div class="u-s-p-b-60">

            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="dash">
                    <div class="container">
                        <div class="row">
                            @include('store.partials.profile-sidebar')
                            <div class="col-lg-9 col-md-12">
                                <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                    <div class="dash__pad-2">
                                        <h1 class="dash__h1 u-s-m-b-14">Edit Profile</h1>

                                        <span class="dash__text u-s-m-b-30">Looks like you haven't update your
                                            profile</span>
                                        <div class="dash__link dash__link--secondary u-s-m-b-30">

                                            <a data-modal="modal" data-modal-id="#dash-newsletter">Subscribe Newsletter</a>
                                        </div>
                                        @session('status')
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                            </div>
                                            @endsession
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form class="dash-edit-p" method="post"
                                                    action="{{ route('profile.update') }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="gl-inline">
                                                        <div class="u-s-m-b-30">
                                                            <label class="gl-label" for="reg-fname">FIRST NAME *</label>
                                                            <input class="input-text input-text--primary-style"
                                                                type="text" id="reg-fname" name="first_name"
                                                                value="{{ Auth::user()->first_name }}">
                                                            @error('first_name')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="u-s-m-b-30">

                                                            <label class="gl-label" for="reg-lname">LAST NAME *</label>

                                                            <input class="input-text input-text--primary-style"
                                                                type="text" id="reg-lname" name="last_name"
                                                                value="{{ Auth::user()->last_name }}">
                                                            @error('last_name')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="gl-inline">
                                                        <div class="u-s-m-b-30">

                                                            <label class="gl-label" for="reg-email">EMAIL *</label>

                                                            <input class="input-text input-text--primary-style"
                                                                type="text" id="reg-email" name="email"
                                                                value="{{ Auth::user()->email }}">
                                                            @error('email')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="u-s-m-b-30">

                                                            <label class="gl-label" for="reg-phone">PHONE *</label>

                                                            <input class="input-text input-text--primary-style"
                                                                type="text" id="reg-phone" name="phone"
                                                                value="{{ Auth::user()->phone }}">
                                                            @error('phone')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <button class="btn btn--e-brand-b-2" type="submit">SAVE</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                    <div class="dash__pad-2">
                                        <h1 class="dash__h1 u-s-m-b-14 mb-5">Change password</h1>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form class="dash-edit-p" action="{{ route('profile.change-password') }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="current_password">Current password *</label>

                                                        <input class="input-text input-text--primary-style" type="password"
                                                            id="current_password" name="current_password">
                                                            @error('current_password')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                    </div>
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="password">New password *</label>

                                                        <input class="input-text input-text--primary-style" type="password"
                                                            id="password" name="password">
                                                            @error('password')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                    </div>
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="password-confirm">Confirm Password *</label>

                                                        <input class="input-text input-text--primary-style" type="password"
                                                            id="password-confirm" name="password_confirmation">

                                                    </div>
                                                    <button class="btn btn--e-brand-b-2" type="submit">UPDATE</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 2 ======-->
    </div>
@endsection
