@extends('layouts.ecommerce')

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

        .font_size {
            font-size: 50px;
        }

        .card {
            height: 100%;
        }

        .view-account {
            font-family: Arial, sans-serif;
        }

        .dashed-border-card {
            border: 2px dashed #ccc;
        }

        .plus-icon {
            font-size: 48px;
            color: #ccc;
        }

        .add-address-text {
            font-size: 18px;
        }

        .properties-selector input[type=radio] {
  display: none !important;
}

.properties-selector input[type=radio] + label {
  display: inline-block;
  border-radius: 6px;
  background: #dddddd;
  padding: 5px;
  padding-left: 10px;
  padding-right: 10px;
  margin-right: 3px;
  text-align: center;
  cursor: pointer;
}

.properties-selector input[type=radio]:checked + label {
  background: #2AD705;
  color: #ffffff;
}
/* Style the accordion container */
.accordion {
    margin: 0 auto;
}

/* Style accordion titles */
.accordion-title {
    background-color: #f0f0f0;
    padding: 10px;
    cursor: pointer;
    user-select: none;
    border-bottom: 1px solid #ccc;
}

/* Hide the checkboxes */
.accordion-input {
    display: none;
}

/* Style accordion content (hidden by default) */
.accordion-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-in-out;
}

/* Style the active accordion item (when input is checked) */
.accordion-input:checked + .accordion-title + .accordion-content {
    max-height: 1000px; /* Set to a large enough value to show all content */
}

.weekDays-selector input[type=radio] {
    display: none!important;
}

.weekDays-selector label {
    display: inline-block;
    border-radius: 6px;
    background: #dddddd;
    margin-right: 3px;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 5px;
    padding-bottom: 5px;
    text-align: center;
    cursor: pointer;
}

.weekDays-selector input[type=radio]:checked + label {
    background: #688A85;
    color: #ffffff;
}
body {
            font-family: 'Roboto', sans-serif;
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
                            @include('ecommerce.my-account.partials.side_menu')
                        </div>

                        <div class="content-panel">
                            <div class="tab-content">
                                @include('ecommerce.my-account.partials.dashboard')
                                @include('ecommerce.my-account.partials.orders')
                                @include('ecommerce.my-account.partials.your_address')
                                @include('ecommerce.my-account.partials.order_status')
                                @include('ecommerce.my-account.partials.mobile_app')
                                @include('ecommerce.my-account.partials.mobile_app')
                                @include('ecommerce.my-account.partials.wishlist')
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main><!-- End .main -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection
@push('scripts')
    @include('ecommerce.wishlist-js')
    <script src="{{ asset('js/panel/address/address.js') }}"></script>

    <!-- My Account JS File -->
    <script>
        function userAddress() {
            loadUserAddress(@json($user->id ?? null));
        }

        $(document).ready(function() {


            userAddress();

            function loadUserOrder(user_id) {
                var search_value = $("#search_value").val();
                var from_date = $("#from_date").val();
                var to_date = $("#to_date").val();
                var items_per_page_select = $("#items_per_page_select").val();

                var url = `/user/orders`;
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        user_id: user_id,
                        code: search_value,
                        from_date: from_date,
                        to_date: to_date,
                        items_per_page_select: items_per_page_select
                    },
                    success: function(data) {
                        console.log(data);
                        var orders = data.orders;
                        var container = $('#orders-container');
                        container.empty();

                        // Loop through the orders and append them to the container
                        $.each(orders, function(index, order) {
                            var orderHtml = '<div class="card p-2">';
                            orderHtml += '<div class="card border border-dark">';
                            orderHtml += '<div class="card-body">';
                            orderHtml += '<div class="row">';
                            orderHtml += '<div class="col-md-4">';
                            orderHtml += '<h5 class="card-title">Order ID# ' + order.code +
                                '</h5>';
                            orderHtml += '<p class="card-text">Ordered On </p>';
                            orderHtml += '</div>';
                            orderHtml +=
                                '<div class="col-md-4 d-flex justify-content-center align-items-center">';
                            orderHtml += '<div>';
                            orderHtml += '<h5 class="card-title">Estimated Delivery</h5>';
                            orderHtml += '<p class="card-text">By </p>';
                            orderHtml += '</div>';
                            orderHtml += '</div>';
                            orderHtml +=
                                '<div class="col-md-2 d-flex justify-content-center align-items-center">';
                            orderHtml += '<div>';
                            orderHtml += '<h5 class="card-title">Order Total</h5>';
                            orderHtml += '<p class="card-text">Taka ' + order.payable_amount +
                                '</p>';
                            orderHtml += '</div>';
                            orderHtml += '</div>';
                            orderHtml +=
                                '<div class="col-md-2 justify-content-center align-items-center">';
                            orderHtml +=
                                `<a href="orders-tracking/${order.id}" class="btn btn-sm btn-primary mb-2">Track Package</a><br>`;
                            orderHtml +=
                                `<a href="user-cancel-order/${order.id}" class="btn btn-sm btn-danger mb-2">Cancel Order</a><br>`;
                            orderHtml +=
                                '<button class="btn btn-sm btn-success">Print Invoice</button>';
                            orderHtml += '</div>'; // Close the button div
                            orderHtml += '</div>'; // Close the row div
                            orderHtml += '</div>'; // Close the card-body div
                            orderHtml += '</div>'; // Close the card div

                            // Append the orderHtml to the container
                            container.append(orderHtml);

                            // Loop through the order details
                            $.each(order.order_detail, function(index, orderDetail) {
                                var orderDetailHtml = '<div class="row py-2">';
                                orderDetailHtml += '<div class="col-md-1">';
                                if (orderDetail.product != null) {
                                    orderDetailHtml += '<img src="' + orderDetail
                                        .product.name +
                                        '" style="width:70px; height:70px;" class="img-responsive">';
                                }
                                orderDetailHtml += '</div>';
                                orderDetailHtml += '<div class="col-md-5">';
                                if (orderDetail.product != null) {
                                    orderDetailHtml += '<h6 class="mb-3">' + orderDetail
                                        .product.name + '</h6>';
                                }
                                orderDetailHtml += '</div>';
                                orderDetailHtml += '<div class="col-md-2">';
                                orderDetailHtml +=
                                    '<h6 class="mb-3 badge badge-danger p-2 rounded">' +
                                    order.status + '</h6>';
                                orderDetailHtml += '</div>';
                                orderDetailHtml +=
                                    '<div class="col-md-2">Standard Delivery</div>';
                                orderDetailHtml += '<div class="col-md-2">';
                                // No buttons here
                                orderDetailHtml += '</div>';
                                orderDetailHtml += '</div>'; // Close the row div
                                // Append the orderDetailHtml to the container
                                container.append(orderDetailHtml);
                            });
                        });


                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
            $(document).on('change', 'select', function() {
                loadUserOrder(@json($user->id ?? null));
            });

            $(document).on('change input', 'input[type="date"]', function() {
                loadUserOrder(@json($user->id ?? null));
            });

            $(document).on('keyup', '.search_parameter', function() {
                loadUserOrder(@json($user->id ?? null));
            });

            loadUserOrder(@json($user->id ?? null));
        });
    </script>
@endpush
