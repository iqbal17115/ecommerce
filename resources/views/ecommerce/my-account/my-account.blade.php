@extends('layouts.ecommerce')
@push('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('web_css/global.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_css/my_account.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_css/custom_modal.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web/user/my_account.css') }}">
@endpush
@section('content')

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

                    var orders = data.orders;
                    var container = $('#orders-container');
                    container.empty();
console.log(data.results.data);
                // Loop through the orders and append them to the container
                $.each(data.results.data, function (index, order) {
                var orderHtml = `
                    <div class="card mb-4 shadow-lg border-0">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Order ID# ${order.code}</h5>
                            <a href="https://www.aladdinne.com/" target="_blank" class="text-light text-decoration-none">
                                Ordered On: aladdinne.com
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h6 class="text-muted">Estimated Delivery</h6>
                                    <p class="fw-bold text-dark">By TBD</p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h6 class="text-muted">Order Total</h6>
                                    <p class="fs-5 fw-bold text-success">৳ ${order.payable_amount}</p>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="orders-tracking/${order.id}" class="btn btn-outline-primary btn-sm me-2">Track Package</a>
                                    <a href="user-cancel-order/${order.id}" class="btn btn-outline-danger btn-sm me-2">Cancel Order</a>
                                    <button class="btn btn-outline-success btn-sm">Print Invoice</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <h6 class="text-muted">Order Details</h6>
                            ${Array.isArray(order.order_detail) && order.order_detail.length > 0 ? order.order_detail.map(orderDetail => `
                                <div class="row py-3 border-bottom">
                                    <div class="col-md-1 text-center">
                                        ${orderDetail.product
                                            ? `<img src="${orderDetail.product.image}" class="img-fluid rounded" style="max-width: 60px;" alt="Product">`
                                            : '<span class="text-muted">No Image</span>'
                                        }
                                    </div>
                                    <div class="col-md-5">
                                        <h6 class="mb-1">${orderDetail.product ? orderDetail.product.name : 'Product not available'}</h6>
                                        <small class="text-muted">${orderDetail.product ? orderDetail.product.description : ''}</small>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <span class="badge bg-danger">${order.status}</span>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <span class="text-muted">Standard Delivery</span>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            `).join('') : '<p class="text-muted">No order details available.</p>'}
                        </div>
                    </div>
                `;
                    // Append the orderHtml to the container
                    container.append(orderHtml);
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

        document.getElementById('toggle-filters').addEventListener('click', function () {
            const filterSection = document.getElementById('filter-section');
            const toggleIcon = document.getElementById('toggle-icon');
            const toggleText = document.getElementById('toggle-text');

            if (filterSection.style.display === 'none' || !filterSection.style.display) {
                filterSection.style.display = 'block';
                toggleIcon.style.transform = 'rotate(180deg)';
                toggleText.textContent = 'Hide Filters';
            } else {
                filterSection.style.display = 'none';
                toggleIcon.style.transform = 'rotate(0deg)';
                toggleText.textContent = 'Show Filters';
            }
        });
    </script>

@endpush
