@extends('layouts.ecommerce')
@push('links')
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ URL::asset('aladdinne/') }}/assets/css/bootstrap.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ URL::asset('aladdinne/') }}/assets/css/style.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('aladdinne/') }}/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('aladdinne/') }}/assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
@endpush
@section('content')
    <main class="main">

        <div class="container account-container custom-account-container">
            <div class="row">
                <div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
                    <h2 class="text-uppercase">My Account</h2>
                    <ul class="nav nav-tabs list flex-column mb-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="order-tab" data-toggle="tab" href="#order" role="tab"
                                aria-controls="order" aria-selected="true">Order History</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                                aria-controls="address" aria-selected="false">Addresses</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                                aria-controls="address" aria-selected="false">Service Requests</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="wishlist-tab" data-toggle="tab" href="#wishlist" role="tab"
                                aria-controls="wishlist" aria-selected="false">Wishlist</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="download-tab" data-toggle="tab" href="#download" role="tab"
                                aria-controls="download" aria-selected="false">Reviews</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                                aria-controls="edit" aria-selected="false">Profile
                                details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="shop-address-tab" data-toggle="tab" href="#shipping" role="tab"
                                aria-controls="edit" aria-selected="false">Payment Options</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="login.html">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9 order-lg-last order-1 tab-content">

                    <div class="tab-pane fade show active" id="order" role="tabpanel">
                        <div class="order-content">
                            <h3 class="account-sub-title d-none d-md-block"><i
                                    class="sicon-social-dropbox align-middle mr-3"></i>Orders</h3>
                            <div class="order-table-container text-center">
                                <table class="table table-order text-left">
                                    <thead>
                                        <tr>
                                            <th class="order-id">ORDER</th>
                                            <th class="order-date">DATE</th>
                                            <th class="order-status">STATUS</th>
                                            <th class="order-price">TOTAL</th>
                                            <th class="order-action">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach (Auth::user()?->Contact?->Order as $order)
                                            <tr>
                                                <td><a href="javascript: void(0);"
                                                        class="text-body font-weight-bold">{{ $order->code }}</a> </td>
                                                <td>
                                                    {{ date('d-M-Y H:i', strtotime($order->order_date)) }}
                                                </td>
                                                <td>
                                                    {{ ucwords($order->status) }}
                                                </td>
                                                <td>
                                                    {{ $order->total_amount }}
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr class="mt-0 mb-3 pb-2" />

                                <a href="category.html" class="btn btn-dark">Go Shop</a>
                            </div>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="download" role="tabpanel">
                        <div class="download-content">
                            <h3 class="account-sub-title d-none d-md-block"><i
                                    class="sicon-cloud-download align-middle mr-3"></i>Downloads</h3>
                            <div class="download-table-container">
                                <p>No downloads available yet.</p> <a href="category.html"
                                    class="btn btn-primary text-transform-none mb-2">GO SHOP</a>
                            </div>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="address" role="tabpanel">
                        <h3 class="account-sub-title d-none d-md-block mb-1"><i
                                class="sicon-location-pin align-middle mr-3"></i>Addresses</h3>
                        <div class="addresses-content">
                            <p class="mb-4">
                                The following addresses will be used on the checkout page by
                                default.
                            </p>

                            <div class="row">
                                <div class="address col-md-6">
                                    <div class="heading d-flex">
                                        <h4 class="text-dark mb-0">Billing address</h4>
                                    </div>

                                    <div class="address-box">
                                        You have not set up this type of address yet.
                                    </div>

                                    <a href="#billing" class="btn btn-default address-action link-to-tab">Add
                                        Address</a>
                                </div>

                                <div class="address col-md-6 mt-5 mt-md-0">
                                    <div class="heading d-flex">
                                        <h4 class="text-dark mb-0">
                                            Shipping address
                                        </h4>
                                    </div>

                                    <div class="address-box">
                                        You have not set up this type of address yet.
                                    </div>

                                    <a href="#shipping" class="btn btn-default address-action link-to-tab">Add
                                        Address</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="wishlist" role="tabpanel">
                        <div class="order-content">
                            <h3 class="account-sub-title d-none d-md-block"><i
                                    class="sicon-social-dropbox align-middle mr-3"></i>Orders</h3>
                            <div class="order-table-container text-center">

                                <table class="table table-wishlist mb-0">
                                    <thead>
                                        <tr>
                                            <th class="thumbnail-col"></th>
                                            <th class="product-col">Product</th>
                                            <th class="price-col">Price</th>
                                            <th class="status-col">Stock Status</th>
                                            <th class="action-col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Auth::user()?->wishlist as $list)
                                            <tr class="product-row">
                                                <td>
                                                    <figure class="product-image-container">
                                                        <a href="product.html" class="product-image">
                                                            <img @if ($list?->product?->ProductMainImage) src="{{ asset('storage/product_photo/' . $list?->product?->ProductMainImage->image) }}" @endif
                                                                alt="product">
                                                        </a>

                                                        <a href="#" class="btn-remove icon-cancel"
                                                            title="Remove Product"></a>
                                                    </figure>
                                                </td>
                                                <td>
                                                    <h5 class="product-title">
                                                        <a href="product.html">{{ $list?->product->name }}</a>
                                                    </h5>
                                                </td>
                                                <td class="price-box">
                                                    @if (
                                                        $list?->product->sale_price &&
                                                            $list?->product->sale_start_date &&
                                                            $list?->product->sale_end_date &&
                                                            $list?->product->sale_start_date <= now() &&
                                                            $list?->product->sale_end_date >= now())
                                                        {{ $currency->icon }}{{ number_format($list?->product->sale_price, 2) }}
                                                    @else
                                                        {{ $currency->icon }}{{ number_format($list?->product->your_price, 2) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="stock-status">In stock</span>
                                                </td>
                                                <td class="action">
                                                    <button href="javascript:void(0);" title="Add To Cart"
                                                    data-id="{{ $list?->product->id }}" data-name="{{ $list?->product->name }}"
                                                    data-your_price="{{ $list?->product->your_price }}"
                                                    data-sale_price="{{ $list?->product->sale_price }}"
                                                    @if ($list?->product->ProductMainImage) data-image="{{ $list?->product->ProductMainImage->image }}" @endif class="btn btn-dark btn-add-cart product-type-simple btn-shop">
                                                        ADD TO CART
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr class="mt-0 mb-3 pb-2" />

                                <a href="category.html" class="btn btn-dark">Go Shop</a>
                            </div>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="edit" role="tabpanel">
                        <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
                                class="icon-user-2 align-middle mr-3 pr-1"></i>Account Details</h3>
                        <div class="account-content">
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="acc-name">First name <span class="required">*</span></label>
                                            <input type="text" class="form-control" placeholder="Editor"
                                                id="acc-name" name="acc-name" required />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="acc-lastname">Last name <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="acc-lastname"
                                                name="acc-lastname" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="acc-text">Display name <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="acc-text" name="acc-text"
                                        placeholder="Editor" required />
                                    <p>This will be how your name will be displayed in the account section and
                                        in
                                        reviews</p>
                                </div>


                                <div class="form-group mb-4">
                                    <label for="acc-email">Email address <span class="required">*</span></label>
                                    <input type="email" class="form-control" id="acc-email" name="acc-email"
                                        placeholder="editor@gmail.com" required />
                                </div>

                                <div class="change-password">
                                    <h3 class="text-uppercase mb-2">Password Change</h3>

                                    <div class="form-group">
                                        <label for="acc-password">Current Password (leave blank to leave
                                            unchanged)</label>
                                        <input type="password" class="form-control" id="acc-password"
                                            name="acc-password" />
                                    </div>

                                    <div class="form-group">
                                        <label for="acc-password">New Password (leave blank to leave
                                            unchanged)</label>
                                        <input type="password" class="form-control" id="acc-new-password"
                                            name="acc-new-password" />
                                    </div>

                                    <div class="form-group">
                                        <label for="acc-password">Confirm New Password</label>
                                        <input type="password" class="form-control" id="acc-confirm-password"
                                            name="acc-confirm-password" />
                                    </div>
                                </div>

                                <div class="form-footer mt-3 mb-0">
                                    <button type="submit" class="btn btn-dark mr-0">
                                        Save changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="billing" role="tabpanel">
                        <div class="address account-content mt-0 pt-2">
                            <h4 class="title">Billing address</h4>

                            <form class="mb-2" action="#">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First name <span class="required">*</span></label>
                                            <input type="text" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last name <span class="required">*</span></label>
                                            <input type="text" class="form-control" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Company </label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="select-custom">
                                    <label>Country / Region <span class="required">*</span></label>
                                    <select name="orderby" class="form-control">
                                        <option value="" selected="selected">British Indian Ocean Territory
                                        </option>
                                        <option value="1">Brunei</option>
                                        <option value="2">Bulgaria</option>
                                        <option value="3">Burkina Faso</option>
                                        <option value="4">Burundi</option>
                                        <option value="5">Cameroon</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Street address <span class="required">*</span></label>
                                    <input type="text" class="form-control" placeholder="House number and street name"
                                        required />
                                    <input type="text" class="form-control"
                                        placeholder="Apartment, suite, unit, etc. (optional)" required />
                                </div>

                                <div class="form-group">
                                    <label>Town / City <span class="required">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>

                                <div class="form-group">
                                    <label>State / Country <span class="required">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>

                                <div class="form-group">
                                    <label>Postcode / ZIP <span class="required">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>

                                <div class="form-group mb-3">
                                    <label>Phone <span class="required">*</span></label>
                                    <input type="number" class="form-control" required />
                                </div>

                                <div class="form-group mb-3">
                                    <label>Email address <span class="required">*</span></label>
                                    <input type="email" class="form-control" placeholder="editor@gmail.com" required />
                                </div>

                                <div class="form-footer mb-0">
                                    <div class="form-footer-right">
                                        <button type="submit" class="btn btn-dark py-4">
                                            Save Address
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="shipping" role="tabpanel">
                        <div class="address account-content mt-0 pt-2">
                            <h4 class="title mb-3">Shipping Address</h4>

                            <form class="mb-2" action="#">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First name <span class="required">*</span></label>
                                            <input type="text" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last name <span class="required">*</span></label>
                                            <input type="text" class="form-control" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Company </label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="select-custom">
                                    <label>Country / Region <span class="required">*</span></label>
                                    <select name="orderby" class="form-control">
                                        <option value="" selected="selected">British Indian Ocean Territory
                                        </option>
                                        <option value="1">Brunei</option>
                                        <option value="2">Bulgaria</option>
                                        <option value="3">Burkina Faso</option>
                                        <option value="4">Burundi</option>
                                        <option value="5">Cameroon</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Street address <span class="required">*</span></label>
                                    <input type="text" class="form-control" placeholder="House number and street name"
                                        required />
                                    <input type="text" class="form-control"
                                        placeholder="Apartment, suite, unit, etc. (optional)" required />
                                </div>

                                <div class="form-group">
                                    <label>Town / City <span class="required">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>

                                <div class="form-group">
                                    <label>State / Country <span class="required">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>

                                <div class="form-group">
                                    <label>Postcode / ZIP <span class="required">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>

                                <div class="form-footer mb-0">
                                    <div class="form-footer-right">
                                        <button type="submit" class="btn btn-dark py-4">
                                            Save Address
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->
@endsection
@push('scripts')
    <!-- Plugins JS File -->
    <script src="{{ URL::asset('aladdinne/') }}/assets/js/jquery.min.js"></script>
    <script src="{{ URL::asset('aladdinne/') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('aladdinne/') }}/assets/js/plugins.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ URL::asset('aladdinne/') }}/assets/js/main.min.js"></script>
    @include('ecommerce.wishlist-js')
@endpush
