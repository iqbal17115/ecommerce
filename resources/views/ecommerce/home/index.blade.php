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

    .sold_out {
        top: 2em;
        left: -4em;
        color: #fff;
        display: block;
        position: absolute;
        text-align: center;
        text-decoration: none;
        letter-spacing: .06em;
        background-color: #A00;
        padding: 0.5em 5em 0.4em 5em;
        text-shadow: 0 0 0.75em #444;
        box-shadow: 0 0 0.5em rgba(0, 0, 0, 0.5);
        font: bold 16px/1.2em Arial, Sans-Serif;
        -webkit-text-shadow: 0 0 0.75em #444;
        -webkit-box-shadow: 0 0 0.5em rgba(0, 0, 0, 0.5);
        -webkit-transform: rotate(-45deg) scale(0.75, 1);
        z-index: 10;
    }

    .sold_out:before {
        content: '';
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        position: absolute;
        margin: -0.3em -5em;
        transform: scale(0.7);
        -webkit-transform: scale(0.7);
        border: 2px rgba(255, 255, 255, 0.7) dashed;
    }

    /* two line name show css code */
</style>
<main class="main">
    <div class="bg-gray pb-5">
        <div class="container pb-2">
            @include('ecommerce.home.partials.sliders')
            <!-- End .home-slider -->

            <div class="categories-section appear-animate" data-animation-name="fadeIn" data-animation-delay="100">

            </div>
            <!-- Start Top Feature -->
            @include('ecommerce.home.partials.top_features')
        </div>

    </div>

    <div class="bg-gray">
        <div class="container">
               @include('ecommerce.home.partials.feature_products', ['product_features' => $product_features])
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
<script src="{{ asset('js/panel/users/cart/cart_drawer.js') }}" defer></script>
<script src="{{ asset('js/panel/users/cart/cart_list.js') }}" defer></script>
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

    window.dataLayer = window.dataLayer || [];
        dataLayer.push({
        'event': 'home_page_view'
    });

</script>


@include('ecommerce.wishlist-js')
<script src="{{ asset('js/panel/users/lazyload.js') }}" defer></script>
@endpush