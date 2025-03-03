<div class="tab-pane fade @if ($type != 'wishlist') show active @endif" id="dashboard">
    <div class="grey-bg container-fluid">
        <section id="minimal-statistics">
            <div class="row">
                <div class="col-12 mt-3 mb-1">
                    <h4 class="text-uppercase">{{ $user->name }}'s dashboard</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <a class="nav-link custom_link" href="#orders" data-toggle="tab">
                        <div class="card shadow-sm">
                            <div class="card-content">
                                <div class="card-body p-4">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i
                                                class="fa fa-shopping-cart text-info font-large-2 float-left font_size"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>Your Orders</h3>
                                            <span class="text-dark">View Orders, Cancel an Order, Download
                                                Invoice</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-content">
                            <div class="card-body p-4">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-home font-large-2 float-left font_size"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>Your Address</h3>
                                        <span class="text-dark">Edit, Remove and Purchase a new Gift Card</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <a class="nav-link custom_link" href="#order_status" data-toggle="tab">
                        <div class="card shadow-sm">
                            <div class="card-content">
                                <div class="card-body p-4">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fas fa-truck font-large-2 float-left font_size"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>Order Status</h3>
                                            <span class="text-dark">Track Your Order</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a class="nav-link custom_link" href="#cartlist" data-toggle="tab">
                        <div class="card shadow-sm">
                            <div class="card-content">
                                <div class="card-body p-4">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fa fa-shopping-cart font-large-2 float-left font_size"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>Cart</h3>
                                            <span class="text-dark">View, Modify, Share your cart
                                                list.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a class="nav-link custom_link" href="#wishlist" data-toggle="tab">
                        <div class="card shadow-sm">
                            <div class="card-content">
                                <div class="card-body p-4">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="far fa-heart font-large-2 float-left font_size"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>Wishlist</h3>
                                            <span class="text-dark">View, Modify, Share your wish
                                                list.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4 under_development">
                    <div class="card shadow-sm">
                        <div class="card-content">
                            <div class="card-body p-4">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-gift font-large-2 float-left font_size"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>Reward & Gift Card</h3>
                                        <span class="text-dark">View Balance and Purchase a
                                            new Gift Card</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <a class="nav-link custom_link" href="#your_payment" data-toggle="tab">
                        <div class="card shadow-sm">
                            <div class="card-content">
                                <div class="card-body p-4">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fas fa-money-bill font-large-2 float-left font_size"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>Your Payment</h3>
                                            <span class="text-dark">View Aladdiinne Balance,
                                                Manage or Add Payment
                                                Methods.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-4">
                    <a class="nav-link custom_link" href="#your_transactions" data-toggle="tab">
                        <div class="card shadow-sm">
                            <div class="card-content">
                                <div class="card-body p-4">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fas fa-exchange-alt font-large-2 float-left font_size"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>Transaction</h3>
                                            <span class="text-dark">View your Transactions.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-content">
                            <div class="card-body p-4">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-calendar font-large-2 float-left font_size"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>Installment Plan</h3>
                                        <span class="text-dark">View Installment Plans
                                            Offered.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <a class="nav-link custom_link" href="#return_exchange" data-toggle="tab">
                        <div class="card shadow-sm">
                            <div class="card-content">
                                <div class="card-body p-4">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fas fa-arrow-left float-left font_size"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>Return & Exchange</h3>
                                            <span class="text-dark">View and manage Your Raturn
                                                Orders</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-4 under_development">
                    <div class="card shadow-sm">
                        <div class="card-content">
                            <div class="card-body p-4">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fas fa-store-alt font-large-2 float-left font_size"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>Following Stores</h3>
                                        <span class="text-dark">View and Modify your
                                            Following Stores</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <a class="nav-link" href="#review_feedback" data-toggle="tab">
                        <div class="card shadow-sm">
                            <div class="card-content">
                                <div class="card-body p-4">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="far fa-comments float-left font_size"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>Review & Feedback</h3>
                                            <span class="text-dark">View the previous reviews &
                                                feedback you have submitted.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-4 under_development">
                    <div class="card shadow-sm">
                        <div class="card-content">
                            <div class="card-body p-4">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fas fa-mobile-alt float-left font_size"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>Mobile App</h3>
                                        <span class="text-dark">Download the Aladdinne
                                            Mobile App.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-content">
                            <div class="card-body p-4">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-address-book float-left font_size"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>Contact Us</h3>
                                        <span class="text-dark">Massage, Help Article and
                                            Contact Us.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4"></div>
            </div>
        </section>
    </div>
</div>