{{-- @extends('store.master')

@section('title', 'Track Order')


@section('content')

    @include('store.messages')
    <!--====== Main App ======-->
    <div id="app">

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

                                <div class="col-lg-9 col-md-12">
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">Track your Order</h1>

                                            <span class="dash__text u-s-m-b-30">To track your order please enter your Order
                                                ID in the box below and press the "Track" button. This was given to you on
                                                your receipt and in the confirmation email you should have received.</span>
                                            <form class="dash-track-order" method="POST"
                                                action="{{ route('order.find-order') }}">
                                                @csrf
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="order-id">Order ID *</label>

                                                        <input class="input-text input-text--primary-style" type="text"
                                                            name="order_number" id="order-id"
                                                            placeholder="Found in your confirmation email">
                                                        @error('order_number')
                                                            <p class ="alert alert-danger text-center ">{{ $message }}
                                                            </p>
                                                        @enderror

                                                    </div>

                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="track-phone">Phone *</label>

                                                        <input class="input-text input-text--primary-style" type="number"
                                                            name="phone" id="track-phone"
                                                            placeholder="phone you used during checkout">
                                                        @error('phone')
                                                            <p class ="alert alert-danger text-center ">{{ $message }}
                                                            </p>
                                                        @enderror

                                                    </div>

                                                </div>

                                                <button class="btn btn--e-brand-b-2" type="submit">TRACK</button>
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



    </div>
    <!--====== End - Main App ======-->


@endsection --}}

@extends('store.master')

@section('title', 'Track Order')

