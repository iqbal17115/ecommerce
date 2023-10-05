@extends('layouts.ecommerce')
@push('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_css/global.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_css/my_account.css') }}">
@endpush
@section('content')
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
