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

                                    <a href="checkout.html">Checkout</a>
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
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="checkout-msg-group">
                                <div class="msg">

                                    <span class="msg__text">Have a coupon?

                                        <a class="gl-link" href="#have-coupon" data-toggle="collapse">Click Here to enter
                                            your code</a></span>
                                    <div class="collapse" id="have-coupon" data-parent="#checkout-msg-group">
                                        <div class="c-f u-s-m-b-16">

                                            <span class="gl-text u-s-m-b-16">Enter your coupon code if you have one.</span>
                                            <form class="c-f__form">
                                                <div class="u-s-m-b-16">
                                                    <div class="u-s-m-b-15">

                                                        <label for="coupon"></label>

                                                        <input class="input-text input-text--primary-style" type="text"
                                                            id="coupon" placeholder="Coupon Code">
                                                    </div>
                                                    <div class="u-s-m-b-15">

                                                        <button class="btn btn--e-transparent-brand-b-2"
                                                            type="submit">APPLY</button>
                                                    </div>
                                                </div>
                                            </form>
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


        <!--====== Section 3 ======-->
        <div class="u-s-p-b-60">
            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="checkout-f">
                        <div class="row">
                            <div class="col-lg-6">
                                <h1 class="checkout-f__h1">DELIVERY INFORMATION</h1>
                                <form class="checkout-f__delivery" method="post" action="{{ route('processOrder') }}"
                                    id="checkout-form">
                                    @csrf
                                    <div class="u-s-m-b-30">
                                        <div class="u-s-m-b-15"></div>

                                        <!--====== First Name, Last Name ======-->
                                        <div class="gl-inline">
                                            <div class="u-s-m-b-15">
                                                <label class="gl-label" for="billing-fname">FIRST NAME *</label>
                                                <input class="input-text input-text--primary-style" type="text"
                                                    id="billing-fname"
                                                    value="{{ old('first_name', $address->first_name ?? '') }}"
                                                    data-bill="" name="first_name">
                                                @error('first_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="u-s-m-b-15">
                                                <label class="gl-label" for="billing-lname">LAST NAME *</label>
                                                <input class="input-text input-text--primary-style" type="text"
                                                    id="billing-lname"
                                                    value="{{ old('last_name', $address->last_name ?? '') }}" data-bill=""
                                                    name="last_name">
                                                @error('last_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--====== End - First Name, Last Name ======-->

                                        <!--====== E-MAIL ======-->
                                        <div class="u-s-m-b-15">
                                            <label class="gl-label" for="billing-email">E-MAIL *</label>
                                            <input class="input-text input-text--primary-style" type="email"
                                                id="billing-email" value="{{ old('email', $user->email) }}" data-bill=""
                                                name="email">
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <!--====== End - E-MAIL ======-->

                                        <!--====== PHONE ======-->
                                        <div class="u-s-m-b-15">
                                            <label class="gl-label" for="billing-phone">PHONE *</label>
                                            <input class="input-text input-text--primary-style" type="tel"
                                                id="billing-phone" value="{{ old('phone', $address->phone ?? '') }}"
                                                data-bill="" name="phone">
                                            @error('phone')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <!--====== End - PHONE ======-->

                                        <div class="gl-inline">
                                            <div class="u-s-m-b-30">
                                                <label class="gl-label" for="address-type">ADDRESS TYPE *</label>
                                                <select class="select-box select-box--primary-style" id="address-type"
                                                    name="address_type">
                                                    <option value="">Choose Address Type</option>
                                                    <option value="home" @selected(old('address_type', $address->address_type ?? '') == 'home')>Home</option>
                                                    <option value="work" @selected(old('address_type', $address->address_type ?? '') == 'work')>Work</option>
                                                    <option value="other" @selected(old('address_type', $address->address_type ?? '') == 'other')>Other</option>
                                                </select>
                                                @error('address_type')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!--====== Street Address ======-->
                                        <div class="u-s-m-b-15">
                                            <label class="gl-label" for="billing-street">STREET ADDRESS *</label>
                                            <input class="input-text input-text--primary-style" type="text"
                                                id="billing-street" value="{{ old('address', $address->address ?? '') }}"
                                                placeholder="House name and street name" data-bill="" name="address">
                                            @error('address')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <!--====== End - Street Address ======-->

                                        <!--====== Town / City ======-->
                                        <div class="u-s-m-b-15">
                                            <label class="gl-label" for="billing-town-city">TOWN/CITY *</label>
                                            <input class="input-text input-text--primary-style" type="text"
                                                id="billing-town-city" value="{{ old('town', $address->town ?? '') }}"
                                                data-bill="" name="town">
                                            @error('town')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <!--====== End - Town / City ======-->

                                        <!--====== STATE/PROVINCE ======-->
                                        <div class="gl-inline">
                                            <div class="u-s-m-b-30">
                                                <label class="gl-label" for="city">City *</label>
                                                <select class="select-box select-box--primary-style" id="city"
                                                    name="city">
                                                    <option value="">Choose City</option>
                                                    <option value="Alexandria" @selected(old('city', $address->city ?? '') == 'Alexandria')>Alexandria
                                                    </option>
                                                    <option value="Aswan" @selected(old('city', $address->city ?? '') == 'Aswan')>Aswan</option>
                                                    <option value="Asyut" @selected(old('city', $address->city ?? '') == 'Asyut')>Asyut</option>
                                                    <option value="Beni Suef" @selected(old('city', $address->city ?? '') == 'Beni Suef')>Beni Suef
                                                    </option>
                                                    <option value="Cairo" @selected(old('city', $address->city ?? '') == 'Cairo')>Cairo</option>
                                                    <option value="Damanhur" @selected(old('city', $address->city ?? '') == 'Damanhur')>Damanhur</option>
                                                    <option value="Damietta" @selected(old('city', $address->city ?? '') == 'Damietta')>Damietta</option>
                                                    <option value="El Arish" @selected(old('city', $address->city ?? '') == 'El Arish')>El Arish
                                                    </option>
                                                    <option value="El Mahalla El Kubra" @selected(old('city', $address->city ?? '') == 'El Mahalla El Kubra')>El
                                                        Mahalla El Kubra</option>
                                                    <option value="Faiyum" @selected(old('city', $address->city ?? '') == 'Faiyum')>Faiyum</option>
                                                    <option value="Giza" @selected(old('city', $address->city ?? '') == 'Giza')>Giza</option>
                                                    <option value="Hurghada" @selected(old('city', $address->city ?? '') == 'Hurghada')>Hurghada
                                                    </option>
                                                    <option value="Ismailia" @selected(old('city', $address->city ?? '') == 'Ismailia')>Ismailia
                                                    </option>
                                                    <option value="Kafr El Sheikh" @selected(old('city', $address->city ?? '') == 'Kafr El Sheikh')>Kafr El
                                                        Sheikh</option>
                                                    <option value="Luxor" @selected(old('city', $address->city ?? '') == 'Luxor')>Luxor</option>
                                                    <option value="Mansoura" @selected(old('city', $address->city ?? '') == 'Mansoura')>Mansoura
                                                    </option>
                                                    <option value="Marsa Matruh" @selected(old('city', $address->city ?? '') == 'Marsa Matruh')>Marsa Matruh
                                                    </option>
                                                    <option value="Minya" @selected(old('city', $address->city ?? '') == 'Minya')>Minya</option>
                                                    <option value="Port Said" @selected(old('city', $address->city ?? '') == 'Port Said')>Port Said
                                                    </option>
                                                    <option value="Qena" @selected(old('city', $address->city ?? '') == 'Qena')>Qena</option>
                                                    <option value="Sharm El Sheikh" @selected(old('city', $address->city ?? '') == 'Sharm El Sheikh')>Sharm El
                                                        Sheikh</option>
                                                    <option value="Sohag" @selected(old('city', $address->city ?? '') == 'Sohag')>Sohag</option>
                                                    <option value="Suez" @selected(old('city', $address->city ?? '') == 'Suez')>Suez</option>
                                                    <option value="Tanta" @selected(old('city', $address->city ?? '') == 'Tanta')>Tanta</option>
                                                    <option value="Zagazig" @selected(old('city', $address->city ?? '') == 'Zagazig')>Zagazig</option>
                                                </select>
                                                @error('city')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--====== End - STATE/PROVINCE ======-->

                                        <div class="u-s-m-b-10">
                                            <!--====== Check Box ======-->
                                            <div class="check-box">
                                                <input type="checkbox" id="ship-to-different-address-checkbox"
                                                    data-bill="" name="ship_to_another_address" value="1"
                                                    {{ old('ship_to_another_address') ? 'checked' : '' }}>
                                                <div class="check-box__state check-box__state--primary">
                                                    <label class="check-box__label"
                                                        for="ship-to-different-address-checkbox">Ship to another
                                                        address</label>
                                                </div>
                                            </div>
                                            <!--====== End - Check Box ======-->
                                            @error('ship_to_another_address')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Dynamic Shipping Address Form -->
                                        <div id="shipping-address-form"
                                            style="display: {{ old('ship_to_another_address') ? 'block' : 'none' }};">
                                            <div class="u-s-m-b-30">
                                                <!--====== First Name, Last Name ======-->
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-15">
                                                        <label class="gl-label" for="shipping-fname">SHIPPING FIRST NAME
                                                            *</label>
                                                        <input class="input-text input-text--primary-style" type="text"
                                                            id="shipping-fname" name="shipping_first_name"
                                                            value="{{ old('shipping_first_name') }}">
                                                        @error('shipping_first_name')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="u-s-m-b-15">
                                                        <label class="gl-label" for="shipping-lname">SHIPPING LAST NAME
                                                            *</label>
                                                        <input class="input-text input-text--primary-style" type="text"
                                                            id="shipping-lname" name="shipping_last_name"
                                                            value="{{ old('shipping_last_name') }}">
                                                        @error('shipping_last_name')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--====== End - First Name, Last Name ======-->

                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">
                                                        <label class="gl-label" for="shipping-address-type">SHIPPING
                                                            ADDRESS TYPE *</label>
                                                        <select class="select-box select-box--primary-style"
                                                            id="shipping-address-type" name="shipping_address_type">
                                                            <option value="">Choose Address Type</option>
                                                            <option value="home"
                                                                {{ old('shipping_address_type') == 'home' ? 'selected' : '' }}>
                                                                Home</option>
                                                            <option value="work"
                                                                {{ old('shipping_address_type') == 'work' ? 'selected' : '' }}>
                                                                Work</option>
                                                            <option value="other"
                                                                {{ old('shipping_address_type') == 'other' ? 'selected' : '' }}>
                                                                Other</option>
                                                        </select>
                                                        @error('shipping_address_type')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!--====== Street Address ======-->
                                                <div class="u-s-m-b-15">
                                                    <label class="gl-label" for="shipping-street">SHIPPING STREET ADDRESS
                                                        *</label>
                                                    <input class="input-text input-text--primary-style" type="text"
                                                        id="shipping-street" placeholder="House name and street name"
                                                        name="shipping_address" value="{{ old('shipping_address') }}">
                                                    @error('shipping_address')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <!--====== End - Street Address ======-->

                                                <!--====== Town / City ======-->
                                                <div class="u-s-m-b-15">
                                                    <label class="gl-label" for="shipping-town-city">SHIPPING TOWN/CITY
                                                        *</label>
                                                    <input class="input-text input-text--primary-style" type="text"
                                                        id="shipping-town-city" name="shipping_town"
                                                        value="{{ old('shipping_town') }}">
                                                    @error('shipping_town')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <!--====== End - Town / City ======-->

                                                <!--====== STATE/PROVINCE ======-->
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">
                                                        <label class="gl-label" for="shipping_city">SHIPPING City
                                                            *</label>
                                                        <select class="select-box select-box--primary-style"
                                                            id="shipping_city" name="shipping_city">
                                                            <option value="">Choose City</option>
                                                            <option value="Alexandria"
                                                                {{ old('shipping_city') == 'Alexandria' ? 'selected' : '' }}>
                                                                Alexandria</option>
                                                            <option value="Aswan"
                                                                {{ old('shipping_city') == 'Aswan' ? 'selected' : '' }}>
                                                                Aswan</option>
                                                            <option value="Asyut"
                                                                {{ old('shipping_city') == 'Asyut' ? 'selected' : '' }}>
                                                                Asyut</option>
                                                            <option value="Beni Suef"
                                                                {{ old('shipping_city') == 'Beni Suef' ? 'selected' : '' }}>
                                                                Beni Suef</option>
                                                            <option value="Cairo"
                                                                {{ old('shipping_city') == 'Cairo' ? 'selected' : '' }}>
                                                                Cairo</option>
                                                            <option value="Damanhur"
                                                                {{ old('shipping_city') == 'Damanhur' ? 'selected' : '' }}>
                                                                Damanhur</option>
                                                            <option value="Damietta"
                                                                {{ old('shipping_city') == 'Damietta' ? 'selected' : '' }}>
                                                                Damietta</option>
                                                            <option value="El Arish"
                                                                {{ old('shipping_city') == 'El Arish' ? 'selected' : '' }}>
                                                                El Arish</option>
                                                            <option value="El Mahalla El Kubra"
                                                                {{ old('shipping_city') == 'El Mahalla El Kubra' ? 'selected' : '' }}>
                                                                El Mahalla El Kubra</option>
                                                            <option value="Faiyum"
                                                                {{ old('shipping_city') == 'Faiyum' ? 'selected' : '' }}>
                                                                Faiyum</option>
                                                            <option value="Giza"
                                                                {{ old('shipping_city') == 'Giza' ? 'selected' : '' }}>Giza
                                                            </option>
                                                            <option value="Hurghada"
                                                                {{ old('shipping_city') == 'Hurghada' ? 'selected' : '' }}>
                                                                Hurghada</option>
                                                            <option value="Ismailia"
                                                                {{ old('shipping_city') == 'Ismailia' ? 'selected' : '' }}>
                                                                Ismailia</option>
                                                            <option value="Kafr El Sheikh"
                                                                {{ old('shipping_city') == 'Kafr El Sheikh' ? 'selected' : '' }}>
                                                                Kafr El Sheikh</option>
                                                            <option value="Luxor"
                                                                {{ old('shipping_city') == 'Luxor' ? 'selected' : '' }}>
                                                                Luxor</option>
                                                            <option value="Mansoura"
                                                                {{ old('shipping_city') == 'Mansoura' ? 'selected' : '' }}>
                                                                Mansoura</option>
                                                            <option value="Marsa Matruh"
                                                                {{ old('shipping_city') == 'Marsa Matruh' ? 'selected' : '' }}>
                                                                Marsa Matruh</option>
                                                            <option value="Minya"
                                                                {{ old('shipping_city') == 'Minya' ? 'selected' : '' }}>
                                                                Minya</option>
                                                            <option value="Port Said"
                                                                {{ old('shipping_city') == 'Port Said' ? 'selected' : '' }}>
                                                                Port Said</option>
                                                            <option value="Qena"
                                                                {{ old('shipping_city') == 'Qena' ? 'selected' : '' }}>Qena
                                                            </option>
                                                            <option value="Sharm El Sheikh"
                                                                {{ old('shipping_city') == 'Sharm El Sheikh' ? 'selected' : '' }}>
                                                                Sharm El Sheikh</option>
                                                            <option value="Sohag"
                                                                {{ old('shipping_city') == 'Sohag' ? 'selected' : '' }}>
                                                                Sohag</option>
                                                            <option value="Suez"
                                                                {{ old('shipping_city') == 'Suez' ? 'selected' : '' }}>Suez
                                                            </option>
                                                            <option value="Tanta"
                                                                {{ old('shipping_city') == 'Tanta' ? 'selected' : '' }}>
                                                                Tanta</option>
                                                            <option value="Zagazig"
                                                                {{ old('shipping_city') == 'Zagazig' ? 'selected' : '' }}>
                                                                Zagazig</option>
                                                        </select>
                                                        @error('shipping_city')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--====== End - STATE/PROVINCE ======-->

                                                <!-- Save Address Option -->
                                                <div class="u-s-m-b-15">
                                                    <div class="check-box">
                                                        <input type="checkbox" id="save-shipping-address"
                                                            name="save_shipping_address" value="1"
                                                            {{ old('save_shipping_address') ? 'checked' : '' }}>
                                                        <div class="check-box__state check-box__state--primary">
                                                            <label class="check-box__label" for="save-shipping-address">
                                                                Save this address for future orders
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('save_shipping_address')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End dynamic Form -->

                                        <div class="u-s-m-b-10">
                                            <label class="gl-label" for="order-note">ORDER NOTE</label>
                                            <textarea class="text-area text-area--primary-style" id="order-note" name="order_note">{{ old('order_note') }}</textarea>
                                            @error('order_note')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-6">
                                <h1 class="checkout-f__h1">ORDER SUMMARY</h1>

                                <!--====== Order Summary ======-->
                                <div class="o-summary">
                                    <div class="o-summary__section u-s-m-b-30">
                                        <div class="o-summary__item-wrap gl-scroll">
                                            @foreach ($cartItems as $cartItem)
                                                <div class="o-card">
                                                    <div class="o-card__flex">
                                                        <div class="o-card__img-wrap">
                                                            <img class="u-img-fluid"
                                                                src="images/product/electronic/product3.jpg"
                                                                alt="">
                                                        </div>
                                                        <div class="o-card__info-wrap">
                                                            <span class="o-card__name">
                                                                <a href="product-detail.html">{{ $cartItem->name }}</a>
                                                            </span>
                                                            <span class="o-card__quantity">Quantity x
                                                                {{ $cartItem->quantity }}</span>
                                                            <span class="o-card__price">EGP
                                                                {{ $cartItem->price }}</span>
                                                        </div>
                                                    </div>
                                                    <!-- Remove item button - using JavaScript instead of nested form -->
                                                    <button type="button" class="o-card__del far fa-trash-alt"
                                                        onclick="removeCartItem({{ $cartItem->id }})"
                                                        style="background: none; border: none;"></button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="o-summary__section u-s-m-b-30">
                                        <div class="o-summary__box">
                                            <table class="o-summary__table">
                                                <tbody>
                                                    <tr>
                                                        <td>SUBTOTAL</td>
                                                        <td>{{ $subtotal }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>TAX</td>
                                                        <td>{{ $tax_amount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>SHIPPING</td>
                                                        <td id="shipping-cost">{{ $initialShippingCost }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>GRAND TOTAL</td>
                                                        <td id="total-amount">
                                                            {{ number_format($subtotal + $tax_amount + ($initialShippingCost ?? 0), 2) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="o-summary__section u-s-m-b-30">
                                        <div class="o-summary__box">
                                            <h1 class="checkout-f__h1">PAYMENT INFORMATION</h1>

                                            <div class="u-s-m-b-10  mb-3">
                                                <!--====== Radio Box ======-->
                                                <div class="radio-box">
                                                    <input type="radio" id="cash-on-delivery" name="payment_method"
                                                        value="cash_on_delivery" form="checkout-form" required
                                                        {{ old('payment_method') == 'cash_on_delivery' ? 'checked' : '' }}>
                                                    <div class="radio-box__state radio-box__state--primary">
                                                        <label class="radio-box__label" for="cash-on-delivery">Cash on
                                                            Delivery</label>
                                                    </div>
                                                </div>
                                                <!--====== End - Radio Box ======-->
                                            </div>

                                            <div class="u-s-m-b-10">
                                                <!--====== Radio Box ======-->
                                                <div class="radio-box">
                                                    <input type="radio" id="pay-with-card" name="payment_method"
                                                        value="pay_with_card" form="checkout-form" required
                                                        {{ old('payment_method') == 'pay_with_card' ? 'checked' : '' }}>
                                                    <div class="radio-box__state radio-box__state--primary">
                                                        <label class="radio-box__label" for="pay-with-card">Pay With
                                                            Credit / Debit Card</label>
                                                    </div>
                                                </div>
                                                <!--====== End - Radio Box ======-->
                                            </div>
                                            @error('payment')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                            <div class="u-s-m-b-15">
                                                <!--====== Check Box ======-->
                                                <div class="check-box">
                                                    <input type="checkbox" id="term-and-condition" name="terms_accepted"
                                                        value="1" form="checkout-form" required
                                                        {{ old('terms_accepted') ? 'checked' : '' }}>
                                                    <div class="check-box__state check-box__state--primary">
                                                        <label class="check-box__label" for="term-and-condition">I consent
                                                            to the</label>
                                                    </div>
                                                </div>
                                                <!--====== End - Check Box ======-->
                                                <a class="gl-link">Terms of Service.</a>
                                                @error('terms_accepted')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <button class="btn btn--e-brand-b-2" type="submit"
                                                    form="checkout-form">PLACE ORDER</button>
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


            <!--====== End - Section 3 ======-->


        </div>
        <!--====== End - App Content ======-->
    @endsection


    @push('script')
        <script>
            // Wait for the entire page to be loaded
            document.addEventListener('DOMContentLoaded', function() {

                // Use our new, unique IDs
                const shipAnotherAddressCheckbox = document.getElementById('ship-to-different-address-checkbox');
                const shippingAddressForm = document.getElementById('shipping-address-form');




                // Make sure we found the checkbox before adding a listener
                if (shipAnotherAddressCheckbox) {
                    shipAnotherAddressCheckbox.addEventListener('change', function() {
                        // If the checkbox is checked, show the form. Otherwise, hide it.
                        if (this.checked) {
                            shippingAddressForm.style.display = 'block';

                        } else {
                            shippingAddressForm.style.display = 'none';

                        }
                    });
                }
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const citySelect = document.getElementById('city'); // Main address city
                const shippingCitySelect = document.getElementById(
                    'shipping_city'); // Shipping address city (your new one)
                const shippingCostEl = document.getElementById('shipping-cost');
                const totalEl = document.getElementById('total-amount');

                const subtotal = {{ $subtotal }};
                const tax = {{ $tax_amount }};
                let shippingCost = {{ $initialShippingCost ?? 0 }};

                function updateTotal() {
                    const total = subtotal + tax + shippingCost;
                    totalEl.textContent = total.toFixed(2) + ' EGP';
                }

                function handleCityChange(selectedCity) {
                    if (!selectedCity) {
                        shippingCost = 0;
                        shippingCostEl.textContent = '0.00 EGP';
                        updateTotal();
                        return;
                    }

                    shippingCostEl.textContent = 'Calculating...';

                    const csrfToken = document.querySelector('meta[name="csrf-token"]');
                    const token = csrfToken ? csrfToken.getAttribute('content') : '';

                    fetch('{{ route('checkout.shipping-cost') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                city: selectedCity
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                shippingCost = data.shipping_cost;
                                shippingCostEl.textContent = data.formatted_cost;
                                updateTotal();
                            } else {
                                shippingCost = 40;
                                shippingCostEl.textContent = '40.00 EGP';
                                updateTotal();
                            }
                        })
                        .catch(error => {
                            shippingCost = 40;
                            shippingCostEl.textContent = '40.00 EGP';
                            updateTotal();
                        });
                }

                // Add event listeners to both city selects
                if (citySelect) {
                    citySelect.addEventListener('change', function() {
                        handleCityChange(this.value);
                    });
                }

                if (shippingCitySelect) {
                    shippingCitySelect.addEventListener('change', function() {
                        handleCityChange(this.value);
                    });
                }
            });
        </script>
    @endpush
