@extends('store.master')


@section('content')
    <!--====== App Content ======-->
    <div class="app-content">

        <!--====== Section 1 ======-->
        <div class="u-s-p-y-60">
            @if ($cartItems->isNotEmpty())
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

                                        <a href="cart.html">Cart</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!--====== End - Section 1 ======-->

        @session('success')
        <div class=" w-50 m-auto alert alert-success text-center">{{ session('success') }} </div>
    @endsession
        <!--====== Section 2 ======-->
        <div class="u-s-p-b-60">

            <!--====== Section Intro ======-->
            <div class="section__intro u-s-m-b-60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary">SHOPPING CART</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Intro ======-->


            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                            <div class="table-responsive">
                                <table class="table-p">
                                    <tbody>
                                        <tr>
                                            <td>PRODUCT</td>
                                            <td>PRICE</td>
                                            <td>QUANTITY</td>
                                            <td>SUBTOTAL</td>
                                            <td></td>
                                        </tr>

                                        <!--====== Row ======-->
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td>
                                                    <div class="table-p__box">
                                                        <div class="table-p__img-wrap">
                                                            @php
                                                                if (
                                                                    !empty($item->product) &&
                                                                    $item->product->images->isNotEmpty()
                                                                ) {
                                                                    $productImage = $item->product->images->first()->url;
                                                                } else {
                                                                    $cartImage = $item->attributes->images[0];
                                                                }

                                                                $imageUrl = $productImage ?? $cartImage;
                                                            @endphp

                                                            <img style="width: 79px; height:134px;"
                                                                src="{{ asset('store_assets/images/products/' . $imageUrl) }}"
                                                                alt="">
                                                        </div>
                                                        <div class="table-p__info">
                                                            <span class="table-p__name">
                                                                <a href="{{ route('home.product-details', ['id' => $item->id, 'slug' => $item->attributes->slug ?? $item->product->slug]) }}">
                                                                    {{ $item->name }}
                                                                </a>
                                                            </span>
                                                            <span class="table-p__category">
                                                                <a href="shop-side-version-2.html"></a>
                                                            </span>
                                                            <ul class="table-p__variant-list">
                                                                <li>
                                                                    <span>Size: {{ $item->size ?? $item->attributes->size }}</span>
                                                                </li>
                                                                <li>
                                                                    <span>Color: {{ $item->color ?? $item->attributes->color }}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="table-p__price">EGP {{ $item->price }}</span>
                                                </td>
                                                <td>
                                                    <div class="table-p__input-counter-wrap">
                                                        <!--====== Input Counter ======-->
                                                        <div class="input-counter">
                                                            <span class="input-counter__minus fas fa-minus"></span>
                                                            <input
                                                                class="input-counter__text input-counter--text-primary-style quantity-input"
                                                                type="text"
                                                                value="{{ $item->quantity }}"
                                                                data-min="1"
                                                                data-max="{{ $item->variant->stock ?? $item->attributes->stock ?? 10 }}"
                                                                data-product-id="{{ $item->id }}">

                                                            @error("quantities.{$item->id}")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                            <span class="input-counter__plus fas fa-plus"></span>
                                                        </div>
                                                        <!--====== End - Input Counter ======-->
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="table-p__price">EGP {{ $item->price * $item->quantity }}</span>
                                                </td>
                                                <td>
                                                    <div class="table-p__del-wrap">
                                                        <a href="#"
                                                           onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();"
                                                           class="mini-product__delete-link far fa-trash-alt"></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!--====== End - Row ======-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="route-box">
                                <div class="route-box__g1">
                                    <a class="route-box__link" href="{{ route('shop') }}">
                                        <i class="fas fa-long-arrow-alt-left"></i>
                                        <span>CONTINUE SHOPPING</span>
                                    </a>
                                </div>
                                <div class="d-flex">
                                    <!-- UPDATE CART BUTTON -->
                                    <button class="route-box__link" type="button" onclick="updateCart()">
                                        <i class="fas fa-sync"></i>
                                        <span>UPDATE CART</span>
                                    </button>

                                    <!-- CLEAR CART BUTTON -->
                                    <form METHOD="POST" action="{{ route('home.clear-cart') }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="route-box__link" type="submit">
                                            <i class="fas fa-trash"></i>
                                            <span>CLEAR CART</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Separate delete forms for each item (hidden) -->
            @foreach ($cartItems as $item)
                <form method="POST"
                      action="{{ route('remove-products-cart', $item->id) }}"
                      style="display: none;"
                      id="delete-form-{{ $item->id }}">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
            <!-- Hidden form for updating cart -->
