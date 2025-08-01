<div class="checkout-box shadow-sm p-4 rounded bg-white">
    <h5 class="mb-4 font-weight-bold">Your Order</h5>

    <!-- Product Block -->
    <div class="d-flex align-items-start mb-3">
        <img src="{{ asset('images/products/puma-shirt.png') }}" alt="Product Image" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
        <div class="ml-3">
            <h6 class="mb-1 font-weight-bold">Premium Puma Basic T-Shirt</h6>
            <small>Brand: Puma, Size: XL, Color: Black</small>
            <div class="d-flex align-items-center mt-2">
                <span class="font-weight-bold text-dark mr-3">279 Taka</span>

                <div class="quantity-control">
                    <button class="btn btn-qty btn-decrease" type="button">−</button>
                    <input type="text" class="qty-input" value="1" readonly>
                    <button class="btn btn-qty btn-increase" type="button">+</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Method -->
    <div class="mb-3">
        <h6 class="font-weight-bold">Select Payment Method</h6>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
            <label class="form-check-label" for="cod">
                &nbsp;Cash On Delivery
            </label>
        </div>
    </div>

    <!-- Order Summary -->
    <div class="order-summary border-top pt-3">
        <div class="d-flex justify-content-between mb-2">
            <span>Subtotal (1 Item)</span>
            <span>Taka 279</span>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <span>Shipping Fee</span>
            <span>Taka 100</span>
        </div>
        <hr>
        <div class="d-flex justify-content-between font-weight-bold">
            <span>Total (VAT Inclusive if Applicable)</span>
            <span>Taka 379</span>
        </div>
    </div>

    <!-- Order Button -->
    <div class="text-right mt-4">
        <button type="button" class="btn btn-warning btn-block font-weight-bold" id="placeOrderBtn">Order Place</button>
    </div>
</div>