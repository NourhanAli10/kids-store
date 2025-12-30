@extends('store.master')

@section('title', 'Kids store')

@section('content')
    <!--====== Primary Slider ======-->
    <div class="s-skeleton s-skeleton--h-600 s-skeleton--bg-grey">
        <div class="owl-carousel primary-style-1" id="hero-slider">
            <div class="hero-slide hero-slide--1">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="slider-content slider-content--animation">

                                <span class="content-span-1 u-c-secondary">Latest Update Stock</span>

                                <span class="content-span-2 u-c-secondary">30% Off On kids Clothes</span>

                                <span class="content-span-3 u-c-secondary">Find Clothes on best prices,
                                    Also Discover most selling products of kids clothes</span>

                                <span class="content-span-4 u-c-secondary">Starting At

                                    <span class="u-c-brand">150 EGP</span></span>

                                <a class="shop-now-link btn--e-brand" href="{{ route('shop') }}">SHOP
                                    NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-slide hero-slide--2">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                              <div class="slider-content slider-content--animation">

                                <span class="content-span-1 u-c-secondary">Latest Update Stock</span>

                                <span class="content-span-2 u-c-secondary">30% Off On kids Clothes</span>

                                <span class="content-span-3 u-c-secondary">Find Clothes on best prices,
                                    Also Discover most selling products of kids clothes</span>

                                <span class="content-span-4 u-c-secondary">Starting At

                                    <span class="u-c-brand">150 EGP</span></span>

                                <a class="shop-now-link btn--e-brand" href="{{ route('shop') }}">SHOP
                                    NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-slide hero-slide--3">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                           <div class="slider-content slider-content--animation">

                                <span class="content-span-1 u-c-secondary">Latest Update Stock</span>

                                <span class="content-span-2 u-c-secondary">30% Off On kids Clothes</span>

                                <span class="content-span-3 u-c-secondary">Find Clothes on best prices,
                                    Also Discover most selling products of kids clothes</span>

                                <span class="content-span-4 u-c-secondary">Starting At

                                    <span class="u-c-brand">150 EGP</span></span>

                                <a class="shop-now-link btn--e-brand" href="{{ route('shop') }}">SHOP
                                    NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Primary Slider ======-->


    <!--====== Section 1 ======-->
    <div class="u-s-p-y-60">

        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-46">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary u-s-m-b-12">SHOP BY CATEGORIES</h1>

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
                    @foreach ($categories as $category)
                        <div class="col-lg-4 col-md-4 u-s-m-b-30">

                            <a class="collection" href="{{ route('shop', ['category_id' => $category->id]) }}">
                                <div class="aspect aspect--bg-grey aspect--square">
                                    <img class="aspect__img collection__img"
                                        src="{{ asset('store_assets/images/categories/' . $category->image) }}"
                                        alt="{{ $category->name }}">
                                </div>
                                <p class="text-center mt-5 text-dark">{{ $category->name }}</p>

                            </a>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <!--====== Section Content ======-->
    </div>
    <!--====== End - Section 1 ======-->


    <!--====== Section 2 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-16">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary u-s-m-b-12">Best Sellers</h1>
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
                    <div class="col-lg-12">
                        <div class="filter__grid-wrapper u-s-m-t-30">
                            <div class="row">
                                @if ($products)
                                    @foreach ($products as $product)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item headphone">
                                            <div class="product-o product-o--hover-on product-o--radius">
                                                <div class="product-o__wrap">

                                                    <a class="aspect aspect--bg-grey aspect--square u-d-block"
                                                        href="{{ route('home.product-details', ['id' => $product->id, 'slug' => $product->slug]) }}">

                                                        <img class="aspect__img"
                                                            src="{{ asset('store_assets/images/products/' . $product->images[0]->url) }}"
                                                            alt=""></a>
                                                    <div class="product-o__action-wrap">
                                                        <ul class="product-o__action-list">
                                                            <li>
                                                                <a  href= "{{ route('home.product-details', ['id' => $product->id, 'slug' => $product->slug]) }}" data-modal="modal" data-modal-id="#add-to-cart"
                                                                    data-tooltip="tooltip" data-placement="top"
                                                                    title="Add to Cart"><i
                                                                        class="fas fa-plus-circle"></i></a>
                                                            </li>
                                                            <li>

                                                                <a href="#" data-tooltip="tooltip"
                                                                    data-placement="top" title="Add to Wishlist">

                                                                    <form method="post"
                                                                        action="{{ route('wishlist.store') }}">
                                                                        @csrf
                                                                        <span class="pd-detail__click-wrap">
                                                                            <button type="submit"
                                                                                class="btn p-0 add-to-wishlist"
                                                                                data-id="{{ $product->id }}">
                                                                                <i class="fas fa-heart"></i>
                                                                            </button>
                                                                            <input type="hidden" name="product_id"
                                                                                value="{{ $product->id }}">
                                                                        </span>

                                                                    </form>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>

                                                <span class="product-o__category">

                                                    <a
                                                        href="{{ route('shop', ['category_id' => $product->category->id]) }}">{{ $product->category->name }}</a></span>

                                                <span class="product-o__name">

                                                    <a
                                                        href="{{ route('home.product-details', ['id' => $product->id, 'slug' => $product->slug]) }}">{{ $product->name }}</a></span>
                                                @if ($product->hasActiveOffer())
                                                    <span
                                                        class="product-o__price text-danger">{{ $product->getFinalPrice() }}
                                                        EGP
                                                        <span class="product-o__discount">
                                                            {{ $product->base_price }} EGP</span></span>
                                                @else
                                                    <span class="product-o__price">
                                                        {{ $product->base_price }} EGP</span></span>
                                                @endif


                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="load-more">

                            <button class="btn btn--e-brand" type="button">Load More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 2 ======-->


