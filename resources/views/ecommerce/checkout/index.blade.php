@extends('layouts.ecommerce')

@section('content')
<link rel="stylesheet" href="{{ asset('css/web/user/checkout/checkout.css') }}?v={{ time() }}">
<div class="container py-5">
    <div class="row">
        <!-- Left: Shipping Details -->
        <div class="col-md-6">
            @include('ecommerce.checkout.partials.shipping-form')
        </div>

        <!-- Right: Order Summary -->
        <div class="col-md-6">
            @include('ecommerce.checkout.partials.order-summary')
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/panel/users/common.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_manager.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_drawer.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_active_item_list.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/address.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/checkout/place_order.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/apply_coupon.js') }}?v={{ time() }}"></script>

<script>
    // Set the hasCartList variable
    window.hasCartList = false;
    // Set the hasCartActiveItemList variable
    window.hasCartActiveItemList = true;

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