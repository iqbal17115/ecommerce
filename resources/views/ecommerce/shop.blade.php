@extends('layouts.ecommerce')
@section('content')
    <style>
        @media (min-width:1220px) {
            .container {
                max-width: 1500px;
                ;
            }
        }

        /* five start css code */
        .five-star-rating {
            color: #F4631B;
            /* Set the color of the stars */
            font-size: 12px;
            /* margin-left: 11px; */
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

        .product-name {
            display: inline-block;
            word-wrap: break-word;
        }



        /* end of five start css code */
        /* end Start rating review Css */
    </style>
    <main class="main">
        @if (isset($all_active_advertisements['Category']['1']['ads']))
            <div>
                <center>
                    <img src="{{ asset('storage/' . $all_active_advertisements['Category']['1']['ads']) }}">
                </center>
            </div>
        @endif
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-1">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="demo36.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                </ol>
            </div>
        </nav>

        <div class="container pt-2">
            <div class="row">
                <div class="col-lg-9 main-content">
                    <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                        <div class="toolbox-left">
                            <a href="#" class="sidebar-toggle"><svg data-name="Layer 3" id="Layer_3"
                                    viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                                    <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                                    <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                    <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                    <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                    <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                </svg>
                                <span>Filter</span>
                            </a>
                            <input value="{{ $filter_type }}" name="filter_type" id="filter_type" type="hidden" />
                            <input value="{{ $filter_for }}" name="filter_for" id="filter_for" type="hidden" />
                            <div class="toolbox-item toolbox-sort">
                                <label>Sort By:</label>

                                <div class="select-custom">
                                    <select name="orderby" class="form-control order_of_product">
                                        <option value="1" selected="selected">Default sorting</option>
                                        <option value="2">Sort by price: low to high</option>
                                        <option value="3">Sort by price: high to low</option>
                                    </select>
                                </div>
                                <!-- End .select-custom -->


                            </div>
                            <!-- End .toolbox-item -->
                        </div>
                        <!-- End .toolbox-left -->

                        <div class="toolbox-right">
                            <div class="toolbox-item toolbox-show">
                                <label>Show:</label>

                                <div class="select-custom">
                                    <select name="count_paginate" class="form-control count_paginate">
                                        <option value="12">12</option>
                                        <option value="24">24</option>
                                        <option value="36">36</option>
                                    </select>
                                </div>
                                <!-- End .select-custom -->
                            </div>
                            <!-- End .toolbox-item -->

                            <div class="toolbox-item layout-modes">
                                <a href="category.html" class="layout-btn btn-grid active" title="Grid">
                                    <i class="icon-mode-grid"></i>
                                </a>
                                <a href="category-list.html" class="layout-btn btn-list" title="List">
                                    <i class="icon-mode-list"></i>
                                </a>
                            </div>
                            <!-- End .layout-modes -->
                        </div>
                        <!-- End .toolbox-right -->
                    </nav>

                    <div id="main-content" class="row row-joined divide-line products-group">
                        @foreach ($products as $product)
                            <div class="col-xl-3 col-lg-4 col-md-3 col-sm-4 col-6">
                                <div class="product-default inner-quickview inner-icon">
                                    <figure>
                                        <a href="{{ route('products.show', ['name' => urlencode($product->name)]) }}">
                                            @if ($product->ProductMainImage)
                                                <img src="{{ asset('storage/product_photo/' . $product->ProductMainImage->image) }}"
                                                    width="239" height="239" style="width: 239px; height: 239px;"
                                                    alt="product">
                                            @endif
                                        </a>
                                        <div class="btn-icon-group">
                                            <a href="javascript:void(0);" title="Add To Cart"
                                                data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                data-your_price="{{ $product->your_price }}"
                                                data-sale_price="{{ $product->sale_price }}"
                                                @if ($product->ProductMainImage) data-image="{{ $product->ProductMainImage->image }}" @endif
                                                class="btn-icon
                                        btn-add-cart product-type-simple"><i
                                                    class="icon-shopping-cart"></i></a>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h3 class="product-title">
                                            <a href="{{ route('products.show', ['name' => urlencode($product->name)]) }}"
                                                class="product-name">{{ $product->name }}</a>
                                            {{-- rating add html code --}}
                                            <span class="five-star-rating">
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
                                            </span>
                                            <span class="rating-number">-</span>
                                            <span class="rating-number"
                                                style="font-size: 11px;">{{ $product->reviews()->sum('rating') }}</span>
                                        </h3>


                                        <!-- End .product-container -->
                                        <div class="price-box">
                                            @if ($product->sale_price &&
                                                    $product->sale_start_date &&
                                                    $product->sale_end_date &&
                                                    $product->sale_start_date <= now() &&
                                                    $product->sale_end_date >= now())
                                                <del
                                                    class="old-price">{{ $currency?->icon }} {{ number_format($product->your_price, 2) }}</del>
                                                <span
                                                    class="product-price">{{ $currency?->icon }} {{ number_format($product->sale_price, 2) }}</span>
                                            @else
                                                <span
                                                    class="product-price">{{ $currency?->icon }} {{ number_format($product->your_price, 2) }}</span>
                                            @endif
                                        </div>
                                        <!-- End .price-box -->
                                    </div>
                                    <!-- End .product-details -->
                                </div>
                            </div>
                        @endforeach
                        <div class="col-12">
                            <nav class="toolbox toolbox-pagination border-0">
                                <ul class="pagination toolbox-item">
                                    <li class="page-item">
                                        {!! $products->links() !!}
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                    <!-- End .row -->
                    <div class="col-md-12">
                        <div class="toolbox-item toolbox-show">
                            <label>Show:</label>

                            <div class="select-custom">
                                <select name="count_paginate" class="form-control count_paginate">
                                    <option value="12">12</option>
                                    <option value="24">24</option>
                                    <option value="36">36</option>
                                </select>
                            </div>
                            <!-- End .select-custom -->
                        </div>
                        <!-- End .toolbox-item -->
                    </div>

                    <!-- Start Ads -->
                    <div class="col-12">
                        @if (isset($all_active_advertisements['Category']['3']['ads']))
                            <div class="mt-1">
                                <center>
                                    <img
                                        src="{{ asset('storage/' . $all_active_advertisements['Category']['3']['ads']) }}">
                                </center>
                            </div>
                        @endif
                    </div>
                    <!-- End Ads -->

                </div>
                <!-- End .col-lg-9 -->

                <div class="sidebar-overlay"></div>
                <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                    <div class="sidebar-wrapper">
                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true"
                                    aria-controls="widget-body-2">Categories</a>
                            </h3>

                            <div class="collapse show" id="widget-body-2">
                                <div class="widget-body">
                                    <ul class="cat-list">
                                        @if ($related_category && $related_category->Parent && $related_category->Parent->SubCategory)
                                            @foreach ($related_category->Parent->SubCategory as $cat)
                                                <li>
                                                    <input type="checkbox" name="category[]"
                                                        value="{{ $cat->id }}">
                                                    <a>{{ $cat->name }}</a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        <!-- End .widget -->

                        <div class="widget widget-price">
                            <h3 class=" widget-title">
                                <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true"
                                    aria-controls="widget-body-3">Price</a>
                            </h3>

                            <div class="collapse show" id="widget-body-3">
                                <div class="widget-body pb-0">
                                    <form id="productFilterByPrice">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-control-sm rounded"
                                                        id="min-price" name="min-price" placeholder="Min" min="0"
                                                        style="-moz-appearance: textfield; height: 30px; font-size: 14px;"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-control-sm rounded"
                                                        id="max-price" name="max-price" placeholder="Max" min="0"
                                                        style="-moz-appearance: textfield;height: 30px; font-size: 14px;"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 align-items-end">
                                                <center>
                                                    <button type="submit" class="btn btn-primary btn-sm"
                                                        style="height: 30px; border-radius: 3px; background-color: #007bff; border-color: #007bff; color: #fff; padding: 0em 0em;">Filter</button>
                                                </center>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        <!-- End .widget -->

                        <div class="widget widget-color">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true"
                                    aria-controls="widget-body-4">Color</a>
                            </h3>

                            <div class="collapse show" id="widget-body-4">
                                <div class="widget-body pb-0">
                                    <ul class="config-swatch-list">
                                        <li class="active">
                                            <a href="#" style="background-color: #000;"></a>
                                        </li>
                                        <li>
                                            <a href="#" style="background-color: #0188cc;"></a>
                                        </li>
                                        <li>
                                            <a href="#" style="background-color: #81d742;"></a>
                                        </li>
                                        <li>
                                            <a href="#" style="background-color: #6085a5;"></a>
                                        </li>
                                        <li>
                                            <a href="#" style="background-color: #ab6e6e;"></a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        <!-- End .widget -->

                        <div class="widget widget-brand">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-7" role="button" aria-expanded="true"
                                    aria-controls="widget-body-7">Brand</a>
                            </h3>

                            <div class="collapse show" id="widget-body-7">
                                <div class="widget-body pb-0">
                                    <ul class="cat-list">
                                        @foreach ($brands as $brand)
                                            <li>
                                                <input type="checkbox" name="brand[]" value="{{ $brand->id }}">
                                                <a>{{ $brand->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        <!-- End .widget -->

                        <!-- Start Ads -->
                        @if (isset($all_active_advertisements['Category']['2']['ads']))
                            <div class="mt-1">
                                <center>
                                    <img
                                        src="{{ asset('storage/' . $all_active_advertisements['Category']['2']['ads']) }}">
                                </center>
                            </div>
                        @endif
                        <!-- End Ads -->
                    </div>
                    <!-- End .sidebar-wrapper -->
                </aside>
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->

        <div class="mb-xl-4 mb-0"></div>
        <!-- margin -->
    </main>
    <!-- End .main -->
    <!-- footer-area -->
    @include('ecommerce.footer')
    <!-- footer-area-end -->

    <!-- Start Sidebar -->
    @include('ecommerce.sidebar-js')
    <!-- End Sidebar -->

@endsection
@push('scripts')
    <script>
        count = 12;
        filter_type = '';
        filter_for = '';

        $(document).ready(function() {
            filter_type = $("#filter_type").val();
            filter_for = $("#filter_for").val();

            // Filter By Category
            $('input[name="category[]"]').on('change', function() {
                minPrice = $('#min-price').val();
                maxPrice = $('#max-price').val();

                order = $(this).children("option:selected").val();
                selectedBrands = $('input[name="brand[]"]:checked').map(function() {
                    return this.value;
                }).get();
                selectedCategories = $('input[name="category[]"]:checked').map(function() {
                    return this.value;
                }).get();
                $.ajax({
                    url: '/pagination/shop-order-total-data?count=' + count + '&order=' + order +
                        '&filter_type=' + filter_type + '&filter_for=' + filter_for + '&brand_id=' +
                        selectedBrands + '&category_id=' + selectedCategories + '&min_price=' +
                        minPrice + '&max_price=' + maxPrice,
                    success: function(data) {
                        $('#main-content').html(data);
                    }
                })
            });

            // Filter By Price
            $('#productFilterByPrice').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                // Get the form values
                minPrice = $('#min-price').val();
                maxPrice = $('#max-price').val();
                // Do something with the form values, such as sending an AJAX request to filter the product listing
                order = $(this).children("option:selected").val();
                selectedBrands = $('input[name="brand[]"]:checked').map(function() {
                    return this.value;
                }).get();
                selectedCategories = $('input[name="category[]"]:checked').map(function() {
                    return this.value;
                }).get();

                $.ajax({
                    url: '/pagination/shop-order-total-data?count=' + count + '&order=' + order +
                        '&filter_type=' + filter_type + '&filter_for=' + filter_for + '&brand_id=' +
                        selectedBrands + '&category_id=' + selectedCategories + '&min_price=' +
                        minPrice + '&max_price=' + maxPrice,
                    success: function(data) {
                        $('#main-content').html(data);
                    }
                })
            });

            $('input[name="brand[]"]').on('change', function() {
                minPrice = $('#min-price').val();
                maxPrice = $('#max-price').val();

                order = $(this).children("option:selected").val();
                selectedBrands = $('input[name="brand[]"]:checked').map(function() {
                    return this.value;
                }).get();

                selectedCategories = $('input[name="category[]"]:checked').map(function() {
                    return this.value;
                }).get();

                $.ajax({
                    url: '/pagination/shop-order-total-data?count=' + count + '&order=' + order +
                        '&filter_type=' + filter_type + '&filter_for=' + filter_for + '&brand_id=' +
                        selectedBrands + '&category_id=' + selectedCategories + '&min_price=' +
                        minPrice + '&max_price=' + maxPrice,
                    success: function(data) {
                        $('#main-content').html(data);
                    }
                })
            });

            $("select.order_of_product").change(function() {
                minPrice = $('#min-price').val();
                maxPrice = $('#max-price').val();

                order = $(this).children("option:selected").val();
                selectedBrands = $('input[name="brand[]"]:checked').map(function() {
                    return this.value;
                }).get();

                selectedCategories = $('input[name="category[]"]:checked').map(function() {
                    return this.value;
                }).get();

                $.ajax({
                    url: '/pagination/shop-order-total-data?count=' + count + '&order=' + order +
                        '&filter_type=' + filter_type + '&filter_for=' + filter_for + '&brand_id=' +
                        selectedBrands + '&category_id=' + selectedCategories + '&min_price=' +
                        minPrice + '&max_price=' + maxPrice,
                    success: function(data) {
                        $('#main-content').html(data);
                    }
                })
            });
            $("select.count_paginate").change(function() {
                minPrice = $('#min-price').val();
                maxPrice = $('#max-price').val();

                count = $(this).children("option:selected").val();
                selectedBrands = $('input[name="brand[]"]:checked').map(function() {
                    return this.value;
                }).get();

                selectedCategories = $('input[name="category[]"]:checked').map(function() {
                    return this.value;
                }).get();

                $.ajax({
                    url: '/pagination/shop-pagination-total-data?count=' + count + '&filter_type=' +
                        filter_type + '&filter_for=' + filter_for + '&brand_id=' + selectedBrands +
                        '&category_id=' + selectedCategories +
                        '&min_price=' + minPrice + '&max_price=' + maxPrice,
                    success: function(data) {
                        $('#main-content').html(data);
                    }
                })
            });
        });

        function pagination(page, count) {
            $.ajax({
                url: '/pagination/shop-pagination-data?count=' + count + '&page=' + page,
                success: function(data) {
                    $('#main-content').html(data);
                }
            })
        }
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            pagination(page, count);
        });
    </script>
@endpush
