@extends('layouts.ecommerce')
@section('content')
<style>
@media (min-width:1220px) {
    .container {
        max-width: 1500px;
        ;
    }
}

.post-slider>.owl-stage-outer,
.products-slider>.owl-stage-outer {
    padding: 0px 0px;
}
</style>
<main class="main">
    <div class="bg-gray pb-5">
        <div class="container pb-2">
            <div class="slide-animate slider-image-header owl-carousel owl-theme nav-circle mb-2" data-owl-options="{
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
                            'loop': true,
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
                                    'items': 10
                                }
                            }
                        }">
                    @foreach($top_show_categories as $top_show_category)
                    <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                        <a href="{{ route('shop', ['id'=>$top_show_category->id]) }}">
                            <figure>
                                <img src="{{ asset('storage/'.$top_show_category->image) }}" alt="category" width="280"
                                    height="240" style="height: 128px; height: 116px; border-radius: 50%;" />
                            </figure>
                            <div class="category-content p-0">
                                <span
                                    style="margin: 8px 12px 0;font-size: 12px;color: #212121;line-height: 18px;height: 36px;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;">{{$top_show_category->name}}</span>
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
                <div class="heading shop-list d-flex align-items-center flex-wrap bg-gray mb-0 pl-0 pr-0 pt-0">
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
                    @foreach($product_feature->Product as $product)
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="{{ route('product-detail', ['id'=>$product->id]) }}">
                                <img @if($product->ProductMainImage)
                                src="{{ asset('storage/product_photo/'.$product->ProductMainImage->image) }}" @endif
                                width="239" height="239" style="width: 239px; height: 239px; filter: brightness(0.9)
                                contrast(1.2) saturate(1.1);" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="javascript:void(0);" title="Add To Cart" data-id="{{$product->id}}"
                                    data-name="{{$product->name}}" data-your_price="{{$product->your_price}}"
                                    data-sale_price="{{$product->sale_price}}" @if($product->ProductMainImage)
                                    data-image="{{$product->ProductMainImage->image }}" @endif class="btn-icon
                                    btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i></a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <h3 class="product-title">
                                <a href="{{ route('product-detail', ['id'=>$product->id]) }}">{{$product->name}}</a>
                            </h3>
                            <!-- End .product-container -->
                            <div class="price-box">
                                @php
                                echo $product->your_price? '<span
                                    class="old-price">'.$currency->icon.''.number_format((float)$product->your_price,
                                    2).'</span>' : '';
                                echo $product->sale_price? '<span
                                    class="product-price">'.$currency->icon.''.number_format((float)$product->sale_price,
                                    2).'</span>' :
                                '';
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
            @if($product_feature->Advertisement)
            <!-- Start Ads -->
            <div class="row">
                @foreach($product_feature->Advertisement as $feature_ads)
                <div class="@if($feature_ads->width=='Full') col-md-12 @elseif($feature_ads->width=='Half') col-md-6 @else col-md-4 @endif">
                    <div class="sale-banner banner bg-image mb-1 appear-animate" data-animation-name="fadeIn"
                        data-animation-delay="100"
                        style="background-image: url({{asset('storage/'.$feature_ads->ads)}}); height: 200px;width: auto;object-fit: contain;">
                        <div class="container banner-content">
                            <div class="row no-gutter justify-content-start">
                                <!-- <div
                                    class="col-auto col-lg-5 col-md-6 col-12 d-flex flex-column justify-content-center content-left text-center text-md-right">
                                    <h4 class="align-left text-white text-uppercase">THE PERFECT GIFT FOR YOUR
                                        GIRLFRIEND
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
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- End Ads -->
            @endif
            @endif
            @endforeach
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