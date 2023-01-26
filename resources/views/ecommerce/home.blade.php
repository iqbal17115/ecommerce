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
                    <img class="slider_image slide-bg" src="{{ asset('storage/'.$slider->image) }}"
                        alt="slider image">
                    <div
                        class="container d-flex align-items-sm-center justify-content-sm-between justify-content-center flex-column flex-sm-row">
                        <div class="banner-content content-left text-sm-right mb-sm-0 mb-2">
                          
                        </div>
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
                                <img src="{{ asset('storage/'.$top_show_category->image) }}"
                                    alt="category" width="280" height="240" style="height: 128px; height: 116px;"/>
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

            <div class="promo-section bg-white appear-animate" data-animation-name="fadeIn" data-animation-delay="100">
                <div class="promo-banner banner container text-uppercase bg-transparent">
                    <div class=" banner-content d-flex align-items-center justify-content-center flex-column
                            flex-md-row text-center">
                        <h1 class="text-white text-animate text-shadow font1">DOWNLOAD OUR APP DOWNLOAD OUR APP DOWNLOAD
                            OUR APP DOWNLOAD OUR APP DOWNLOAD OUR APP DOWNLOAD OUR APP DOWNLOAD OUR APP DOWNLOAD OUR APP
                        </h1>
                        <h6 class="font1 mb-md-0 mb-1 pt-2 pt-md-0 pb-1">EXCLUSIVE SALES, GET IT NOW!</h6>
                        <h4 class="d-inline-block mb-0 pl-3 pr-3 pt-1 pb-1 mb-md-0 mb-1">DOWNLOAD OUR APP</h4>
                        <a href="demo36-shop.html" class="btn btn-dark">Get NOW!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="info-boxes-slider owl-carousel owl-theme appear-animate" data-animation-name="fadeInUpShorter"
            data-animation-delay="200" data-owl-options="{
					'dots': false,
					'loop': false,
					'responsive': {
						'576': {
							'items': 2
						},
						'992': {
							'items': 3
                        },
                        '1400': {
							'items': 4
						}
					}
				}">
            <div class="info-box info-box-icon-left">
                <i class="icon-shipping text-primary"></i>

                <div class="info-box-content">
                    <h4>FREE SHIPPING &amp; RETURN</h4>
                    <p class="text-body">Free shipping on all orders over $99.</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->

            <div class="info-box info-box-icon-left">
                <i class="icon-money text-primary"></i>

                <div class="info-box-content">
                    <h4>MONEY BACK GUARANTEE</h4>
                    <p class="text-body">100% money back guarantee</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->

            <div class="info-box info-box-icon-left">
                <i class="icon-support text-primary"></i>

                <div class="info-box-content">
                    <h4>ONLINE SUPPORT 24/7</h4>
                    <p class="text-body">Lorem ipsum dolor sit amet.</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->

            <div class="info-box info-box-icon-left">
                <i class="icon-password-lock text-primary"></i>

                <div class="info-box-content">
                    <h4>SECURE PAYMENT</h4>
                    <p class="text-body">Lorem ipsum dolor sit amet.</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->
        </div>
        <!-- End .info-boxes-slider -->

        <div class="banner-section appear-animate" data-animation-name="fadeInUpShorter" data-animation-delay="200">
            <div class="row">
                <div class="col-md-4 mb-2 mb-md-0">
                    <div class="container d-flex align-items-center justify-content-end">
                        <div class="banner-layer text-right">
                            <h5 class="coupon-sale-text text-white font1">
                                <b class="text-white font1 ml-auto"><i>UP TO</i>50%</b><span
                                    class="mr-0 ls-0">OFF</span>
                            </h5>
                            <h6 class="font1 ls-10">FLASH SALES ON</h6>
                            <h4 class="text-white mb-0">NICE SHOES</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="banner banner2 d-flex align-items-center justify-content-end"
                    style="background-image: url(aladdinne/assets/images/demoes/demo36/banners/banner2.jpg);">
                    <div class="container d-flex align-items-center justify-content-end">
                        <div class="banner-layer text-right pt-0">
                            <h4 class="text-dark mb-0 pl-3 pr-3 pt-1 pb-1">TOP ELECTRONIC<br />FOR GIFTS
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="deal-products-section">
        <h2 class="section-title d-flex align-items-center text-transform-none"><i
                class="icon-percent-shape"></i>Special Offers
        </h2>
        <div class="row appear-animate" data-animation-name="fadeInUpShorter" data-animation-delay="200">
            <div class="col-md-4 mb-2 mb-md-0">
                <div class="product-default deal-product">
                    <figure>
                        <a href="demo36-product.html">
                            <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-1.jpg') }}"
                                width="450" height="450" alt="product">
                        </a>
                        <div class="product-countdown-container custom-product-countdown">
                            <span class="product-countdown-title">offer ends in:</span>
                            <div class="product-countdown countdown-compact" data-until="2021, 10, 5"
                                data-compact="true">
                            </div>
                            <!-- End .product-countdown -->
                        </div>
                        <!-- End .product-countdown-container -->
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="demo36-shop.html" class="product-category">Category</a>
                        </div>
                        <h3 class="product-title">
                            <a href="demo36-product.html">Drone Pro</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->
                        <div class="price-box">
                            <del class="old-price">$59.00</del>
                            <span class="product-price">$49.00</span>
                        </div>
                        <!-- End .price-box -->
                        <div class="product-action">
                            <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i
                                    class="icon-heart"></i></a>
                            <a href="#" class="btn btn-primary btn-icon btn-add-cart product-type-simple"><i
                                    class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                    class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                    <!-- End .product-details -->
                </div>
            </div>
            <div class="col-md-8">
                <div class="products-with-divide">
                    <div class="row row-joined">
                        <div class="col-xl-3 col-sm-4 col-6">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="demo36-product.html">
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="label-group">
                                        <div class="product-label label-hot">HOT</div>
                                        <div class="product-label label-sale">-20%</div>
                                    </div>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="demo36-product.html">PT Speaker</a>
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
                        <div class="col-xl-3 col-sm-4 col-6">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="demo36-product.html">
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="product.html">Beats Solo HD Drenched</a>
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
                        <div class="col-xl-3 col-sm-4 col-6">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="demo36-product.html">
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-4.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="product.html">Palm Print Jacket</a>
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
                        <div class="col-xl-3 col-sm-4 col-6">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="demo36-product.html">
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-5.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="product.html">Camera</a>
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
                        <div class="col-xl-3 col-sm-4 col-6">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="demo36-product.html">
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-6.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="product.html">Red Football</a>
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
                        <div class="col-xl-3 col-sm-4 col-6">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="demo36-product.html">
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-7.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="product.html">Soft Hat</a>
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
                        <div class="col-xl-3 col-sm-4 col-6">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="demo36-product.html">
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-8.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="product.html">PT Bag</a>
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
                        <div class="col-xl-3 col-sm-4 col-6">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="demo36-product.html">
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-9.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="product.html">GM Camaro SS Original</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="category-filter-section bg-gray appear-animate" data-animation-name="fadeInUpShorter"
        data-animation-delay="200">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 pr-lg-3 pr-sm-0 col-sm-6 order-1 order-sm-0">
                    <div class="shop-list h-100">
                        <h4>Sort By</h4>

                        <ul class="nav nav-tabs flex-sm-column border-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="filter-1-tab" data-toggle="tab" href="#filter-1"
                                    role="tab" aria-controls="filter-1" aria-selected="true">Kids Fashion</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="filter-2-tab" data-toggle="tab" href="#filter-2" role="tab"
                                    aria-controls="filter-2" aria-selected="true">Casual
                                    Shoes</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="filter-3-tab" data-toggle="tab" href="#filter-3" role="tab"
                                    aria-controls="filter-3" aria-selected="false">Spring &
                                    Autumn</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="filter-4-tab" data-toggle="tab" href="#filter-4" role="tab"
                                    aria-controls="filter-4" aria-selected="false">Man</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="filter-5-tab" data-toggle="tab" href="#filter-5" role="tab"
                                    aria-controls="filter-5" aria-selected="false">Accessories</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="filter-6-tab" data-toggle="tab" href="#filter-6" role="tab"
                                    aria-controls="filter-6" aria-selected="false">Pants &
                                    Denim</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="filter-7-tab" data-toggle="tab" href="#filter-7" role="tab"
                                    aria-controls="filter-7" aria-selected="false">Tees, Knits &
                                    Polos</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="filter-8-tab" data-toggle="tab" href="#filter-8" role="tab"
                                    aria-controls="filter-8" aria-selected="false">Watch Fashion</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="filter-9-tab" data-toggle="tab" href="#filter-9" role="tab"
                                    aria-controls="filter-9" aria-selected="false">Woman</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="filter-10-tab" data-toggle="tab" href="#filter-10" role="tab"
                                    aria-controls="filter-10" aria-selected="false">Accessories</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="filter-11-tab" data-toggle="tab" href="#filter-11" role="tab"
                                    aria-controls="filter-11" aria-selected="false">Dresses &
                                    Skirts</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="filter-12-tab" data-toggle="tab" href="#filter-12" role="tab"
                                    aria-controls="filter-12" aria-selected="false">Shoes &
                                    Boots</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="filter-13-tab" data-toggle="tab" href="#filter-13" role="tab"
                                    aria-controls="filter-13" aria-selected="false">Top &
                                    Blouses</a>
                            </li>
                        </ul>

                        <a class="view-all" href="demo36-shop.html">View
                            All<i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 pl-lg-3 pl-sm-0 order-0">
                    <div class="banner banner3"
                        style="background-image: url(aladdinne/assets/images/demoes/demo36/banners/banner3.jpg);">
                        <div class="container d-flex justify-content-center">
                            <div class="banner-layer text-center">
                                <h4 class="font1"><i class="font2">Find the Boundaries. Push Through!</i>
                                </h4>

                                <h3 class="text-dark mb-0">MEGA SALE</h3>
                                <h2 class="text-dark">70% OFF</h2>
                                <h5 class="coupon-sale-text justify-content-end">
                                    <span class="text-dark">STARTING AT</span>
                                    <b class="text-white align-middle"><sup>$</sup><em
                                            class="align-text-top">199</em><sup>99</sup></b>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 tab-content mt-2 mt-lg-0 order-2 order-sm-0">
                    <div class="tab-pane fade show active h-100" id="filter-1" role="tabpanel"
                        aria-labelledby="filter-1-tab">
                        <div class="product-content products-with-divide">
                            <div class="row row-joined h-100">
                                <div class="col-sm-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-10.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
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
                                </div>

                                <div class="col-sm-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-11.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Brown Belt</a>
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

                                <div class="col-sm-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-4.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Palm Print Jacket</a>
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

                                <div class="col-sm-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-8.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">PT Bag</a>
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

                                <div class="col-sm-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-6.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Red Football</a>
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

                                <div class="col-sm-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-7.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Soft Hat</a>
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="filter-2" role="tabpanel">
                        <div class="product-content products-with-divide">
                            <div class="row row-joined">
                                <div class=" col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="label-group">
                                                <div class="product-label label-hot">HOT</div>
                                                <div class="product-label label-sale">-20%</div>
                                            </div>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="demo36-product.html">PT Speaker</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Beats Solo HD Drenched</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-4.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Palm Print Jacket</a>
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="filter-3" role="tabpanel">
                        <div class="product-content products-with-divide">
                            <div class="row row-joined">
                                <div class=" col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="label-group">
                                                <div class="product-label label-hot">HOT</div>
                                                <div class="product-label label-sale">-20%</div>
                                            </div>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="demo36-product.html">PT Speaker</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Beats Solo HD Drenched</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-4.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Palm Print Jacket</a>
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="filter-4" role="tabpanel">
                        <div class="product-content products-with-divide">
                            <div class="row row-joined">
                                <div class=" col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="label-group">
                                                <div class="product-label label-hot">HOT</div>
                                                <div class="product-label label-sale">-20%</div>
                                            </div>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="demo36-product.html">PT Speaker</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Beats Solo HD Drenched</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-4.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Palm Print Jacket</a>
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="filter-5" role="tabpanel">
                        <div class="product-content products-with-divide">
                            <div class="row row-joined">
                                <div class=" col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="label-group">
                                                <div class="product-label label-hot">HOT</div>
                                                <div class="product-label label-sale">-20%</div>
                                            </div>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="demo36-product.html">PT Speaker</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Beats Solo HD Drenched</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-4.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Palm Print Jacket</a>
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="filter-6" role="tabpanel">
                        <div class="product-content products-with-divide">
                            <div class="row row-joined">
                                <div class=" col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="label-group">
                                                <div class="product-label label-hot">HOT</div>
                                                <div class="product-label label-sale">-20%</div>
                                            </div>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="demo36-product.html">PT Speaker</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Beats Solo HD Drenched</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-4.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Palm Print Jacket</a>
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="filter-7" role="tabpanel">
                        <div class="product-content products-with-divide">
                            <div class="row row-joined">
                                <div class=" col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="label-group">
                                                <div class="product-label label-hot">HOT</div>
                                                <div class="product-label label-sale">-20%</div>
                                            </div>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="demo36-product.html">PT Speaker</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Beats Solo HD Drenched</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-4.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Palm Print Jacket</a>
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="filter-8" role="tabpanel">
                        <div class="product-content products-with-divide">
                            <div class="row row-joined">
                                <div class=" col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="label-group">
                                                <div class="product-label label-hot">HOT</div>
                                                <div class="product-label label-sale">-20%</div>
                                            </div>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="demo36-product.html">PT Speaker</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Beats Solo HD Drenched</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-4.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Palm Print Jacket</a>
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="filter-9" role="tabpanel">
                        <div class="product-content products-with-divide">
                            <div class="row row-joined">
                                <div class=" col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="label-group">
                                                <div class="product-label label-hot">HOT</div>
                                                <div class="product-label label-sale">-20%</div>
                                            </div>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="demo36-product.html">PT Speaker</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Beats Solo HD Drenched</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-4.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Palm Print Jacket</a>
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="filter-10" role="tabpanel">
                        <div class="product-content products-with-divide">
                            <div class="row row-joined">
                                <div class=" col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="label-group">
                                                <div class="product-label label-hot">HOT</div>
                                                <div class="product-label label-sale">-20%</div>
                                            </div>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="demo36-product.html">PT Speaker</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Beats Solo HD Drenched</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-4.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Palm Print Jacket</a>
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="filter-11" role="tabpanel">
                        <div class="product-content products-with-divide">
                            <div class="row row-joined">
                                <div class=" col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="label-group">
                                                <div class="product-label label-hot">HOT</div>
                                                <div class="product-label label-sale">-20%</div>
                                            </div>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="demo36-product.html">PT Speaker</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Beats Solo HD Drenched</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-4.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Palm Print Jacket</a>
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="filter-12" role="tabpanel">
                        <div class="product-content products-with-divide">
                            <div class="row row-joined">
                                <div class=" col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="label-group">
                                                <div class="product-label label-hot">HOT</div>
                                                <div class="product-label label-sale">-20%</div>
                                            </div>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="demo36-product.html">PT Speaker</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Beats Solo HD Drenched</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-4.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Palm Print Jacket</a>
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="filter-13" role="tabpanel">
                        <div class="product-content products-with-divide">
                            <div class="row row-joined">
                                <div class=" col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="label-group">
                                                <div class="product-label label-hot">HOT</div>
                                                <div class="product-label label-sale">-20%</div>
                                            </div>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="demo36-product.html">PT Speaker</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Beats Solo HD Drenched</a>
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
                                <div class="col-md-4 col-6">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-4.jpg') }}"
                                                    width="239" height="239" alt="product">
                                            </a>
                                            <div class="btn-icon-group">
                                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                        class="icon-shopping-cart"></i></a>
                                            </div>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">Quick
                                                View</a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="demo36-shop.html" class="product-category">category</a>
                                                </div>
                                                <a href="wishlist.html" class="btn-icon-wish"><i
                                                        class="icon-heart"></i></a>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="product.html">Palm Print Jacket</a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray">
        <div class="container">
            <div class="categories-container bg-white appear-animate" data-animation-name="fadeIn"
                data-animation-delay="100">
                <h4 class="section-title text-transform-none">Electronics</h4>
                <div class="row">
                    <div class="col-md-6 mb-2 mb-md-0">
                        <div class="banner banner4 bg-image"
                            style="background-image: url(aladdinne/assets/images/demoes/demo36/banners/banner4.jpg);">
                            <div
                                class="banner-layer d-flex align-items-center flex-column flex-sm-row justify-content-end">
                                <div class="content-left">
                                    <div class="coupon-sale-content">
                                        <h4
                                            class="custom-coupon-sale-text text-white bg-dark d-block ext-transform-none mr-0 ls-0">
                                            Exclusive COUPON
                                        </h4>
                                        <h5 class="custom-coupon-sale-text text-dark  ls-0 p-0"><i class="ls-0">UP
                                                TO</i><b class="text-white bg-dark">$100</b><sub>OFF</sub></h5>
                                    </div>
                                </div>
                                <div class="content-right">
                                    <h3 class="text-dark mb-0 text-sm-right text-left">DRONE & CAMERAS
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="banner banner5 bg-image"
                            style="background-image: url(aladdinne/assets/images/demoes/demo36/banners/banner5.jpg);">
                            <div
                                class="banner-layer d-flex align-items-center flex-column flex-sm-row justify-content-end">
                                <div class="content-left">
                                    <h3 class="text-white text-center mb-0">ELECTRONIC DEALS
                                    </h3>
                                </div>

                                <div class="content-right">
                                    <div class="coupon-sale-content pt-1">
                                        <h4
                                            class="custom-coupon-sale-text text-dark bg-white d-block ext-transform-none mr-0 ls-0">
                                            Exclusive COUPON
                                        </h4>
                                        <h5 class="custom-coupon-sale-text text-white mb-0 ls-0 p-0"><i class="ls-0">UP
                                                TO</i><b class="text-white bg-secondary">$100</b><sub>OFF</sub>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-sm-6">
                        <div class="shop-list p-0">
                            <a href="demo36-shop.html" class="sub-title">Accessories</a>
                            <ul class="d-flex flex-wrap">
                                <li><a href="demo36-shop.html">Bags & Cases</a></li>
                                <li><a href="demo36-shop.html">Batteries</a></li>
                                <li><a href="demo36-shop.html">Cables & Adapters</a></li>
                                <li><a href="demo36-shop.html">Chargers</a></li>
                                <li><a href="demo36-shop.html">Electronic Cigarettes</a></li>
                                <li><a href="demo36-shop.html">Home Electronic</a></li>
                            </ul>
                            <a class="view-all" href="demo36-shop.html">View
                                All<i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="shop-list p-0">
                            <a href="demo36-shop.html" class="sub-title">Audio & Video</a>
                            <ul class="d-flex flex-wrap">
                                <li><a href="demo36-shop.html">Audio Amplifier</a></li>
                                <li><a href="demo36-shop.html">HDMI Projectors</a></li>
                                <li><a href="demo36-shop.html">Projectors</a></li>
                                <li><a href="demo36-shop.html">Televisions</a></li>
                                <li><a href="demo36-shop.html">TV Receivers</a></li>
                                <li><a href="demo36-shop.html">TV Sticks</a></li>
                            </ul>
                            <a class="view-all" href="demo36-shop.html">View
                                All<i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="shop-list p-0">
                            <a href="demo36-shop.html" class="sub-title">Camera & Photo</a>
                            <ul class="d-flex flex-wrap">
                                <li><a href="demo36-shop.html">Action Cameras</a></li>
                                <li><a href="demo36-shop.html">Camcorders</a></li>
                                <li><a href="demo36-shop.html">Camera & Photo</a></li>
                                <li><a href="demo36-shop.html">Camera Drones</a></li>
                                <li><a href="demo36-shop.html">Digital Cameras</a></li>
                                <li><a href="demo36-shop.html">Photo Supplies</a></li>
                            </ul>
                            <a class="view-all" href="demo36-shop.html">View
                                All<i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="shop-list p-0">
                            <a href="demo36-shop.html" class="sub-title">Laptops</a>
                            <ul class="d-flex flex-wrap">
                                <li><a href="demo36-shop.html">Gaming Laptops</a></li>
                                <li><a href="demo36-shop.html">Laptop Accessories</a></li>
                                <li><a href="demo36-shop.html">Laptop Bags & Cases</a></li>
                                <li><a href="demo36-shop.html">Tablet Accessories</a></li>
                                <li><a href="demo36-shop.html">Tablets</a></li>
                                <li><a href="demo36-shop.html">Ultraslim Laptops</a></li>
                            </ul>
                            <a class="view-all" href="demo36-shop.html">View
                                All<i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="products-slider owl-carousel owl-theme nav-outer carousel-with-bg show-nav-hover nav-image-center appear-animate"
                data-animation-name="fadeIn" data-animation-delay="100" data-owl-options="{
                            'margin': 1,
                            'dots': false,
                            'navText': [ '<i class=icon-left-open-big>', '<i class=icon-right-open-big>' ],
                            'nav': true,
                            'responsive': {
                                '1200': {
                                    'items': 6
                                }
                            }
                        }">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="demo36-product.html">
                            <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                width="239" height="239" alt="product">
                        </a>
                        <div class="btn-icon-group">
                            <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
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
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                        </div>
                        <h3 class="product-title">
                            <a href="demo36-product.html">Beats solo HD Drenched</a>
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
                            <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-5.jpg') }}"
                                width="239" height="239" alt="product">
                        </a>
                        <div class="btn-icon-group">
                            <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
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
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                        </div>
                        <h3 class="product-title">
                            <a href="demo36-product.html">Camera</a>
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
                            <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-1.jpg') }}"
                                width="239" height="239" alt="product">
                        </a>
                        <div class="btn-icon-group">
                            <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                    class="icon-shopping-cart"></i></a>
                        </div>
                        <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                            View</a>
                        <div class="product-countdown-container">
                            <span class="product-countdown-title">offer ends in:</span>
                            <div class="product-countdown countdown-compact" data-until="2021, 10, 5"
                                data-compact="true">
                            </div>
                            <!-- End .product-countdown -->
                        </div>
                        <!-- End .product-countdown-container -->
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
                                <a href="demo36-shop.html" class="product-category">category</a>
                            </div>
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
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
                            <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-9.jpg') }}"
                                width="239" height="239" alt="product">
                        </a>
                        <div class="btn-icon-group">
                            <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
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
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                        </div>
                        <h3 class="product-title">
                            <a href="demo36-product.html">GM CAMARO SS Original</a>
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
                            <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                width="239" height="239" alt="product">
                        </a>
                        <div class="btn-icon-group">
                            <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
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
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                        </div>
                        <h3 class="product-title">
                            <a href="demo36-product.html">PT Speaker</a>
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
                            <img src="{{ asset('aladdinne//demo36/products/product-12.jpg') }}" width="239" height="239"
                                alt="product">
                        </a>
                        <div class="btn-icon-group">
                            <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
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
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                        </div>
                        <h3 class="product-title">
                            <a href="demo36-product.html">Sport Watches</a>
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

            <div class="categories-container categories-container-two bg-white appear-animate"
                data-animation-name="fadeIn" data-animation-delay="100">
                <h4 class="section-title text-transform-none">Gift & Gadgets</h4>
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="shop-list p-0 d-flex align-items-sm-center flex-sm-row flex-column">
                            <a href="#"><i class="icon-boy-broad-smile"></i></a>
                            <div>
                                <a href="#" class="sub-title">For Him</a>
                                <ul>
                                    <li><a href="demo36-shop.html">Gifts for Boyfriend</a></li>
                                    <li><a href="demo36-shop.html">Gifts for Dad</a>
                                    </li>
                                    <li><a href="demo36-shop.html">Gifts for Husband</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="shop-list p-0 d-flex align-items-sm-center flex-sm-row flex-column">
                            <a href="#"><i class="icon-smiling-girl"></i></a>

                            <div>
                                <a href="#" class="sub-title">For Her</a>
                                <ul>
                                    <li><a href="demo36-shop.html">Gifts for Girlfriend</a></li>
                                    <li><a href="demo36-shop.html">Gifts for Mom</a>
                                    </li>
                                    <li><a href="demo36-shop.html">Gifts for Wife</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="shop-list p-0 d-flex align-items-sm-center flex-sm-row flex-column">
                            <a href="#"><i class="icon-smiling-baby"></i></a>
                            <div>
                                <a href="#" class="sub-title">For Kids</a>
                                <ul>
                                    <li><a href="demo36-shop.html">Gifts for Boys</a></li>
                                    <li><a href="demo36-shop.html">Gifts for Girls</a>
                                    </li>
                                    <li><a href="demo36-shop.html">Gifts for Tween Boys</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="shop-list p-0 d-flex align-items-sm-center flex-sm-row flex-column">
                            <a href="#"><i class="icon-gift-2"></i></a>
                            <div>
                                <a href="#" class="sub-title">Birthday</a>
                                <ul>
                                    <li><a href="demo36-shop.html">Birthday for Her</a></li>
                                    <li><a href="demo36-shop.html">Birthday for Him</a>
                                    </li>
                                    <li><a href="demo36-shop.html">Boyfriend Gifts</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="products-slider product-slider-two owl-carousel carousel-with-bg owl-theme nav-outer show-nav-hover nav-image-center pb-0 appear-animate"
                data-animation-name="fadeIn" data-animation-delay="100" data-owl-options="{
                            'margin': 1,
                            'dots': false,
                            'nav': true,
                            'navText': [ '<i class=icon-left-open-big>', '<i class=icon-right-open-big>' ],
                            'responsive': {
                                '1200': {
                                    'items': 6
                                }
                            }
                        }">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="demo36-product.html">
                            <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-13.jpg') }}"
                                width="239" height="239" alt="product">
                        </a>
                        <div class="btn-icon-group">
                            <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
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
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                        </div>
                        <h3 class="product-title">
                            <a href="demo36-product.html">Belt accessories</a>
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
                            <img src="{{ asset('aladdinne//demo36/products/product-9.jpg') }}" width="239" height="239"
                                alt="product">
                        </a>
                        <div class="btn-icon-group">
                            <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
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
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                        </div>
                        <h3 class="product-title">
                            <a href="demo36-product.html">GM Camaro SS Original</a>
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
                            <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-14.jpg') }}"
                                width="239" height="239" alt="product">
                        </a>
                        <div class="btn-icon-group">
                            <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
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
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                        </div>
                        <h3 class="product-title">
                            <a href="demo36-product.html">PT Cup</a>
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
                            <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
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
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
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
                            <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-16.jpg') }}"
                                width="239" height="239" alt="product">
                        </a>
                        <div class="btn-icon-group">
                            <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
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
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                        </div>
                        <h3 class="product-title">
                            <a href="demo36-product.html">White brooch</a>
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
                            <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
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
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
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
            </div>

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

            <div class="bg-white appear-animate" data-animation-name="fadeIn" data-animation-delay="100">
                <div class="row">
                    <div class="col-xl-9 col-xl-9cols pr-xl-0">
                        <div class="categories-container categories-container-three bg-white pb-0">
                            <div class="heading d-flex flex-lg-row flex-column align-items-lg-center">
                                <h4 class="section-title text-transform-none mb-0">Home & Garden</h4>
                                <ul class="shop-list d-flex flex-wrap align-items-center p-0 mt-0">
                                    <li><a href="demo36-shop.html">Furniture</a></li>
                                    <li><a href="demo36-shop.html">Garden & Outdoors</a></li>
                                    <li><a href="demo36-shop.html">Home Accessories</a></li>
                                    <li><a href="demo36-shop.html">Lighting</a></li>
                                </ul>
                                <a class="view-all" href="demo36-shop.html">View
                                    All<i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                            <div class="banner banner6" data-md-order="8">
                                <figure>
                                    <img src="{{ asset('aladdinne/assets/images/demoes/demo36/banners/banner7.jpg') }}"
                                        alt="banner">
                                </figure>
                                <div class="banner-layer text-center content-left">
                                    <h4 class="heading-border">Amazing</h4>
                                    <h3 class="ls-0">Collection</h3>
                                    <hr class="mb-1 mt-0">
                                    <h5>Check our discounts</h5>
                                </div>

                                <div class="banner-layer text-center content-right">
                                    <h5 class="coupon-sale-text">
                                        <span>STARTING AT</span>
                                        <b class="text-dark align-middle"><sup>$</sup><em
                                                class="align-text-top">199</em><sup>99</sup></b>
                                    </h5>
                                    <h6>* limited time only</h6>
                                </div>

                            </div>
                            <!-- End .banner -->
                        </div>

                        <div class="product-slider-tab appear-animate bg-white carousel-with-bg"
                            data-animation-name="fadeIn" data-animation-delay="100">
                            <div
                                class="heading shop-list d-flex align-items-center flex-wrap justify-content-center justify-content-md-start">
                                <ul class=" nav ml-0 justify-content-center mb-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="seller-tab" data-toggle="tab" href="#seller"
                                            role="tab" aria-controls="seller" aria-selected="true">Best Sellers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="new-tab" data-toggle="tab" href="#new" role="tab"
                                            aria-controls="new" aria-selected="false">New
                                            Arrivals</a>
                                    </li>
                                    <li class="nav-item mr-0">
                                        <a class="nav-link" id="best-tab" data-toggle="tab" href="#best" role="tab"
                                            aria-controls="best" aria-selected="false">Best
                                            Ratings</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="seller" role="tabpanel"
                                    aria-labelledby="seller-tab">
                                    <div class="products-slider owl-carousel nav-circle owl-theme pb-0"
                                        data-owl-options="{
                                                'margin': 1,
                                                'dots': false,
                                                'nav': true,
                                                'navText': [ '<i class=icon-left-open-big>', '<i class=icon-right-open-big>' ],
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
                                                        'items': 4
                                                    }
                                                }
                                            }">
                                        <div class="product-default inner-quickview inner-icon">
                                            <figure>
                                                <a href="demo36-product.html">
                                                    <img src="{{ asset('aladdinne/demoes/demo36/products/product-18.jpg') }}"
                                                        width="239" height="239" alt="product">
                                                </a>
                                                <div class="btn-icon-group">
                                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                            class="icon-shopping-cart"></i></a>
                                                </div>
                                                <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                    title="Quick View">Quick
                                                    View</a>
                                            </figure>
                                            <div class="product-details">
                                                <div class="category-wrap">
                                                    <div class="category-list">
                                                        <a href="demo36-shop.html" class="product-category">category</a>
                                                    </div>
                                                    <a href="wishlist.html" class="btn-icon-wish"><i
                                                            class="icon-heart"></i></a>
                                                </div>
                                                <h3 class="product-title">
                                                    <a href="demo36-product.html">Brown Arm Chair</a>
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
                                                    <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-19.jpg') }}"
                                                        width="239" height="239" alt="product">
                                                </a>
                                                <div class="btn-icon-group">
                                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                            class="icon-shopping-cart"></i></a>
                                                </div>
                                                <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                    title="Quick View">Quick
                                                    View</a>
                                            </figure>
                                            <div class="product-details">
                                                <div class="category-wrap">
                                                    <div class="category-list">
                                                        <a href="demo36-shop.html" class="product-category">category</a>
                                                    </div>
                                                    <a href="wishlist.html" class="btn-icon-wish"><i
                                                            class="icon-heart"></i></a>
                                                </div>
                                                <h3 class="product-title">
                                                    <a href="demo36-product.html">Coffee Cup</a>
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
                                                    <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-20.jpg') }}"
                                                        width="239" height="239" alt="product">
                                                </a>
                                                <div class="btn-icon-group">
                                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                            class="icon-shopping-cart"></i></a>
                                                </div>
                                                <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                    title="Quick View">Quick
                                                    View</a>
                                            </figure>
                                            <div class="product-details">
                                                <div class="category-wrap">
                                                    <div class="category-list">
                                                        <a href="demo36-shop.html" class="product-category">category</a>
                                                    </div>
                                                    <a href="wishlist.html" class="btn-icon-wish"><i
                                                            class="icon-heart"></i></a>
                                                </div>
                                                <h3 class="product-title">
                                                    <a href="demo36-product.html">White Sofa</a>
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
                                                    <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-21.jpg') }}"
                                                        width="239" height="239" alt="product">
                                                </a>
                                                <div class="btn-icon-group">
                                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                            class="icon-shopping-cart"></i></a>
                                                </div>
                                                <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                    title="Quick View">Quick
                                                    View</a>
                                            </figure>
                                            <div class="product-details">
                                                <div class="category-wrap">
                                                    <div class="category-list">
                                                        <a href="demo36-shop.html" class="product-category">category</a>
                                                    </div>
                                                    <a href="wishlist.html" class="btn-icon-wish"><i
                                                            class="icon-heart"></i></a>
                                                </div>
                                                <h3 class="product-title">
                                                    <a href="demo36-product.html">Wooden Chair</a>
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
                                <div class="tab-pane fade" id="new" role="tabpanel" aria-labelledby="new-tab">
                                    <div class="products-slider owl-carousel nav-circle owl-theme pb-0"
                                        data-owl-options="{
                                                'margin': 1,
                                                'dots': false,
                                                'nav': true,
                                                'navText': [ '<i class=icon-left-open-big>', '<i class=icon-right-open-big>' ],
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
                                                        'items': 4
                                                    }
                                                }
                                            }">
                                        <div class="product-default inner-quickview inner-icon">
                                            <figure>
                                                <a href="demo36-product.html">
                                                    <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-19.jpg') }}"
                                                        width="239" height="239" alt="product">
                                                </a>
                                                <div class="btn-icon-group">
                                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                            class="icon-shopping-cart"></i></a>
                                                </div>
                                                <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                    title="Quick View">Quick
                                                    View</a>
                                            </figure>
                                            <div class="product-details">
                                                <div class="category-wrap">
                                                    <div class="category-list">
                                                        <a href="demo36-shop.html" class="product-category">category</a>
                                                    </div>
                                                    <a href="wishlist.html" class="btn-icon-wish"><i
                                                            class="icon-heart"></i></a>
                                                </div>
                                                <h3 class="product-title">
                                                    <a href="demo36-product.html">Coffee Cup</a>
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
                                                    <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-20.jpg') }}"
                                                        width="239" height="239" alt="product">
                                                </a>
                                                <div class="btn-icon-group">
                                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                            class="icon-shopping-cart"></i></a>
                                                </div>
                                                <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                    title="Quick View">Quick
                                                    View</a>
                                            </figure>
                                            <div class="product-details">
                                                <div class="category-wrap">
                                                    <div class="category-list">
                                                        <a href="demo36-shop.html" class="product-category">category</a>
                                                    </div>
                                                    <a href="wishlist.html" class="btn-icon-wish"><i
                                                            class="icon-heart"></i></a>
                                                </div>
                                                <h3 class="product-title">
                                                    <a href="demo36-product.html">White Sofa</a>
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
                                                    <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-21.jpg') }}"
                                                        width="239" height="239" alt="product">
                                                </a>
                                                <div class="btn-icon-group">
                                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                            class="icon-shopping-cart"></i></a>
                                                </div>
                                                <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                    title="Quick View">Quick
                                                    View</a>
                                            </figure>
                                            <div class="product-details">
                                                <div class="category-wrap">
                                                    <div class="category-list">
                                                        <a href="demo36-shop.html" class="product-category">category</a>
                                                    </div>
                                                    <a href="wishlist.html" class="btn-icon-wish"><i
                                                            class="icon-heart"></i></a>
                                                </div>
                                                <h3 class="product-title">
                                                    <a href="demo36-product.html">Wooden Chair</a>
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
                                <div class="tab-pane fade" id="best" role="tabpanel" aria-labelledby="best-tab">
                                    <div class="products-slider owl-carousel nav-circle owl-theme" data-owl-options="{
                                                'margin': 1,
                                                'dots': false,
                                                'nav': true,
                                                'navText': [ '<i class=icon-left-open-big>', '<i class=icon-right-open-big>' ],
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
                                                        'items': 4
                                                    }
                                                }
                                            }">
                                        <div class="product-default inner-quickview inner-icon">
                                            <figure>
                                                <a href="demo36-product.html">
                                                    <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-20.jpg') }}"
                                                        width="239" height="239" alt="product">
                                                </a>
                                                <div class="btn-icon-group">
                                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                            class="icon-shopping-cart"></i></a>
                                                </div>
                                                <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                    title="Quick View">Quick
                                                    View</a>
                                            </figure>
                                            <div class="product-details">
                                                <div class="category-wrap">
                                                    <div class="category-list">
                                                        <a href="demo36-shop.html" class="product-category">category</a>
                                                    </div>
                                                    <a href="wishlist.html" class="btn-icon-wish"><i
                                                            class="icon-heart"></i></a>
                                                </div>
                                                <h3 class="product-title">
                                                    <a href="demo36-product.html">White Sofa</a>
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
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-xl-3cols">
                        <div class="products-widget-container bg-white">
                            <h2 class="section-title d-flex align-items-center text-transform-none"><i
                                    class="icon-percent-shape"></i>Special Offers
                            </h2>

                            <div class="product-countdown-container custom-product-countdown bg-white">
                                <span class="product-countdown-title ls-10">offer ends in:</span>
                                <div class="product-countdown countdown-compact" data-until="2021, 10, 5"
                                    data-compact="true">
                                </div>
                                <!-- End .product-countdown -->
                            </div>
                            <!-- End .product-countdown-container -->

                            <div class="row">
                                <div class="col-xl-12 col-md-4 col-sm-6">
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/small/product-1.jpg') }}"
                                                    width="84" height="84" alt="product">
                                            </a>
                                        </figure>

                                        <div class="product-details">
                                            <h3 class="product-title"> <a href="demo36-product.html">PT
                                                    Speaker</a> </h3>

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
                                                <span class="product-price">$49.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-4 col-sm-6">
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/small/product-2.jpg') }}"
                                                    width="84" height="84" alt="product">
                                            </a>
                                        </figure>

                                        <div class="product-details">
                                            <h3 class="product-title"> <a href="demo36-product.html">Beats Solo
                                                    HD Drenched</a> </h3>

                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:100%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top">5.00</span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>
                                            <!-- End .product-container -->

                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-4 col-sm-6">
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/small/product-3.jpg') }}"
                                                    width="84" height="84" alt="product">
                                            </a>
                                        </figure>

                                        <div class="product-details">
                                            <h3 class="product-title"> <a href="demo36-product.html">Palm Print
                                                    Jacket</a> </h3>

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
                                                <span class="product-price">$49.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-4 col-sm-6">
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/small/product-4.jpg') }}"
                                                    width="84" height="84" alt="product">
                                            </a>
                                        </figure>

                                        <div class="product-details">
                                            <h3 class="product-title"> <a href="demo36-product.html">Camera</a>
                                            </h3>

                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:100%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top">5.00</span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>
                                            <!-- End .product-container -->

                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-4 col-sm-6">
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/small/product-5.jpg') }}"
                                                    width="84" height="84" alt="product">
                                            </a>
                                        </figure>

                                        <div class="product-details">
                                            <h3 class="product-title"> <a href="demo36-product.html">Red
                                                    Football</a> </h3>

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
                                                <span class="product-price">$49.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-4 col-sm-6">
                                    <div class=" product-default left-details product-widget">
                                        <figure>
                                            <a href="demo36-product.html">
                                                <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/small/product-6.jpg') }}"
                                                    width="84" height="84" alt="product">
                                            </a>
                                        </figure>

                                        <div class="product-details">
                                            <h3 class="product-title"> <a href="demo36-product.html">Soft
                                                    Hat</a> </h3>

                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:100%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top">5.00</span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>
                                            <!-- End .product-container -->

                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                </div>
                            </div>

                            <a class="view-all" href="demo36-shop.html">View
                                All<i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="brands-section mt-2 mb-3 appear-animate" data-animation-delay="200" data-animation-name="fadeIn"
                data-animation-duration="1000">
                <div class="headding">
                    <h4 class="section-title text-transform-none">Featured Brands</h4>
                </div>
                <div class="brands-slider owl-carousel bg-white owl-theme nav-circle images-center" data-owl-options="{
                                'margin': 1,
                                'navText': [ '<i class=icon-left-open-big>', '<i class=icon-right-open-big>' ],
                                'nav': true
                            }">
                    <figure><img src="{{ asset('aladdinne/assets/images/brands/small/brand1.png') }}" width="140"
                            height="60" alt="brand">
                    </figure>
                    <figure><img src="{{ asset('aladdinne/assets/images/brands/small/brand2.png') }}" width="140"
                            height="60" alt="brand">
                    </figure>
                    <figure><img src="{{ asset('aladdinne/assets/images/brands/small/brand3.png') }}" width="140"
                            height="60" alt="brand">
                    </figure>
                    <figure><img src="{{ asset('aladdinne/assets/images/brands/small/brand4.png') }}" width="140"
                            height="60" alt="brand">
                    </figure>
                    <figure><img src="{{ asset('aladdinne/assets/images/brands/small/brand5.png') }}" width="140"
                            height="60" alt="brand">
                    </figure>
                    <figure><img src="{{ asset('aladdinne/assets/images/brands/small/brand6.png') }}" width="140"
                            height="60" alt="brand">
                    </figure>
                    <figure><img src="{{ asset('aladdinne/assets/images/brands/small/brand4.png') }}" width="140"
                            height="60" alt="brand">
                    </figure>
                </div>
                <!-- End .brands-slider -->
            </div>

            <div class="product-slider-tab selected-products-section appear-animate bg-white"
                data-animation-name="fadeIn" data-animation-delay="100">
                <div
                    class="heading shop-list d-flex flex-lg-row flex-column align-items-lg-center bg-gray mb-0 pl-0 pr-0 pt-2">
                    <h4 class="section-title text-transform-none mb-0 ml-0">Selected Products</h4>
                    <ul class="nav justify-content-lg-center mb-0" id="myTab-two" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="seller-two-tab" data-toggle="tab" href="#seller-two"
                                role="tab" aria-controls="seller-two" aria-selected="true">Best Sellers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="new-two-tab" data-toggle="tab" href="#new-two" role="tab"
                                aria-controls="new-two" aria-selected="false">New
                                Arrivals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="best-two-tab" data-toggle="tab" href="#best-two" role="tab"
                                aria-controls="best-two" aria-selected="false">Best
                                Ratings</a>
                        </li>
                    </ul>
                    <a class="view-all ml-auto" href="demo36-shop.html">View
                        All<i class="fas fa-long-arrow-alt-right"></i></a>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="seller-two" role="tabpanel"
                        aria-labelledby="seller-two-tab">
                        <div class="products-slider owl-carousel nav-circle carousel-with-bg owl-theme pb-0"
                            data-owl-options="{
                                'margin': 1,
                                'dots': false,
                                'nav': true,
                                'navText': [ '<i class=icon-left-open-big>', '<i class=icon-right-open-big>' ],
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
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-16.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="demo36-product.html">White Brooch</a>
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
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
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
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-17.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
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
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-14.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="demo36-product.html">PT Cup</a>
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
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-13.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="demo36-product.html">Belt accessories</a>
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
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="demo36-product.html">PT Speaker</a>
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
                                        <img src="{{ asset('aladdinne/demoes/demo36/products/product-21.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="demo36-product.html">Wooden Chair</a>
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
                    <div class="tab-pane fade" id="new-two" role="tabpanel" aria-labelledby="new-two-tab">
                        <div class="products-slider owl-carousel nav-circle carousel-with-bg owl-theme pb-0"
                            data-owl-options="{
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
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-14.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="demo36-product.html">PT Cup</a>
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
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-13.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="demo36-product.html">Belt accessories</a>
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
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="demo36-product.html">PT Speaker</a>
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
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-21.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="demo36-product.html">Wooden Chair</a>
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
                    <div class="tab-pane fade" id="best-two" role="tabpanel" aria-labelledby="best-tab">
                        <div class="products-slider owl-carousel nav-circle carousel-with-bg owl-theme"
                            data-owl-options="{
                                    'margin': 1,
                                    'dots': false,
                                    'navText': [ '<i class=icon-left-open-big>', '<i class=icon-right-open-big>' ],
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
                                        <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-20.jpg') }}"
                                            width="239" height="239" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview"
                                        title="Quick View">Quick
                                        View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="demo36-shop.html" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="demo36-product.html">White Sofa</a>
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
                </div>
            </div>

            <div class="top-notice bg-dark text-white  top-notice-bg appear-animate" data-animation-name="fadeIn"
                data-animation-delay="100">
                <div
                    class="container text-center d-flex align-items-center justify-content-center flex-column flex-xl-row ">
                    <img src="{{ asset('aladdinne/demoes/demo36/shop-logo.png') }}" width="116" height="23"
                        alt="logo" />
                    <h5 class="d-inline-block mb-0 pl-3 pr-3 pt-1 pb-1">The Lowest Prices Once A Month! Hurry To Snap Up
                    </h5>
                    <a href="demo36-shop.html" class="btn btn-darkcategory ls-n-0 mt-xl-0 mt-1">SHOP NOW!</a>
                </div>
                <!-- End .container -->
            </div>
            <!-- End .top-notice -->

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
        </div>
    </div>
</main>
<!-- End .main -->
@endsection