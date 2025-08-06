<div class="checkout-box shadow-sm p-4 rounded bg-white">
    <h5 class="mb-4 font-weight-bold">Your Order</h5>

    <!-- Product Block -->
    <div id="productBlockList"></div>

    <!-- Payment Method -->
    <div class="mb-3">
        <!-- <h6 class="font-weight-bold">Select Payment Method</h6> -->
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
            <span>Subtotal (<span class="total_item_count">0</span> Item)</span>
            <span class="cart_total_price">0</span>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <span>Shipping Fee</span>
            <span class="shipping_charge_amount"></span>
        </div>
        <hr class="my-2">
        <div class="d-flex justify-content-between font-weight-bold">
            <span>Total (VAT Inclusive if Applicable)</span>
            <span class="grand_total_price"></span>
        </div>
    </div>

    <!-- Coupon Section -->
    <div class="apply-coupon mt-3">
        <div class="input-group">
            <input type="text" class="form-control" id="coupon_code" placeholder="Enter coupon code">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="applyCouponBtn">Apply</button>
            </div>
        </div>
        <small id="couponFeedback" class="form-text text-muted mt-1"></small>
    </div>

    <!-- Order Button -->
    <div class="text-right mt-2">
        <button type="button" class="btn btn-warning btn-block font-weight-bold mb-sm-4 mb-md-0" id="placeOrderBtn">Order Place</button>
    </div>
</div>