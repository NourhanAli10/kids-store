@extends('store.master')

@push('css')
    <style>
        body {
            margin:0;
            padding:0;
        }
        .order-header {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .checkmark {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            animation: checkmarkBounce 0.8s ease-out 0.3s both;
        }

        .checkmark svg {
            width: 40px;
            height: 40px;
            fill: white;
        }
        .order-header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            /* position: relative;
            z-index: 1; */
        }
        .order-number {
            font-size: 18px;
            opacity: 0.9;
            /* position: relative;
            z-index: 1; */
        }

        .content {
            padding: 40px 30px;
        }
        .section {
            margin-bottom: 40px;
            margin-top: 60px;
            padding: 25px;
            background: #f8f9ff;
            border-radius: 15px;
            border-left: 4px solid #667eea;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .section:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        .section h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .item {
            display: flex;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .item:last-child {
            border-bottom: none;
        }

        .item-image {
            background: linear-gradient(45deg, #f0f0f0, #e0e0e0);
            border-radius: 10px;
            margin-right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 12px;
            text-align: center;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .item-specs {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .item-price {
            font-weight: bold;
            color: #4CAF50;
            font-size: 18px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .summary-row:last-child {
            border-bottom: none;
            font-weight: bold;
            font-size: 18px;
            color: #333;
            padding-top: 15px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-block {
            background: white;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #e0e0e0;
        }

        .info-block h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .info-block p {
            color: #666;
            line-height: 1.6;
            margin: 5px 0;
        }

        .next-steps {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-left-color: #4CAF50;
        }

        .next-steps h2 {
            color: white;
        }

        .step {
            display: flex;
            align-items: center;
            margin: 15px 0;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-weight: bold;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: #4CAF50;
            color: white;
        }

        .btn-primary:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
        }

        .btn-secondary {
            background: #f0f0f0;
            color: #333;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
        }



    </style>
@endpush
@section('content')
    <div class="u-s-p-t-90">
        <div class="section__content">
            <div class="container ">
                <div class="order-header ">
                    <div class="checkmark">
                        <svg viewBox="0 0 24 24">
                            <path d="M9,20.42L2.79,14.21L5.21,11.79L9,15.58L18.79,5.79L21.21,8.21L9,20.42Z" />
                        </svg>
                    </div>
                    <h3>Thank you for your purchase!</h3>
                    <h1>Order Confirmed!</h1>
                    <p class="order-number">Order {{ $order->order_number }}</p>


                </div>

                <div class="content">

                    <div class="section">
                        <h2>📦 Order Details</h2>
                        @foreach ($orderItems as $orderItem)
                            <div class="item">
                                <div class="item-image">

                                    {{-- <img src="{{ asset('store_assets/images/products/' . $orderItem->product->images->first()->url) }}"
                            alt="product Image"> --}}
                                    <img style="width: 130px; height:134px;"
                                        src="{{ asset('store_assets/images/products/' . $orderItem->product->images->first()->url) }}"
                                        alt="{{ $orderItem->product_name }}">
                                </div>

                                <div class="item-details">
                                    <div class="item-name">{{ $orderItem->product_name }}</div>
                                    <div class="item-specs">Size: {{ $orderItem->size }} | Qty:
                                        {{ $orderItem->quantity }}</div>
                                    <div class="item-price">{{ $orderItem->unit_price }} EGP</div>
                                </div>
                            </div>
                        @endforeach


                    </div>

                    <div class="section">
                        <h2>💰 Order Summary</h2>
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span>{{ $order->subtotal }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span>{{ $order->shipping_cost }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax:</span>
                            <span>{{ $order->tax_amount }}</span>
                        </div>
                        @if ($order->discount_amount != 0)
                            <div class="summary-row">
                                <span>Discount :</span>
                                <span>{{ $order->discount_amount }}</span>
                            </div>
                        @endif

                        <div class="summary-row">
                            <span>Total:</span>
                            <span>{{ $order->total_amount }}</span>
                        </div>
                    </div>

                    <div class="section">
                        <h2>📍 Delivery & Payment Information</h2>
                        <div class="info-grid">
                            <div class="info-block">
                                <h3>Shipping Address</h3>
                                <p>{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}<br>
                                    {{ $order->shipping_address }}<br>
                                    {{ $order->shipping_town }}<br>
                                    {{ $order->shipping_city }}</p>
                            </div>
                            <div class="info-block">
                                <h3>Payment Method</h3>
                                <p>{{ $order->payment_method }}<br>
                                    {{-- •••• •••• •••• 1234<br>
                            Expires: 12/26 --}}
                                </p>
                            </div>
                            <div class="info-block">
                                <h3>Estimated Delivery</h3>
                                <p><strong>3-5 Business Days</strong><br>
                                    {{-- Expected: Sep 3-5, 2025
                            <br> --}}
                                    Standard Shipping</p>
                            </div>
                            <div class="info-block">
                                <h3>Need Help?</h3>
                                <p>Customer Service<br>
                                    01203105581<br>
                                    noura@store-kids.com<br>
                                    Mon-Fri 9AM-6PM EST</p>
                            </div>
                        </div>
                    </div>

                    <div class="section">
                        <h2>📏 Important Information</h2>
                        <div class="info-grid">
                            <div class="info-block">
                                <h3>Returns & Exchanges</h3>
                                <p>Free returns within 30 days. Items must be unworn with tags attached. Don't worry about
                                    fit -
                                    exchanges are easy!</p>
                            </div>
                            <div class="info-block">
                                <h3>Care Instructions</h3>
                                <p>Care labels are attached to each item. For best results, follow washing instructions to
                                    maintain
                                    quality and fit.</p>
                            </div>
                        </div>
                    </div>

                    <div class="buttons">
                        <a href="{{ route('order.track-order') }}" class="btn btn-primary">Track Your Order</a>
                        <a href="{{ route('shop') }}" class="btn btn-secondary">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
