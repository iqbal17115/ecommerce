@extends('layouts.backend_app')
@section('title', 'Edit Product')

@section('styles')
<link href="{{ asset('css/admin/products/product-add.css') }}?v={{ time() }}" rel="stylesheet">
<link href="{{ asset('css/admin/products/category-loader.css') }}?v={{ time() }}" rel="stylesheet">
<!-- Bootstrap should already be loaded by your layout. -->
@endsection

@section('content')
<div class="add-product-container">
    <!-- <h1>Add Product</h1> -->
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
<script>
    const routeIndex = "{{ route('product.index') }}";
</script>

<script src="{{ asset('js/admin_panel/products/product-add.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/admin_panel/products/product-edit.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/admin_panel/category_loader.js') }}?v={{ time() }}"></script>
<script>
    window.PRODUCT_DATA = @json($product);
    window.EDIT_PRODUCT = @json($editProduct ?? []);
</script>

<script>
    // --- Summernote Initialization ---

    $(document).ready(function() {
        // Initialize Main Description
        $('#description').summernote({
            height: 120,
            placeholder: 'Please input the full product description details...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // Initialize Short Description
        $('#short_description').summernote({
            height: 120,
            placeholder: 'Enter a concise summary or brief description...',
            toolbar: [
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol']],
            ]
        });

        // Initialize Highlights
        $('#highlights').summernote({
            height: 120,
            placeholder: 'Enter key selling points or bulleted highlights...',
            toolbar: [
                ['para', ['ul']], // Only need bullet points for highlights
            ]
        });
    });
</script>
@endsection