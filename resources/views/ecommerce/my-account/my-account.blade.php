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
                                aria-controls="order" aria-selected="true">Your Orders</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                                aria-controls="address" aria-selected="false">Your Address</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="order_status-tab" data-toggle="tab" href="#order_status" role="tab"
                                aria-controls="order_status" aria-selected="false">Order Status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="mobile_app-tab" data-toggle="tab" href="#mobile_app" role="tab"
                                aria-controls="mobile_app" aria-selected="false">Mobile App</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="wishlist-tab" data-toggle="tab" href="#wishlist" role="tab"
                                aria-controls="wishlist" aria-selected="false">Wishlist</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                                aria-controls="address" aria-selected="false">Reward & Gift Card</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="shop-address-tab" data-toggle="tab" href="#shipping" role="tab"
                                aria-controls="edit" aria-selected="false">Your Payment</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="transaction-tab" data-toggle="tab" href="#transaction" role="tab"
                                aria-controls="edit" aria-selected="false">Transactions</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="transaction-tab" data-toggle="tab" href="#transaction" role="tab"
                                aria-controls="edit" aria-selected="false">Installation Plan</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="transaction-tab" data-toggle="tab" href="#transaction" role="tab"
                                aria-controls="edit" aria-selected="false">Return & Exchange</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="download-tab" data-toggle="tab" href="#download" role="tab"
                            aria-controls="download" aria-selected="false">Review & Feedback</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="contact_us-tab" data-toggle="tab" href="#contact_us" role="tab"
                                aria-controls="contact_us" aria-selected="false">Contact Us</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="switch_account-tab" data-toggle="tab" href="#switch_account" role="tab"
                                aria-controls="switch_account" aria-selected="false">Switch Accounts</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="login.html">Sign Out</a>
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
                                                        data-id="{{ $list?->product->id }}"
                                                        data-name="{{ $list?->product->name }}"
                                                        data-your_price="{{ $list?->product->your_price }}"
                                                        data-sale_price="{{ $list?->product->sale_price }}"
                                                        @if ($list?->product->ProductMainImage) data-image="{{ $list?->product->ProductMainImage->image }}" @endif
                                                        class="btn btn-dark btn-add-cart product-type-simple btn-shop">
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
