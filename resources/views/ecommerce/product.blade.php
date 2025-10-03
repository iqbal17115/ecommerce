@extends('layouts.ecommerce')
@section('meta')
<meta property="og:title" content="{{ $product_detail->name }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($product_detail->ProductDetail?->short_deacription), 150) }}">
<meta property="og:image" content="{{ asset('storage/product_photo/' . $product_detail?->ProductMainImage?->image) }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="product">
@endsection

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

    .sold_out {
        top: 2em;
        left: -4em;
        color: #fff;
        display: block;
        position: absolute;
        text-align: center;
        text-decoration: none;
        letter-spacing: .06em;
        background-color: #A00;
        padding: 0.5em 5em 0.4em 5em;
        text-shadow: 0 0 0.75em #444;
        box-shadow: 0 0 0.5em rgba(0, 0, 0, 0.5);
        font: bold 16px/1.2em Arial, Sans-Serif;
        -webkit-text-shadow: 0 0 0.75em #444;
        -webkit-box-shadow: 0 0 0.5em rgba(0, 0, 0, 0.5);
        -webkit-transform: rotate(-45deg) scale(0.75, 1);
        z-index: 10;
    }

    .sold_out:before {
        content: '';
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        position: absolute;
        margin: -0.3em -5em;
        transform: scale(0.7);
        -webkit-transform: scale(0.7);
        border: 2px rgba(255, 255, 255, 0.7) dashed;
    }

    #write-a-review {
        text-transform: none;
    }

    #write-a-review {
        color: #666 !important;
        border-bottom: 1px solid #bdbbb4;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
        cursor: pointer;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('css/web/user/review.css') }}?v={{ time() }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/web/user/product_variation.css') }}?v={{ time() }}">

<main class="main">
    <div id="temp_user_id" data-user_id="{{ $user_id }}"></div>
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
                @php
                $breadcrumbs = $product_detail?->Category?->getParentsAttribute()->pluck('name')->toArray() ?? [];
                $breadcrumbs[] = $product_detail?->Category?->name; // add current category
                @endphp

                {{ implode(' » ', $breadcrumbs) }}

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
                            @foreach ($product_detail->ProductImage as $product_image)
                            <div class="product-item">
                                <img class="product-single-image lazy-load"
                                    data-src="{{ asset('storage/product_photo/' . $product_image->image) }}"
                                    data-zoom-image="{{ asset('storage/product_photo/' . $product_image->image) }}"
                                    width="468" height="468" />
                            </div>
                            @endforeach
                            <!-- @foreach ($product_detail->productColors as $productColor)
                            @foreach ($productColor->media as $media)
                            <div class="product-item">
                                <img class="product-single-image"
                                    src="{{ asset('storage/' . $media->file_path) }}"
                                    data-zoom-image="{{ asset('storage/' . $media->file_path) }}" />
                            </div>
                            @endforeach
                            @endforeach -->
                        </div>
                        <!-- End .product-single-carousel -->
                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>
                    </div>

                    <div class="prod-thumbnail owl-dots">
                        @foreach ($product_detail->ProductImage as $product_image)
                        <div class="owl-dot">
                            <img class="lazy-load" data-src="{{ asset('storage/product_photo/' . $product_image->image) }}" width="110"
                                height="110" style="width: 110px; height: 110px;" alt="product-thumbnail" />
                        </div>
                        @endforeach
                        <!-- @foreach ($product_detail->productColors as $productColor)
                        @foreach ($productColor->media as $media)
                        <div class="owl-dot">
                            <img src="{{ asset('storage/' . $media->file_path) }}" width="110" height="110"
                                style="width: 110px; height: 110px;" alt="product-thumbnail" />
                        </div>
                        @endforeach
                        @endforeach -->
                    </div>
                </div>
                <!-- End .product-single-gallery -->
                <div class="col-lg-7 col-md-6 product-single-details">
                    <h1 class="product-title">
                        {{ $product_detail?->name }}

                    </h1>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-12">
                            <h5 class="fw-bold m-0 p-0">
                                {{ $product_detail->code ? 'Item #:' : '' }}
                                <span class="m-0 p-0" style="font-weight: bold; color: #f4631b;">
                                    {{ $product_detail->code ? $product_detail->code : '' }}
                                </span>
                            </h5>
                        </div>

                        <div class="col-md-12">
                            <h5 class="fw-bold m-0 p-0">
                                {{ $product_detail->Brand ? 'Brand:' : '' }}
                                <span class="m-0 p-0" style="font-weight: bold; color: #f4631b;">
                                    {{ $product_detail->Brand ? $product_detail->Brand->name : '' }}
                                </span>

                                {!! $product_detail->stock_qty > 0
                                ? 'Available Qty: <span class="m-0 p-0" style="font-weight: bold; color: #f4631b;">' .
                                    $product_detail->stock_qty .
                                    '</span>'
                                : '<span class="m-0 p-0" style="font-weight: bold;">Sold Out</span>' !!}

                            </h5>
                        </div>
                    </div>

                    {{-- star Rating --}}
                    @php
                    $avgRating = round($product_detail->reviews_avg_rating);
                    $totalReviews = $product_detail->reviews_count;
                    @endphp

                    <span class="five-star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <=$avgRating)
                            <i class="fas fa-star"></i>
                            @else
                            <i class="far fa-star"></i>
                            @endif
                            @endfor
                    </span>

                    <span class="rating-number">({{ $totalReviews }} reviews)</span>


                    <span class="rating-number">-</span>
                    <span class="rating-number"
                        style="font-size: 11px;">{{ $totalReviews }} ratings |</span>
                    <a class="write-review" id="write-a-review" role="button">
                        &nbsp; <span><i class="fas fa-pen"></i> Write a review</span>
                    </a>
                    {{-- end star Rating --}}
                    @if (isset($all_active_advertisements['Details']['2']['ads']))
                    <div class="" style="width: 600px;">
                        <img data-src="{{ asset('storage/' . $all_active_advertisements['Details']['2']['ads']) }}"
                            class="w-100 ml-sm-0 mb-2 lazy-load" style="height: 72px; width: 80%;" alt="Porto Logo">
                    </div>
                    @else
                    <hr class="short-divider">
                    @endif

                    <div class="price-box">
                        @if (
                        $product_detail->sale_price &&
                        $product_detail->sale_start_date &&
                        $product_detail->sale_end_date &&
                        $product_detail->sale_start_date <= now() &&
                            $product_detail->sale_end_date >= now())
                            <del class="old-price">{{ $currency?->icon }}
                                {{ number_format($product_detail->your_price, 2) }}</del>
                            <span class="product-price brand_text_design">{{ $currency?->icon }}
                                {{ number_format($product_detail->sale_price, 2) }}</span>
                            @else
                            <span class="brand_text_design">{{ $currency?->icon }}</span> <span
                                class="product-price brand_text_design">
                                {{ number_format($product_detail->your_price, 2) }}</span>
                            @endif


                    </div>
                    <!-- End .price-box -->

                    <div class="product-desc">
                        <p>
                            @if ($product_detail && $product_detail->ProductDetail)
                            {!! $product_detail->ProductDetail->short_deacription !!}
                            @endif
                        </p>
                    </div>
                    {{-- Start Product Varations --}}
                    @if(count($attributeOptions) > 0)
                    <div id="variation-selectors" class="variation-selector">
                        @foreach($attributeOptions as $attribute => $values)
                        <div class="attribute-group mb-2">
                            <div class="attribute-label fw-semibold text-uppercase text-muted mb-1">{{ $attribute }}</div>
                            <div class="btn-group-wrap" data-attribute="{{ $attribute }}">
                                @foreach($values as $value)
                                <button type="button"
                                    class="btn variation-btn"
                                    data-attribute="{{ $attribute }}"
                                    data-value="{{ $value }}">
                                    {{ $value }}
                                </button>
                                @endforeach
                            </div>
                        </div>
                        @endforeach

                        <div class="mt-1">
                            <button type="button" id="clear-variations" class="btn btn-sm btn-outline-secondary">Clear</button>
                        </div>

                        <input type="hidden" name="selected_variation_id" id="selected_variation_id" required>
                    </div>
                    @endif
                    {{-- End Product Varations --}}
                    <!-- End .product-desc -->
                    <div class="product-desc">
                        <p class="text-dark">
                            {{ $product_detail?->ProductDetail?->Condition?->title ? 'Condition: ' : '' }}
                            <span class="">{{ $product_detail?->ProductDetail?->Condition?->title }}</span>
                        </p>
                    </div>

                    <!-- End .product-desc -->
                    <div class="product-desc">
                        <p class="text-dark">{{ $product_detail?->ProductMoreDetail?->warranty ? 'Warranty: ' : '' }}
                            <span class="">{{ $product_detail?->ProductMoreDetail?->warranty }}
                                {{ $product_detail?->ProductMoreDetail?->warranty_unit }}</span>
                        </p>
                    </div>

                    {{-- Show Product Variations --}}
                    <div class="product-desc">
                        <div class="variation-select">

                        </div>
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
                                value="{{ $cart_qty }}" id="current_product_quantity" type="text">
                        </div>
                        <!-- End .product-single-qty -->

                        <a href="javascript:void(0);" title="Add To Cart"
                            data-product_id="{{ $product_detail->id }}"
                            class="btn btn-dark add_cart_item {{ $product_detail->stock_qty == 0 ? 'non-clickable' : '' }}
                            add_cart_item_quantity add-cart @if ($product_detail->cartItem) added-to-cart @endif mr-2"
                            title="Add to Cart">{{ __('translate.add_to_cart') }}</a>

                        <a href="javascript:void(0);" title="Buy Now" data-id="{{ $product_detail->id }}"
                            data-product_id="{{ $product_detail->id }}"
                            @if ($product_detail->ProductMainImage) data-image="{{ $product_detail->ProductMainImage->image }}" @endif
                            class="btn {{ $product_detail->stock_qty == 0 ? 'non-clickable' : '' }}
                            buy_now_with_quantity btn-buy-now mr-2"
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

                        @php
                        $productUrl = route('products.details', [
                        'name' => rawurlencode($product_detail->name),
                        'seller_sku' => $product_detail->seller_sku
                        ]);
                        @endphp

                        <x-social-share :url="$productUrl" :title="$product_detail->name" />

                        <!-- End .social-icons -->
                        @if (isset($all_active_advertisements['Details']['3']['ads']))
                        <img data-src="{{ asset('storage/' . $all_active_advertisements['Details']['3']['ads']) }}"
                            class="ml-md-5 lazy-load" style="height: 52px; width: 390px;">
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
                        role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews <span
                            class="total_review">0</span></a>
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
                        {!! $product_detail?->ProductDetail?->condition_note
                        ? '<span class="h4 brand_text_color">Product Condition: </span>'
                        : '' !!}
                        {!! $product_detail?->ProductDetail?->condition_note !!}
                        <br>
                        {!! $product_detail?->ProductMoreDetail?->warranty_description
                        ? '<span class="h4 brand_text_color">Warranty Description: </span>'
                        : '' !!}
                        {!! $product_detail?->ProductMoreDetail?->warranty_description !!}
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
                        <h3 class="reviews-title"><span class="total_review">0</span> review for
                            {{ $product_detail->name }}
                        </h3>

                        <div class="review-list" id="review_list"></div>

                        <div class="add-product-review">
                            <h3 class="review-title">Add a review</h3>

                            <form class="comment-form m-0" id="review_form">
                                <input type="hidden" name="product_id" id="product_id" value="{{ $product_detail->id }}">
                                <div class="rating-form">
                                    <label>Your rating <span class="required">*</span></label>
                                    <span class="rating-stars">
                                        <a class="star-1" href="#">1</a>
                                        <a class="star-2" href="#">2</a>
                                        <a class="star-3" href="#">3</a>
                                        <a class="star-4" href="#">4</a>
                                        <a class="star-5" href="#">5</a>
                                    </span>
                                    <select name="rating" id="rating" style="display: none;" required>
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
                                    <textarea name="comment" id="comment" class="form-control form-control-sm" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                            <div class="review-list mt-4" id="review_list"></div>

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
                @php
                    $avgRating = round($product_category_product->reviews_avg_rating);
                    $totalReviews = $product_category_product->reviews_count;
                @endphp
                <div class="product-default inner-quickview inner-icon" style="overflow:hidden;">
                    <figure>
                        <a
                            href="{{ route('products.details', ['name' => rawurlencode($product_category_product->name), 'seller_sku' => $product_category_product->seller_sku]) }}">
                            <x-lazy-img
    :src="asset('storage/product_photo/' . $product_category_product->ProductMainImage->image)"
    :alt="$product_category_product->name ?? 'product'"
    width="239"
    height="239"
    class="rounded-md shadow-sm"
    style="filter: brightness(0.9) contrast(1.2) saturate(1.1);"
/>

                        </a>
                        @if ($product_detail->stock_qty > 0)
                        <div class="btn-icon-group">
                            <a href="javascript:void(0);" title="Add To Cart"
                                data-product_id="{{ $product_category_product->id }}"
                                @if ($product_category_product->ProductMainImage) data-image="{{ $product_category_product->ProductMainImage->image }}" @endif
                                class="btn-icon
                                add_cart_item product-type-simple"><i
                                    class="icon-shopping-cart"></i></a>
                        </div>
                        @endif
                    </figure>
                    <div class="product-details">
                        <h3 class="product-title">
                            <a
                                href="{{ route('products.details', ['name' => $product_category_product->name, 'seller_sku' => $product_category_product->seller_sku]) }}">{{ $product_category_product->name }}</a>
                            {{-- rating add html code --}}
                           {{-- rating --}}
                    <span class="five-star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $avgRating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </span>

                    <span class="rating-number" style="font-size: 11px;">
                        ({{ $totalReviews }} reviews)
                    </span>
                        </h3>
                        <!-- End .product-container -->
                        <div class="price-box">
                            @if (
                            $product_category_product->sale_price &&
                            $product_category_product->sale_start_date &&
                            $product_category_product->sale_end_date &&
                            $product_category_product->sale_start_date <= now() &&
                                $product_category_product->sale_end_date >= now())
                                <del
                                    class="old-price">{{ $currency?->icon }}{{ number_format($product_category_product->your_price, 2) }}</del>
                                <span
                                    class="product-price brand_text_design">{{ $currency?->icon }}{{ number_format($product_category_product->sale_price, 2) }}</span>
                                @else
                                <span
                                    class="product-price brand_text_design">{{ $currency?->icon }}{{ number_format($product_category_product->your_price, 2) }}</span>
                                @endif
                        </div>
                        <!-- End .price-box -->

                    </div>
                    <!-- End .product-details -->
                    @if ($product_category_product->stock_qty <= 0)
                        <a class="sold_out" style="color: #fff;">Sold out</a>
                        @endif
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
            <img data-src="{{ asset('storage/' . $all_active_advertisements['Details']['4']['ads']) }}"
                class="lazy-load">
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

@endsection
@push('scripts')
<script>
    window.variationMap = @json($variationMap);
</script>

<script src="{{ asset('js/panel/users/cart/add_to_cart.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_manager.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_drawer.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/review/reviews.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/product_details/product_variation.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/share.js') }}?v={{ time() }}"></script>
<script>
    // Set the hasCartList variable
    window.hasCartList = false;
    // Add an event listener to the DOMContentLoaded event
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof CartManager !== 'undefined') {
            CartManager.loadCartData();
        }
    });

    // This handles BACK button cache restore
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            CartManager.loadCartData();
        }
    });

    window.dataLayer = window.dataLayer || [];
        dataLayer.push({
        'event': 'home_page_view'
    });
</script>

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

<script>
    window.dataLayer = window.dataLayer || [];

    let productDetail = @json($product_detail);

    dataLayer.push({
        'event': 'view_item',
        'ecommerce': {
            'items': [{
                'item_id': productDetail.id,
                'item_name': productDetail.name,
                'item_category': productDetail.category?.name || '',
                'price': productDetail.sale_price || 0,
            }]
        }
    });
</script>
@endpush