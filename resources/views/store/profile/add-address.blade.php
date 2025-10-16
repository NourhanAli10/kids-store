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

                                    <a href="dash-address-add.html">My Account</a>
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
                                        <h1 class="dash__h1 u-s-m-b-14">Add new Address</h1>

                                        <span class="dash__text u-s-m-b-30">We need an address where we could deliver
                                            products.</span>
                                        <form class="dash-address-manipulation" method="POST"
                                            action="{{ route('address.store') }}">
                                            @csrf
                                            <div class="gl-inline">
                                                <div class="u-s-m-b-30">

                                                    <label class="gl-label" for="address-fname">FIRST NAME *</label>

                                                    <input class="input-text input-text--primary-style" type="text"
                                                        id="address-fname" name="first_name">
                                                </div>
                                                <div class="u-s-m-b-30">

                                                    <label class="gl-label" for="address-lname">LAST NAME *</label>

                                                    <input class="input-text input-text--primary-style" type="text"
                                                        id="address-lname" name="last_name">
                                                </div>
                                            </div>
                                            <div class="gl-inline">
                                                <div class="u-s-m-b-30">

                                                    <label class="gl-label" for="address-phone">PHONE *</label>

                                                    <input class="input-text input-text--primary-style" type="text"
                                                        id="address-phone" name="phone" value="{{ $user->phone }}">
                                                </div>

                                            </div>

                                            <div class="gl-inline">
                                                <div class="u-s-m-b-30">

                                                    <label class="gl-label" for="address-type">ADDRESS TYPE *</label>
                                                    <select class="select-box select-box--primary-style" id="address-type"
                                                        name="address_type">
                                                        <option value="home">Home</option>
                                                        <option value="work">Work</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="gl-inline">

                                                <div class="u-s-m-b-30">

                                                    <label class="gl-label" for="address-street">ADDRESS *</label>

                                                    <input class="input-text input-text--primary-style" type="text"
                                                        name="address" id="address-street"
                                                        placeholder="House number , Street , floor and apartment">
                                                </div>
                                            </div>
                                            <div class="gl-inline">
                                                <div class="u-s-m-b-30">

                                                    <label class="gl-label" for="address-city">TOWN*</label>

                                                    <input class="input-text input-text--primary-style" type="text"
                                                        id="address-city" name="town">
                                                </div>

                                            </div>
                                            <div class="gl-inline">
                                                <div class="u-s-m-b-30">

                                                    <!--====== Select Box ======-->

                                                    <label class="gl-label" for="address-country">City *</label><select
                                                        class="select-box select-box--primary-style" id="address-country"
                                                        name="city">
                                                        <option selected value="">Choose City</option>
                                                        <option value="Alexandria">Alexandria</option>
                                                        <option value="Aswan">Aswan</option>
                                                        <option value="Asyut">Asyut</option>
                                                        <option value="Beni Suef">Beni Suef</option>
                                                        <option value="Cairo">Cairo</option>
                                                        <option value="Damanhur">Damanhur</option>
                                                        <option value="Damietta">Damietta</option>
                                                        <option value="El Arish">El Arish</option>
                                                        <option value="El Mahalla El Kubra">El Mahalla El Kubra</option>
                                                        <option value="Faiyum">Faiyum</option>
                                                        <option value="Giza">Giza</option>
                                                        <option value="Hurghada">Hurghada</option>
                                                        <option value="Ismailia">Ismailia</option>
                                                        <option value="Kafr El Sheikh">Kafr El Sheikh</option>
                                                        <option value="Luxor">Luxor</option>
                                                        <option value="Mansoura">Mansoura</option>
                                                        <option value="Marsa Matruh">Marsa Matruh</option>
                                                        <option value="Minya">Minya</option>
                                                        <option value="Port Said">Port Said</option>
                                                        <option value="Qena">Qena</option>
                                                        <option value="Sharm El Sheikh">Sharm El Sheikh</option>
                                                        <option value="Sohag">Sohag</option>
                                                        <option value="Suez">Suez</option>
                                                        <option value="Tanta">Tanta</option>
                                                        <option value="Zagazig">Zagazig</option>
                                                    </select>
                                                    <!--====== End - Select Box ======-->
                                                </div>

                                                {{-- <div class="u-s-m-b-30">

                                                <!--====== Select Box ======-->

                                                <label class="gl-label" for="address-state">STATE/PROVINCE *</label><select class="select-box select-box--primary-style" id="address-state">
                                                    <option selected value="">Choose State/Province</option>
                                                    <option value="al">Alabama</option>
                                                    <option value="al">Alaska</option>
                                                    <option value="ny">New York</option>
                                                </select>
                                                <!--====== End - Select Box ======-->
                                            </div> --}}
                                            </div>
                                            <div class="fl-inline">
                                                <div class="u-s-m-b-30">
                                                <input type="checkbox" id="is-default" name="is_default" value="1">
                                                <label class="gl-label d-inline" for="is-default">Set as default address</label>
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
@endsection