@if($deals->count() > 0)
    <!--====== Section 3 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-46">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary u-s-m-b-12">DEAL OF THE DAY</h1>

                            <span class="section__span u-c-silver">BUY DEAL OF THE DAY, HURRY UP! THESE NEW
                                PRODUCTS WILL EXPIRE SOON.</span>

                            <span class="section__span u-c-silver">ADD THESE ON YOUR CART.</span>
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
                    <div class="col-lg-6 col-md-6 u-s-m-b-30">
                        <div class="product-o product-o--radius product-o--hover-off u-h-100">
                            <div class="product-o__wrap">

                                <a class="aspect aspect--bg-grey aspect--square u-d-block"
                                    href="">

                                    <img class="aspect__img"
                                        src="{{ asset('store_assets/images/product/electronic/product11.jpg') }}"
                                        alt=""></a>
                                <div class="product-o__special-count-wrap">
                                    <div class="countdown countdown--style-special" data-countdown="2020/05/01"></div>
                                </div>
                                <div class="product-o__action-wrap">
                                    <ul class="product-o__action-list">
                                        <li>

                                            <a data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip"
                                                data-placement="top" title="Quick View"><i
                                                    class="fas fa-search-plus"></i></a>
                                        </li>
                                        <li>

                                            <a data-modal="modal" data-modal-id="#add-to-cart" data-tooltip="tooltip"
                                                data-placement="top" title="Add to Cart"><i
                                                    class="fas fa-plus-circle"></i></a>
                                        </li>
                                        <li>

                                            <a href="signin.html" data-tooltip="tooltip" data-placement="top"
                                                title="Add to Wishlist"><i class="fas fa-heart"></i></a>
                                        </li>
                                        <li>

                                            <a href="signin.html" data-tooltip="tooltip" data-placement="top"
                                                title="Email me When the price drops"><i class="fas fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <span class="product-o__category">

                                <a href="shop-side-version-2.html">Electronics</a></span>

                            <span class="product-o__name">

                                <a href="product-detail.html">DJI Phantom Drone 4k</a></span>
                            <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i>

                                <span class="product-o__review">(2)</span>
                            </div>

                            <span class="product-o__price">$125.00

                                <span class="product-o__discount">$160.00</span></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 u-s-m-b-30">
                        <div class="product-o product-o--radius product-o--hover-off u-h-100">
                            <div class="product-o__wrap">

                                <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">

                                    <img class="aspect__img"
                                        src="{{ asset('store_assets/images/product/electronic/product12.jpg') }}"
                                        alt=""></a>
                                <div class="product-o__special-count-wrap">
                                    <div class="countdown countdown--style-special" data-countdown="2020/05/01"></div>
                                </div>
                                <div class="product-o__action-wrap">
                                    <ul class="product-o__action-list">
                                        <li>

                                            <a data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip"
                                                data-placement="top" title="Quick View"><i
                                                    class="fas fa-search-plus"></i></a>
                                        </li>
                                        <li>

                                            <a data-modal="modal" data-modal-id="#add-to-cart" data-tooltip="tooltip"
                                                data-placement="top" title="Add to Cart"><i
                                                    class="fas fa-plus-circle"></i></a>
                                        </li>
                                        <li>

                                            <a href="signin.html" data-tooltip="tooltip" data-placement="top"
                                                title="Add to Wishlist"><i class="fas fa-heart"></i></a>
                                        </li>
                                        <li>

                                            <a href="signin.html" data-tooltip="tooltip" data-placement="top"
                                                title="Email me When the price drops"><i class="fas fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <span class="product-o__category">

                                <a href="shop-side-version-2.html">Electronics</a></span>

                            <span class="product-o__name">

                                <a href="product-detail.html">DJI Phantom Drone 2k</a></span>
                            <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i>

                                <span class="product-o__review">(2)</span>
                            </div>

                            <span class="product-o__price">$125.00

                                <span class="product-o__discount">$160.00</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
