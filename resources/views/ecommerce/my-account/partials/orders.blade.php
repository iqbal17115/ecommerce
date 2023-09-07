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
                            <input type="text" class="form-control" placeholder="Search..." aria-label="Search"
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
                            <input type="date" class="form-control">
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    {{-- End From Date --}}

                    {{-- Start Item Per Page --}}
                    <div class="col-md-3">
                        <select class="form-control form-control-sm" id="itemsPerPageSelect" style="height: 25px;">
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
            <div class="card-body">
                <h5 class="card-title mb-4">Order Details</h5>

                @foreach ($user->Contact?->Order as $userOrder)
                    <div class="card p-2">
                        {{-- Start Order Header --}}
                        <div class="card border border-dark">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="card-title">Order ID# {{ $userOrder->code }}</h5>
                                        <p class="card-text">Ordered On
                                            {{ date('d M Y H:i', strtotime($userOrder->order_date)) }}</p>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                                        <div>
                                            <h5 class="card-title">Estimated Delivery</h5>
                                            <p class="card-text">By
                                                {{ $userOrder?->orderProductBox?->first()?->pickup_day }} -
                                                {{ $userOrder?->orderProductBox?->first()?->pickup_time }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                                        <div>
                                            <h5 class="card-title">Order Total</h5>
                                            <p class="card-text">Taka {{ $userOrder?->payable_amount }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Order Header --}}
                        @foreach ($userOrder->OrderDetail as $orderDetail)
                            <div class="row py-2">
                                <div class="col-md-1">
                                    <img src="{{ asset('storage/product_photo/' . $orderDetail->Product?->ProductImage?->first()->image) }}"
                                        style="width:70px; height: 70px;" class="img-responsive">
                                </div>
                                <div class="col-md-5">
                                    <h6 class="mb-3">{{ $orderDetail?->Product?->name }}</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6 class="mb-3 badge badge-danger p-2 rounded">
                                        {{ ucfirst($userOrder?->status) }}
                                    </h6>

                                </div>
                                <div class="col-md-2">
                                    Standard Delivery
                                </div>
                                <div class="col-md-2">

                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
