@extends('layouts.backend_app')

@section('content')
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
                <div class="col-md-5">
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
                <div class="col-md-3">
                    <div class="d-flex justify-content-end mb-3">
                        <div>
                            <button class="btn btn-primary btn-sm" id="printBtn">Print</button>
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
                                    <th>View Details</th>
                        </tr>
                    </thead>
                    <tbody id="order_container"></tbody>
                </table>
            </div>
            <div id="pagination_container" class="mt-3"></div>
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
            const itemsPerPage = $("#itemsPerPageSelect").val(); // Item per page

            $.ajax({
                url: '/order_data',
                type: "get",
                data: {
                    status: 'pending',
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
                                            <td>${order.contact ? order.contact.first_name : ''}</td>
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
                            data['order']['contact']['first_name'] + '</span></p>';
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
    </script>
@endpush
