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

        /* five start css code */
        .five-star-rating {
            color: #F4631B;
            /* Set the color of the stars */
            font-size: 12px;
            margin-left: 11px;
            /* Adjust the size of the stars */
        }

        .five-star-rating i {
            display: inline-block;
        }

        /* If you are using FontAwesome for the star icons */
        .five-star-rating .fa-star:before {
            content: "\f005";
            /* Use the appropriate Unicode for the star icon */
        }

        /* end of five start css code */

        /* two line name show css code */


        .product-name {
            display: inline-block;
            word-wrap: break-word;
        }

        /* two line name show css code */
    </style>
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
                            <img class="slider_image slide-bg" src="{{ asset('storage/' . $slider->image) }}" alt="slider image"
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
                    <div class="categories-slider owl-carousel owl-theme show-nav-hover nav-outer"
                        data-owl-options="{
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
                        @foreach ($top_show_categories as $top_show_category)
                            <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                                <a href="{{ route('catalog', ['id' => $top_show_category->id]) }}">
                                    <figure>
                                        <img class="lazy-load" data-src="{{ asset('storage/' . $top_show_category->image) }}"
                                            alt="category" width="280" height="240"
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
            <div class="container" id="ecom_main_content">

            </div>
        </div>
    </main>
    <!-- End .main -->
    <!-- footer-area -->
    @include('ecommerce.footer')
    <!-- footer-area-end -->


@endsection

@push('scripts')
    <script>
        function get_main_content() {
            $.ajax({
                url: '{{ route('get-main-content') }}',
                type: 'GET',
                beforeSend: function() {
                    $('#ecom_main_content').html('');
                },
                success: function(data) {
                    // Handle the response data
                    $('#ecom_main_content').html(data);
                }
            });
        }
        $(document).ready(function() {
            setTimeout(() => {
                get_main_content();
            }, 1000);
        });
    </script>
@endpush
