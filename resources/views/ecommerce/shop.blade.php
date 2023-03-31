@extends('layouts.ecommerce')
@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
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
                        <a href="#" class="sidebar-toggle"><svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32"
                                xmlns="http://www.w3.org/2000/svg">
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
                    @foreach($products as $product)
                    <div class="col-xl-3 col-lg-4 col-md-3 col-sm-4 col-6">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="demo36-product.html">
                                    <img src="{{ asset('storage/product_photo/'.$product->ProductMainImage->image) }}"
                                        width="239" height="239" style="width: 239px; height: 239px;" alt="product">
                                </a>
                                <div class="btn-icon-group">
                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                            class="icon-shopping-cart"></i></a>
                                </div>
                            </figure>
                            <div class="product-details">
                                <h3 class="product-title">
                                    <a href="demo36-product.html">{{$product->name}}</a>
                                </h3>
                                <!-- End .product-container -->
                                <div class="price-box">
                                @php
                                echo $product->your_price? '<span
                                    class="old-price">'.$currency->icon.''.number_format((float)$product->your_price, 2).'</span>' : '';
                                echo $product->sale_price? '<span
                                    class="product-price">'.$currency->icon.''.number_format((float)$product->sale_price, 2).'</span>' :
                                '';
                                @endphp
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
                                    <li>
                                        <a href="#widget-category-1">
                                            Cameras
                                        </a>
                                    </li>
                                    @foreach($parentCategories as $parentCategory)
                                    <li>
                                        <a href="#widget-category-{{$parentCategory->id}}" class="collapsed"
                                            data-toggle="collapse" role="button" aria-expanded="false"
                                            aria-controls="widget-category-2">
                                            {{$parentCategory->name}} @if($parentCategory->SubCategory)<span class="toggle"></span>@endif
                                        </a>
                                        @if($parentCategory->SubCategory)
                                        <div class="collapse" id="widget-category-{{$parentCategory->id}}">
                                            <ul class="cat-sublist">
                                                @foreach($parentCategory->SubCategory as $subCategory)
                                                <li>
                                                    <a href="#widget-category-{{$subCategory->id}}" class="collapsed"
                                                        data-toggle="collapse" role="button" aria-expanded="false"
                                                        aria-controls="widget-category-2">
                                                        {{$subCategory->name}}@if($subCategory->SubCategory)<span class="toggle"></span>@endif
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </li>
                                    @endforeach
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
                                <form action="#">
                                    <div class="price-slider-wrapper">
                                        <div id="price-slider"></div>
                                        <!-- End #price-slider -->
                                    </div>
                                    <!-- End .price-slider-wrapper -->

                                    <div
                                        class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="filter-price-text">
                                            Price:
                                            <span id="filter-price-range"></span>
                                        </div>
                                        <!-- End .filter-price-text -->

                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                    <!-- End .filter-price-action -->
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
                                    <li><a href="#">Adidas</a></li>
                                    <li><a href="#">Asics</a></li>
                                    <li><a href="#">Brooks</a></li>
                                    <li><a href="#">Nike</a></li>
                                    <li><a href="#">Puma</a></li>
                                </ul>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .collapse -->
                    </div>
                    <!-- End .widget -->
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
<script>
count = 12;
$(document).ready(function() {
    $("select.order_of_product").change(function() {
        order = $(this).children("option:selected").val();
        $.ajax({
            url: '/pagination/shop-order-total-data?count=' + count + '&order=' + order,
            success: function(data) {
                $('#main-content').html(data);
            }
        })
    });
    $("select.count_paginate").change(function() {
        count = $(this).children("option:selected").val();
        $.ajax({
            url: '/pagination/shop-pagination-total-data?count=' + count,
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
@endsection