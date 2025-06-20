@extends('layouts.ecommerce')
@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-1">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Shop</a></li>
            </ol>
        </div>
    </nav>

    <div class="container pt-2">
        <div class="row">
            <div class="col-lg-9 main-content">
                @include('ecommerce.shop.partials.sticky_header')
                
                <div id="product-container" class="row"></div>
                <!-- End .row -->
            </div>
            <!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                <div class="sidebar-wrapper">
                    @include('ecommerce.shop.partials.category_widget')
                    <!-- End .widget -->

                    @include('ecommerce.shop.partials.price_widget')
                    <!-- End .widget -->

                    <!-- Start Ads -->
                    @if (isset($all_active_advertisements['Category']['2']['ads']))
                    <div class="mt-1">
                        <center>
                            <img src="{{ asset('storage/' . $all_active_advertisements['Category']['2']['ads']) }}">
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
@php
$baseRoute = route('products.details', ['name' => '', 'seller_sku' => '']);
@endphp
@endsection
@push('scripts')
<script src="{{ asset('js/panel/users/common.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/add_to_cart.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_manager.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_drawer.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_list.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/lazyload.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/products.js') }}?v={{ time() }}"></script>
<script>
    // Set the hasCartList variable
    window.hasCartList = false;
    // Add an event listener to the DOMContentLoaded event
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof CartManager !== 'undefined') {
            CartManager.loadCartData();
        }
    });

    // This handles BACK button cache restore
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            CartManager.loadCartData();
        }
    });
</script>
@endpush