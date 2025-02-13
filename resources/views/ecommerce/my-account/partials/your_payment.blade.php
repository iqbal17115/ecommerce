<div class="tab-pane fade" id="your_payment">
    <h2 class="tab-title">Your Payment</h2>

    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12 mb-2">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success">{{ number_format($userBalance, 2) }}</h3>
                                <span>Your Balance</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-wallet success font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12 mb-2">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success">{{ number_format($totalPurchase, 2) }}</h3>
                                <span>Your Purchases</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-basket success font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12 mb-2">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success">{{ number_format($totalReturns, 2) }}</h3>
                                <span>Your Returns</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-refresh success font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12 mb-2">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success">{{ number_format($totalRefunds, 2) }}</h3>
                                <span>Your Refunds</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-credit-card success font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12 mb-2">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success">{{ number_format($totalPayments, 2) }}</h3>
                                <span>Your Payments</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-wallet success font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        
        <!-- Total Discounts -->
    <div class="col-xl-3 col-sm-6 col-12 mb-2">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="success">{{ number_format($totalDiscounts, 2) }}</h3>
                            <span>Total Discounts</span>
                        </div>
                        <div class="align-self-center">
                            <i class="icon-tag success font-large-2 float-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Shipping Charges -->
    <div class="col-xl-3 col-sm-6 col-12 mb-2">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="success">{{ number_format($totalShippingCharges, 2) }}</h3>
                            <span>Total Shipping Charges</span>
                        </div>
                        <div class="align-self-center">
                            <i class="icon-truck success font-large-2 float-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Due Amount -->
    <div class="col-xl-3 col-sm-6 col-12 mb-2">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="danger">{{ number_format($totalDueAmount, 2) }}</h3>
                            <span>Total Due Amount</span>
                        </div>
                        <div class="align-self-center">
                            <i class="icon-credit-card danger font-large-2 float-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="col-xl-3 col-sm-6 col-12 mb-2">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="info">{{ $totalOrders }}</h3>
                            <span>Total Orders</span>
                        </div>
                        <div class="align-self-center">
                            <i class="icon-basket-loaded info font-large-2 float-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
