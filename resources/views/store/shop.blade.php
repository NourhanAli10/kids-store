@extends('store.master')

@section('title', 'Shop')

@section('content')
@include('store.messages')
    <!--====== App Content ======-->
    <div class="app-content">

        <!--====== Section 1 ======-->
        <div class="u-s-p-y-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <div class="shop-w-master">
                            <h1 class="shop-w-master__heading u-s-m-b-30">
                                <i class="fas fa-filter u-s-m-r-8"></i>
                                <span>FILTERS</span>
                            </h1>

                            {{-- Clear All Filters Button --}}
                            @if (request()->hasAny(['category_id', 'sizes', 'min_price', 'max_price', 'sort_by']))
                                <div class="u-s-m-b-15">
                                    <a href="{{ route('shop') }}" class="btn btn--e-brand-b-2 btn--block">Clear All
                                        Filters</a>
                                </div>
                            @endif

                            <div class="shop-w-master__sidebar sidebar--bg-snow">
                                {{-- CATEGORY FILTER --}}
                                <div class="u-s-m-b-30">
                                    <div class="shop-w">
                                        <div class="shop-w__intro-wrap">
                                            <h1 class="shop-w__h">CATEGORY</h1>
                                            <span class="fas fa-minus shop-w__toggle" data-target="#s-category"
                                                data-toggle="collapse"></span>
                                        </div>
                                        <div class="shop-w__wrap collapse show" id="s-category">
                                            <ul class="shop-w__category-list gl-scroll">
                                                @foreach ($categories as $category)
                                                    <li class="has-list">
                                                        <a href="{{ route('shop', array_merge(request()->except('page'), ['category_name' => $category->name, 'category_id' => $category->id])) }}"
                                                            class="{{ request('category_id') == $category->id ? 'active' : '' }}">
                                                            {{ $category->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                {{-- PRICE FILTER --}}
                                <div class="u-s-m-b-30">
                                    <div class="shop-w">
                                        <div class="shop-w__intro-wrap">
                                            <h1 class="shop-w__h">PRICE</h1>
                                            <span class="fas fa-minus shop-w__toggle" data-target="#s-price"
                                                data-toggle="collapse"></span>
                                        </div>
                                        <div class="shop-w__wrap collapse show" id="s-price">
                                            <form class="shop-w__form-p" method="GET" action="{{ route('shop') }}"
                                                id="price-filter-form">
                                                {{-- Preserve other filters --}}
                                                @if (request('category_id'))
                                                    <input type="hidden" name="category_id"
                                                        value="{{ request('category_id') }}">
                                                    <input type="hidden" name="category_name"
                                                        value="{{ request('category_name') }}">
                                                @endif
                                                @if (request('sizes'))
                                                    @foreach (request('sizes') as $size)
                                                        <input type="hidden" name="sizes[]" value="{{ $size }}">
                                                    @endforeach
                                                @endif
                                                @if (request('sort_by'))
                                                    <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                                                @endif
                                                @if (request('per_page'))
                                                    <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                                                @endif

                                                <div class="shop-w__form-p-wrap">
                                                    <div>
                                                        <label for="price-min"></label>
                                                        <input class="input-text input-text--primary-style" type="number"
                                                            name="min_price" id="price-min" placeholder="Min"
                                                            value="{{ request('min_price') }}" step="0.01">
                                                    </div>
                                                    <div>
                                                        <label for="price-max"></label>
                                                        <input class="input-text input-text--primary-style" type="number"
                                                            name="max_price" id="price-max" placeholder="Max"
                                                            value="{{ request('max_price') }}" step="0.01">
                                                    </div>
                                                    <div>
                                                        <button
                                                            class="btn btn--icon fas fa-angle-right btn--e-transparent-platinum-b-2"
                                                            type="submit"></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- SIZE FILTER --}}
                                <div class="u-s-m-b-30">
                                    <div class="shop-w">
                                        <div class="shop-w__intro-wrap">
                                            <h1 class="shop-w__h">SIZE</h1>
                                            <span class="fas fa-minus collapsed shop-w__toggle" data-target="#s-size"
                                                data-toggle="collapse"></span>
                                        </div>
                                        <div class="shop-w__wrap collapse" id="s-size">
                                            <form class="shop-w__form-p" method="GET" action="{{ route('shop') }}"
                                                id="size-filter-form">
                                                {{-- Preserve other filters --}}
                                                @if (request('category_id'))
                                                    <input type="hidden" name="category_id"
                                                        value="{{ request('category_id') }}">
                                                    <input type="hidden" name="category_name"
                                                        value="{{ request('category_name') }}">
                                                @endif
                                                @if (request('min_price'))
                                                    <input type="hidden" name="min_price"
                                                        value="{{ request('min_price') }}">
                                                @endif
                                                @if (request('max_price'))
                                                    <input type="hidden" name="max_price"
                                                        value="{{ request('max_price') }}">
                                                @endif
                                                @if (request('sort_by'))
                                                    <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                                                @endif
                                                @if (request('per_page'))
                                                    <input type="hidden" name="per_page"
                                                        value="{{ request('per_page') }}">
                                                @endif

                                                <ul class="shop-w__list gl-scroll">
                                                    @foreach ($sizes as $size)
                                                        <li>
                                                            <div class="check-box">
                                                                <input type="checkbox" id="size-{{ $size }}"
                                                                    name="sizes[]" value="{{ $size }}"
                                                                    onchange="this.form.submit()"
                                                                    {{ in_array($size, request('sizes', [])) ? 'checked' : '' }}>
                                                                <div class="check-box__state check-box__state--primary">
                                                                    <label class="check-box__label"
                                                                        for="size-{{ $size }}">{{ $size }}</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12">
                        <div class="shop-p">
                            {{-- TOOLBAR WITH SORTING AND PAGINATION --}}
                            <div class="shop-p__toolbar u-s-m-b-30">
                                <div class="shop-p__tool-style">
                                    <div class="tool-style__group u-s-m-b-8">
                                        <span class="js-shop-grid-target is-active">Grid</span>
                                        <span class="js-shop-list-target">List</span>
                                    </div>
                                    <form method="GET" action="{{ route('shop') }}" id="toolbar-form">
                                        {{-- Preserve filters --}}
                                        @if (request('category_id'))
                                            <input type="hidden" name="category_id"
                                                value="{{ request('category_id') }}">
                                            <input type="hidden" name="category_name"
                                                value="{{ request('category_name') }}">
                                        @endif
                                        @if (request('sizes'))
                                            @foreach (request('sizes') as $size)
                                                <input type="hidden" name="sizes[]" value="{{ $size }}">
                                            @endforeach
                                        @endif
                                        @if (request('min_price'))
                                            <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                                        @endif
                                        @if (request('max_price'))
                                            <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                                        @endif

                                        <div class="tool-style__form-wrap">
                                            {{-- Items Per Page --}}
                                            <div class="u-s-m-b-8">
                                                <select class="select-box select-box--transparent-b-2" name="per_page"
                                                    onchange="this.form.submit()">
                                                    <option value="8"
                                                        {{ request('per_page') == 8 ? 'selected' : '' }}>Show: 8</option>
                                                    <option value="12"
                                                        {{ request('per_page', 12) == 12 ? 'selected' : '' }}>Show: 12
                                                    </option>
                                                    <option value="16"
                                                        {{ request('per_page') == 16 ? 'selected' : '' }}>Show: 16</option>
                                                    <option value="28"
                                                        {{ request('per_page') == 28 ? 'selected' : '' }}>Show: 28</option>
                                                </select>
                                            </div>

                                            {{-- Sorting --}}
                                            <div class="u-s-m-b-8">
                                                <select class="select-box select-box--transparent-b-2" name="sort_by"
                                                    onchange="this.form.submit()">
                                                    <option value="newest"
                                                        {{ request('sort_by', 'newest') == 'newest' ? 'selected' : '' }}>
                                                        Sort By: Newest Items</option>
                                                    <option value="oldest"
                                                        {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Sort By:
                                                        Oldest Items</option>
                                                    <option value="price_low"
                                                        {{ request('sort_by') == 'price_low' ? 'selected' : '' }}>Sort By:
                                                        Lowest Price</option>
                                                    <option value="price_high"
                                                        {{ request('sort_by') == 'price_high' ? 'selected' : '' }}>Sort By:
                                                        Highest Price</option>
                                                    <option value="name_asc"
                                                        {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Sort By:
                                                        Name (A-Z)</option>
                                                    <option value="name_desc"
                                                        {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Sort By:
                                                        Name (Z-A)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- PRODUCTS GRID --}}
                            <div class="shop-p__collection">
                                <div class="row is-grid-active">
                                    @forelse($products as $product)
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="product-m">
                                                <div class="product-m__thumb">
                                                    <a class="aspect aspect--bg-grey aspect--square u-d-block"
                                                        href="{{ route('home.product-details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                                        <img class="aspect__img"
                                                            src="{{ asset('store_assets/images/products/' . $product->images[0]->url) }}"
                                                            alt="{{ $product->name }}">
                                                    </a>
                                                    <div class="product-m__quick-look">
                                                        <a class="fas fa-search" data-modal="modal"
                                                            data-modal-id="#quick-look" data-tooltip="tooltip"
                                                            data-placement="top" title="Quick Look"></a>
                                                    </div>
                                                    <div class="product-m__add-cart">
                                                        <a href="{{ route('home.product-details', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                                            class="btn--e-brand" data-modal="modal"
                                                            data-modal-id="#add-to-cart">Add to Cart</a>
                                                    </div>
                                                </div>
                                                <div class="product-m__content">
                                                    <div class="product-m__category">
                                                        <a
                                                            href="{{ route('shop', ['category_id' => $product->category->id, 'category_name' => $product->category->name]) }}">
                                                            {{ $product->category->name }}
                                                        </a>
                                                    </div>
                                                    <div class="product-m__name">
                                                        <a
                                                            href="{{ route('home.product-details', ['id' => $product->id, 'slug' => $product->slug]) }}">{{ $product->name }}</a>
                                                    </div>

                                                    <div class="product-m__price mt-2">
                                                        {{-- @if ($product->variants && $product->variants->count() > 0)
                                                            ${{ number_format($product->variants->min('price'), 2) }}
                                                            @if ($product->variants->min('price') != $product->variants->max('price'))
                                                                - ${{ number_format($product->variants->max('price'), 2) }}
                                                            @endif
                                                        @else
                                                            ${{ number_format($product->base_price, 2) }}
                                                        @endif --}}

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
                                                    <div class="product-m__hover">
                                                        <div class="product-m__wishlist">
                                                            {{-- <a class="far fa-heart" href="#" data-tooltip="tooltip"
                                                                data-placement="top" title="Add to Wishlist"></a> --}}
                                                            <form method="post" action="{{ route('wishlist.store') }}">
                                                                @csrf
                                                                <span class="pd-detail__click-wrap">
                                                                    <button type="submit" class="btn p-0 add-to-wishlist"
                                                                        data-id="{{ $product->id }}">
                                                                        <i class="fas fa-heart"></i>
                                                                    </button>
                                                                    <input type="hidden" name="product_id"
                                                                        value="{{ $product->id }}">
                                                                </span>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-info text-center">
                                                <h4>No products found</h4>
                                                <p>Try adjusting your filters or <a href="{{ route('shop') }}">clear all
                                                        filters</a></p>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            {{-- PAGINATION --}}
                            @if ($products->hasPages())
                                <div class="u-s-p-y-60">
                                    <ul class="shop-p__pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($products->onFirstPage())
                                            <li class="disabled"><span class="fas fa-angle-left"></span></li>
                                        @else
                                            <li><a class="fas fa-angle-left"
                                                    href="{{ $products->appends(request()->except('page'))->previousPageUrl() }}"></a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                            @if ($page == $products->currentPage())
                                                <li class="is-active"><a>{{ $page }}</a></li>
                                            @else
                                                <li><a
                                                        href="{{ $products->appends(request()->except('page'))->url($page) }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($products->hasMorePages())
                                            <li><a class="fas fa-angle-right"
                                                    href="{{ $products->appends(request()->except('page'))->nextPageUrl() }}"></a>
                                            </li>
                                        @else
                                            <li class="disabled"><span class="fas fa-angle-right"></span></li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section 1 ======-->
    </div>
    <!--====== End - App Content ======-->

@endsection
