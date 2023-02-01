@extends('layouts.ecommerce')
@section('content')
<main class="main">
    <div class="bg-gray pb-5">
        <div class="container pb-3">
            <div class="slide-animate owl-carousel owl-theme nav-circle mb-2" data-owl-options="{
				'loop': true,
                'autoplay':true,
                'autoplayTimeout':5000
			}">
                @foreach($sliders as $slider)
                <div class="home-slide home-slide1 banner">
                    <img class="slider_image slide-bg" src="{{ asset('storage/'.$slider->image) }}" alt="slider image">
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
                <div class="categories-slider owl-carousel owl-theme show-nav-hover nav-outer" data-owl-options="{
                            'responsive': {
                                '0': {
                                    'items': 2
                                },
                                '480': {
                                    'items': 3
                                },
                                '576': {
                                    'items': 4
                                },
                                '768': {
                                    'items': 5
                                },
                                '992': {
                                    'items': 7
                                },
                                '1200': {
                                    'items': 8
                                }
                            }
                        }">
                    @foreach($top_show_categories as $top_show_category)
                    <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                        <a href="demo36-shop.html">
                            <figure>
                                <img src="{{ asset('storage/'.$top_show_category->image) }}" alt="category" width="280"
                                    height="240" style="height: 128px; height: 116px;" />
                            </figure>
                            <div class="category-content">
                                <h3>Fashion</h3>
                                <span><mark class="count">7</mark> products</span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    </div>

    <div class="bg-gray">
        <div class="container">

            <div class="recent-products-section appear-animate" data-animation-name="fadeIn" data-animation-delay="100">
                <div class="heading shop-list d-flex align-items-center flex-wrap bg-gray mb-0 pl-0 pr-0">
                    <h4 class="section-title text-transform-none mb-0 mr-0">Recently Viewed Products</h4>
                    <a class="view-all ml-auto" href="demo36-shop.html">View
                        All<i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
                <div class="products-slider owl-carousel owl-theme carousel-with-bg nav-circle pb-0" data-owl-options="{
                            'margin': 1,
                            'navText': [ '<i class=icon-left-open-big>', '<i class=icon-right-open-big>' ],
                            'dots': false,
                            'nav': true,
                            'loop': false,
                            'responsive': {
                                '0': {
                                    'items': 2
                                },
                                '576': {
                                    'items': 3
                                },
                                '768': {
                                    'items': 4
                                },
                                '992': {
                                    'items': 5
                                },
                                '1200': {
                                    'items': 6
                                }
                            }
                        }">

                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo36-product.html">
                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-1.jpg') }}"
                                    width="239" height="239" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="#" title="Add To Cart" class="btn-icon btn-add-cart product-type-simple"><i
                                        class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo36-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Add to Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo36-product.html">Drone Pro</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="old-price">$29.00</span>
                                <span class="product-price">$19.00</span>
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>

                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo36-product.html">
                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-8.jpg') }}"
                                    width="239" height="239" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="#" title="Add To Cart" class="btn-icon btn-add-cart product-type-simple"><i
                                        class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo36-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Add to Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo36-product.html">PT Bag</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="old-price">$29.00</span>
                                <span class="product-price">$19.00</span>
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>

                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo36-product.html">
                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-7.jpg') }}"
                                    width="239" height="239" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="#" title="Add To Cart" class="btn-icon btn-add-cart product-type-simple"><i
                                        class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo36-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Add to Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo36-product.html">Soft Hat</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="old-price">$29.00</span>
                                <span class="product-price">$19.00</span>
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>

                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo36-product.html">
                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-17.jpg') }}"
                                    width="239" height="239" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="#" title="Add To Cart" class="btn-icon btn-add-cart product-type-simple"><i
                                        class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo36-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Add to Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo36-product.html">White ring</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="old-price">$29.00</span>
                                <span class="product-price">$19.00</span>
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>

                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo36-product.html">
                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-10.jpg') }}"
                                    width="239" height="239" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="#" title="Add To Cart" class="btn-icon btn-add-cart product-type-simple"><i
                                        class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo36-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Add to Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo36-product.html">Black Bag</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="old-price">$29.00</span>
                                <span class="product-price">$19.00</span>
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>

                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo36-product.html">
                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-15.jpg') }}"
                                    width="239" height="239" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="#" title="Add To Cart" class="btn-icon btn-add-cart product-type-simple"><i
                                        class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo36-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Add to Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo36-product.html">Tea bowl</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="old-price">$29.00</span>
                                <span class="product-price">$19.00</span>
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>

                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo36-product.html">
                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                    width="239" height="239" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="#" title="Add To Cart" class="btn-icon btn-add-cart product-type-simple"><i
                                        class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo36-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Add to Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo36-product.html">Beats Solo HD Drenched</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="old-price">$29.00</span>
                                <span class="product-price">$19.00</span>
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
                </div>
                <!-- End .products-slider -->
            </div>
            <!-- Start Add -->
            <div class="sale-banner banner bg-image mb-4 appear-animate" data-animation-name="fadeIn"
                data-animation-delay="100"
                style="background-image: url(aladdinne/assets/images/demoes/demo36/banners/banner6.jpg);">
                <div class="container banner-content">
                    <div class="row no-gutter justify-content-start">
                        <div
                            class="col-auto col-lg-5 col-md-6 col-12 d-flex flex-column justify-content-center content-left text-center text-md-right">
                            <h4 class="align-left text-white text-uppercase">THE PERFECT GIFT FOR YOUR GIRLFRIEND
                            </h4>
                            <h3 class="text-white mb-0 align-left text-uppercase">GIFT SELECTION ON SALE</h3>
                        </div>
                        <div
                            class="col-auto col-md-2 col-12 col-2 justify-content-center content-center mr-md-3 mr-lg-0  ml-md-4 ml-lg-0">
                            <h2 class="text-white mb-0 position-relative align-left">
                                50<small>%<ins>OFF</ins></small>
                            </h2>
                        </div>
                        <div
                            class="mb-0 col-md-4 col-12 col-3 col-auto justify-content-center justify-content-md-start content-right">
                            <a href="demo8-shop.html" class="btn btn-lg bg-white text-dark font2">Shop Now!</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Add -->
        </div>
    </div>
</main>
<!-- End .main -->
    @include('ecommerce.sidebar-js')
@endsection