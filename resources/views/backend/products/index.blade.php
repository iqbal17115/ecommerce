@extends('layouts.backend_app')
@section('title', 'Edit Product')

@section('styles')
<link href="{{ asset('css/admin/products/product-add.css') }}?v={{ time() }}" rel="stylesheet">
<!-- Bootstrap should already be loaded by your layout. -->
@endsection

@section('content')
<div class="add-product-container">
        <h1>Add Product</h1>
            {{-- HIDDEN FIELDS TO CARRY STEP 1 DATA TO STEP 2 AND FINAL SUBMISSION --}}
            <input type="hidden" name="product_name" id="hiddenProductName">
            <input type="hidden" name="category_id" id="hiddenCategoryId">
            <input type="hidden" name="category_path" id="hiddenCategoryPath">

            {{-- Basic Information and Category (Step 1) --}}
            <div class="form-section basic-info-category-step">
                @include('backend.products.partials.basic_info_category')
            </div>

            {{-- Product Details, Price, Stock & Variants, Shipping (Step 2) --}}
            <div class="form-section product-details-step" style="display: none;">
                @include('backend.products.partials.product_details')
            </div>
    </div>
@endsection

@section('script')
   <script src="{{ asset('js/admin_panel/products/product-add.js') }}?v={{ time() }}"></script>
@endsection
