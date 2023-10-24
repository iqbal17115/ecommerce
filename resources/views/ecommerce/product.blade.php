@extends('layouts.ecommerce')
@section('content')
    <style>
        .rating-container {
            display: flex;
            align-items: center;
        }

        .star-rating {
            display: inline-block;
            font-size: 4px;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label.star {
            font-size: 17px;
            color: #F85506;
            cursor: pointer;
        }

        .star-rating input[type="radio"]:checked~label.star {
            color: #ffcc00;
        }

        .rating-text {
            /* margin-left: 10px; */
            font-size: 16px;
        }

        .brand-container {
            background-color: #f7f7f7;
            padding: 5px;
            margin-bottom: 2px;
        }

        .category-container {
            background-color: #f7f7f7;
            padding: 5px;
            margin-bottom: 5px;
        }

        .brand-label h5 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .brand-name h4 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            color: #c00;
        }
    </style>
    <main class="main">
        @if (isset($all_active_advertisements['Details']['1']['ads']))
            <div>
                <center>
                    <img src="{{ asset('storage/' . $all_active_advertisements['Details']['1']['ads']) }}">
                </center>
            </div>
        @endif
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-1">
            <div class="container">
                <ol class="breadcrumb">
                                @foreach ($product_detail->category->getParentsAttribute() as $parentCategory)
                                    {{ $parentCategory->name }}
                                    @if (!$loop->last)
                                        &raquo;
                                    @else
                                        &raquo;
                                        {{ $product_detail->category->name }}
                                    @endif
                                @endforeach
                            </span></a>
                    </li>
                </ol>
            </div>
        </nav>

        <div class="container pt-2">

            <div class="product-single-container product-single-default">

                <div class="row">
                    <div class="col-lg-5 col-md-6 product-single-gallery">
                        <div class="product-slider-container">

                            <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                @foreach ($product_detail->ProductImage as $product_details)
                                    <div class="product-item">
                                        <img class="product-single-image"
                                            src="{{ asset('storage/product_photo/' . $product_details->image) }}"
                                            data-zoom-image="{{ asset('storage/product_photo/' . $product_details->image) }}"
                                            width="468" height="468" alt="product" />
                                    </div>
                                @endforeach
                            </div>
                            <!-- End .product-single-carousel -->
                            <span class="prod-full-screen">
                                <i class="icon-plus"></i>
                            </span>
                        </div>

                        <div class="prod-thumbnail owl-dots">
                            @foreach ($product_detail->ProductImage as $product_image)
                                <div class="owl-dot">
                                    <img src="{{ asset('storage/product_photo/' . $product_image->image) }}" width="110"
                                        height="110" style="width: 110px; height: 110px;" alt="product-thumbnail" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- End .product-single-gallery -->

                    <div class="col-lg-7 col-md-6 product-single-details">
                        <h1 class="product-title">{{ $product_detail->name }}</h1>
                        @if ($product_detail->Brand)
                            <div class="row g-3 align-items-center">
                                <div class="col-md-3">
                                    <h5 class="fw-bold m-0 p-0">Brand: <span class="m-0 p-0"
                                            style="font-weight: bold;color: #f4631b;">{{ $product_detail->Brand->name }}</span>
                                    </h5>
                                </div>
                            </div>
                        @endif

                        {{-- star Rating --}}
                        <span class="five-star-rating">
                            @if ($product_detail->reviews()->avg('rating') >= 1)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif

                            @if ($product_detail->reviews()->avg('rating') >= 2)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif

                            @if ($product_detail->reviews()->avg('rating') >= 3)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif

                            @if ($product_detail->reviews()->avg('rating') >= 4)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif

                            @if ($product_detail->reviews()->avg('rating') >= 5)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        </span>

                        <span class="rating-number">-</span>
                        <span class="rating-number"
                            style="font-size: 11px;">{{ $product_detail->reviews()->sum('rating') }} ratings |</span>
                        {{-- end star Rating --}}
                        @if (isset($all_active_advertisements['Details']['2']['ads']))
                            <div class="" style="width: 600px;">
                                <img src="{{ asset('storage/' . $all_active_advertisements['Details']['2']['ads']) }}"
                                    class="w-100 ml-sm-0 mb-2" style="height: 72px; width: 80%;" alt="Porto Logo">
                            </div>
                        @else
                            <hr class="short-divider">
                        @endif


                        <div class="price-box">
                            @php
                                echo $product_detail->your_price
                                    ? '<span
                            class="old-price">' .
                                        $currency?->icon .
                                        '' .
                                        number_format((float) $product_detail->your_price, 2) .
                                        '</span>'
                                    : '';
                                echo $product_detail->sale_price
                                    ? '<span
                            class="new-price">' .
                                        $currency?->icon .
                                        '' .
                                        number_format((float) $product_detail->sale_price, 2) .
                                        '</span>'
                                    : '';
                            @endphp
                        </div>
                        <!-- End .price-box -->

                        <div class="product-desc">
                            <p>
                                @if ($product_detail && $product_detail->ProductDetail)
                                    {!! $product_detail->ProductDetail->short_deacription !!}
                                @endif
                            </p>
                        </div>
                        <!-- End .product-desc -->
                        <div class="product-action">

                            <div class="product-single-qty">
                                @php
                                    $cart_qty = 1;
                                    $cart = session()->get('cart', []);
                                @endphp
                                @if (isset($cart[$product_detail->id]))
                                    @php
                                        $cart_qty = $cart[$product_detail->id]['quantity'];
                                    @endphp
                                @endif
                                <input class="horizontal-quantity form-control product-quantity-{{ $product_detail->id }}"
                                    value="{{ $cart_qty }}" type="text">
                            </div>
                            <!-- End .product-single-qty -->

                            <a href="javascript:void(0);" title="Add To Cart" data-id="{{ $product_detail->id }}"
                                data-name="{{ $product_detail->name }}"
                                data-your_price="{{ $product_detail->your_price }}"
                                data-sale_price="{{ $product_detail->sale_price }}"
                                @if ($product_detail->ProductMainImage) data-image="{{ $product_detail->ProductMainImage->image }}" @endif
                                class="btn btn-dark
                            btn-add-cart add-cart mr-2"
                                title="Add to Cart">{{ __('translate.add_to_cart') }}</a>

                            <a href="javascript:void(0);" title="Buy Now" data-id="{{ $product_detail->id }}"
                                data-name="{{ $product_detail->name }}"
                                data-your_price="{{ $product_detail->your_price }}"
                                data-sale_price="{{ $product_detail->sale_price }}"
                                @if ($product_detail->ProductMainImage) data-image="{{ $product_detail->ProductMainImage->image }}" @endif
                                class="btn
                            btn-add-cart add-cart btn-buy-now mr-2"
                                style="background-color: #F4631B; color: white;"
                                title="Buy
                            Now">{{ __('translate.buy_now') }}</a>

                            <a href="{{ route('cart') }}" class="btn btn-gray view-cart d-none">View cart</a>
                        </div>
                        <!-- End .product-action -->
                        </tr>
                        <hr class="divider mb-0 mt-0">

                        <div class="product-single-share mb-3">
                            <label class="sr-only">Share:</label>

                            <div class="social-icons mr-2">
                                <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                    title="Facebook"></a>
                                <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                                    title="Twitter"></a>
                                <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank"
                                    title="Linkedin"></a>
                                <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank"
                                    title="Google +"></a>
                                <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank"
                                    title="Mail"></a>
                            </div>
                            <!-- End .social-icons -->
                            @if (isset($all_active_advertisements['Details']['3']['ads']))
                                <img src="{{ asset('storage/' . $all_active_advertisements['Details']['3']['ads']) }}"
                                    class="ml-md-5" style="height: 52px; width: 390px;">
                            @endif
                        </div>
                        <!-- End .product single-share -->
                    </div>
                    <!-- End .product-single-details -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .product-single-container -->

            <div class="product-single-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content"
                            role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content"
                            role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews ({{count($product_detail->reviews)}})</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                        aria-labelledby="product-tab-desc">
                        <div class="product-desc-content">
                            @if ($product_detail && $product_detail->ProductDetail)
                                {!! $product_detail->ProductDetail->description !!}
                            @endif
                            <br>
                            @if ($product_detail && $product_detail->ProductDetail)
                                {!! $product_detail->ProductDetail->condition_note !!}
                            @endif
                            <br>
                            @if ($product_detail && $product_detail->ProductDetail)
                                {!! $product_detail->ProductDetail->product_content !!}
                            @endif
                        </div>
                        <!-- End .product-desc-content -->
                    </div>
                    <!-- End .tab-pane -->

                    <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                        aria-labelledby="product-tab-reviews">
                        <div class="product-reviews-content">
                            <h3 class="reviews-title">{{count($product_detail->reviews)}} review for {{$product_detail->name}}</h3>

                            <div class="comment-list">
                                @foreach($product_detail->reviews as $review)
                                <div class="comments">
                                    <figure class="img-thumbnail">
                                        <img src="{{ asset('aladdinne/assets/images/blog/author.jpg') }}" alt="author" width="80" height="80">
                                    </figure>

                                    <div class="comment-block">
                                        <div class="comment-header">
                                            <div class="comment-arrow"></div>

                                            <div class="ratings-container float-sm-right">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width: {{ $review->rating*2 }}0%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>

                                            <span class="comment-by">
                                                <strong>{{ $review->user->name }}</strong> - {{ $review->created_at->format('F d, Y') }}
                                            </span>
                                        </div>

                                        <div class="comment-content">
                                            <p>{{ $review->comment }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>


                            <div class="divider"></div>

                            <div class="add-product-review">
                                <h3 class="review-title">Add a review</h3>

                                <form class="comment-form m-0" id="reviewForm">
                                    <input name="product_id" id="product_id" value="{{ $product_detail->id }}" hidden />
                                    <div class="rating-form">
                                        <label for="rating">Your rating <span class="required">*</span></label>
                                        <span class="rating-stars">
                                            <a class="star-1" href="#">1</a>
                                            <a class="star-2" href="#">2</a>
                                            <a class="star-3" href="#">3</a>
                                            <a class="star-4" href="#">4</a>
                                            <a class="star-5" href="#">5</a>
                                        </span>

                                        <select name="rating" id="rating" required="" style="display: none;">
                                            <option value="">Rate…</option>
                                            <option value="5">Perfect</option>
                                            <option value="4">Good</option>
                                            <option value="3">Average</option>
                                            <option value="2">Not that bad</option>
                                            <option value="1">Very poor</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Your review <span class="required">*</span></label>
                                        <textarea cols="5" rows="6" name="comment" id="comment" class="form-control form-control-sm"></textarea>
                                    </div>
                                    <!-- End .form-group -->


                                    {{-- <div class="row">
                                        <div class="col-md-6 col-xl-12">
                                            <div class="form-group">
                                                <label>Name <span class="required">*</span></label>
                                                <input type="text" class="form-control form-control-sm" required>
                                            </div>
                                            <!-- End .form-group -->
                                        </div>

                                        <div class="col-md-6 col-xl-12">
                                            <div class="form-group">
                                                <label>Email <span class="required">*</span></label>
                                                <input type="text" class="form-control form-control-sm" required>
                                            </div>
                                            <!-- End .form-group -->
                                        </div>

                                        <div class="col-md-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="save-name" />
                                                <label class="custom-control-label mb-0" for="save-name">Save my
                                                    name, email, and website in this browser for the next time I
                                                    comment.</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    @if (Auth::user())
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    @endif
                                </form>
                            </div>
                            <!-- End .add-product-review -->
                        </div>
                        <!-- End .product-reviews-content -->
                    </div>
                    <!-- End .tab-pane -->
                </div>
                <!-- End .tab-content -->
            </div>
            <!-- End .product-single-tabs -->

            <div class="products-section pt-0 pb-2">
                <h2 class="section-title pb-3">Related Products</h2>

                <div class="products-slider owl-carousel owl-theme dots-top dots-small"
                    data-owl-options="{
                        'responsive': {
                            '768': {
                                'items': 4
                            },
                            '991': {
                                'items': 4
                            },
                            '1200': {
                                'items': 5
                            }
                        }
                    }">
                    @if ($product_detail && $product_detail->Category && $product_detail->Category->Product)
                        @foreach ($product_detail->Category->Product as $product_category_product)
                            @if ($product_category_product->id != $product_detail->id)
                                <div class="product-default inner-quickview inner-icon">
                                    <figure>
                                        <a href="{{ route('products.show', ['name' => urlencode($product_category_product->name)]) }}">
                                            <img @if ($product_category_product->ProductMainImage) src="{{ asset('storage/product_photo/' . $product_category_product->ProductMainImage->image) }}" @endif
                                                width="239" height="239" style="width: 239px; height: 239px;"
                                                alt="product">
                                        </a>
                                        <div class="btn-icon-group">
                                            <a href="javascript:void(0);" title="Add To Cart"
                                                data-id="{{ $product_category_product->id }}"
                                                data-name="{{ $product_category_product->name }}"
                                                data-your_price="{{ $product_category_product->your_price }}"
                                                data-sale_price="{{ $product_category_product->sale_price }}"
                                                @if ($product_category_product->ProductMainImage) data-image="{{ $product_category_product->ProductMainImage->image }}" @endif
                                                class="btn-icon
                                btn-add-cart product-type-simple"><i
                                                    class="icon-shopping-cart"></i></a>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h3 class="product-title">
                                            <a
                                                href="{{ route('products.show', ['name' => urlencode($product_category_product->name)]) }}">{{ $product_category_product->name }}</a>
                                            {{-- rating add html code --}}
                                            <span class="five-star-rating">
                                                @if ($product_category_product->reviews()->avg('rating') >= 1)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif

                                                @if ($product_category_product->reviews()->avg('rating') >= 2)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif

                                                @if ($product_category_product->reviews()->avg('rating') >= 3)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif

                                                @if ($product_category_product->reviews()->avg('rating') >= 4)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif

                                                @if ($product_category_product->reviews()->avg('rating') >= 5)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            </span>
                                            <span class="rating-number">-</span>
                                            <span class="rating-number"
                                                style="font-size: 11px;">{{ $product_category_product->reviews()->sum('rating') }}</span>
                                        </h3>
                                        <!-- End .product-container -->
                                        <div class="price-box">
                                            @if ($product_category_product->sale_price && $product_category_product->sale_start_date && $product_category_product->sale_end_date && $product_category_product->sale_start_date <= now() && $product_category_product->sale_end_date >= now())
                                                <del class="old-price">{{ $currency?->icon }}{{ number_format($product_category_product->your_price, 2) }}</del>
                                                <span class="product-price">{{ $currency?->icon }}{{ number_format($product_category_product->sale_price, 2) }}</span>
                                            @else
                                                <span class="product-price">{{ $currency?->icon }}{{ number_format($product_category_product->your_price, 2) }}</span>
                                            @endif
                                        </div>
                                        <!-- End .price-box -->

                                    </div>
                                    <!-- End .product-details -->
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <!-- End .products-slider -->

            </div>
            <!-- End .products-section -->
        </div>
        <!-- End .container -->
        <!-- Start Ads -->
        @if (isset($all_active_advertisements['Details']['4']['ads']))
            <div>
                <center>
                    <img src="{{ asset('storage/' . $all_active_advertisements['Details']['4']['ads']) }}"
                        class="">
                </center>
            </div>
        @endif
        <!-- End Ads -->
        <br>
    </main>
    <!-- End .main -->
    <!-- footer-area -->
    @include('ecommerce.footer')
    <!-- footer-area-end -->
    @include('ecommerce.cart-js')
    <!-- Start Sidebar -->
    @include('ecommerce.sidebar-js')
    <!-- End Sidebar -->
    <script>
        function lazyLoad() {
            const lazyImages = document.querySelectorAll('.lazy-load');
            lazyImages.forEach(img => {
                if (img.getBoundingClientRect().top <= window.innerHeight && img.getBoundingClientRect()
                    .bottom >= 0 && getComputedStyle(img).display !== 'none') {
                    img.src = img.dataset.src;
                    img.classList.remove('lazyload');
                }
            });
        }

        // Check for visible images on page load
        document.addEventListener("DOMContentLoaded", lazyLoad);
        $(document).ready(function() {
            // Get an array of all the image elements you want to load
            var images = document.getElementsByClassName('lazy-load');

            // Set up an IntersectionObserver to detect when the images are in view
            var options = {
                rootMargin: '0px',
                threshold: 0.1
            };

            var observer = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    // If the image is in the viewport, load it by setting its `src` attribute to the appropriate URL
                    if (entry.isIntersecting) {
                        var image = entry.target;
                        var imageUrl = image.getAttribute('data-src');
                        image.src = imageUrl;
                        image.classList.remove(
                            'lazy-load'
                        ); // Remove the class to prevent the image from being loaded again
                        observer.unobserve(
                            image); // Stop observing the image once it has been loaded
                    }
                });
            }, options);

            // Loop through all the image elements and observe them with the IntersectionObserver
            for (var i = 0; i < images.length; i++) {
                var image = images[i];
                observer.observe(image);
            }
        });
    </script>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#reviewForm').submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting normally
                // Get the form data
                var formData = {
                    product_id: $('#product_id').val(),
                    rating: $('#rating').val(),
                    comment: $('textarea[name=comment]').val()
                };
                console.log(formData);
                // Send an AJAX POST request
                $.ajax({
                    type: 'POST',
                    url: '{{ route('reviews.store') }}', // Replace with your Laravel route
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        $('#rating').val('');
                        $('textarea[name=comment]').val('');
                        // You can perform any additional actions here, like updating the UI or showing a success message
                    },
                    error: function(error) {
                        // Handle error response
                        alert('Error submitting the review');
                        // You can display an error message or handle the error in any other way
                    }
                });
            });
        });
    </script>
@endpush
