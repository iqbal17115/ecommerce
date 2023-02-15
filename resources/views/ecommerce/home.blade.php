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
                        <a href="{{ route('shop', ['id'=>$top_show_category->id]) }}">
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
            @foreach($product_features as $product_feature)
            @if(count($product_feature->Product) > 0)
            <div class="recent-products-section appear-animate" data-animation-name="fadeIn" data-animation-delay="100">
                <div class="heading shop-list d-flex align-items-center flex-wrap bg-gray mb-0 pl-0 pr-0">
                    <h4 class="section-title text-transform-none mb-0 mr-0">{{$product_feature->name}}</h4>
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
                    @foreach($product_feature->Product as $product)
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="{{ route('product-detail', ['id'=>$product->id]) }}">
                                <img @if($product->ProductMainImage) src="{{ asset('storage/product_photo/'.$product->ProductMainImage->image) }}" @endif
                                    width="239" height="239" style="width: 239px; height: 239px;" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="javascript:void(0);" title="Add To Cart" data-id="{{$product->id}}" data-name="{{$product->name}}" data-your_price="{{$product->your_price}}" data-sale_price="{{$product->sale_price}}" @if($product->ProductMainImage) data-image="{{$product->ProductMainImage->image }}" @endif class="btn-icon btn-add-cart product-type-simple"><i
                                        class="icon-shopping-cart"></i></a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <h3 class="product-title">
                                <a href="{{ route('product-detail', ['id'=>$product->id]) }}">{{$product->name}}</a>
                            </h3>
                            <!-- End .product-container -->
                            <div class="price-box">
                                @php
                                echo $product->your_price? '<span class="old-price">$'.number_format((float)$product->your_price, 2).'</span>' : '';
                                echo $product->sale_price? '<span class="product-price">$'.number_format((float)$product->sale_price, 2).'</span>' : '';
                                @endphp
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
                    @endforeach
                </div>
                <!-- End .products-slider -->
            </div>
            @endif
            @endforeach
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
@include('ecommerce.cart-js')
<!-- footer-area -->
@include('ecommerce.footer')
<!-- footer-area-end -->
@include('ecommerce.sidebar-js')
@endsection