@extends('layouts.ecommerce')
@push('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('web_css/global.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_css/my_account.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_css/custom_modal.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web/user/my_account.css') }}?v={{ time() }}">
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
    const searchValue = $("#search_value").val();
    const startDate = $("#from_date").val();
    const endDate = $("#to_date").val();
    const itemsPerPage = $("#items_per_page_select").val();

    // Construct query parameters
    const params = new URLSearchParams({
        user_id: user_id,
        code: searchValue,
        limit: itemsPerPage,
        start_date: startDate,
        end_date: endDate
    }).toString();

    getDetails(`user-orders/lists?${params}`, (data) => {
        const container = $('#orders-container');
        container.empty();

        if (!data.results.data.length) {
            container.append('<p class="text-muted text-center">No orders found.</p>');
            return;
        }

        $.each(data.results.data, (index, order) => {
            container.append(generateOrderCard(order));
        });
    }, (error) => {
        console.error("Error fetching user orders:", error);
    });
}

// Function to format price (adds currency symbol and comma separators)
function formatPrice(amount) {
    return new Intl.NumberFormat('en-BD', { 
        style: 'currency', 
        currency: 'BDT', 
        minimumFractionDigits: 2 
    }).format(amount).replace('BDT', '৳');
}

// Function to format quantity (removes decimals if unnecessary)
function formatQuantity(quantity) {
    return quantity % 1 === 0 ? quantity : quantity.toFixed(2);
}

// Function to generate order card HTML
function generateOrderCard(order) {
    // Use the dates directly from the backend API response
    let orderDate = formatDate(order.order_date);
    let estimatedDeliveryDate = order.estimate_delivery_date;

    return `
        <div class="card mb-4 shadow-lg border-0">
            <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #f4631b;">
                <h5 class="m-0">Order ID# ${order.code}</h5>
                <a href="https://www.aladdinne.com/" target="_blank" class="text-light text-decoration-none">
                    Ordered On: aladdinne.com
                </a>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h6 class="text-muted">Order Date</h6>
                        <p class="fw-bold text-dark">${orderDate}</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <h6 class="text-muted">Estimated Delivery</h6>
                        <p class="fw-bold text-dark">${estimatedDeliveryDate}</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="orders-tracking/${order.id}" class="btn btn-outline-primary btn-sm me-2" style="text-decoration: none;">Track Package</a>
                        <a href="user-cancel-order/${order.id}" class="btn btn-outline-danger btn-sm me-2" style="text-decoration: none;">Cancel Order</a>
                        <button class="btn btn-outline-success btn-sm" onclick="printInvoice('${order.id}')">Print Invoice</button>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <h6 class="text-muted">Order Details</h6>
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${generateOrderDetails(order.order_details)}
                    </tbody>
                </table>
            </div>
        </div>
    `;
}

// Function to format order date
function formatDate(date) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('en-US', options);
}

