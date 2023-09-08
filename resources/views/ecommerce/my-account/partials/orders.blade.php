<div class="tab-pane fade" id="orders">
    <h6 class="tab-title">Your Orders</h6>

    {{-- Order Searching Menu --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card p-2" style="height: 40px;">
                <div class="row">
                    {{-- Start Search Box --}}
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="saerch_box"><i class='fas fa-search'></i></span>
                            </div>
                            <input type="text" class="form-control search_parameter" id="search_value" placeholder="Search..." aria-label="Search"
                                aria-describedby="saerch_box">
                        </div>
                    </div>
                    {{-- End Search Box --}}

                    {{-- Start From Date --}}
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Date Wise Search</span>
                            </div>
                            <input type="date" id="from_date" class="form-control search_parameter">
                            <input type="date" id="to_date" class="form-control search_parameter">
                        </div>
                    </div>
                    {{-- End From Date --}}

                    {{-- Start Item Per Page --}}
                    <div class="col-md-3">
                        <select class="form-control search_parameter form-control-sm" id="items_per_page_select" style="height: 25px;">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </div>
                    {{-- End Item Per Page --}}

                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <div class="card shadow">
            <h5 class="card-title mb-4">Order Details</h5>
            <div class="card-body" id="orders-container">


            </div>
        </div>
    </div>
</div>
