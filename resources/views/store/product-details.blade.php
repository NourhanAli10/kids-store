@extends('store.master')


@section('content')
    @include('store.messages')


    <!--====== Section 1 ======-->
    <div class="u-s-p-t-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <!--====== Product Breadcrumb ======-->
                    <div class="pd-breadcrumb u-s-m-b-30">
                        <ul class="pd-breadcrumb__list">
                            <li class="has-separator">

                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="has-separator">

                                <a href="#">{{ $product->category->name }}</a>
                            </li>
                            <li class="is-marked">

                                <a
                                    href="{{ route('home.product-details', [$product->id, $product->slug]) }}">{{ $product->name }}</a>
                            </li>
                        </ul>
                    </div>
                    <!--====== End - Product Breadcrumb ======-->


                    <!--====== Product Detail Zoom ======-->
                    <div class="pd u-s-m-b-30">
                        <div class="slider-fouc pd-wrap">
                            <div id="pd-o-initiate">
                                @forelse($product->images as $image)
                                    <div class="pd-o-img-wrap"
                                        data-src="{{ asset('store_assets/images/products/' . $image->url) }}">
                                        <img class="u-img-fluid"
                                            src="{{ asset('store_assets/images/products/' . $image->url) }}"
                                            data-zoom-image="{{ asset('store_assets/images/products/' . $image->url) }}"
                                            alt="{{ $image->alt ?? $product->name }}">
                                    </div>
                                @empty
                                    <div class="pd-o-img-wrap" data-src="{{ asset('store_assets/images/no-image.jpg') }}">
                                        <img class="u-img-fluid" src="{{ asset('store_assets/images/no-image.jpg') }}"
                                            data-zoom-image="{{ asset('store_assets/images/no-image.jpg') }}"
                                            alt="No image">
                                    </div>
                                @endforelse
                            </div>
                            <span class="pd-text">Click for larger zoom</span>
                        </div>
                        <div class="u-s-m-t-15">
                            <div class="slider-fouc">
                                <div id="pd-o-thumbnail">
                                    @foreach ($product->images as $image)
                                        <div>
                                            <img class="u-img-fluid"
                                                src="{{ asset('store_assets/images/products/' . $image->url) }}"
                                                alt="{{ $image->alt ?? $product->name }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--====== End - Product Detail Zoom ======-->
                </div>
                <div class="col-lg-7">
                    <!--====== Product Right Side Details ======-->
                    <div class="pd-detail">
                        <div>
                            <span class="pd-detail__name">{{ $product->name }}</span>
                        </div>
                        <div>
                            @php
                                $basePriceAfterDiscount = $product->getFinalPrice();
                            @endphp
                            <div class="pd-detail__inline" style="display: flex; align-items: center; gap: 10px;">
                                @if ($product->hasActiveOffer())
                                    <span class="pd-detail__price" id="product-price"
                                        style="color: #e74c3c; font-weight: bold;">{{ $basePriceAfterDiscount }} EGP</span>
                                    <span class="pd-detail__discount" id="product-original-price"
                                        style="text-decoration: line-through; color: #999;">{{ $product->base_price }}
                                        EGP</span>
                                @else
                                    <span class="pd-detail__price" id="product-price">{{ $product->base_price }} EGP</span>
                                    <span class="pd-detail__discount" id="product-original-price"
                                        style="display: none; text-decoration: line-through; color: #999;"></span>
                                @endif
                            </div>
                        </div>
                        <div class="u-s-m-b-15">
                            <form class="pd-detail__form" method="POST" action="{{ route('home.add-to-cart') }}">
                                @csrf
                                <input type="hidden" name="product_id" value ="{{ $product->id }}">
                                <!-- 2. The Size Selector -->
                                <div class="u-s-m-b-15">
                                    <span class="pd-detail__label u-s-m-b-8">Size:</span>
                                    <div class="pd-detail__size"
                                        style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
                                        @foreach ($product->variants as $variant)
                                            @php
                                                $variantFinalPrice = $variant->getFinalPrice();
                                                $hasDiscount =
                                                    $product->hasActiveOffer() && $variantFinalPrice < $variant->price;
                                            @endphp
                                            <div class="size__radio" style="margin: 0; display: inline-block;">
                                                <input type="radio" class="js-size-selector"
                                                    id="size-{{ $variant->id }}" name="size"
                                                    value="{{ $variant->size }}" data-price="{{ $variant->price }}"
                                                    data-final-price="{{ $variantFinalPrice }}"
                                                    data-has-discount="{{ $hasDiscount ? 'true' : 'false' }}"
                                                    data-stock="{{ $variant->stock }}" style="display: none;">
                                                <label class="size__radio-label" for="size-{{ $variant->id }}"
                                                    style="display: inline-block; padding: 10px 20px; border: 1px solid #ccc; cursor: pointer; min-width: 60px; text-align: center; margin: 0;">
                                                    {{ $variant->size }}
                                                </label>
                                                @error('size')
                                                    <p class="alert alert-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Stock status - moved outside and below to prevent layout shift -->
                                </div>

                                <!-- Stock status shown AFTER the size section -->
                                <div class="u-s-m-b-15" id="stock-display" style="display: none;">
                                    <span id="stock-icon" style="color: #5cb85c; margin-right: 5px;">✓</span>
                                    <span id="stock-status" style="color: #5cb85c;"></span>
                                </div>
                                <div class="pd-detail-inline-2">
                                    <div class="u-s-m-b-15">

                                        <!--====== Input Counter ======-->
                                        <div class="input-counter">

                                            <span class="input-counter__minus fas fa-minus"></span>

                                            <input class="input-counter__text input-counter--text-primary-style"
                                                type="number" name="quantity" value="1" data-min="1"
                                                data-max="1000">

                                            <span class="input-counter__plus fas fa-plus"></span>
                                        </div>

                                        <!--====== End - Input Counter ======-->
                                    </div>
                                    <div class="u-s-m-b-15">
                                        <button class="btn btn--e-brand-b-2" type="submit">Add to Cart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="u-s-m-b-15">
                            <div class="pd-detail__rating gl-rating-style"><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star-half-alt"></i>

                                <span class="pd-detail__review u-s-m-l-4">

                                    <a data-click-scroll="#view-review">{{ $totalReviews }} Reviews</a></span>
                            </div>
                        </div>
                        <div class="u-s-m-b-15">
                            <div class="pd-detail__inline">
                                <form method="post" action="{{ route('wishlist.store') }}">
                                    @csrf
                                    <span class="pd-detail__click-wrap">
                                        <button type="submit" class="btn p-0 add-to-wishlist"
                                            data-id="{{ $product->id }}">
                                            <i class="far fa-heart u-s-m-r-6"></i>
                                            Add to Wishlist
                                        </button>
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        </span>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Product Right Side Details ======-->
            </div>
        </div>
    </div>
    </div>

    <!--====== Product Detail Tab ======-->
    <div class="u-s-p-y-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pd-tab">
                        <div class="u-s-m-b-30">
                            <ul class="nav pd-tab__list">
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#pd-desc">DESCRIPTION</a>
                                </li>
                                <li class="nav-item">

                                    <a class="nav-link active" id="view-review" data-toggle="tab" href="#pd-rev">REVIEWS

                                        <span>({{ $totalReviews }})</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">

                            <!--====== Tab 1 ======-->
                            <div class="tab-pane" id="pd-desc">
                                <div class="pd-tab__desc">
                                    <div class="u-s-m-b-15">
                                        <p>{{ $product->description }}</p>
                                    </div>
                                </div>
                            </div>
                            <!--====== End - Tab 1 ======-->




                            <!--====== Tab 3 ======-->
                            <div class="tab-pane fade show active" id="pd-rev">
                                @if ($product['reviews']->count() > 0)
                                    <div class="pd-tab__rev">
                                        <div class="u-s-m-b-30">
                                            <div class="pd-tab__rev-score">
                                                <div class="u-s-m-b-8">
                                                    <h2>{{ count($product['reviews']) }} Reviews -
                                                        {{ round($reviewsAvg, 1) }}
                                                        (Overall)</h2>
                                                </div>
                                                <div class="gl-rating-style-2 u-s-m-b-8"><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                                                <div class="u-s-m-b-8">
                                                    <h4>We want to hear from you!</h4>
                                                </div>

                                                <span class="gl-text">Tell us what you think about this item</span>
                                            </div>
                                        </div>
                                        <div class="u-s-m-b-30">
                                            <div class="pd-tab__rev-f1">

                                                <!-- Reviews Header -->
                                                <div class="rev-f1__group">
                                                    <div class="u-s-m-b-15">
                                                        <h2>{{ $totalReviews }} Review(s) for {{ $product->name }}</h2>
                                                    </div>
                                                </div>

                                                <!-- Reviews List -->
                                                <div class="rev-f1__review">
                                                    @foreach ($product->reviews as $review)
                                                        <div
                                                            class="review-o border-bottom pb-2 d-flex justify-content-between align-items-start w-100">

                                                            <!-- Review Content -->
                                                            <div class="flex-grow-1">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center u-s-m-b-8">
                                                                    <span
                                                                        class="review-o__name fw-bold">{{ $review->user->first_name }}</span>
                                                                    <span class="review-o__date text-muted small">
                                                                        {{ $review->created_at->format('l, d F Y') }}
                                                                    </span>
                                                                </div>

                                                                <div class="review-o__rating gl-rating-style u-s-m-b-8">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $review->rating)
                                                                            <i class="fas fa-star text-warning"></i>
                                                                        @else
                                                                            <i class="far fa-star text-warning"></i>
                                                                        @endif
                                                                    @endfor
                                                                    <span
                                                                        class="text-muted small">{{ $review->rating }}</span>
                                                                </div>

                                                                <p class="review-o__text mb-0"
                                                                    id="review-text-{{ $review->id }}">
                                                                    {{ $review->comment }}
                                                                </p>
                                                            </div>
                                                            <!-- /Review Content -->

                                                            <!-- Dropdown Menu -->
                                                            <div class="dropdown ms-2">
                                                                <button class="btn btn-link text-dark p-0" type="button"
                                                                    id="dropdownMenu{{ $review->id }}"
                                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                                    style="font-size: 18px;">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>

                                                                <ul class="dropdown-menu dropdown-menu-end"
                                                                    aria-labelledby="dropdownMenu{{ $review->id }}">
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"
                                                                            onclick="event.preventDefault(); showEditForm({{ $review->id }})">
                                                                            Edit
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('reviews.destroy', $review->id) }}"
                                                                            method="POST"
                                                                            onsubmit="return confirm('Are you sure you want to delete it?');">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="dropdown-item text-danger">
                                                                                Delete
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <!-- /Dropdown Menu -->
                                                        </div>

                                                        <!-- Hidden Edit Form -->
                                                        <form action="{{ route('reviews.update', $review->id) }}"
                                                            method="POST" class="d-none mt-2"
                                                            id="edit-form-{{ $review->id }}">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="mb-2">
                                                                <div class="editable-stars"
                                                                    data-review-id="{{ $review->id }}">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <i class="fa-star {{ $i <= $review->rating ? 'fas text-warning' : 'far text-warning' }}"
                                                                            data-value="{{ $i }}"
                                                                            style="cursor: pointer; font-size: 20px;"></i>
                                                                    @endfor
                                                                </div>
                                                                <input type="hidden" name="rating"
                                                                    id="rating-input-{{ $review->id }}"
                                                                    value="{{ $review->rating }}">
                                                            </div>

                                                            <div class="d-flex gap-2">
                                                                <input type="text" name="comment" class="form-control"
                                                                    value="{{ $review->comment }}">
                                                                <button type="submit" class="btn btn-success btn-sm">💾
                                                                    Save</button>
                                                                <button type="button" class="btn btn-secondary btn-sm"
                                                                    onclick="cancelEdit({{ $review->id }})">❌
                                                                    Cancel</button>
                                                            </div>
                                                        </form>

                                                        <!-- /Hidden Edit Form -->
                                                    @endforeach
                                                </div>
                                                <!-- /Reviews List -->

                                            </div>
                                        </div>


                                    </div>
                                @else
                                    <div class="text-center">
                                        <p>There are no reviews yet. </p>
                                    </div>
                                    @auth
                                        <div class="u-s-m-b-30 mt-5">
                                            <form class="pd-tab__rev-f2"
                                                action="{{ route('reviews.store', $product->name) }}" method="post">
                                                @csrf
                                                <h2 class="u-s-m-b-15">Add a Review</h2>
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">

                                                <div class="review-rating">
                                                    <h3>Rate this product</h3>
                                                    <div class="star-rating">
                                                        <input type="radio" id="star5" name="rating" value="5">
                                                        <label for="star5" title="5 stars">★</label>


                                                        <input type="radio" id="star4" name="rating" value="4">
                                                        <label for="star4" title="4 stars">★</label>


                                                        <input type="radio" id="star3" name="rating" value="3">
                                                        <label for="star3" title="3 stars">★</label>



                                                        <input type="radio" id="star2" name="rating" value="2">
                                                        <label for="star2" title="2 stars">★</label>



                                                        <input type="radio" id="star1" name="rating" value="1">
                                                        <label for="star1" title="1 stars">★</label>
                                                    </div>
                                                    <p class="rating-display">Selected rating: <span
                                                            id="rating-value">0</span> stars</p>
                                                    @error('rating')
                                                        <div class="alert alert-danger text-center">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="rev-f2__group">
                                                    <div class="u-s-m-b-15">

                                                        <label class="gl-label" for="reviewer-text">YOUR REVIEW *</label>
                                                        <textarea class="text-area text-area--primary-style" name="comment" id="reviewer-text"></textarea>
                                                        @error('comment')
                                                            <div class="alert alert-danger text-center">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <p class="u-s-m-b-30">

                                                            <label class="gl-label" for="reviewer-name">NAME *</label>

                                                            <input class="input-text input-text--primary-style" type="text"
                                                                id="reviewer-name">
                                                        </p>
                                                        <p class="u-s-m-b-30">

                                                            <label class="gl-label" for="reviewer-email">EMAIL *</label>

                                                            <input class="input-text input-text--primary-style" type="text"
                                                                id="reviewer-email">
                                                        </p>
                                                    </div>
                                                </div>
                                                <div>

                                                    <button class="btn btn--e-brand-shadow" type="submit">SUBMIT</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endauth
                                @endif

                            </div>
                            <!--====== End - Tab 3 ======-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Product Detail Tab ======-->
    @if ($relatedProducts->count() > 0)
        <div class="u-s-p-b-90">

            <!--====== Section Intro ======-->
            <div class="section__intro u-s-m-b-46">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">CUSTOMER ALSO VIEWED</h1>

                                <span class="section__span u-c-grey">PRODUCTS THAT CUSTOMER VIEWED</span>
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
                            @foreach ($relatedProducts as $product)
                                <div class="u-s-m-b-30">
                                    <div class="product-o product-o--hover-on">
                                        <div class="product-o__wrap">

                                            <a class="aspect aspect--bg-grey aspect--square u-d-block"
                                                href="{{ route('home.product-details', [$product->id, $product->slug]) }}">
                                                <img class="aspect__img"
                                                    src="{{ asset('store_assets/images/products/' . $product->images[0]->url) }}"
                                                    alt="{{ $product->images[0]->alt ?? $product->name }}">
                                            </a>
                                            <div class="product-o__action-wrap">
                                                <ul class="product-o__action-list">
                                                    <li>
                                                        <a data-modal="modal" data-modal-id="#quick-look"
                                                            data-tooltip="tooltip" data-placement="top"
                                                            title="Quick View"><i class="fas fa-search-plus"></i></a>
                                                    </li>
                                                    <li>

                                                        <a data-modal="modal" data-modal-id="#add-to-cart"
                                                            data-tooltip="tooltip" data-placement="top"
                                                            title="Add to Cart"><i class="fas fa-plus-circle"></i></a>
                                                    </li>
                                                    <li>
                                                        <form method="POST"
                                                            action="{{ route('wishlist.store', $product->id) }}">
                                                            @csrf
                                                            <button type="button"
                                                                class="btn btn-link p-0 add-to-wishlist"
                                                                data-id="{{ $product->id }}" data-tooltip="tooltip"
                                                                data-placement="top" title="Add to Wishlist">
                                                                <i class="fas fa-heart"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>

                                                        <a href="signin.html" data-tooltip="tooltip" data-placement="top"
                                                            title="Email me When the price drops"><i
                                                                class="fas fa-envelope"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <span class="product-o__category">

                                            <a href="#">{{ $product->category->name }}</a></span>

                                        <span class="product-o__name">

                                            <a
                                                href="{{ route('home.product-details', [$product->id, $product->slug]) }}">{{ $product->name }}</a></span>
                                        @php
                                            $priceAfterDiscount = $product->getFinalPrice();
                                        @endphp
                                        @if ($product->hasActiveOffer())
                                            <div style="display: flex; align-items: center; gap: 8px;">
                                                <span class="product-o__price"
                                                    style="color: #e74c3c; font-weight: bold;">{{ $priceAfterDiscount }}
                                                    EGP</span>
                                                <span class="product-o__discount"
                                                    style="text-decoration: line-through; color: #999;">{{ $product->base_price }}
                                                    EGP</span>
                                            </div>
                                        @else
                                            <span class="product-o__price">{{ $product->base_price }} EGP</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--====== End - Section Content ======-->