<form method="POST" action="{{ route('home.update-cart') }}" id="update-cart-form" style="display: none;">
    @csrf
    @method('PUT')
    <div id="quantities-container"></div>
</form>
            <!--====== End - Section Content ======-->

        </div>
        <!--====== End - Section 2 ======-->


        <!--====== Section 3 ======-->
        <div class="u-s-p-b-60">

            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                            <form class="f-cart">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                        <div class="f-cart__pad-box">
                                            <h1 class="gl-h1">ESTIMATE SHIPPING AND TAXES</h1>

                                            <span class="gl-text u-s-m-b-30">Enter your destination to get a shipping
                                                estimate.</span>
                                            <div class="u-s-m-b-30">

                                                <!--====== Select Box ======-->

                                                <label class="gl-label" for="shipping-country">COUNTRY *</label><select
                                                    class="select-box select-box--primary-style" id="shipping-country">
                                                    <option selected value="">Choose Country</option>
                                                    <option value="uae">United Arab Emirate (UAE)</option>
                                                    <option value="uk">United Kingdom (UK)</option>
                                                    <option value="us">United States (US)</option>
                                                </select>
                                                <!--====== End - Select Box ======-->
                                            </div>
                                            <div class="u-s-m-b-30">

                                                <!--====== Select Box ======-->

                                                <label class="gl-label" for="shipping-state">STATE/PROVINCE
                                                    *</label><select class="select-box select-box--primary-style"
                                                    id="shipping-state">
                                                    <option selected value="">Choose State/Province</option>
                                                    <option value="al">Alabama</option>
                                                    <option value="al">Alaska</option>
                                                    <option value="ny">New York</option>
                                                </select>
                                                <!--====== End - Select Box ======-->
                                            </div>
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="shipping-zip">ZIP/POSTAL CODE *</label>

                                                <input class="input-text input-text--primary-style" type="text"
                                                    id="shipping-zip" placeholder="Zip/Postal Code">
                                            </div>
                                            <div class="u-s-m-b-30">

                                                <a class="f-cart__ship-link btn--e-transparent-brand-b-2"
                                                    href="cart.html">CALCULATE SHIPPING</a>
                                            </div>

                                            <span class="gl-text">Note: There are some countries where free shipping is
                                                available otherwise our flat rate charges or country delivery charges
                                                will
                                                be apply.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                        <div class="f-cart__pad-box">
                                            <h1 class="gl-h1">NOTE</h1>

                                            <span class="gl-text u-s-m-b-30">Add Special Note About Your Product</span>
                                            <div>

                                                <label for="f-cart-note"></label>
                                                <textarea class="text-area text-area--primary-style" id="f-cart-note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                        <div class="f-cart__pad-box">
                                            <div class="u-s-m-b-30">
                                                <table class="f-cart__table">
                                                    <tbody>
                                                        <tr>
                                                            <td>SHIPPING</td>
                                                            <td>$4.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>TAX</td>
                                                            <td>$0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>SUBTOTAL</td>
                                                            <td>$379.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>GRAND TOTAL</td>
                                                            <td>$379.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div>

                                                <button class="btn btn--e-brand-b-2" type="submit"> PROCEED TO
                                                    CHECKOUT</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 3 ======-->
    @else
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 u-s-m-b-30">
                        <div class="empty">
                            <div class="empty__wrap">

                                <span class="empty__big-text">EMPTY</span>

                                <span class="empty__text-1">No items found on your cart.</span>

                                <a class="empty__redirect-link btn--e-brand" href="{{ route('shop') }}">CONTINUE
                                    SHOPPING</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!--====== End - App Content ======-->
@endsection
@push('script')

<script>
    function updateCart() {
        // Get all quantity inputs
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const container = document.getElementById('quantities-container');

        // Clear previous inputs
        container.innerHTML = '';

        // Create hidden inputs for each quantity
        quantityInputs.forEach(input => {
            const productId = input.getAttribute('data-product-id');
            const quantity = input.value;

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = `quantities[${productId}]`;
            hiddenInput.value = quantity;

            container.appendChild(hiddenInput);
        });

        // Submit the form
        document.getElementById('update-cart-form').submit();
    }
    </script>

@endpush
