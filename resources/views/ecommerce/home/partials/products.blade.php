<div class="home-product-section py-4">

    {{-- Section Title --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0" style="font-size: 20px;">Just For You</h4>
        <a href="#" class="text-primary" style="font-size: 14px;">View More</a>
    </div>

    <div class="row g-3">

        @foreach($home_products as $product)
            {{-- PRODUCT CARD 1 --}}
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <div class="product-card shadow-sm bg-white rounded p-2 h-100">

                <div class="product-img-wrapper position-relative">
                    <img src="{{ $product['image'] }}"
                         class="product-img img-fluid">

                    <span class="discount-badge">-25%</span>
                </div>

                <div class="pt-2">
                    <div class="product-name text-truncate-2">
                        {{ $product['name'] }}
                    </div>

                    <div class="mt-1">
                        <span class="price fw-bold text-danger">{{ $product['price'] }}</span>
                        <small class="old-price text-muted ms-1">{{ $product['special_price'] }}</small>
                    </div>

                    <div class="rating-sold d-flex align-items-center mt-1" style="font-size: 12px;">
                        <span class="text-warning">&#9733;</span>
                        <span class="ms-1">4.8</span>
                        <span class="text-muted ms-2">| Sold 1.2k</span>
                    </div>

                    <div class="mt-2">
                        <span class="badge bg-light text-dark border">
                            <i class="fa fa-truck me-1"></i> Free Delivery
                        </span>
                    </div>
                </div>

            </div>
        </div>

        {{-- PRODUCT CARD 2 --}}
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <div class="product-card shadow-sm bg-white rounded p-2 h-100">
                <div class="product-img-wrapper position-relative">
                    <img src="{{ $product['image'] }}"
                         class="product-img img-fluid">

                    <span class="discount-badge">-18%</span>
                </div>

                <div class="pt-2">
                    <div class="product-name text-truncate-2">
                        Realme Buds Air 5 Pro - Dual Driver ANC Earbuds
                    </div>

                    <div class="mt-1">
                        <span class="price fw-bold text-danger">৳4,899</span>
                        <small class="old-price text-muted ms-1">৳5,990</small>
                    </div>

                    <div class="rating-sold d-flex align-items-center mt-1" style="font-size: 12px;">
                        <span class="text-warning">&#9733;</span>
                        <span class="ms-1">4.5</span>
                        <span class="text-muted ms-2">| Sold 850</span>
                    </div>

                    <div class="mt-2">
                        <span class="badge bg-light text-dark border">
                            <i class="fa fa-truck me-1"></i> Free Delivery
                        </span>
                    </div>
                </div>

            </div>
        </div>
        @endforeach

    </div>
</div>
