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
                    <img class="slider_image slide-bg" src="{{ asset('storage/'.$slider->image) }}" alt="slider image"
                        style="min-height: 208px;">
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
                                    'items': 12
                                }
                            }
                        }">
                    @foreach($top_show_categories as $top_show_category)
                    <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                        <a href="{{ route('catalog', ['id'=>$top_show_category->id]) }}">
                            <figure>
                                <img class="lazyload"
                                    data-src="{{ asset('storage/'.$top_show_category->image) }}" alt="category"
                                    width="280" height="240" style="width: 100px; height: 100px; border-radius: 50%;" />
                            </figure>
                            <div class="category-content p-0">
                                <span
                                    style="margin: 8px 12px 0;font-size: 12px;color: #212121;line-height: 18px;height: 36px;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;">
                                    {{ $top_show_category->name }}
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
                @foreach($top_features as $top_feature)
                @if($top_feature->TopFeatureSetting)
                @if($top_feature->TopFeatureSetting && count($top_feature->TopFeatureSetting->FeatureSettingDetail) >=
                2)
                <div class="col-md-3 card">
                    <div class="card-body">
                        <div class="a-cardui-header">
                            <h2 class="a-color-base headline truncate-2line ">
                                {{$top_feature->name}}
                            </h2>
                        </div>
                        <div class="row">
                            @foreach($top_feature->TopFeatureSetting->FeatureSettingDetail as $feature_setting_detail)
                            <div class="col-6 p-0">
                                <a href="{{ route('catalog', ['id'=>$feature_setting_detail->category_id]) }}">
                                    <div class="card mb-0">
                                        <img class="card-img-top lazy-load"
                                            data-src="{{ asset('storage/'.$feature_setting_detail->Category->image) }}"
                                            style="height: 150px;">
                                        <div class="text-center text-dark">
                                            <span>{{$feature_setting_detail->Category->name}}</span>
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
                @endif
                @endforeach
            </div>
        </div>

    </div>

    <div class="bg-gray">
        <div class="container">
            @foreach($product_features as $product_feature)
            @if($product_feature->card_feature != 1 && count($product_feature->Product) > 0)
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
                                <img class="lazy-load" @if($product->ProductMainImage)
                                data-src="{{ asset('storage/product_photo/'.$product->ProductMainImage->image) }}"
                                @endif style="width: 239px; height: 239px; filter: brightness(0.9)
                                contrast(1.2) saturate(1.1);"
                                width="239" height="239" alt="product">
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

            <!-- Start Card Feature -->
            @if($product_feature->FeatureSetting)
            <div class="row" style="margin-top: 18px;">
                <!-- Start Product Part -->
                @foreach($product_feature->FeatureSetting as $feature_setting)
                @if($feature_setting->ProductFeature->card_feature == 1 && count($feature_setting->FeatureSettingDetail)
                >= 2)
                <div class="col-md-3 card">
                    <div class="card-body">
                        <div class="a-cardui-header">
                            <h2 class="a-color-base headline truncate-2line">@if($feature_setting->ProductFeature)
                                {{$feature_setting->ProductFeature->name}} @endif</h2>
                        </div>
                        <div class="row">
                            @foreach($feature_setting->FeatureSettingDetail as $feature_setting_detail)
                            <div class="col-6 p-0">
                                <a href="{{ route('catalog', ['id'=>$feature_setting_detail->category_id]) }}">
                                    <div class="card mb-0">
                                        <img class="card-img-top lazy-load"
                                            data-src="{{ asset('storage/'.$feature_setting_detail->Category->image) }}"
                                            style="height: 150px;">
                                        <div class="text-center text-dark">
                                            <span>{{$feature_setting_detail->Category->name}}</span>
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
                @endforeach
            </div>
            @endif
            <!-- End Card Feature -->
            @endif
            @endforeach
        </div>
    </div>
</main>
<script>
    function lazyLoad() {
    const lazyImages = document.querySelectorAll('.lazyload');
    lazyImages.forEach(img => {
        if (img.getBoundingClientRect().top <= window.innerHeight && img.getBoundingClientRect().bottom >= 0 && getComputedStyle(img).display !== 'none') {
            img.src = img.dataset.src;
            img.classList.remove('lazyload');
        }
    });
}

window.addEventListener('scroll', lazyLoad);
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
            'lazy-load'); // Remove the class to prevent the image from being loaded again
            observer.unobserve(image); // Stop observing the image once it has been loaded
        }
    });
}, options);

// Loop through all the image elements and observe them with the IntersectionObserver
for (var i = 0; i < images.length; i++) {
    var image = images[i];
    observer.observe(image);
}
</script>
<!-- End .main -->
@include('ecommerce.cart-js')
<!-- footer-area -->
@include('ecommerce.footer')
<!-- footer-area-end -->
@include('ecommerce.sidebar-js')

@endsection