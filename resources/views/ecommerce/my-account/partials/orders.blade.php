<div class="tab-pane fade" id="orders">
    <div class="row">
        @include('ecommerce.my-account.partials.filters.sales')
        <input type="date" id="from_date" class="form-control search_parameter" style="display: none;">
                            <input type="date" id="to_date" class="form-control search_parameter" style="display: none;">
    </div>

    <div class="card shadow">
        <h5 class="card-title mb-4">Order Details</h5>
        <div class="card-body" id="orders-container"></div>
    </div>
</div>