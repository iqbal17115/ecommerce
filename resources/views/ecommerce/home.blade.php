@extends('layouts.ecommerce')
@section('content')
    <style>
        @media (min-width:1220px) {
            .container {
                max-width: 1500px;
            }
        }

        .post-slider>.owl-stage-outer,
        .products-slider>.owl-stage-outer {
            padding: 0px 0px;
        }

        .feature-card {
            width: 100%;
            background-color: #ccc;
        }

        @media screen and (min-width: 480px) {
            .feature-card {
                width: 100%;
            }
        }

        @media screen and (min-width: 768px) {
            .feature-card {
                width: 50%;
            }
        }

        @media screen and (min-width: 992px) {
            .feature-card {
                width: 25%;
            }
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

        /* two line name show css code */
    </style>
    <div id="temp_user_id" data-user_id="{{ $user_id }}"></div>
    <main class="main">
        <div class="bg-gray pb-5">
            <div class="container pb-2">
                <div class="slide-animate slider-image-header owl-carousel owl-theme nav-circle mb-2"
                    data-owl-options="{
				'loop': true,
                'autoplay':true,
                'autoplayTimeout':5000
			}">
                    @foreach ($sliders as $slider)
                        <div class="home-slide home-slide1 banner">
                            <img class="slider_image slide-bg lazy-load" data-src="{{ asset('storage/' . $slider->image) }}"
                                alt="slider image" style="min-height: 208px;">
                            <div
                                class="container d-flex align-items-sm-center justify-content-sm-between justify-content-center flex-column flex-sm-row">
                                <div class="banner-content content-left text-sm-right mb-sm-0 mb-2"></div>
                                <!-- End .banner-layer -->
                            </div>
                        </div>
                        <!-- End .home-slide -->
                    @endforeach
                </div>
                <!-- End .home-slider -->

                <div class="categories-section appear-animate" data-animation-name="fadeIn" data-animation-delay="100">
                    <div class="categories-slider owl-carousel owl-theme show-nav-hover nav-outer"
                        data-owl-options="{
                            'loop': false,
                            'autoplay': true,
                            'autoplayTimeout': 3000,
                            'responsive': {
                                '0': {
                                    'items': 3
                                },
                                '480': {
                                    'items': 5
                                },
                                '576': {
                                    'items': 6
                                },
                                '768': {
                                    'items': 7
                                },
                                '992': {
                                    'items': 8
                                },
                                '1200': {
                                    'items': 12
                                }
                            }
                        }">
                        @foreach ($top_show_categories as $top_show_category)
                            <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                                <a
                                    href="{{ route('catalog.show', ['category_name' => rawurlencode($top_show_category->name)]) }}">
                                    <figure>
                                        <img class="lazy-load"
                                            data-src="{{ asset('storage/' . $top_show_category->image) }}" alt="category"
                                            width="280" height="240"
                                            style="width: 100px; height: 100px; border-radius: 50%;" />
                                    </figure>
                                    <div class="category-content p-0">
                                        <span
                                            style="margin: 8px 12px 0;font-size: 12px;color: #212121;line-height: 18px;height: 36px;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;">
                                            {{ __($top_show_category->name, [], app()->getLocale()) }}
                                        </span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Start Top Feature -->
                <div class="row" style="margin-top: 18px;">
                    <!-- Start Product Part -->
                    <!-- Start Product Part -->
                    @foreach ($top_features as $top_feature)
                        @if ($top_feature->TopFeatureSetting)
                            @if ($top_feature->TopFeatureSetting && count($top_feature->TopFeatureSetting->FeatureSettingDetail) >= 2)
                                <div class="col-md-3 card">
                                    <div class="card-body">
                                        <div class="a-cardui-header">
                                            <h2 class="a-color-base headline truncate-2line ">
                                                {{ $top_feature->name }}
                                            </h2>
                                        </div>
                                        <div class="row">
                                            @foreach ($top_feature->TopFeatureSetting->FeatureSettingDetail as $feature_setting_detail)
                                                <div class="col-6 p-0">
                                                    <a href="{{ route('catalog.show', ['name' => rawurlencode($feature_setting_detail->Category->name)]) }}"
                                                        style="text-decoration: none;">
                                                        <div class="card mb-0">
                                                            <img class="card-img-top lazy-load"
                                                                data-src="{{ asset('storage/' . $feature_setting_detail->Category->image) }}"
                                                                style="height: 150px;">
                                                            <div class="text-center text-dark">
                                                                <span>{{ $feature_setting_detail->Category->name }}</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <!-- End Product -->
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- End Feature -->
                                    </div>
                                </div>
                            @endif
                            <!-- Start Ads -->
                            @if (
                                $top_feature->TopFeatureSetting->ProductFeature->Advertisement &&
                                    count($top_feature->TopFeatureSetting->ProductFeature->Advertisement) > 0)
                                <div class="col-md-3 card">
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($top_feature->TopFeatureSetting->ProductFeature->Advertisement as $advertisement)
                                                <div class="col-12 p-0">
                                                    <div class="card mb-0">
                                                        <img class="card-img-top lazy-load"
                                                            data-src="{{ asset('storage/' . $advertisement->ads) }}">
                                                    </div>
                                                    <!-- End Product -->
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- End Feature -->
                                    </div>
                                </div>
                            @endif
                            <!-- End Ads -->
                        @endif
                    @endforeach
                </div>
            </div>

        </div>

        <div class="bg-gray">
            <div class="container">
                @foreach ($product_features as $product_feature)
                    @if (count($product_feature->Product) > 0)
                        <div class="recent-products-section appear-animate" data-animation-name="fadeIn"
                            data-animation-delay="100">
                            <div class="heading shop-list d-flex align-items-center flex-wrap bg-gray mb-0 pl-0 pr-0 pt-0">
                                <h4 class="section-title text-transform-none mb-0 mr-0">{{ $product_feature->name }}</h4>
                                <a class="view-all ml-auto" href="{{ route('catalog.show') }}?filters[feature_names]={{ urlencode($product_feature->name) }}">View
                                    All<i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                            <div class="products-slider owl-carousel owl-theme carousel-with-bg nav-circle pb-0"
                                data-owl-options="{
                            'margin': 1,
                            'navText': [ '<i class=icon-left-open-big>', '<i class=icon-right-open-big>' ],
                            'dots': false,
                            'nav': true,
                            'loop': false,
                            'responsive': {
                                '0': {
                                    'items': 2,
                                    'margin': 5
                                },
                                '576': {
                                    'items': 3,
                                    'margin': 10
                                },
                                '768': {
                                    'items': 4,
                                    'margin': 10
                                },
                                '992': {
                                    'items': 5,
                                    'margin': 10
                                },
                                '1200': {
                                    'items': 6,
                                    'margin': 10
                                }
                            }
                        }">
                                @foreach ($product_feature->Product as $product)
                                    <div class="product-default inner-quickview inner-icon" style="overflow:hidden;">
                                        <figure>
                                            <a
                                                href="{{ route('products.details', ['name' => rawurlencode($product->name), 'seller_sku' => $product->seller_sku]) }}">
                                                <img class="lazy-load"
                                                    @if ($product->ProductMainImage) data-src="{{ asset('storage/product_photo/' . $product->ProductMainImage->image) }}" @endif
                                                    style="width: 239px; height: 239px; filter: brightness(0.9)
                                contrast(1.2) saturate(1.1);"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <!-- Check if your_price is not null -->
                                            @if ($product->sale_price)
                                                <?php
                                                $offerPercentage = round((($product->sale_price - $product->your_price) / $product->sale_price) * 100, 0); // Calculate the offer percentage
                                                ?>
                                                <div class="label-group">
                                                    <div class="product-label label-sale">-{{ $offerPercentage }}%</div>
                                                </div>
                                            @endif
                                            <div class="btn-icon-group">
                                                @if (($product->stock_qty > 0) && count($product->productVariations) == 0)
                                                    <a href="javascript:void(0);" title="Add To Cart"
                                                        data-product_id="{{ $product->id }}"
                                                        @if ($product->ProductMainImage) data-image="{{ $product->ProductMainImage->image }}" @endif
                                                        class="btn-icon add_cart_item product-type-simple"><i
                                                            class="icon-shopping-cart"></i></a>
                                                @endif
                                            </div>
                                        </figure>
                                        <div class="product-details">
                                            <h3 class="product-title">
                                                <a href="{{ route('products.details', ['name' => rawurlencode($product->name), 'seller_sku' => $product->seller_sku]) }}"
                                                    class="product-name" id="product-name">{{ $product->name }}</a>
                                            </h3>
                                            <div class="category-wrap">
                                                <span class="five-star-rating ml-0 mb-1">
                                                    @if ($product->reviews()->avg('rating') >= 1)
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif

                                                    @if ($product->reviews()->avg('rating') >= 2)
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif

                                                    @if ($product->reviews()->avg('rating') >= 3)
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif

                                                    @if ($product->reviews()->avg('rating') >= 4)
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif

                                                    @if ($product->reviews()->avg('rating') >= 5)
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                    <span class="rating-number">-</span>
                                                    <span class="rating-number"
                                                        style="font-size: 11px;">{{ $product->reviews()->sum('rating') }}</span>
                                                </span>

                                                {{-- Add to wishlist --}}
                                                <a href="javascript:void(0);" class="btn-icon-wish"
                                                    data-product_id="{{ $product->id }}" title="Add To Wishlist"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <!-- End .product-container -->
                                            <div class="price-box">
                                                @if (
                                                    $product->sale_price &&
                                                        $product->sale_start_date &&
                                                        $product->sale_end_date &&
                                                        $product->sale_start_date <= now() &&
                                                        $product->sale_end_date >= now())
                                                    <del class="old-price">{{ $currency?->icon }}
                                                        {{ number_format($product->your_price, 2) }}</del>
                                                    <span class="product-price brand_text_design">{{ $currency?->icon }}
                                                        {{ number_format($product->sale_price, 2) }}</span>
                                                @else
                                                    <span class="product-price brand_text_design">{{ $currency?->icon }}
                                                        {{ number_format($product->your_price, 2) }}</span>
                                                @endif
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                        @if ($product->stock_qty <= 0)
                                            <a class="sold_out" style="color: #fff;">Sold out</a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <!-- End .products-slider -->
                        </div>

                        <!-- Start Card Feature -->
                        @if ($product_feature->FeatureSetting)
                            <div class="row" style="margin-top: 18px;">
                                <!-- Start Product Part -->
                                @foreach ($product_feature->FeatureSetting as $feature_setting)
                                    @if ($feature_setting->ProductFeature->card_feature == 1 && count($feature_setting->FeatureSettingDetail) >= 2)
                                        <div class="col-md-3 card">
                                            <div class="card-body">
                                                <div class="a-cardui-header">
                                                    <h2 class="a-color-base headline truncate-2line">
                                                        @if ($feature_setting->ProductFeature)
                                                            {{ $feature_setting->ProductFeature->name }}
                                                        @endif
                                                    </h2>
                                                </div>
                                                <div class="row">
                                                    @if ($feature_setting->FeatureSettingDetail)
                                                        @foreach ($feature_setting->FeatureSettingDetail as $feature_setting_detail)
                                                            <div class="col-6 p-0">
                                                                <a
                                                                    href="{{ route('catalog', ['id' => $feature_setting_detail->category_id]) }}">
                                                                    <div class="card mb-0">
                                                                        <img class="card-img-top lazy-load"
                                                                            data-src="{{ asset('storage/' . $feature_setting_detail->Category->image) }}"
                                                                            style="height: 150px;">
                                                                        <div class="text-center text-dark">
                                                                            <span>{{ $feature_setting_detail->Category->name }}</span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <!-- End Product -->
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <!-- End Feature -->
                                            </div>
                                        </div>
                                    @endif
                                    <!-- Start Ads -->
                                    @if ($feature_setting->ProductFeature->Advertisement)
                                        <div class="col-md-3 card">
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach ($feature_setting->ProductFeature->Advertisement as $advertisement)
                                                        <div class="col-12 p-0">
                                                            <div class="card mb-0">
                                                                <img class="card-img-top lazy-load"
                                                                    data-src="{{ asset('storage/' . $advertisement->ads) }}">
                                                            </div>
                                                            <!-- End Product -->
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!-- End Feature -->
                                            </div>
                                        </div>
                                    @endif
                                    <!-- End Ads -->
                                @endforeach
                            </div>
                        @endif
                        <!-- End Card Feature -->
                    @endif
                @endforeach
            </div>
        </div>
    </main>
    <!-- End .main -->
    <!-- footer-area -->
    @include('ecommerce.footer')
    <!-- footer-area-end -->

@endsection
@push('scripts')
    <script src="{{ asset('js/panel/users/cart/cart.js') }}"></script>
    <script src="{{ asset('js/panel/users/common.js') }}"></script>
    <script>
        window.onload = function() {
            // Code to be executed after rendering the full layout
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
        };
    </script>
@endpush
