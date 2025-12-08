@extends('layouts.ecommerce')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/web/user/home_page_products.css') }}?v={{ time() }}">
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

    .slider-image-header .owl-dots {
        position: absolute;
        bottom: 15px;
        /* distance from bottom of slider */
        left: 0;
        right: 0;
        text-align: center;
        z-index: 10;
        /* make sure dots appear above the image */
    }

    .slider-image-header .owl-dot span {
        width: 12px;
        height: 12px;
        margin: 0 5px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        /* semi-transparent white */
        display: inline-block;
        transition: background 0.3s ease;
    }

    .slider-image-header .owl-dot.active span {
        background: #fff;
        /* solid white when active */
    }

    .owl-dots {
        display: block !important;
        text-align: center;
        margin-top: 15px;
    }

    .owl-carousel .owl-dots .owl-dot span {
        width: 11px !important;
        height: 11px !important;
        border-width: 3px !important;
    }
</style>
<main class="main">
    <div class="bg-gray pb-5">
        <div class="container pb-2">
            @include('ecommerce.home.partials.sliders')
            <!-- End .home-slider -->

            <div class="categories-section appear-animate" data-animation-name="fadeIn" data-animation-delay="100">

            </div>
        </div>

    </div>

    <div class="bg-gray">
        <div class="container">
            @include('ecommerce.home.partials.products')
        </div>
    </div>
</main>
<!-- End .main -->
<!-- footer-area -->
@include('ecommerce.footer')
<!-- footer-area-end -->

@endsection
@push('scripts')
<script src="{{ asset('js/panel/users/common.js') }}" defer></script>
<script src="{{ asset('js/panel/users/cart/add_to_cart.js') }}" defer></script>
<script src="{{ asset('js/panel/users/cart/cart_manager.js') }}" defer></script>
<script>
    window.addEventListener('load', function() {
        let script = document.createElement('script');
        script.src = "{{ asset('js/panel/users/cart/cart_drawer.js') }}";
        script.onload = function() {
            if (typeof CartManager !== 'undefined') {
                CartManager.loadCartData();
            }
        };
        document.body.appendChild(script);
    });
</script>

<script src="{{ asset('js/panel/users/home-products.js') }}?v={{ time() }}" defer></script>

<script src="{{ asset('js/panel/users/cart/cart_list.js') }}" defer></script>
<script src="{{ asset('js/panel/users/lazyload.js') }}" defer></script>

<script>
    // Set the hasCartList variable
    window.hasCartList = false;
    // Add an event listener to the DOMContentLoaded event
    document.addEventListener('DOMContentLoaded', function() {

    });

    // This handles BACK button cache restore
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            CartManager.loadCartData();
        }
    });

    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        'event': 'home_page_view'
    });
</script>


@include('ecommerce.wishlist-js')
@endpush