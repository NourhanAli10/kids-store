@extends('store.master')

@section('title', 'My Account')


@section('content')



<div class="app-content">

 
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
                            <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                <div class="dash__pad-2">
                                    <h1 class="dash__h1 u-s-m-b-14">Manage My Account</h1>

                                    <span class="dash__text u-s-m-b-30">From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</span>
                                    <div class="row">
                                        <div class="col-lg-4 u-s-m-b-30">
                                            <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">PERSONAL PROFILE</h2>
                                                    <div class="dash__link dash__link--secondary u-s-m-b-8">

                                                        <a href="dash-edit-profile.html">Edit</a></div>

                                                    <span class="dash__text">{{ $user->first_name }} {{ $user->last_name }}</span>

                                                    <span class="dash__text">{{ $user->email }}</span>                                        
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 u-s-m-b-30">
                                            <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">ADDRESS BOOK</h2>

                                                    <span class="dash__text-2 u-s-m-b-8">Default Shipping Address</span>
                                                    <div class="dash__link dash__link--secondary u-s-m-b-8">

                                                        <a href="dash-address-book.html">Edit</a></div>

                                                    <span class="dash__text">4247 Ashford Drive Virginia - VA-20006 - USA</span>

                                                    <span class="dash__text">{{ $user->phone }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 u-s-m-b-30">
                                            <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">BILLING ADDRESS</h2>

                                                    <span class="dash__text-2 u-s-m-b-8">Default Billing Address</span>

                                                    <span class="dash__text">4247 Ashford Drive Virginia - VA-20006 - USA</span>

                                                    <span class="dash__text">(+0) 900901904</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($orders->count() > 0)
                                <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius">
                                    <h2 class="dash__h2 u-s-p-xy-20">RECENT ORDERS</h2>
                                    <div class="dash__table-wrap gl-scroll">
                                        <table class="dash__table">
                                            <thead>
                                                <tr>
                                                    <th>Order #</th>
                                                    <th>Placed On</th>
                                                    <th>Items</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                <tr>
                                                    <td>{{ $order->order_number }}</td>
                                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        {{ $order->status }}
                                                    <td>
                                                        <div class="dash__table-total">

                                                            <span>{{ $order->total_amount }}</span>
                                                            <div class="dash__link dash__link--brand">

                                                                <a href="{{ route('orders.manage', $order->id) }}">MANAGE</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
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

