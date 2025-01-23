@extends('layouts.ecommerce')
@push('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_css/global.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_css/my_account.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_css/custom_modal.css') }}">
@endpush
@section('content')
<style>
.order-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .order-header {
            font-size: 1.1rem;
            font-weight: bold;
        }
        .order-details {
            font-size: 0.9rem;
            color: #555;
        }
        .order-cancel {
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 0.85rem;
            float: right;
        }
        .btn-red {
            background-color: #ff4d4d;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            padding: 10px 15px;
            border: none;
        }
        .btn-red:hover {
            background-color: #e60000;
        }
        .speech-bubble {
            position: relative;
            background: #ff4d4d;
            color: white;
            padding: 10px;
            border-radius: 10px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
        }
        .speech-bubble:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 30px;
            width: 0;
            height: 0;
            border: 15px solid transparent;
            border-top-color: #ff4d4d;
            border-bottom: 0;
            margin-left: -15px;
            margin-bottom: -15px;
        }
        .invoice {
        background: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .invoice-header {
        padding: 15px;
        background-color: #007bff;
        color: #fff;
        border-radius: 10px 10px 0 0;
    }

    .invoice-header h4 {
        margin: 0;
        font-size: 1.5rem;
    }

    .invoice-details {
        padding: 20px;
        border-bottom: 1px solid #ddd;
    }

    .invoice-details p {
        margin: 0;
        line-height: 1.5;
    }

    .invoice-table th {
        background-color: #007bff;
        color: #fff;
        text-align: center;
        vertical-align: middle;
    }

    .invoice-table td {
        text-align: center;
    }

    .invoice-footer {
        padding: 20px;
        background-color: #f1f1f1;
        border-radius: 0 0 10px 10px;
    }

    .invoice-footer h5 {
        margin: 0;
        font-weight: bold;
        color: #333;
    }

    .invoice-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
    }

    .invoice-details p {
        margin: 0;
    }
    </style>
    <main class="main">
        <div id="temp_user_id" data-user_id="{{ $user_id }}"></div>
        <div class="bg-gray pt-2 pb-5">
            <div class="container">
            <div class="view-account">
                <section class="module">
                    <div class="module-inner">
                        <div class="side-bar">
                            <div class="user-info">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div class="user_profile_img">
                                            </div>
                                        </div>
                                    </div>
                                {{-- <center>
                                    <img class="img-profile img-circle img-responsive center-block"
                                        style="border-radius: 50%;" id="user_profile_img">
                                </center> --}}
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
                                @include('ecommerce.my-account.partials.your_payment')
                                @include('ecommerce.my-account.partials.your_transaction')
                                @include('ecommerce.my-account.partials.wishlist')
                                @include('ecommerce.my-account.partials.review_feedback')
                                @include('ecommerce.my-account.partials.cartlist')
                            </div>
                        </div>
                    </div>
                </section>
            </div>
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
    <script src="{{ asset('js/panel/users/my_account/my_account.js') }}"></script>
    <script src="{{ asset('js/panel/address/address.js') }}"></script>
    <script src="{{ asset('js/panel/users/my_account/my_transaction.js') }}"></script>

    <!-- My Account JS File -->
    <script>
        function userAddress() {
            loadUserAddress(@json($user->id ?? null));
        }

        $(document).ready(function() {
            $('#saerch_box').val();
            $('#from_date').val('');
            $('#to_date').val('');
            $('#saerch_box').val();

            userAddress();

            function loadUserOrder(user_id) {
                var code = $("#search_value").val();
                var start_date = $("#from_date").val();
                var end_date = $("#to_date").val();
                var items_per_page_select = $("#items_per_page_select").val();

                getDetails(
            "user-orders/lists?user_id=" + user_id + "&code="+code+ "&start_date="+start_date+ "&end_date="+end_date,
                (data) => {
                    console.log(data);
                        var orders = data.orders;
                        var container = $('#orders-container');
                        container.empty();

                        // Loop through the orders and append them to the container
                        $.each(data.results.data, function(index, order) {
                            var orderHtml = '<div class="card p-2">';
                            orderHtml += '<div class="card border border-dark">';
                            orderHtml += '<div class="card-body">';
                            orderHtml += '<div class="row">';
                            orderHtml += '<div class="col-md-4">';
                            orderHtml += '<h5 class="card-title p-0 m-0">Order ID# ' + order.code +
                                '</h5>';
                            orderHtml += '<p class="card-text">Ordered On: <a href="https://www.aladdinne.com/">aladdinne.com</a> </p>';
                            orderHtml += '</div>';
                            orderHtml +=
                                '<div class="col-md-4 d-flex justify-content-center align-items-center">';
                            orderHtml += '<div>';
                            orderHtml += '<h5 class="card-title p-0 m-0">Estimated Delivery</h5>';
                            orderHtml += '<p class="card-text">By </p>';
                            orderHtml += '</div>';
                            orderHtml += '</div>';
                            orderHtml +=
                                '<div class="col-md-2 d-flex justify-content-center align-items-center">';
                            orderHtml += '<div>';
                            orderHtml += '<h5 class="card-title p-0 m-0">Order Total</h5>';
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
                (error) => {

                }
            );
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
