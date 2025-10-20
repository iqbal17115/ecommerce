@extends('layouts.backend_app')
@section('title', 'Edit Product')

@section('styles')
<link href="{{ asset('css/admin/products/product-add.css') }}" rel="stylesheet">
<!-- Bootstrap should already be loaded by your layout. -->
@endsection

@section('content')
<div class="container py-4">
        @csrf
        @method(isset($product) ? 'PUT' : 'POST')

        @include('backend.products.partials.header')

        <div class="row mt-3">
            <div class="col-md-8">
                @include('backend.products.partials.basic-info')
                @include('backend.products.partials.product-images')
                @include('backend.products.partials.specs')
                @include('backend.products.partials.description')
            </div>

            <div class="col-md-4">
                @include('backend.products.partials.price-variants')
                @include('backend.products.partials.shipping-warranty')
            </div>
        </div>

        @include('backend.products.partials.footer-actions')
</div>
@endsection

@section('script')
   <script src="{{ asset('js/admin_panel/products/product-add.js') }}"></script>
@endsection
