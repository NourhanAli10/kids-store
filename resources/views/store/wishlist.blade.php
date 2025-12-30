@extends('store.master')

@section('content')

@include('store.messages')
    <!--====== Section 2 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary">Wishlist</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->

        @if ($wishlistItems->count() > 0)
            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <!--====== Wishlist Product ======-->
                            @foreach ($wishlistItems as $item)
                                <div class="w-r u-s-m-b-30">
                                    <div class="w-r__container">
                                        <div class="w-r__wrap-1">

                                            <div class="w-r__img-wrap">

                                                <img class="u-img-fluid"
                                                    src="{{ asset('store_assets/images/products/' . $item->images->first()->url) }}"
                                                    alt="">
                                            </div>
                                            <div class="w-r__info">

                                                <span class="w-r__name">

                                                    <a
                                                        href="{{ route('home.product-details', [$item->id, $item->slug]) }}">{{ $item->name }}</a></span>

                                                <span class="w-r__category">

                                                    <a href="#">{{ $item->category->name }}</a></span>

                                                <span class="w-r__price">{{ $item->getFinalPrice() }} EGP </span>

                                                <span class="w-r__discount"></span>
                                            </div>
                                        </div>
                                        <div class="w-r__wrap-2">
                                            <a class="w-r__link btn--e-transparent-platinum-b-2"
                                                href="{{ route('home.product-details', [$item->id, $item->slug]) }}">VIEW</a>
                                            <form method="post" action="{{ route('wishlist.remove', $item->id) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-r__link btn--e-transparent-platinum-b-2">REMOVE</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!--====== End - Wishlist Product ======-->
                            <div class="col-lg-12">
                                <div class="route-box">
                                    <div class="route-box__g">

                                        <a class="route-box__link" href="{{ route('shop') }}"><i
                                                class="fas fa-long-arrow-alt-left"></i>

                                            <span>CONTINUE SHOPPING</span></a>
                                    </div>
                                    <div class="route-box__g">
                                        <form method="post" action="{{ route('wishlist.clear') }}">
                                            @csrf
                                            @method('delete')
                                            <button class="route-box__link border-0" type="submit">
                                                {{-- <i class="fas fa-trash"></i> --}}
                                                CLEAR WISHLIST
                                            </button>
                                        </form>


                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        @else
            <!--====== Empty wishlist ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 u-s-m-b-30">
                            <div class="empty">
                                <div class="empty__wrap">

                                    <span class="empty__big-text">EMPTY</span>

                                    <span class="empty__text-1">No items found on your wishlist.</span>

                                    <a class="empty__redirect-link btn--e-brand" href="{{ route('shop') }}">CONTINUE
                                        SHOPPING</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--====== End Empty Wishlist ======-->
    </div>
    <!--====== End Section 2 ======-->
    @endif
@endsection