// Function to generate order details HTML
function generateOrderDetails(orderDetails) {
    if (!Array.isArray(orderDetails) || orderDetails.length === 0) {
        return '<tr><td colspan="4" class="text-muted text-center">No order details available.</td></tr>';
    }

    return orderDetails.map(orderDetail => `
        <tr>
            <td>
                <div class="d-flex align-items-center">
                    ${`<img src="${orderDetail.image}" class="img-fluid rounded me-2" style="width: 50px; height: 50px;" alt=""> `}
                </div>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="ml-1">${orderDetail.product_name || 'Product not available'}</span>
                </div>
            </td>
            <td class="text-center">${formatPrice(orderDetail.unit_price)}</td>
            <td class="text-center">${formatQuantity(orderDetail.quantity)} pcs</td>
            <td class="text-center">${formatPrice(orderDetail.total_amount)}</td>
        </tr>
    `).join('');
}


            $(document).on('change', 'select', function() {
                loadUserOrder(@json($user->id ?? null));
            });

            $(document).on('change input', 'input[type="date"]', function() {
                loadUserOrder(@json($user->id ?? null));
            });

            $(document).on('input', '.search_parameter', function() {
                loadUserOrder(@json($user->id ?? null));
            });

            loadUserOrder(@json($user->id ?? null));
        });

        function toggleFilter() {
        var section = document.getElementById("filterSection");
        section.style.display = section.style.display === "none" ? "block" : "none";
    }

        // Function to generate order card HTML
        function generateOrderDetailCard(order) {
            return `
                <div class="card mb-4 shadow-lg border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center" style="background-color: #f4631b;">
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
                                <p class="fs-5 fw-bold text-success">${formatDetailPrice(order.payable_amount)}</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="orders-tracking/${order.id}" class="btn btn-outline-primary btn-sm me-2" style="text-decoration: none;">Track Package</a>
                                <a href="user-cancel-order/${order.id}" class="btn btn-outline-danger btn-sm me-2" style="text-decoration: none;">Cancel Order</a>
                                <button class="btn btn-outline-success btn-sm" onclick="printInvoice('${order.id}')">Print Invoice</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <h6 class="text-muted">Order Details</h6>
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th class="text-center">Unit Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${generateOrderDetailsCard(order.order_details)}
                            </tbody>
                        </table>
                    </div>
                </div>
            `;
        }

        // Function to format price (adds currency symbol and comma separators)
        function formatDetailPrice(amount) {
            return new Intl.NumberFormat('en-BD', { 
                style: 'currency', 
                currency: 'BDT', 
                minimumFractionDigits: 2 
            }).format(amount).replace('BDT', '৳');
        }

        // Function to format quantity (removes decimals if unnecessary)
        function formatDetailQuantity(quantity) {
            return quantity % 1 === 0 ? quantity : quantity.toFixed(2);
        }

        // Function to generate order details HTML
        function generateOrderDetailsCard(orderDetails) {
            if (!Array.isArray(orderDetails) || orderDetails.length === 0) {
                return '<tr><td colspan="4" class="text-muted text-center">No order details available.</td></tr>';
            }

            return orderDetails.map(orderDetail => `
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            ${`<img src="${orderDetail.image}" class="img-fluid rounded me-2" style="width: 50px; height: 50px;" alt=""> `}
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="ml-1">${orderDetail.product_name || 'Product not available'}</span>
                        </div>
                    </td>
                    <td class="text-center">${formatDetailPrice(orderDetail.unit_price)}</td>
                    <td class="text-center">${formatDetailQuantity(orderDetail.quantity)} pcs</td>
                    <td class="text-center">${formatDetailPrice(orderDetail.total_amount)}</td>
                </tr>
            `).join('');
        }

        $(document).on('submit', '#orderSearchForm', function(e) {
            e.preventDefault(); // Prevent default form submission
            
            let orderCode = $('#order_code').val().trim(); // Get input value
            
            let params = new URLSearchParams({ order_code: orderCode }).toString();
            getDetails(`user-orders/order-details?${params}`, (data) => {
                const container = $('#order-detail-container');
                container.empty();

                if (!data.results) {
                    // container.append('<p class="text-muted text-center">No orders found.</p>');
                    return;
                }

                // Append the generated order tracking UI
                container.append(generateOrderTrackingUI(data.results.order_statuses, data.results.order_tracking, data.results.status_messages));

                container.append(generateOrderDetailCard(data.results));
            });
        });

        // Function to generate order tracking UI with status messages
        function generateOrderTrackingUI(orderStatuses, trackingData, statusMessages) {
            const trackingContainer = $('<div class="row justify-content-between mb-3"></div>');
            const messageContainer = $('<div class="status-message-container"></div>');

            orderStatuses.forEach(orderStatus => {
                let matchingItem = trackingData.find(item => item.status === orderStatus);
                let completed = matchingItem !== undefined;
                let desiredCreatedAt = completed ? matchingItem.created_at : null;
                let statusMessage = statusMessages[orderStatus] || ''; // Get message or empty string

                let trackingHTML = `
                    <div class="order-tracking ${completed ? 'completed' : ''}">
                        <span class="is-complete"></span>
                        <p>${orderStatus.charAt(0).toUpperCase() + orderStatus.slice(1)}
                            <br><span>${desiredCreatedAt ? formatDate(desiredCreatedAt) : ''}</span>
                        </p>
                    </div>
                `;
                trackingContainer.append(trackingHTML);

                if (completed && statusMessage) {
                    let messageHTML = `
                        <div class="d-flex p-3" style="font-size: 16px;">
                            <span class="badge badge-primary badge-pill mr-5">${formatDateTime(desiredCreatedAt)}</span>
                            ${statusMessage}
                        </div>
                    `;
                    messageContainer.append(messageHTML);
                }
            });

            return $('<div></div>').append(trackingContainer).append(messageContainer);
        }

        // Function to format date
        function formatDate(dateStr) {
            let date = new Date(dateStr);
            return date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
        }

        // Function to format date and time
        function formatDateTime(dateStr) {
            let date = new Date(dateStr);
            return date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) +
                ' ' + date.toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });
        }

        function printInvoice(orderId) {
            const printWindow = window.open(`/my-orders/invoice/${orderId}`, '_blank');
            printWindow.onload = function() {
                printWindow.print();
            };
        }
    </script>

@endpush