@endif
    </div>
    <!--====== End - Section 3 ======-->

@if($newArrivals->count() > 0)
    <!--====== Section 4 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-46">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary u-s-m-b-12">NEW ARRIVALS</h1>

                            <span class="section__span u-c-silver">GET UP FOR NEW ARRIVALS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->


        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="slider-fouc">
                    <div class="owl-carousel product-slider" data-item="4">
                        @foreach ($newArrivals as $newArrival)
                            <div class="u-s-m-b-30">
                                <div class="product-o product-o--hover-on">
                                    <div class="product-o__wrap">

                                        <a class="aspect aspect--bg-grey aspect--square u-d-block"
                                            href="{{ route('home.product-details', ['id' => $newArrival->id, 'slug' => $newArrival->slug]) }}">

                                            <img class="aspect__img"
                                                src="{{ asset('store_assets/images/products/' . $newArrival->images[0]->url) }}"
                                                alt=""></a>
                                        <div class="product-o__action-wrap">
                                            <ul class="product-o__action-list">
                                                <li>
                                                    <a  href= "{{ route('home.product-details', ['id' => $newArrival->id, 'slug' => $newArrival->slug]) }}" data-modal="modal" data-modal-id="#add-to-cart"
                                                        data-tooltip="tooltip" data-placement="top"
                                                        title="Add to Cart"><i class="fas fa-plus-circle"></i></a>
                                                </li>
                                                <li>

                                                    <a href="#" data-tooltip="tooltip" data-placement="top"
                                                        title="Add to Wishlist">

                                                        <form method="post" action="{{ route('wishlist.store') }}">
                                                            @csrf
                                                            <span class="pd-detail__click-wrap">
                                                                <button type="submit" class="btn p-0 add-to-wishlist"
                                                                    data-id="{{ $newArrival->id }}">
                                                                    <i class="fas fa-heart"></i>
                                                                </button>
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $newArrival->id }}">
                                                            </span>

                                                        </form>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                    <span class="product-o__category">

                                        <a
                                            href="{{ route('shop', ['category_id' => $newArrival->category->id]) }}">{{ $newArrival->category->name }}</a></span>

                                    <span class="product-o__name">

                                        <a
                                            href="{{ route('home.product-details', ['id' => $newArrival->id, 'slug' => $newArrival->slug]) }}">{{ $newArrival->name }}</a></span>

                                    @if ($newArrival->hasActiveOffer())
                                        <span class="product-o__price text-danger">{{ $newArrival->getFinalPrice() }}
                                            EGP
                                            <span class="product-o__discount">
                                                {{ $newArrival->base_price }} EGP</span></span>
                                    @else
                                        <span class="product-o__price">
                                            {{ $newArrival->base_price }} EGP</span></span>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 4 ======-->