@push('css')
    {{-- Custom Styles for Order Tracking --}}
    <style>
        .track-order-timeline {
            position: relative;
            padding: 20px 0;
        }

        .track-step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
            position: relative;
            padding-left: 60px;
        }

        .track-step:not(:last-child)::before {
            content: '';
            position: absolute;
            left: 22px;
            top: 45px;
            width: 2px;
            height: calc(100% + 10px);
            background-color: #e0e0e0;
        }

        .track-step.completed:not(:last-child)::before {
            background-color: #28a745;
        }

        .track-icon {
            position: absolute;
            left: 0;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: #f0f0f0;
            border: 2px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #999;
            z-index: 1;
        }

        .track-step.completed .track-icon {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .track-step.active .track-icon {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            animation: pulse 2s infinite;
        }

        .track-step.cancelled .track-icon {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .track-step.refunded .track-icon {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: white;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(0, 123, 255, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(0, 123, 255, 0);
            }
        }

        .track-content h6 {
            margin: 0 0 5px 0;
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .track-content p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }

        .track-step.completed .track-content h6 {
            color: #28a745;
        }

        .track-step.active .track-content h6 {
            color: #007bff;
        }

        .track-step.cancelled .track-content h6 {
            color: #dc3545;
        }

        .track-step.refunded .track-content h6 {
            color: #17a2b8;
        }

        .table-p__box {
            display: flex;
            align-items: center;
        }

        .table-p__img-wrap {
            width: 60px;
            height: 60px;
            margin-right: 15px;
            overflow: hidden;
            border-radius: 4px;
        }

        .table-p__img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #333;
        }
    </style>
@endpush


@section('content')

    @include('store.messages')
    <!--====== Main App ======-->
    <div id="app">

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

                                <div class="col-lg-9 col-md-12">
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">Track your Order</h1>

                                            <span class="dash__text u-s-m-b-30">To track your order please enter your Order
                                                ID in the box below and press the "Track" button. This was given to you on
                                                your receipt and in the confirmation email you should have received.</span>
                                            <form class="dash-track-order" method="POST"
                                                action="{{ route('order.find-order') }}">
                                                @csrf
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="order-id">Order ID *</label>

                                                        <input class="input-text input-text--primary-style" type="text"
                                                            name="order_number" id="order-id"
                                                            placeholder="Found in your confirmation email"
                                                            value="{{ old('order_number') }}">
                                                        @error('order_number')
                                                            <p class="alert alert-danger text-center">{{ $message }}
                                                            </p>
                                                        @enderror

                                                    </div>

                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="track-phone">Phone *</label>

                                                        <input class="input-text input-text--primary-style" type="number"
                                                            name="phone" id="track-phone"
                                                            placeholder="phone you used during checkout"
                                                            value="{{ old('phone') }}">
                                                        @error('phone')
                                                            <p class="alert alert-danger text-center">{{ $message }}
                                                            </p>
                                                        @enderror

                                                    </div>

                                                </div>

                                                <button class="btn btn--e-brand-b-2" type="submit">TRACK</button>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- Order Status Display --}}
                                    @if (isset($order))
                                        <div
                                            class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-t-30">
                                            <div class="dash__pad-2">
                                                <h1 class="dash__h1 u-s-m-b-14">Order Details</h1>

                                                <div class="row u-s-m-b-30">
                                                    <div class="col-lg-6">
                                                        <div class="u-s-m-b-15">
                                                            <span class="gl-text"><strong>Order Number:</strong>
                                                                {{ $order->order_number }}</span>
                                                        </div>
                                                        <div class="u-s-m-b-15">
                                                            <span class="gl-text"><strong>Order Date:</strong>
                                                                {{ $order->created_at->format('M d, Y') }}</span>
                                                        </div>
                                                        <div class="u-s-m-b-15">
                                                            <span class="gl-text"><strong>Total Amount:</strong>
                                                                {{ number_format($order->total_amount, 2) }}< EGP/span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="u-s-m-b-15">
                                                            <span class="gl-text"><strong>Payment Status:</strong>
                                                                <span
                                                                    class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                                                                    {{ ucfirst($order->payment_status) }}
                                                                </span>
                                                            </span>
                                                        </div>
                                                        <div class="u-s-m-b-15">
                                                            <span class="gl-text"><strong>Payment Method:</strong>
                                                                {{ ucfirst($order->payment_method) }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Order Status Timeline --}}
                                                <h2 class="dash__h2 u-s-m-b-20">Order Status</h2>

                                                @if (in_array($order->status, ['cancelled', 'refunded']))
                                                    {{-- Show special status for cancelled/refunded orders --}}
                                                    <div
                                                        class="alert alert-{{ $order->status == 'cancelled' ? 'danger' : 'info' }} u-s-m-b-20">
                                                        <strong>Order {{ ucfirst($order->status) }}</strong>
                                                        <p class="mb-0">
                                                            @if ($order->status == 'cancelled')
                                                                This order has been cancelled. If you have any questions,
                                                                please contact our support team.
                                                            @else
                                                                This order has been refunded. The refund will be processed
                                                                within 5-7 business days.
                                                            @endif
                                                        </p>
                                                    </div>
                                                @endif

                                                <div class="track-order-timeline">
                                                    {{-- Order Placed / Pending --}}
                                                    <div
                                                        class="track-step {{ in_array($order->status, ['pending', 'confirmed', 'processing', 'shipped', 'delivered']) ? 'completed' : '' }}">
                                                        <div class="track-icon">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </div>
                                                        <div class="track-content">
                                                            <h6>Order Placed</h6>
                                                            <p>{{ $order->created_at->format('M d, Y H:i') }}</p>
                                                            @if ($order->status == 'pending')
                                                                <small class="text-muted">Waiting for confirmation</small>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- Confirmed --}}
                                                    <div
                                                        class="track-step {{ in_array($order->status, ['confirmed', 'processing', 'shipped', 'delivered']) ? 'completed' : ($order->status == 'pending' ? 'active' : '') }}">
                                                        <div class="track-icon">
                                                            <i class="fas fa-check"></i>
                                                        </div>
                                                        <div class="track-content">
                                                            <h6>Confirmed</h6>
                                                            @if ($order->status == 'confirmed')
                                                                <p>Your order has been confirmed</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- Processing --}}
                                                    <div
                                                        class="track-step {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'completed' : ($order->status == 'confirmed' ? 'active' : '') }}">
                                                        <div class="track-icon">
                                                            <i class="fas fa-box"></i>
                                                        </div>
                                                        <div class="track-content">
                                                            <h6>Processing</h6>
                                                            @if ($order->status == 'processing')
                                                                <p>Your order is being prepared</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- Shipped --}}
                                                    <div
                                                        class="track-step {{ in_array($order->status, ['shipped', 'delivered']) ? 'completed' : ($order->status == 'processing' ? 'active' : '') }}">
                                                        <div class="track-icon">
                                                            <i class="fas fa-truck"></i>
                                                        </div>
                                                        <div class="track-content">
                                                            <h6>Shipped</h6>
                                                            @if ($order->status == 'shipped')
                                                                <p>Your order is on the way</p>
                                                                @if ($order->tracking_number)
                                                                    <small class="text-muted">Tracking:
                                                                        {{ $order->tracking_number }}</small>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- Delivered --}}
                                                    <div
                                                        class="track-step {{ $order->status == 'delivered' ? 'completed' : ($order->status == 'shipped' ? 'active' : '') }}">
                                                        <div class="track-icon">
                                                            <i class="fas fa-check-circle"></i>
                                                        </div>
                                                        <div class="track-content">
                                                            <h6>Delivered</h6>
                                                            @if ($order->status == 'delivered')
                                                                <p>{{ $order->updated_at->format('M d, Y') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- Cancelled --}}
                                                    @if ($order->status == 'cancelled')
                                                        <div class="track-step cancelled">
                                                            <div class="track-icon">
                                                                <i class="fas fa-times-circle"></i>
                                                            </div>
                                                            <div class="track-content">
                                                                <h6>Cancelled</h6>
                                                                <p>{{ $order->updated_at->format('M d, Y') }}</p>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    {{-- Refunded --}}
                                                    @if ($order->status == 'refunded')
                                                        <div class="track-step refunded">
                                                            <div class="track-icon">
                                                                <i class="fas fa-undo"></i>
                                                            </div>
                                                            <div class="track-content">
                                                                <h6>Refunded</h6>
                                                                <p>{{ $order->updated_at->format('M d, Y') }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                {{-- Shipping Information --}}
                                                @if ($order->shipping_address)
                                                    <h2 class="dash__h2 u-s-m-t-30 u-s-m-b-20">Shipping Address</h2>
                                                    <div class="gl-text">
                                                        <p>{{ $order->shipping_address }}</p>
                                                    </div>
                                                @endif

                                                {{-- Order Items --}}
                                                <h2 class="dash__h2 u-s-m-t-30 u-s-m-b-20">Order Items</h2>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Quantity</th>
                                                                <th>Price</th>
                                                                <th>Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->orderItems as $item)
                                                                <tr>
                                                                    <td>
                                                                        <div class="table-p__box">
                                                                            <div class="table-p__img-wrap">
                                                                                @if ($item->product && $item->product->images)
                                                                                    <img class="u-img-fluid"
                                                                                        src="{{ asset('store_assets/images/products/' .$item->product->images->first()->url) }}"
                                                                                        alt="{{ $item->product_name }}">
                                                                                @endif
                                                                            </div>
                                                                            <div class="table-p__info">
                                                                                <span
                                                                                    class="table-p__name">{{ $item->product_name }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{ $item->quantity }}</td>
                                                                    <td>{{ number_format($item->unit_price, 2) }}</td>
                                                                    <td>{{ number_format($item->quantity * $item->unit_price, 2) }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="3" class="text-right">
                                                                    <strong>Subtotal:</strong></td>
                                                                <td><strong> {{ number_format($order->subtotal , 2) }} EGP</strong>
                                                                </td>
                                                            </tr>
                                                            @if ($order->shipping_cost)
                                                                <tr>
                                                                    <td colspan="3" class="text-right">
                                                                        <strong>Shipping:</strong></td>
                                                                    <td><strong>{{ number_format($order->shipping_cost, 2) }} EGP</strong>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            @if ($order->tax_amount)
                                                                <tr>
                                                                    <td colspan="3" class="text-right">
                                                                        <strong>Tax:</strong></td>
                                                                    <td><strong>{{ number_format($order->tax_amount, 2) }} EGP</strong>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            <tr class="table-active">
                                                                <td colspan="3" class="text-right">
                                                                    <strong>Total:</strong></td>
                                                                <td><strong>{{ number_format($order->total_amount, 2) }} EGP</strong>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
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
        <!--====== End - App Content ======-->



    </div>
    <!--====== End - Main App ======-->



@endsection
