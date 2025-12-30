@extends('store.master')

@section('title', 'Orders')

@section('content')

    @include('store.messages')
    <!--====== App Content ======-->
    <div class="app-content">

        <!--====== Section 2 ======-->
        <div class="u-s-p-b-60">

            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="dash">
                    <div class="container">
                        <div class="row">
                            @include('store.partials.profile-sidebar')

                            @if ($orders->count() > 0)
                                <div class="col-lg-9 col-md-12">
                                    <div
                                        class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">My Orders</h1>

                                            <span class="dash__text u-s-m-b-30">Here you can see all products that have been
                                                delivered.</span>
                                            <form class="m-order u-s-m-b-30" method="GET" action="{{ route('orders') }}">
                                                <div class="m-order__select-wrapper">
                                                    <label class="u-s-m-r-8" for="my-order-sort">Show:</label>

                                                    <select class="select-box select-box--primary-style"
                                                        onchange="this.form.submit()" name="filter" id="my-order-sort">
                                                        <option></option>
                                                        <option value="5"
                                                            {{ request('filter') == '5' ? 'selected' : '' }}>Last 5 orders
                                                        </option>
                                                        <option value="15"
                                                            {{ request('filter') == '15' ? 'selected' : '' }}>Last 15 days
                                                        </option>
                                                        <option value="30"
                                                            {{ request('filter') == '30' ? 'selected' : '' }}>Last 30 days
                                                        </option>
                                                        <option value="6"
                                                            {{ request('filter') == '6' ? 'selected' : '' }}> Last 6 months
                                                        </option>
                                                        <option value="all"
                                                            {{ request('filter') == 'all' ? 'selected' : '' }}>All Orders
                                                        </option>
                                                    </select>
                                                </div>
                                            </form>
                                            <div class="m-order__list">
                                                @foreach ($orders as $order)
                                                    <div class="m-order__get">
                                                        <div class="manage-o__header u-s-m-b-30">
                                                            <div class="dash-l-r">
                                                                <div>
                                                                    <div class="manage-o__text-2 u-c-secondary">Order
                                                                        #{{ $order->order_number }}</div>
                                                                    <div class="manage-o__text u-c-silver">Placed on
                                                                        {{ $order->created_at }}</div>
                                                                </div>
                                                                <div>
                                                                    <div class="dash__link dash__link--brand">

                                                                        <a
                                                                            href="{{ route('orders.manage', $order->id) }}">MANAGE</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="manage-o__description">
                                                            <div class="description__container">
                                                                <div class="description__img-wrap">

                                                                    <img style="width:100px; height:100px;"
                                                                        src="{{ asset('store_assets/images/products/'. $order->orderItems->first()->product->images->first()->url ) }}"
                                                                        alt="{{ $order->orderItems->first()->product_name  }}">
                                                                </div>
                                                                <div class="description-title">
                                                                    {{ $order->orderItems->first()->product_name }}</div>
                                                            </div>
                                                            <div class="description__info-wrap">
                                                                <div>

                                                                    <span
                                                                        class="manage-o__badge badge--processing">{{ $order->status }}</span>
                                                                </div>
                                                                <div>

                                                                    <span class="manage-o__text-2 u-c-silver">Quantity:

                                                                        <span
                                                                            class="manage-o__text-2 u-c-secondary">{{ $order->orderItems->first()->quantity }}</span></span>
                                                                </div>
                                                                <div>

                                                                    <span class="manage-o__text-2 u-c-silver">Total:

                                                                        <span class="manage-o__text-2 u-c-secondary"> EGP
                                                                            {{ $order->orderItems->first()->total_price }}</span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-9 col-md-12">

                                    <p class="mb-5 text-dark fs-5"> No order has been made yet.
                                        <a href="{{ route('shop') }}"> BROWSE PRODUCTS</a>
                                    </p>

                                </div>


                            @endif
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
