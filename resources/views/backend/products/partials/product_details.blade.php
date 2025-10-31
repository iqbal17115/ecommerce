<div class="product-details-content">

    {{-- START: MAIN CONTENT WRAPPER FOR STICKY SIDEBAR --}}
    <div class="main-content-flex-wrapper d-flex">

        {{-- LEFT COLUMN: All scrollable content --}}
        <div class="col-md-9 p-0 main-form-content">
            <!-- Basic Information -->
            @include('backend.products.partials.basic_information')

            <!-- Specification -->
            @include('backend.products.partials.specification')

            <!-- Price, Stock & Variants -->
            @include('backend.products.partials.price_stock_variants')

            <!-- Product Description -->
            @include('backend.products.partials.description')

            <!-- Shipping & Warranty -->
            @include('backend.products.partials.shipping_warranty')

        </div>

        <!-- Right Sidebar -->
        @include('backend.products.partials.right_sidebar')

    </div>
    {{-- END: MAIN CONTENT WRAPPER FOR STICKY SIDEBAR --}}

</div>