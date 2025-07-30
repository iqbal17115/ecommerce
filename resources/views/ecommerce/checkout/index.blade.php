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
<script src="{{ asset('js/checkout/checkout.js') }}?v={{ time() }}"></script>
 <script src="{{ asset('js/panel/users/common.js') }}?v={{ time() }}"></script>
@endpush