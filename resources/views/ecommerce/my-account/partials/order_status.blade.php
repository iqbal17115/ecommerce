<div class="tab-pane fade" id="order_status">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="height: auto;">
                <div class="card-body">
                    <h3>Your Order Status</h3>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card" style="height: auto;">
                <div class="card-body">
                    <div class="col-md-5">
                        <form id="orderSearchForm" class="mb-0 w-lg-max mt-2 mt-md-0">
                            @csrf
                            <div class="footer-submit-wrapper d-flex align-items-center">
                                <input type="text" class="form-control mb-0" id="order_code" 
                                    placeholder="Enter Your Order Number ....." size="40" name="order_code" required>
                                <button type="submit" class="btn btn-sm icon-magnifier text-light brand_color min_width_auto"></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="order-detail-container">
        <!-- Order details will be loaded here -->
    </div>
</div>