@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sizeInputs = document.querySelectorAll('.js-size-selector');
            const priceDisplay = document.getElementById('product-price');
            const originalPriceDisplay = document.getElementById('product-original-price');
            const stockDisplay = document.getElementById('stock-display');
            const stockStatus = document.getElementById('stock-status');
            const stockIcon = document.getElementById('stock-icon');

            sizeInputs.forEach(input => {
                input.addEventListener('change', function() {
                    // Get the price and stock from data attributes
                    const originalPrice = this.getAttribute('data-price');
                    const finalPrice = this.getAttribute('data-final-price');
                    const hasDiscount = this.getAttribute('data-has-discount') === 'true';
                    const stock = parseInt(this.getAttribute('data-stock'));

                    // Update the price display
                    if (hasDiscount) {
                        priceDisplay.textContent = finalPrice + ' EGP';
                        priceDisplay.style.color = '#e74c3c';
                        priceDisplay.style.fontWeight = 'bold';
                        originalPriceDisplay.textContent = originalPrice + ' EGP';
                        originalPriceDisplay.style.display = 'inline-block';
                    } else {
                        priceDisplay.textContent = originalPrice + ' EGP';
                        priceDisplay.style.color = '';
                        priceDisplay.style.fontWeight = '';
                        originalPriceDisplay.style.display = 'none';
                    }

                    // Show the stock display
                    stockDisplay.style.display = 'block';

                    // Update stock status based on availability
                    if (stock > 0) {
                        stockIcon.textContent = '✓';
                        stockIcon.style.color = '#5cb85c';
                        stockStatus.textContent = 'In stock';
                        stockStatus.style.color = '#5cb85c';

                        // Show low stock warning if needed
                        if (stock < 5) {
                            stockStatus.textContent = 'In stock (Only ' + stock + ' left)';
                        }
                    } else {
                        stockIcon.textContent = '✗';
                        stockIcon.style.color = '#d9534f';
                        stockStatus.textContent = 'Out of stock';
                        stockStatus.style.color = '#d9534f';
                    }
                });
            });
        });
    </script>

    <script>
        document.querySelectorAll('.star-rating input').forEach(input => {
            input.addEventListener('change', function() {
                document.getElementById('rating-value').textContent = this.value;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.editable-stars').forEach(starContainer => {
                const reviewId = starContainer.dataset.reviewId;
                const ratingInput = document.getElementById(`rating-input-${reviewId}`);

                starContainer.querySelectorAll('.fa-star').forEach(star => {
                    star.addEventListener('click', () => {
                        const value = star.dataset.value;

                        ratingInput.value = value;

                        starContainer.querySelectorAll('.fa-star').forEach(s => {
                            if (s.dataset.value <= value) {
                                s.classList.remove('far');
                                s.classList.add('fas', 'text-warning');
                            } else {
                                s.classList.remove('fas');
                                s.classList.add('far', 'text-warning');
                            }
                        });
                    });
                });
            });
        });
    </script>


    <script>
        function showEditForm(reviewId) {
            document.getElementById(`review-text-${reviewId}`).classList.add('d-none');
            document.getElementById(`edit-form-${reviewId}`).classList.remove('d-none');
        }

        function cancelEdit(reviewId) {
            document.getElementById(`review-text-${reviewId}`).classList.remove('d-none');
            document.getElementById(`edit-form-${reviewId}`).classList.add('d-none');
        }
    </script>
@endpush
