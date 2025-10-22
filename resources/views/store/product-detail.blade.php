@extends('store.master')


@section('content')
    @session('success')
        <div class=" w-50 m-auto alert alert-success text-center">{{ session('success') }} </div>
    @endsession
    @session('error')
        <div class=" w-50 m-auto alert alert-danger text-center">{{ session('error') }} </div>
    @endsession
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

                                <a href="index.hml">Home</a>
                            </li>
                            <li class="has-separator">

                                <a href="shop-side-version-2.html">Electronics</a>
                            </li>
                            <li class="has-separator">

                                <a href="shop-side-version-2.html">DSLR Cameras</a>
                            </li>
                            <li class="is-marked">

                                <a href="shop-side-version-2.html">Nikon Cameras</a>
                            </li>
                        </ul>
                    </div>
                    <!--====== End - Product Breadcrumb ======-->


                    <!--====== Product Detail Zoom ======-->
                    <div class="pd u-s-m-b-30">
                        <div class="slider-fouc pd-wrap">
                            <div id="pd-o-initiate">
                                <div class="pd-o-img-wrap" data-src="images/product/product-d-1.jpg">

                                    <img class="u-img-fluid" src="images/product/product-d-1.jpg"
                                        data-zoom-image="images/product/product-d-1.jpg" alt="">
                                </div>
                                <div class="pd-o-img-wrap" data-src="images/product/product-d-2.jpg">

                                    <img class="u-img-fluid" src="images/product/product-d-2.jpg"
                                        data-zoom-image="images/product/product-d-2.jpg" alt="">
                                </div>
                                <div class="pd-o-img-wrap" data-src="images/product/product-d-3.jpg">

                                    <img class="u-img-fluid" src="images/product/product-d-3.jpg"
                                        data-zoom-image="images/product/product-d-3.jpg" alt="">
                                </div>
                                <div class="pd-o-img-wrap" data-src="images/product/product-d-4.jpg">

                                    <img class="u-img-fluid" src="images/product/product-d-4.jpg"
                                        data-zoom-image="images/product/product-d-4.jpg" alt="">
                                </div>
                                <div class="pd-o-img-wrap" data-src="images/product/product-d-5.jpg">

                                    <img class="u-img-fluid" src="images/product/product-d-5.jpg"
                                        data-zoom-image="images/product/product-d-5.jpg" alt="">
                                </div>
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
                                                alt="{{ $image->alt }}">
                                        </div>
                                    @endforeach
                                    {{-- <div>

                                                <img class="u-img-fluid" src="images/product/product-d-2.jpg" alt=""></div>
                                            <div>

                                                <img class="u-img-fluid" src="images/product/product-d-3.jpg" alt=""></div>
                                            <div>

                                                <img class="u-img-fluid" src="images/product/product-d-4.jpg" alt=""></div>
                                            <div>

                                                <img class="u-img-fluid" src="images/product/product-d-5.jpg" alt=""></div> --}}
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
                            <div class="pd-detail__inline">

                                <span class="pd-detail__price">{{ $product->price }} EGP</span>

                                <span class="pd-detail__discount">(76% OFF)</span><del class="pd-detail__del">$28.97</del>
                            </div>
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

                                <span class="pd-detail__stock">200 in stock</span>

                                <span class="pd-detail__left">Only 2 left</span>
                            </div>
                        </div>
                        <div class="u-s-m-b-15">

                            <span class="pd-detail__preview-desc">
                                {{ $product->description }}
                            </span>
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
                                        <span class="pd-detail__click-count">(222)</span></span>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                </form>




                            </div>
                        </div>
                        <div class="u-s-m-b-15">
                            <div class="pd-detail__inline">

                                <span class="pd-detail__click-wrap"><i class="far fa-envelope u-s-m-r-6"></i>

                                    <a href="signin.html">Email me When the price drops</a>

                                    <span class="pd-detail__click-count">(20)</span></span>
                            </div>
                        </div>
                        <div class="u-s-m-b-15">
                            <ul class="pd-social-list">
                                <li>

                                    <a class="s-fb--color-hover" href="#"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>

                                    <a class="s-tw--color-hover" href="#"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>

                                    <a class="s-insta--color-hover" href="#"><i class="fab fa-instagram"></i></a>
                                </li>
                                <li>

                                    <a class="s-wa--color-hover" href="#"><i class="fab fa-whatsapp"></i></a>
                                </li>
                                <li>

                                    <a class="s-gplus--color-hover" href="#"><i
                                            class="fab fa-google-plus-g"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="u-s-m-b-15">

                            <form class="pd-detail__form" method="POST" action="{{ route('home.add-to-cart') }}">
                                @csrf
                                <input type="hidden" name="product_id" value ="{{ $product->id }}">
                                <div class="u-s-m-b-15">
                                    <span class="pd-detail__label u-s-m-b-8">Color:</span>
                                    <div class="pd-detail__color">
                                        @foreach ($colors as $color)
                                            <div class="color__radio">
                                                <input type="radio" id="{{ $color->name }}" name="color"
                                                    value="{{ $color->name }}">
                                                <label class="color__radio-label" for="{{ $color->name }}"
                                                    style="background-color: {{ $color->hex_code }}" </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="u-s-m-b-15">
                                    <span class="pd-detail__label u-s-m-b-8">Size:</span>
                                    <div class="pd-detail__size">
                                        @foreach ($product->variants as $variant)
                                            <div class="size__radio">
                                                <input type="radio" id="{{ $variant->size->name }}" name="size"
                                                    value="{{ $variant->size->name }}">
                                                <label class="size__radio-label"
                                                    for="size">{{ $variant->size->name }}</label>
                                            </div>
                                        @endforeach

                                    </div>
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
                            <span class="pd-detail__label u-s-m-b-8">Product Policy:</span>
                            <ul class="pd-detail__policy-list">
                                <li><i class="fas fa-check-circle u-s-m-r-8"></i>
                                    <span>Buyer Protection.</span>
                                </li>
                                <li><i class="fas fa-check-circle u-s-m-r-8"></i>
                                    <span>Full Refund if you don't receive your order.</span>
                                </li>
                                <li><i class="fas fa-check-circle u-s-m-r-8"></i>
                                    <span>Returns accepted if product not as described.</span>
                                </li>
                            </ul>
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
                                    <a class="nav-link" data-toggle="tab" href="#pd-tag">TAGS</a>
                                </li>
                                <li class="nav-item">

                                    <a class="nav-link active" id="view-review" data-toggle="tab" href="#pd-rev">REVIEWS

                                        <span>(23)</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">

                            <!--====== Tab 1 ======-->
                            <div class="tab-pane" id="pd-desc">
                                <div class="pd-tab__desc">
                                    <div class="u-s-m-b-15">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book. It has survived not only five centuries, but also the leap into electronic
                                            typesetting, remaining essentially unchanged. It was popularised in the 1960s
                                            with the release of Letraset sheets containing Lorem Ipsum passages, and more
                                            recently with desktop publishing software like Aldus PageMaker including
                                            versions of Lorem Ipsum.</p>
                                    </div>
                                    <div class="u-s-m-b-30"><iframe src="https://www.youtube.com/embed/qKqSBm07KZk"
                                            allowfullscreen></iframe></div>
                                    <div class="u-s-m-b-30">
                                        <ul>
                                            <li><i class="fas fa-check u-s-m-r-8"></i>

                                                <span>Buyer Protection.</span>
                                            </li>
                                            <li><i class="fas fa-check u-s-m-r-8"></i>

                                                <span>Full Refund if you don't receive your order.</span>
                                            </li>
                                            <li><i class="fas fa-check u-s-m-r-8"></i>

                                                <span>Returns accepted if product not as described.</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="u-s-m-b-15">
                                        <h4>PRODUCT INFORMATION</h4>
                                    </div>
                                    <div class="u-s-m-b-15">
                                        <div class="pd-table gl-scroll">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Main Material</td>
                                                        <td>Cotton</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Color</td>
                                                        <td>Green, Blue, Red</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sleeves</td>
                                                        <td>Long Sleeve</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Top Fit</td>
                                                        <td>Regular</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Print</td>
                                                        <td>Not Printed</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Neck</td>
                                                        <td>Round Neck</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pieces Count</td>
                                                        <td>1 Piece</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Occasion</td>
                                                        <td>Casual</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Weight (kg)</td>
                                                        <td>0.5</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--====== End - Tab 1 ======-->


                            <!--====== Tab 2 ======-->
                            <div class="tab-pane" id="pd-tag">
                                <div class="pd-tab__tag">
                                    <h2 class="u-s-m-b-15">ADD YOUR TAGS</h2>
                                    <div class="u-s-m-b-15">
                                        <form>

                                            <input class="input-text input-text--primary-style" type="text">

                                            <button class="btn btn--e-brand-b-2" type="submit">ADD TAGS</button>
                                        </form>
                                    </div>

                                    <span class="gl-text">Use spaces to separate tags. Use single quotes (') for
                                        phrases.</span>
                                </div>
                            </div>
                            <!--====== End - Tab 2 ======-->


                            <!--====== Tab 3 ======-->
                            <div class="tab-pane fade show active" id="pd-rev">
                                @if ($reviews->count() > 0)
                                    <div class="pd-tab__rev">
                                        <div class="u-s-m-b-30">
                                            <div class="pd-tab__rev-score">
                                                <div class="u-s-m-b-8">
                                                    <h2>{{ count($reviews) }} Reviews - {{ $reviewsAvg }} (Overall)</h2>
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

                                                    <div class="u-s-m-b-15">
                                                        <label for="sort-review"></label>
                                                        <select class="select-box select-box--primary-style"
                                                            id="sort-review">
                                                            <option selected>Sort by: Best Rating</option>
                                                            <option>Sort by: Worst Rating</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Reviews List -->
                                                <div class="rev-f1__review">
                                                    @foreach ($reviews as $review)
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
                                                href="product-detail.html">

                                                <img class="aspect__img" src="images/product/electronic/product1.jpg"
                                                    alt=""></a>
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

                                            <a href="shop-side-version-2.html">{{ $product->category->name }}</a></span>

                                        <span class="product-o__name">

                                            <a href="product-detail.html">{{ $product->name }}</a></span>
                                        <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i
                                                class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                class="fas fa-star"></i><i class="fas fa-star"></i>

                                            <span class="product-o__review">(20)</span>
                                        </div>

                                        <span class="product-o__price">EGP {{ $product->price }}

                                            <span class="product-o__discount">$160.00</span></span>
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
