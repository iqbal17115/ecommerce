@extends('layouts.ecommerce')
@section('content')
<main class="main about">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Terms & Condition</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="about-section">
        <div class="container">
            @if($company_info && $company_info->terms_condition)
            {!! $company_info->terms_condition !!}
            @endif
        </div><!-- End .container -->
    </div><!-- End .about-section -->
</main><!-- End .main -->
@endsection
@push('scripts')
<script src="{{ asset('js/panel/users/common.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/add_to_cart.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_manager.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_drawer.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_list.js') }}?v={{ time() }}"></script>
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
