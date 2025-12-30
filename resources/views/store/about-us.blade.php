@extends('store.master')

@section('title', 'About us')

@section('content')

    <!--====== Section 1 ======-->
    <div class="u-s-p-y-60">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="breadcrumb">
                    <div class="breadcrumb__wrap">
                        <ul class="breadcrumb__list">
                            <li class="has-separator">

                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="is-marked">

                                <a href="{{ route('home.about-us') }}">About</a>
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
                        <div class="about">
                            <div class="about__container">
                                <div class="about__info">
                                    <h2 class="about__h2">Welcome to Kiddo Wear Store!</h2>
                                    <div class="about__p-wrap">
                                        <p class="about__p">
                                            At KiddoWear, we believe childhood is a magical time, and we’re here to make it
                                            even more special. Our store offers a thoughtfully curated selection of stylish
                                            and comfortable clothing for kids of all ages, fun and educational toys that
                                            inspire creativity and learning, and trendy accessories to add the perfect touch
                                            to any outfit.

                                            We are committed to providing high-quality, safe, and affordable products that
                                            parents can trust and kids will love. Whether you’re shopping for everyday
                                            essentials or special occasions, KiddoWear Store has everything you need to make
                                            your little one smile.

                                            Thank you for choosing KiddoWear — where happiness meets style!
                                        </p>
                                    </div>

                                    <a class="about__link btn--e-secondary" href="{{ route('shop') }}" target="_blank">Shop
                                        Now</a>
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

@endsection
