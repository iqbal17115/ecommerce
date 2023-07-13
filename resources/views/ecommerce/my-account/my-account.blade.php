@extends('layouts.ecommerce')
@push('links')
@endpush
@push('css')
@endpush
@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        /* Responsive Styles */
        body {
            background: #f9f9fb !important;
        }

        .view-account {
            background: #FFFFFF !important;
            margin-top: 20px !important;
        }

        .view-account .pro-label {
            font-size: 13px !important;
            padding: 4px 5px !important;
            position: relative !important;
            top: -5px !important;
            margin-left: 10px !important;
            display: inline-block !important;
        }

        .view-account .side-bar {
            padding-bottom: 30px !important;
        }

        .view-account .side-bar .user-info {
            text-align: center !important;
            margin-bottom: 15px !important;
            padding: 30px !important;
            color: #616670 !important;
            border-bottom: 1px solid #f3f3f3 !important;
        }

        .view-account .side-bar .user-info .img-profile {
            width: 120px !important;
            height: 120px !important;
            margin-bottom: 15px !important;
        }

        .view-account .side-bar .user-info .meta li {
            margin-bottom: 10px !important;
        }

        .view-account .side-bar .user-info .meta li span {
            display: inline-block !important;
            width: 100px !important;
            margin-right: 5px !important;
            text-align: right !important;
        }

        .view-account .side-bar .user-info .meta li a {
            color: #616670 !important;
        }

        .view-account .side-bar .user-info .meta li.activity {
            color: #a2a6af !important;
        }

        .view-account .side-bar .side-menu {
            text-align: center !important;
        }

        .view-account .side-bar .side-menu .nav {
            display: inline-block !important;
            margin: 0 auto !important;
        }

        .view-account .side-bar .side-menu .nav>li {
            font-size: 14px !important;
            margin-bottom: 0 !important;
            border-bottom: none !important;
            display: inline-block !important;
            float: left !important;
            margin-right: 15px !important;
            margin-bottom: 15px !important;
        }

        .view-account .side-bar .side-menu .nav>li:last-child {
            margin-right: 0 !important;
        }

        .view-account .side-bar .side-menu .nav>li>a {
            display: inline-block !important;
            color: #9499a3 !important;
            padding: 5px !important;
            border-bottom: 2px solid transparent !important;
        }

        .view-account .side-bar .side-menu .nav>li>a:hover {
            color: #616670 !important;
            background: none !important;
        }

        .view-account .side-bar .side-menu .nav>li.active a {
            color: #40babd !important;
            border-bottom: 2px solid #40babd !important;
            background: none !important;
            border-right: none !important;
        }

        .theme-2 .view-account .side-bar .side-menu .nav>li.active a {
            color: #6dbd63 !important;
            border-bottom-color: #6dbd63 !important;
        }

        .theme-3 .view-account .side-bar .side-menu .nav>li.active a {
            color: #497cb1 !important;
            border-bottom-color: #497cb1 !important;
        }

        .theme-4 .view-account .side-bar .side-menu .nav>li.active a {
            color: #ec6952 !important;
            border-bottom-color: #ec6952 !important;
        }

        .view-account .side-bar .side-menu .nav>li .icon {
            display: block !important;
            font-size: 24px !important;
            margin-bottom: 5px !important;
        }

        .view-account .content-panel {
            padding: 30px !important;
        }

        .view-account .content-panel .title {
            margin-bottom: 15px !important;
            margin-top: 0 !important;
            font-size: 18px !important;
        }

        .view-account .content-panel .fieldset-title {
            padding-bottom: 15px !important;
            border-bottom: 1px solid #eaeaf1 !important;
            margin-bottom: 30px !important;
            color: #616670 !important;
            font-size: 16px !important;
        }

        .view-account .content-panel .avatar .figure img {
            float: right !important;
            width: 64px !important;
        }

        .view-account .content-panel .content-header-wrapper {
            position: relative !important;
            margin-bottom: 30px !important;
        }

        .view-account .content-panel .content-header-wrapper .actions {
            position: absolute !important;
            right: 0 !important;
            top: 0 !important;
        }

        .view-account .content-panel .content-utilities {
            position: relative !important;
            margin-bottom: 30px !important;
        }

        .view-account .content-panel .content-utilities .btn-group {
            margin-right: 5px !important;
            margin-bottom: 15px !important;
        }

        .view-account .content-panel .content-utilities .fa {
            font-size: 16px !important;
            margin-right: 0 !important;
        }

        .view-account .content-panel .content-utilities .page-nav {
            position: absolute !important;
            right: 0 !important;
            top: 0 !important;
        }

        .view-account .content-panel .content-utilities .page-nav .btn-group {
            margin-bottom: 0
        }

        .view-account .content-panel .content-utilities .page-nav .indicator {
            color: #a2a6af !important;
            margin-right: 5px !important;
            display: inline-block !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item {
            position: relative !important;
            padding: 10px !important;
            border-bottom: 1px solid #f3f3f3 !important;
            color: #616670 !important;
            overflow: hidden !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item>div {
            float: left !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .icheck {
            background-color: #fff !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item:hover {
            background: #f9f9fb !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item:nth-child(even) {
            background: #fcfcfd !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item:nth-child(even):hover {
            background: #f9f9fb !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item a {
            color: #616670 !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item a:hover {
            color: #494d55 !important;
            text-decoration: none !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .checkbox-container,
        .view-account .content-panel .mails-wrapper .mail-item .star-container {
            display: inline-block !important;
            margin-right: 5px !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .star-container .fa {
            color: #a2a6af !important;
            font-size: 16px !important;
            vertical-align: middle !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .star-container .fa.fa-star {
            color: #f2b542 !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .star-container .fa:hover {
            color: #868c97 !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-to {
            display: inline-block !important;
            margin-right: 5px !important;
            min-width: 120px !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject {
            display: inline-block !important;
            margin-right: 5px !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label {
            margin-right: 5px !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label:last-child {
            margin-right: 10px !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label a,
        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label a:hover {
            color: #fff !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-1 {
            background: #f77b6b !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-2 {
            background: #58bbee !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-3 {
            background: #f8a13f !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-4 {
            background: #ea5395 !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-5 {
            background: #8a40a7 !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .time-container {
            display: inline-block !important;
            position: absolute !important;
            right: 10px !important;
            top: 10px !important;
            color: #a2a6af !important;
            text-align: left
        }

        .view-account .content-panel .mails-wrapper .mail-item .time-container .attachment-container {
            display: inline-block !important;
            color: #a2a6af !important;
            margin-right: 5px !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .time-container .time {
            display: inline-block !important;
            text-align: right !important;
        }

        .view-account .content-panel .mails-wrapper .mail-item .time-container .time.today {
            font-weight: 700 !important;
            color: #494d55 !important;
        }

        .drive-wrapper {
            padding: 15px !important;
            background: #f5f5f5 !important;
            overflow: hidden !important;
        }

        .drive-wrapper .drive-item {
            width: 130px !important;
            margin-right: 15px !important;
            display: inline-block !important;
            float: left !important;
        }

        .drive-wrapper .drive-item:hover {
            box-shadow: 0 1px 5px rgba(0, 0, 0, .1) !important;
            z-index: 1 !important;
        }

        .drive-wrapper .drive-item-inner {
            padding: 15px !important;
        }

        .drive-wrapper .drive-item-title {
            margin-bottom: 15px !important;
            max-width: 100px !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }

        .drive-wrapper .drive-item-title a {
            color: #494d55 !important;
        }

        .drive-wrapper .drive-item-title a:hover {
            color: #40babd !important;
        }

        .theme-2 .drive-wrapper .drive-item-title a:hover {
            color: #6dbd63 !important;
        }

        .theme-3 .drive-wrapper .drive-item-title a:hover {
            color: #497cb1
        }

        .theme-4 .drive-wrapper .drive-item-title a:hover {
            color: #ec6952 !important;
        }

        .drive-wrapper .drive-item-thumb {
            width: 100px !important;
            height: 80px !important;
            margin: 0 auto !important;
            color: #616670 !important;
        }

        .drive-wrapper .drive-item-thumb a {
            -webkit-opacity: .8 !important;
            -moz-opacity: .8 !important;
            opacity: .8 !important;
        }

        .drive-wrapper .drive-item-thumb a:hover {
            -webkit-opacity: 1 !important;
            -moz-opacity: 1 !important;
            opacity: 1 !important;
        }

        .drive-wrapper .drive-item-thumb .fa {
            display: inline-block !important;
            font-size: 36px !important;
            margin: 0 auto !important;
            margin-top: 20px !important;
        }

        .drive-wrapper .drive-item-footer .utilities {
            margin-bottom: 0 !important;
        }

        .drive-wrapper .drive-item-footer .utilities li:last-child {
            padding-right: 0 !important;
        }

        .drive-list-view .name {
            width: 60% !important;
        }

        .drive-list-view .name.truncate {
            max-width: 100px !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }

        .drive-list-view .type {
            width: 15px !important;
        }

        .drive-list-view .date,
        .drive-list-view .size {
            max-width: 60px !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }

        .drive-list-view a {
            color: #494d55 !important;
        }

        .drive-list-view a:hover {
            color: #40babd !important;
        }

        .theme-2 .drive-list-view a:hover {
            color: #6dbd63 !important;
        }

        .theme-3 .drive-list-view a:hover {
            color: #497cb1 !important;
        }

        .theme-4 .drive-list-view a:hover {
            color: #ec6952 !important;
        }

        .drive-list-view td.date,
        .drive-list-view td.size {
            color: #a2a6af !important;
        }

        @media (max-width:767px) {
            .view-account .content-panel .title {
                text-align: center !important;
            }

            .view-account .side-bar .user-info {
                padding: 0 !important;
            }

            .view-account .side-bar .user-info .img-profile {
                width: 60px !important;
                height: 60px !important;
            }

            .view-account .side-bar .user-info .meta li {
                margin-bottom: 5px !important;
            }

            .view-account .content-panel .content-header-wrapper .actions {
                position: static !important;
                margin-bottom: 30px !important;
            }

            .view-account .content-panel {
                padding: 0 !important;
            }

            .view-account .content-panel .content-utilities .page-nav {
                position: static !important;
                margin-bottom: 15px !important;
            }

            .drive-wrapper .drive-item {
                width: 100px !important;
                margin-right: 5px !important;
                float: none !important;
            }

            .drive-wrapper .drive-item-thumb {
                width: auto !important;
                height: 54px !important;
            }

            .drive-wrapper .drive-item-thumb .fa {
                font-size: 24px !important;
                padding-top: 0 !important;
            }

            .view-account .content-panel .avatar .figure img {
                float: none !important;
                margin-bottom: 15px !important;
            }

            .view-account .file-uploader {
                margin-bottom: 15px !important;
            }

            .view-account .mail-subject {
                max-width: 100px !important;
                white-space: nowrap !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
            }

            .view-account .content-panel .mails-wrapper .mail-item .time-container {
                position: static !important;
            }

            .view-account .content-panel .mails-wrapper .mail-item .time-container .time {
                width: auto !important;
                text-align: left !important;
            }
        }

        @media (min-width:768px) {
            .view-account .side-bar .user-info {
                padding: 0 !important;
                padding-bottom: 15px !important;
            }

            .view-account .mail-subject .subject {
                max-width: 200px !important;
                white-space: nowrap !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
            }
        }

        @media (min-width:992px) {
            .view-account .content-panel {
                min-height: 1200px !important;
                border-left: 1px solid #f3f3f7 !important;
                margin-left: 200px !important;
            }

            .view-account .mail-subject .subject {
                max-width: 280px !important;
                white-space: nowrap !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
            }

            .view-account .side-bar {
                position: absolute !important;
                width: 200px !important;
                min-height: 600px !important;
            }

            .view-account .side-bar .user-info {
                margin-bottom: 0 !important;
                border-bottom: none !important;
                padding: 30px !important;
            }

            .view-account .side-bar .user-info .img-profile {
                width: 120px !important;
                height: 120px !important;
            }

            .view-account .side-bar .side-menu {
                text-align: left !important;
            }

            .view-account .side-bar .side-menu .nav {
                display: block !important;
            }

            .view-account .side-bar .side-menu .nav>li {
                display: block !important;
                float: none !important;
                font-size: 14px !important;
                border-bottom: 1px solid #f3f3f7 !important;
                margin-right: 0 !important;
                margin-bottom: 0 !important;
            }

            .view-account .side-bar .side-menu .nav>li>a {
                display: block !important;
                color: #9499a3 !important;
                padding: 10px 15px !important;
                padding-left: 30px !important;
            }

            .view-account .side-bar .side-menu .nav>li>a:hover {
                background: #f9f9fb !important;
            }

            .view-account .side-bar .side-menu .nav>li.active a {
                background: #f9f9fb !important;
                border-right: 4px solid #40babd !important;
                border-bottom: none !important;
            }

            .theme-2 .view-account .side-bar .side-menu .nav>li.active a {
                border-right-color: #6dbd63 !important;
            }

            .theme-3 .view-account .side-bar .side-menu .nav>li.active a {
                border-right-color: #497cb1 !important;
            }

            .theme-4 .view-account .side-bar .side-menu .nav>li.active a {
                border-right-color: #ec6952 !important;
            }

            .view-account .side-bar .side-menu .nav>li .icon {
                font-size: 24px !important;
                vertical-align: middle !important;
                text-align: center !important;
                width: 40px !important;
                display: inline-block !important;
            }
        }

        @media (min-width:1220px) {
            .container {
                max-width: 1500px;
            }
        }

        .table-wishlist {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .table-wishlist th,
        .table-wishlist td {
            padding: 10px;
            vertical-align: middle;
        }

        .table-wishlist th.thumbnail-col,
        .table-wishlist th.product-col,
        .table-wishlist th.price-col,
        .table-wishlist th.status-col,
        .table-wishlist th.action-col {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .table-wishlist .product-row {
            background-color: #ffffff;
        }
    </style>
    <main class="main">
        <div class="container">
            <div class="view-account">
                <section class="module">
                    <div class="module-inner">
                        <div class="side-bar">
                            <div class="user-info">
                                <center>
                                    <img class="img-profile img-circle img-responsive center-block"
                                        style="border-radius: 50%;" src="{{ asset('customer.jpg') }}" alt="">
                                </center>
                                <ul class="meta list list-unstyled">
                                    <li class="name">{{ $user->name }}
                                        {{-- <label class="label label-info">UX Designer</label> --}}
                                    </li>
                                    <li class="email"><a href="#">{{ Auth::user()->mobile }}</a></li>
                                </ul>
                            </div>
                            <nav class="side-menu">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#orders" data-toggle="tab">
                                            <i class="fas fa-shopping-cart"></i>
                                            Your Orders
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#address" data-toggle="tab">
                                            <i class="fas fa-map-marker-alt"></i>
                                            Your Address
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#order-status" data-toggle="tab">
                                            <i class="fas fa-check-circle"></i>
                                            Order Status
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#mobile-app" data-toggle="tab">
                                            <i class="fas fa-mobile-alt"></i>
                                            Mobile App
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#wishlist" data-toggle="tab">
                                            <i class="fas fa-heart"></i>
                                            Wishlist
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#reward-gift-card" data-toggle="tab">
                                            <i class="fas fa-gift"></i>
                                            Reward & Gift Card
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#your-payment" data-toggle="tab">
                                            <i class="fas fa-credit-card"></i>
                                            Your Payment
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#transactions" data-toggle="tab">
                                            <i class="fas fa-exchange-alt"></i>
                                            Transactions
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#installation-plan" data-toggle="tab">
                                            <i class="fas fa-wrench"></i>
                                            Installation Plan
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#return-exchange" data-toggle="tab">
                                            <i class="fas fa-exchange-alt"></i>
                                            Return & Exchange
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#review-feedback" data-toggle="tab">
                                            <i class="fas fa-comment"></i>
                                            Review & Feedback
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#contact-us" data-toggle="tab">
                                            <i class="fas fa-envelope"></i>
                                            Contact Us
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#switch-accounts" data-toggle="tab">
                                            <i class="fas fa-users"></i>
                                            Switch Accounts
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sign-out" data-toggle="tab">
                                            <i class="fas fa-sign-out-alt"></i>
                                            Sign Out
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <div class="content-panel">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="orders">
                                    <h6 class="tab-title">Your Orders</h6>
                                    <div class="table-responsive">
                                        <table class="table table-wishlist shadow">
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

                                                @foreach ($user->Contact?->Order as $order)
                                                    <tr>
                                                        <td><a href="javascript: void(0);"
                                                                class="text-body font-weight-bold">{{ $order->code }}</a>
                                                        </td>
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
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address">
                                    <h6 class="tab-title">Your Address</h6>
                                    <form>
                                        <!-- Address form fields go here -->
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="order-status">
                                    <h6 class="tab-title">Order Status</h6>
                                    <p>This is the order status page.</p>
                                </div>
                                <div class="tab-pane fade" id="mobile-app">
                                    <h6 class="tab-title">Mobile App</h6>
                                    <p>Download our mobile app for a better shopping experience.</p>
                                </div>
                                <div class="tab-pane fade" id="wishlist">
                                    <h6 class="tab-title">Wishlist</h6>
                                    <table class="table table-wishlist mb-0 shadow">
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
                                            @foreach ($user?->wishlist as $list)
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

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main><!-- End .main -->
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    @include('ecommerce.wishlist-js')
@endpush
