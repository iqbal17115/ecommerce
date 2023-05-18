
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
                    <a href="{{ route('product-detail', ['id'=>$product->id]) }}" class="product-name"
                        id="product-name">{{$product->name}}</a>

                    {{-- rating add html code --}}
                    <span class="five-star-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        {{-- end of rating add html code --}}
                    </span>
                    <span class="rating-number">-</span>
                    <span class="rating-number" style="font-size: 11px;">33,213</span>
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
                @if($feature_setting->FeatureSettingDetail)
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
                @endif
            </div>
            <!-- End Feature -->
        </div>
    </div>
    @endif
    <!-- Start Ads -->
    @if($feature_setting->ProductFeature->Advertisement)
    <div class="col-md-3 card">
        <div class="card-body">
            <div class="row">
                @foreach($feature_setting->ProductFeature->Advertisement as $advertisement)
                <div class="col-12 p-0">
                    <div class="card mb-0">
                        <img class="card-img-top lazy-load" data-src="{{ asset('storage/'.$advertisement->ads) }}">
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

    <!-- Plugins JS File -->
    <script src="{{ URL::asset('aladdinne/') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('aladdinne/') }}/assets/js/optional/isotope.pkgd.min.js"></script>
    <script src="{{ URL::asset('aladdinne/') }}/assets/js/plugins.min.js"></script>
    <script src="{{ URL::asset('aladdinne/') }}/assets/js/jquery.appear.min.js"></script>
    <script src="{{ URL::asset('aladdinne/') }}/assets/js/jquery.plugin.min.js"></script>
    <script src="{{ URL::asset('aladdinne/') }}/assets/js/jquery.countdown.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ URL::asset('aladdinne/') }}/assets/js/main.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


