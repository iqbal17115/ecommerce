<div class="checkout-box shadow-sm p-4 rounded bg-white">
    <h5 class="mb-4 font-weight-bold">Your Order</h5>

    <!-- Product Block -->
    <div id="productBlockList"></div>

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