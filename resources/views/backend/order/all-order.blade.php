@extends('layouts.backend_app')

@section('content')
<style>
.tracking-timeline {
    margin-top: 20px;
    border-left: 3px solid #d6d6d6;
    position: relative;
    padding-left: 20px;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
    padding-left: 40px;
}

.timeline-item.completed .timeline-icon {
    background: linear-gradient(145deg, #4caf50, #81c784);
    border-color: transparent;
    box-shadow: 0 0 8px rgba(76, 175, 80, 0.6);
}

.timeline-item.active .timeline-icon {
    background-color: #03a9f4;
    border-color: #03a9f4;
    box-shadow: 0 0 12px rgba(3, 169, 244, 0.7);
    transform: scale(1.2);
    transition: all 0.3s ease;
}

.timeline-item.pending .timeline-icon {
    background-color: #fbc02d;
    border-color: #fbc02d;
    box-shadow: none;
}

.timeline-item .timeline-icon {
    position: absolute;
    left: -25px;
    top: 0;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: bold;
    color: white;
}

.timeline-item .timeline-line {
    position: absolute;
    top: 30px;
    left: -10px;
    width: 3px;
    height: 100%;
    background: #d6d6d6;
}

.timeline-item.completed .timeline-line {
    background: #4caf50;
}

.timeline-content {
    margin-left: 20px;
    padding: 10px 15px;
    background: #f9f9f9;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
}

.timeline-content h6 {
    margin: 0 0 5px;
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

.timeline-content p {
    margin: 0;
    font-size: 14px;
    color: #666;
}

.timeline-content .timestamp {
    font-size: 12px;
    color: #999;
}
    </style>
    <div class="card">
        <div class="card-body">
            <div class="row mb-1">
                <div class="col-md-2">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="search_input" placeholder="Search...">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="bx bx-search-alt"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row mb-4">
                        <div class="col-lg-12">
                            <div class="input-daterange input-group" data-provide="datepicker">
                                <input type="date" class="form-control form-control-sm" placeholder="Start Date"
                                    name="start" />
                                <input type="date" class="form-control form-control-sm" placeholder="End Date"
                                    name="end" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <select class="form-control form-control-sm" id="order_status">
                        <option value="">-- Order Status --</option>
                        @foreach ($statusValues as $statusValue)
                            <option value="{{ $statusValue }}">{{ $statusValue }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex align-items-center justify-content-end">
                        <select class="form-control form-control-sm" id="itemsPerPageSelect">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="d-flex justify-content-end mb-3">
                        <div>
                            <button class="btn btn-success btn-sm" id="pdfBtn">Generate PDF</button>
                            <button class="btn btn-info btn-sm" id="csvBtn">Export CSV</button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="table-responsive">
                <table class="table table-centered nowrap" id="datatable-buttons">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Seller</th>
                            <th>Payment Status</th>
                            <th>Delivery Type</th>
                            <th>Fullfilment Status</th>
                            <th>View</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="order_container"></tbody>
                </table>
            </div>
            <div id="pagination_container" class="mt-3"></div>
            {{-- Order Tracking Modal --}}
        @include('backend.order.order-modal.order-tracking-modal')
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body order-modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    @include('backend.order.order-js')

    <script>
        $('#order_status').on('change', function() {
            getData(1);
        });

        $('#itemsPerPageSelect').on('change', function() {
            getData(1);
        });

        $('#search_input').on('keyup', function() {
            getData(1); // Trigger AJAX request with search query
        });

        $('input[name="start"], input[name="end"]').on('change', function() {
            // Get the values of both start and end date inputs
            const startDate = $('input[name="start"]').val();
            const endDate = $('input[name="end"]').val();

            // Check if both start and end dates are provided
            if (startDate && endDate) {
                // Call the getData function
                getData(1);
            }
        });


        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();

            // Remove 'active' class from all pagination items and add it to the clicked item
            $('.pagination li').removeClass('active');
            $(this).parent('li').addClass('active');

            // Extract the page number from the href attribute
            const page = $(this).data('page');

            // Call the function to fetch data for the clicked page
            getData(page);
        });

        function generatePagination(totalRecords, recordsPerPage, currentPage) {
            const totalPages = Math.ceil(totalRecords / recordsPerPage);
            let paginationHtml = '';

            if (totalPages > 1) {
                paginationHtml += '<ul class="pagination">';
                for (let i = 1; i <= totalPages; i++) {
                    const activeClass = i === currentPage ? 'active' : '';
                    paginationHtml +=
                        `<li class="page-item ${activeClass}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
                }
                paginationHtml += '</ul>';
            }

            return paginationHtml;
        }

        function getData(page) {
            const searchQuery = $('#search_input').val();
            const startDate = $('input[name="start"]').val(); // Get the start date value
            const endDate = $('input[name="end"]').val(); // Get the end date value
            const orderStatus = $("#order_status").val(); // Item per page
            const itemsPerPage = $("#itemsPerPageSelect").val(); // Item per page

            $.ajax({
                url: '/order_data',
                type: "get",
                data: {
                    status: orderStatus,
                    start: (page - 1) * itemsPerPage,
                    length: itemsPerPage,
                    search: {
                        value: searchQuery // Send search value as an object with a 'value' property
                    },
                    start_date: startDate,
                    end_date: endDate
                },
                dataType: 'json'
            }).done(function(data) {
                console.log(data['data']);
                const orderContainer = $('#order_container');
                orderContainer.empty(); // Clear any previous content

                data['data'].forEach(function(order, index) {
                    var url = `/advance-edit?id=${order.id}`;
                    const orderHtml = `
                                        <tr class="shadow-sm" id="order-row-${order.id}">
                                            <td style="font-weight: bold; font-size: 15px;">
                                                ${index+1}<br>
                                            </td>
                                            <td>
                                                ${new Date(order.order_date).toLocaleDateString('en-US', { weekday:"long", year:"numeric", month:"short", day:"numeric"}) }
                                            </td>
                                            <td>
                                                ${order.code}
                                            </td>
                                            <td>${order.user ? order.user.name : ''}</td>
                                            <td>${order.total_amount}</td>
                                            <td></td>
                                            <td><span class="badge badge-pill badge-soft-success font-size-12">Paid</span></td>
                                            <td><i class="fab fa-cc-mastercard mr-1"></i> Mastercard</td>
                                            <td>
                                                <span class="badge badge-danger font-size-14">${order.status.charAt(0).toUpperCase() + order.status.slice(1)}</span>
                                            </td>
                                            <td>
                                                <button type="button" data-order_id="${order.id}"
                                                    class="btn btn-primary btn-sm btn-rounded order_detail_modal" data-toggle="modal"
                                                    data-target=".exampleModal">
                                                    View
                                                </button>
                                            </td>
                                            <td>
                                                <a href="${url}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="Advance Edit" data-original-title="Advance Edit"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                <button 
                                                    type="button" 
                                                    class="btn btn-sm btn-primary view-tracking" 
                                                    data-order-id="${order.id}" 
                                                    data-toggle="modal" 
                                                    data-target="#orderTrackingModal">
                                                     Tracking
                                                </button>
                                            </td>
                                        </tr>
                                      `;

                    orderContainer.append(orderHtml);
                });
                // Create pagination links
                const paginationHtml = generatePagination(data.recordsTotal, itemsPerPage, page);
                $('#pagination_container').html(paginationHtml);

            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }

        getData(1); // Fetch data for the first page
        $(document).ready(function() {
            // Use event delegation for dynamically added elements
            $(document).on("click", ".order_detail_modal", function() {
                var order_id = $(this).data("order_id");
                $.ajax({
                    url: "{{ route('order-detail') }}",
                    method: 'get',
                    data: {
                        order_id: order_id
                    },
                    success: function(data) {
                        console.log(data['order_detail']);
                        modal_content =
                            '<p class="mb-2">Order Id: <span class="text-primary">' +
                            data['order']['code'] +
                            '</span></p><p class="mb-4">Billing Name: <span class="text-primary">' +
                            data['order']?.['user']?.['name'] + '</span></p>';
                        modal_content +=
                            '<div class="table-responsive"><table class="table table-centered table-nowrap">';
                        modal_content +=
                            '<thead><tr><th scope="col">Product</th><th scope="col">Product Name</th><th scope="col">Price</th></tr></thead>';
                        modal_content += '<tbody>';
                        for (var i = 0; i < data['order_detail'].length; i++) {
                            modal_content += '<tr>';
                            modal_content +=
                                '<th scope="row"><div><img id="order-product-id-' + data[
                                    'order_detail'][i]['id'] +
                                '" src="assets/images/product/img-7.png" alt="" class="avatar-sm"></div></th>';
                            modal_content +=
                                '<td><div><h5 class="text-truncate font-size-14" style="word-wrap: break-word;white-space: pre-line;">' +
                                data['order_detail'][i]['product']['name'] +
                                '</h5><p class="text-muted mb-0">$ ' + data['order_detail'][i][
                                    'unit_price'
                                ] + ' x ' + data['order_detail'][i]['quantity'] +
                                '</p></div></td>';
                            modal_content += '<td>$ ' + (data['order_detail'][i]['unit_price'] *
                                data['order_detail'][i]['quantity']) + '</td>';
                            modal_content += '</tr>';
                            $('#order-product-id-' + data['order_detail'][i]['id']).attr("src",
                                'storage/product_photo/' + data['order_detail'][i][
                                    'product_main_image'
                                ]['image']);
                        }
                        modal_content += '<tr>';
                        modal_content +=
                            '<td colspan="2"><h6 class="m-0 text-right">Sub Total:</h6></td>';
                        modal_content += '<td>$ 400</td>';
                        modal_content += '</tr>';
                        modal_content += '<tr>';
                        modal_content +=
                            '<td colspan="2"><h6 class="m-0 text-right">Shipping:</h6></td>';
                        modal_content += '<td>Free</td>';
                        modal_content += '</tr>';
                        modal_content += '<tr>';
                        modal_content +=
                            '<td colspan="2"><h6 class="m-0 text-right">Total:</h6></td>';
                        modal_content += '<td>$ 400</td>';
                        modal_content += '</tr>';
                        modal_content += '</tbody>';
                        modal_content += '</table></div>';
                        $('.order-modal-body').html(modal_content);
                        for (var i = 0; i < data['order_detail'].length; i++) {
                            $('#order-product-id-' + data['order_detail'][i]['id']).attr("src",
                                'storage/product_photo/' + data['order_detail'][i][
                                    'product_main_image'
                                ]['image']);
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
        });

        
        $(document).ready(function () {
    const orderTrackingStatuses = ['pending', 'processing', 'shipped', 'out_for_delivery', 'delivered'];

    $(document).on('click', '.view-tracking', function () {
        const orderId = $(this).data('order-id');
        const modalBody = $('#trackingDetails');

        // Clear the modal content and show loading initially
        modalBody.html('<p>Loading...</p>');
        $('#trackingModal').modal('show'); // Optionally show the modal first to avoid delays in modal rendering

        $.ajax({
            url: `/orders/${orderId}/track`,
            method: 'GET',
            success: function (response) {
                const { code, order_date, status, user, order_address, tracking_details } = response.results;

                let html = `
                            <div style="border: 2px solid #e74c3c; border-radius: 10px; overflow: hidden; width: 100%; margin: 10px auto; font-family: Arial, sans-serif; color: #333; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                                <!-- Header -->
                                <div style="background-color: #e74c3c; color: white; text-align: center; padding: 5px;">
                                    <p style="margin: 0; font-size: 14px;">SHIPPED FROM <strong>Aladdinne.com</strong></p>
                                </div>
                                
                                <!-- Estimate Delivery -->
                                <div style="background-color: #ffebe6; text-align: center; padding: 20px;">
                                    <p style="margin: 0; font-size: 16px; font-weight: bold; color: #e74c3c;">ESTIMATE DELIVERY DATE IS</p>
                                    <h1 style="margin: 10px 0; font-size: 22px; font-weight: bold; color: #333;">MON 18 DEC - FRI 29 DEC</h1>
                                </div>
                                
                                <!-- Order Info -->
                                <div style="padding: 5px; border-top: 2px solid #e74c3c;">
                                    <span style="margin: 0; font-size: 14px;"><strong>Order ID:</strong> #${code}</span>
                                    <span style="margin: 5px 0; font-size: 12px; color: #555; float: right;">${order_date}</span>
                                </div>
                                
                                <!-- Receiver Info -->
                                <div style="background-color: #f9f9f9; padding: 5px; border-top: 1px solid #ddd;">
                                    <p style="margin: 0; font-size: 14px;"><i class="fa fa-user" style="margin-right: 8px; color: #333;"></i> <strong>RECEIVER:</strong> ${user.name}</p>
                                    <p style="margin: 5px 0 0; font-size: 12px; color: #555;"><i class="fa fa-map-marker-alt" style="margin-right: 8px; color: #e74c3c;"></i> ${order_address.address}</p>
                                </div>
                            </div>
                          <div class="tracking-timeline">
                        `;

                // Sort the tracking details by created_at
                const sortedDetails = tracking_details.sort((a, b) =>
                    new Date(a.created_at) - new Date(b.created_at)
                );

                // Generate timeline for each status
                orderTrackingStatuses.forEach(trackingStatus => {
                    const detail = sortedDetails.find(d => d.status.toLowerCase() === trackingStatus.toLowerCase());
                    console.log(detail);
                    const isCompleted = orderTrackingStatuses.indexOf(trackingStatus) < orderTrackingStatuses.indexOf(status) ? 'completed' : '';
                    const isActive = trackingStatus === status ? 'active' : '';
                    const timelineClass = isCompleted || isActive ? `${isCompleted} ${isActive}` : 'pending';
                    const timestamp = detail ? detail['created_at'] : null;

                    html += `
                        <div style="display: flex; align-items: center; margin-bottom: 20px;">
        <div style="width: 50px; height: 50px; border-radius: 50%; background-color: ${timelineClass.includes('completed') ? '#28a745' : '#ffc107'}; color: white; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold; margin-right: 15px;">
            ${trackingStatus.charAt(0).toUpperCase()}
        </div>
        <div style="flex: 1; border-left: 2px solid ${timelineClass.includes('completed') ? '#28a745' : '#ffc107'}; padding-left: 15px; position: relative;">
            <h6 style="margin: 0; font-size: 16px; color: #333;">${trackingStatus.replace(/_/g, ' ').replace(/\b\w/g, char => char.toUpperCase())}</h6>
            ${timestamp ? `<p style="margin: 5px 0 0; font-size: 14px; color: #666;">${timestamp}</p>` : '<p style="margin: 5px 0 0; font-size: 14px; color: #666;">Not Available</p>'}
        </div>
    </div>
                    `;
                });

                html += '</div>';
                modalBody.html(html);

                // Ensure modal is visible after content is fully loaded
                setTimeout(function () {
                    $('#trackingModal').modal('show');
                }, 100); // A small timeout can help with any asynchronous rendering issues
            }
        });
    });
});

    </script>
@endpush