@endif
@if ($productsWithOffers ->count() > 0)

    <!--====== Section 4 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-46">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary u-s-m-b-12">Offers</h1>

                            <span class="section__span u-c-silver">GET UP FOR Offers</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->


        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="slider-fouc">
                    <div class="owl-carousel product-slider" data-item="4">
                        @foreach ($productsWithOffers as $productWithOffer)
                            <div class="u-s-m-b-30">
                                <div class="product-o product-o--hover-on">
                                    <div class="product-o__wrap">

                                        <a class="aspect aspect--bg-grey aspect--square u-d-block"
                                            href="{{ route('home.product-details', ['id' => $productWithOffer->id, 'slug' => $productWithOffer->slug]) }}">

                                            <img class="aspect__img"
                                                src="{{ asset('store_assets/images/products/' . $productWithOffer->images[0]->url) }}"
                                                alt=""></a>
                                        <div class="product-o__action-wrap">
                                            <ul class="product-o__action-list">

                                                <li>

                                                    <a  href= "{{ route('home.product-details', ['id' => $productWithOffer->id, 'slug' => $productWithOffer->slug]) }}" data-modal="modal" data-modal-id="#add-to-cart"
                                                        data-tooltip="tooltip" data-placement="top"
                                                        title="Add to Cart"><i class="fas fa-plus-circle"></i></a>
                                                </li>
                                                <li>

                                                   <a href="#" data-tooltip="tooltip" data-placement="top"
                                                        title="Add to Wishlist">

                                                        <form method="post" action="{{ route('wishlist.store') }}">
                                                            @csrf
                                                            <span class="pd-detail__click-wrap">
                                                                <button type="submit" class="btn p-0 add-to-wishlist"
                                                                    data-id="{{ $productWithOffer->id }}">
                                                                    <i class="fas fa-heart"></i>
                                                                </button>
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $productWithOffer->id }}">
                                                            </span>

                                                        </form>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <span class="product-o__category">

                                        <a href="{{ route('shop', ['category_id' => $productWithOffer->category->id ] ) }}">{{ $productWithOffer->category->name }}</a></span>

                                    <span class="product-o__name">

                                        <a
                                            href="{{ route('home.product-details', ['id' => $productWithOffer->id, 'slug' => $productWithOffer->slug]) }}">{{ $productWithOffer->name }}</a></span>

                                    @if ($productWithOffer->hasActiveOffer())
                                        <span class="product-o__price text-danger">{{ $productWithOffer->getFinalPrice() }}
                                            EGP
                                            <span class="product-o__discount">
                                                {{ $productWithOffer->base_price }} EGP</span></span>
                                    @else
                                        <span class="product-o__price">
                                            {{ $productWithOffer->base_price }} EGP</span></span>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
@endif
    <!--====== End - Section 4 ======-->

    <!--====== Section 5 ======-->
    {{-- <div class="banner-bg">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-bg__countdown">
                            <div class="countdown countdown--style-banner" data-countdown="2020/05/01">
                            </div>
                        </div>
                        <div class="banner-bg__wrap">
                            <div class="banner-bg__text-1">

                                <span class="u-c-white">Global</span>

                                <span class="u-c-secondary">Offers</span>
                            </div>
                            <div class="banner-bg__text-2">

                                <span class="u-c-secondary">Official Launch</span>

                                <span class="u-c-white">Don't Miss!</span>
                            </div>

                            <span class="banner-bg__text-block banner-bg__text-3 u-c-secondary">Enjoy Free
                                Shipping when you buy 2 items and above!</span>

                            <a class="banner-bg__shop-now btn--e-secondary" href="{{ route('shop') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div> --}}
    <!--====== End - Section 5 ======-->


    <!--====== Section 6 ======-->
    <div class="u-s-p-b-60">
        @if ($featuredProducts->count() > 0)
            <div class="section__intro u-s-m-b-46">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">FEATURED PRODUCTS</h1>

                                <span class="section__span u-c-silver">FIND NEW FEATURED PRODUCTS</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">

                        @foreach ($featuredProducts as $featuredProduct)
                            <div class="col-lg-4 col-md-4 col-sm-6 u-s-m-b-30">

                                <a class="promotion" href="shop-side-version-2.html">
                                    <div class="aspect aspect--bg-grey aspect--square">

                                        <img class="aspect__img promotion__img"
                                            src="{{ asset('store_assets/images/promo/promo-img-1.jpg') }}"
                                            alt="">
                                    </div>
                                    <div class="promotion__content">
                                        <div class="promotion__text-wrap">
                                            <div class="promotion__text-1">

                                                <span class="u-c-secondary">ACCESSORIES FOR YOUR EVERYDAY</span>
                                            </div>
                                            <div class="promotion__text-2">

                                                <span class="u-c-secondary">GET IN</span>

                                                <span class="u-c-brand">TOUCH</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        @endif
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 6 ======-->

    <!--====== Section 7 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 u-s-m-b-30">
                        <div class="service u-h-100">
                            <div class="service__icon"><i class="fas fa-truck"></i></div>
                            <div class="service__info-wrap">

                                <span class="service__info-text-1">Free Shipping</span>

                                <span class="service__info-text-2">Free shipping on all US order or order
                                    above $200</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 u-s-m-b-30">
                        <div class="service u-h-100">
                            <div class="service__icon"><i class="fas fa-redo"></i></div>
                            <div class="service__info-wrap">

                                <span class="service__info-text-1">Shop with Confidence</span>

                                <span class="service__info-text-2">Our Protection covers your purchase from
                                    click to delivery</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 u-s-m-b-30">
                        <div class="service u-h-100">
                            <div class="service__icon"><i class="fas fa-headphones-alt"></i></div>
                            <div class="service__info-wrap">

                                <span class="service__info-text-1">24/7 Help Center</span>

                                <span class="service__info-text-2">Round-the-clock assistance for a smooth
                                    shopping experience</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 7 ======-->


@endsection
