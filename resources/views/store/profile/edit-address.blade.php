@extends('store.master')

@section('content')
    <div id="app">

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

                                        <a href="dash-address-edit.html">My Account</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->

            @session('success')
                <div class="alert alert-success text-center ">{{ session('success') }}</div>
            @endsession
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
                                            <h1 class="dash__h1 u-s-m-b-14">Edit Address</h1>
                                            <span class="dash__text u-s-m-b-30">We need an address where we could deliver
                                                products.</span>
                                            <form class="dash-address-manipulation" method="POST"
                                                action="{{ route('address.update', $address->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-fname">FIRST NAME *</label>

                                                        <input class="input-text input-text--primary-style" type="text"
                                                            id="address-fname" name="first_name"
                                                            value="{{ $address->first_name }}">
                                                        @error('first_name')
                                                            <p class="alert alert-danger text-center">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-lname">LAST NAME *</label>

                                                        <input class="input-text input-text--primary-style" type="text"
                                                            id="address-lname" name="last_name"
                                                            value="{{ $address->last_name }}">
                                                        @error('last_name')
                                                            <p class="alert alert-danger text-center">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-phone">PHONE *</label>

                                                        <input class="input-text input-text--primary-style" type="text"
                                                            id="address-phone" name="phone" value="{{ $address->phone }}">
                                                        @error('phone')
                                                            <p class="alert alert-danger text-center">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-type">ADDRESS TYPE *</label>
                                                        <select class="select-box select-box--primary-style"
                                                            id="address-type" name="address_type">
                                                            <option value="home" @selected(old('address_type', $address->address_type) == 'home')>Home
                                                            </option>
                                                            <option value="work" @selected(old('address_type', $address->address_type) == 'work')>Work
                                                            </option>
                                                            <option value="other" @selected(old('address_type', $address->address_type) == 'other')>Other
                                                            </option>
                                                        </select>
                                                        @error('address_type')
                                                            <p class="alert alert-danger text-center">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="gl-inline">

                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-street">ADDRESS *</label>

                                                        <input class="input-text input-text--primary-style" type="text"
                                                            name="address" id="address-street"
                                                            value="{{ $address->address }}">
                                                        @error('address')
                                                            <p class="alert alert-danger text-center">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-city">TOWN*</label>

                                                        <input class="input-text input-text--primary-style" type="text"
                                                            id="address-city" name="town" value="{{ $address->town }}">
                                                        @error('town')
                                                            <p class="alert alert-danger text-center">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <!--====== Select Box ======-->

                                                        <label class="gl-label" for="address-country">City *</label><select
                                                            class="select-box select-box--primary-style"
                                                            id="address-country" name="city">
                                                            <option selected value="">Choose City</option>
                                                            <option value="Alexandria" @selected(old('city', $address->city ?? '') == 'Alexandria')>
                                                                Alexandria</option>
                                                            <option value="Aswan" @selected(old('city', $address->city ?? '') == 'Aswan')>Aswan
                                                            </option>
                                                            <option value="Asyut" @selected(old('city', $address->city ?? '') == 'Asyut')>Asyut
                                                            </option>
                                                            <option value="Beni Suef" @selected(old('city', $address->city ?? '') == 'Beni Suef')>Beni Suef
                                                            </option>
                                                            <option value="Cairo" @selected(old('city', $address->city ?? '') == 'Cairo')>Cairo
                                                            </option>
                                                            <option value="Damanhur" @selected(old('city', $address->city ?? '') == 'Damanhur')>Damanhur
                                                            </option>
                                                            <option value="Damietta" @selected(old('city', $address->city ?? '') == 'Damietta')>Damietta
                                                            </option>
                                                            <option value="El Arish" @selected(old('city', $address->city ?? '') == 'El Arish')>El Arish
                                                            </option>
                                                            <option value="El Mahalla El Kubra"
                                                                @selected(old('city', $address->city ?? '') == 'El Mahalla El Kubra')>El Mahalla El Kubra
                                                            </option>
                                                            <option value="Faiyum" @selected(old('city', $address->city ?? '') == 'Faiyum')>Faiyum
                                                            </option>
                                                            <option value="Giza" @selected(old('city', $address->city ?? '') == 'Giza')>Giza
                                                            </option>
                                                            <option value="Hurghada" @selected(old('city', $address->city ?? '') == 'Hurghada')>Hurghada
                                                            </option>
                                                            <option value="Ismailia" @selected(old('city', $address->city ?? '') == 'Ismailia')>Ismailia
                                                            </option>
                                                            <option value="Kafr El Sheikh" @selected(old('city', $address->city ?? '') == 'Kafr El Sheikh')>
                                                                Kafr El Sheikh</option>
                                                            <option value="Luxor" @selected(old('city', $address->city ?? '') == 'Luxor')>Luxor
                                                            </option>
                                                            <option value="Mansoura" @selected(old('city', $address->city ?? '') == 'Mansoura')>Mansoura
                                                            </option>
                                                            <option value="Marsa Matruh" @selected(old('city', $address->city ?? '') == 'Marsa Matruh')>
                                                                Marsa Matruh</option>
                                                            <option value="Minya" @selected(old('city', $address->city ?? '') == 'Minya')>Minya
                                                            </option>
                                                            <option value="Port Said" @selected(old('city', $address->city ?? '') == 'Port Said')>Port
                                                                Said</option>
                                                            <option value="Qena" @selected(old('city', $address->city ?? '') == 'Qena')>Qena
                                                            </option>
                                                            <option value="Sharm El Sheikh" @selected(old('city', $address->city ?? '') == 'Sharm El Sheikh')>
                                                                Sharm El Sheikh</option>
                                                            <option value="Sohag" @selected(old('city', $address->city ?? '') == 'Sohag')>Sohag
                                                            </option>
                                                            <option value="Suez" @selected(old('city', $address->city ?? '') == 'Suez')>Suez
                                                            </option>
                                                            <option value="Tanta" @selected(old('city', $address->city ?? '') == 'Tanta')>Tanta
                                                            </option>
                                                            <option value="Zagazig" @selected(old('city', $address->city ?? '') == 'Zagazig')>Zagazig
                                                            </option>
                                                        </select>
                                                        <!--====== End - Select Box ======-->
                                                        @error('city')
                                                            <p class="alert alert-danger text-center">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="fl-inline">
                                                    <div class="u-s-m-b-30">
                                                        <input type="checkbox" id="is-default" name="is_default"
                                                            value="1">
                                                        <label class="gl-label d-inline" for="is-default">Set as default
                                                            address</label>
                                                        @error('is_default')
                                                            <p class="alert alert-danger text-center">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <button class="btn btn--e-brand-b-2" type="submit">SAVE</button>
                                            </form>
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
        <!--====== End - App Content ======-->


        <!--====== Main Footer ======-->
    </div>
@endsection
