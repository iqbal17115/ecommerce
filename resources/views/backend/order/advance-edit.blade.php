@extends('layouts.backend_app')

@section('content')
    <style>
        .box {
            position: relative;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .close-icon {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
        }
    </style>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Confirm Order</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Confirm Order</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        {{-- Start confirm or cancel Order --}}
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6"><span>Order Id: {{ $order?->code }}</span> - <span>
                                {{ $order ? date('M d, Y h:i A', strtotime($order->order_date)) : 'N/A' }} </span></div>
                        <div class="col-md-6 text-right h6">
                            <button id="confirmOrderBtn" class="btn btn-success btn-sm">Confirm Order</button>
                            <button id="cancelOrderBtn" class="btn btn-danger btn-sm">Cancel Order</button>
                            <button id="printInvoiceBtn" class="btn btn-success btn-sm" style="display: none;">Print
                                Invoice</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
        {{-- End confirm or cancel Order --}}

        {{-- Start Order status --}}
        <div class="col-12">
            <div class="row">
                {{-- Start Payment status --}}
                <div class="col-md-6">
                    <div class="card text-center ">
                        <div class="card-body d-flex justify-content-center">
                            <h5 class="font-size-15 d-flex align-items-center">
                                <i class="fas fa-money-bill text-success bx-md me-2"></i>
                                <a href="#" class="text-dark">Payment Status</a>
                            </h5>
                        </div>

                        <div class="card-footer bg-transparent border-top">
                            <div class="contact-links d-flex font-size-20">
                                <div class="flex-fill">
                                    <span class="badge badge-pill badge-success font-size-12">Paid</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End payment Status --}}

                {{-- Start Shipment status --}}
                <div class="col-md-6">
                    <div class="card text-center ">
                        <div class="card-body d-flex justify-content-center">
                            <h5 class="font-size-15 d-flex align-items-center">
                                <i class="bx bx-car text-success bx-md me-2"></i>
                                <a href="#" class="text-dark">Fullfilment Status</a>
                            </h5>
                        </div>

                        <div class="card-footer bg-transparent border-top">
                            <div class="contact-links d-flex font-size-20">
                                <div class="flex-fill">
                                    <span class="badge badge-pill badge-danger font-size-12">Unshipped</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Shipment Status --}}

            </div>
        </div> <!-- end col -->
        {{-- End Order status --}}

        {{-- Start Content --}}
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="mb-3">Shipping From:</h6>
                            <div class="address">
                                <p class="mb-2">{{ $company_info->name }}</p>
                                <p class="mb-2">{{ $company_info->address }}</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h6 class="mb-3">Shipping To:</h6>
                            <div class="address">
                                <p class="mb-2">{{ $order->Contact->first_name }}</p>
                                <p class="mb-2">{{ $order?->Contact?->District?->name }},
                                    {{ $order?->Contact?->Division?->name }}</p>
                                <p class="mb-2">{{ $order?->Contact?->Union?->name }},
                                    {{ $order?->Contact?->Upazila?->name }}</p>
                                <p class="mb-2">{{ $order?->Contact?->shipping_address }}</p>
                            </div>
                        </div>
                        <div class="col-md-2 text-info">
                            <i class="fas fa-plus-circle"></i> Shipping Address
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title mb-4">Order Details</h5>
                    <!-- Assuming you have an array of products called 'products' -->
                    @foreach ($order->OrderDetail as $orderDetail)
                        <div class="row shadow-sm py-2">
                            <div class="col-md-1">
                                <img src="{{ asset('storage/product_photo/' . $orderDetail->Product?->ProductImage?->first()->image) }}"
                                    style="width:70px; height: 70px;" class="img-responsive">
                            </div>
                            <div class="col-md-2">
                                @php
                                    $product_codes = [];
                                @endphp
                                @for ($i = 1; $i <= $orderDetail->quantity; $i++)
                                    <p>{{ $order?->code }}{{ $orderDetail->id }}{{ $i }}</p>
                                    @php
                                        $product_codes[] = $order->code . $orderDetail->id . $i;
                                    @endphp
                                @endfor
                            </div>
                            <div class="col-md-5">
                                <h6 class="mb-3">{{ $orderDetail->Product->name }}</h6>
                                <p class="mb-2">SKU: {{ $orderDetail->Product->seller_sku }}</p>
                                <p class="mb-0">Price: (Inclusive Tax)</p>
                            </div>
                            <div class="col-md-2">
                                <div class="price-info">
                                    <p class="mb-2">{{ $orderDetail->quantity * $orderDetail->unit_price }} Taka</p>
                                    <p class="mb-0">Quantity: {{ $orderDetail->quantity }}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('generate.barcodes', ['product_codes' => $product_codes]) }}"
                                    target="_blank" class="btn btn-outline-primary">Generate
                                    Bar Code</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title mb-4">Payment Panel</h5>
                    <form>
                        <div class="form-group row">
                            <label for="paymentType" class="col-sm-3 col-form-label">Payment Type:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="paymentType" name="paymentType">
                                    <option value="creditCard">Credit Card</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bankTransfer">Bank Transfer</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="paymentMethod" class="col-sm-3 col-form-label">Payment Method:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="paymentMethod" name="paymentMethod">
                                    <option value="visa">Visa</option>
                                    <option value="mastercard">MasterCard</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank">Bank Transfer</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="paymentId" class="col-sm-3 col-form-label">Payment ID:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="paymentId" name="paymentId">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="paymentDate" class="col-sm-3 col-form-label">Payment Date:</label>
                            <div class="col-sm-9">
                                <input type="datetime-local" class="form-control" id="paymentDate" name="paymentDate">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-outline-primary">Submit Payment</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Payment Method</h5>
                                <p class="mb-0">Cash On Delivery (COD)</p>
                            </div>
                            <div class="col-md-4">
                                <h5>Payment ID</h5>
                                <p class="mb-0">568746646464</p>
                                <p class="mb-0">23/08/2023 - 10:45 AM</p>
                            </div>
                            <div class="col-md-4">
                                <h5>Payment Status</h5>
                                <p class="mb-0">Paid</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Shipping Panel</h5>
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="courier">Courier:</label>
                                <div class="input-group">
                                    <select class="form-control" id="courier" name="courier">
                                        <option value="pathao">Pathao</option>
                                        <option value="dhl">DHL</option>
                                        <!-- Add more options -->
                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-primary" id="openCourierModal">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="shippingMethod">Shipping Method:</label>
                                <div class="input-group">
                                    <select class="form-control" id="shippingMethod" name="shippingMethod">
                                        <option value="standard">Standard Delivery</option>
                                        <option value="express">Express Delivery</option>
                                        <!-- Add more options -->
                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-primary"
                                            id="openShippingMethodModal">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trackingId">Tracking ID:</label>
                            <input type="text" class="form-control" id="trackingId" name="trackingId">
                        </div>
                        <div class="form-group">
                            <label for="dispatchDate">Dispatch Date:</label>
                            <input type="datetime-local" class="form-control" id="dispatchDate" name="dispatchDate">
                        </div>
                    </form>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Carrier & Delivery</h5>
                                <p>Pathao</p>
                                <p>Standard Delivery</p>
                            </div>
                            <div class="col-md-4">
                                <h5>Tracking ID</h5>
                                <p>568746646464</p>
                                <p>23/08/2023 - 10:45 AM</p>
                            </div>
                            <div class="col-md-4">
                                <h5>Estimate Delivery Date</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div id="package_info">
                            <div id="box_details"></div>
                        </div>
                        <div class="mt-4">
                            <input data-repeater-create type="button" data-box_no="1" id="package_qty"
                                name="package_qty" class="btn btn-sm btn-success inner float-right" value="Add Box" />
                        </div>
                        <br>
                        <br>
                        <div id="accordion">
                            <div class="card mb-1 shadow-none">
                                <div class="card-header bg-mute" id="headingOne">
                                    <h6 class="m-0 text-center" href="#collapseOne" data-toggle="collapse"
                                        aria-expanded="true" aria-controls="collapseOne" style="cursor: pointer;">
                                        <a class="btn btn-sm btn-outline-primary text-dark">
                                            Get Slot
                                        </a>
                                    </h6>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Pickup Slot</h5>
                                        <p class="mb-3">Pickup Slot (note: indicative time; exact pickup time may vary)
                                        </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pickupDate">Pickup Day</label>
                                                    <input type="date" id="pickupDate" name="pickupDate"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pickupTime">Pickup Time</label>
                                                    <select id="pickupTime" name="pickupTime" class="form-control">
                                                        <option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
                                                        <option value="10:30 AM - 11:30 AM">10:30 AM - 11:30 AM</option>
                                                        <option value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
                                                        <option value="11:30 AM - 12:30 PM">11:30 AM - 12:30 PM</option>
                                                        <option value="12:00 PM - 1:00 PM">12:00 PM - 1:00 PM</option>
                                                        <option value="12:30 PM - 1:30 PM">12:30 PM - 1:30 PM</option>
                                                        <option value="1:00 PM - 2:00 PM">1:00 PM - 2:00 PM</option>
                                                        <option value="1:30 PM - 2:30 PM">1:30 PM - 2:30 PM</option>
                                                        <option value="2:00 PM - 3:00 PM">2:00 PM - 3:00 PM</option>
                                                        <option value="2:30 PM - 3:30 PM">2:30 PM - 3:30 PM</option>
                                                        <option value="3:00 PM - 4:00 PM">3:00 PM - 4:00 PM</option>
                                                        <option value="3:30 PM - 4:30 PM">3:30 PM - 4:30 PM</option>
                                                        <option value="4:00 PM - 5:00 PM">4:00 PM - 5:00 PM</option>
                                                        <option value="4:30 PM - 5:30 PM">4:30 PM - 5:30 PM</option>
                                                        <option value="5:00 PM - 6:00 PM">5:00 PM - 6:00 PM</option>
                                                        <option value="5:30 PM - 6:30 PM">5:30 PM - 6:30 PM</option>
                                                        <option value="6:00 PM - 7:00 PM">6:00 PM - 7:00 PM</option>
                                                        <option value="6:30 PM - 7:30 PM">6:30 PM - 7:30 PM</option>
                                                    </select>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Start shipping fee --}}
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div>
                            <p class="text-dark h5">Total Shipping Charge: {{ $currency->icon }} {{ $order->shipping_charge }}</p>
                        </div>
                    </div>
                </div>
                {{-- End shipping fee --}}

            </div>
        </div>
        <div class="col-2">
            <div class="card">
                <div class="card-header text-dark">
                    Order Notes
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="note">Add Note:</label>
                            <input type="text" class="form-control form-control-sm" id="note" name="note">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <select class="form-control form-control-sm" id="noteType" name="noteType">
                                    <option value="private">Private Note</option>
                                    <option value="customer">Note to Customer</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header text-dark">
                    Update Payment Status
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <select class="form-control form-control-sm" id="noteType" name="noteType">
                                    <option value="">Change Status</option>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Apply</button>
                            </div>
                        </div>
                    </form>

                    <form>
                        <div class="form-group">
                            <label for="note">Add Note:</label>
                            <input type="text" class="form-control form-control-sm" id="note" name="note">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <select class="form-control form-control-sm" id="noteType" name="noteType">
                                    <option value="private">Private Note</option>
                                    <option value="customer">Note to Customer</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header text-dark">
                    Update Fullfilment Status
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <select class="form-control form-control-sm" id="noteType" name="noteType">
                                    <option value="">Change Status</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="unshipped">Unshipped</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Apply</button>
                            </div>
                        </div>
                    </form>

                    <form>
                        <div class="form-group">
                            <label for="note">Add Note:</label>
                            <input type="text" class="form-control form-control-sm" id="note" name="note">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <select class="form-control form-control-sm" id="noteType" name="noteType">
                                    <option value="private">Private Note</option>
                                    <option value="customer">Note to Customer</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header text-dark">
                    Order Cancellation/Return
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <a type="submit" class="btn btn-danger" href="{{ route('cancellation_product', ['order' =>$order->id]) }}">Cancellation</a>
                        </div>
                        <div class="col-md-6">
                            <a type="submit" class="btn btn-warning" href="{{ route('return_product', ['order' =>$order->id]) }}">Return</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- End Content --}}
    </div>
    <!-- end row -->
@endsection
@push('script')
    <script>
        function removeBox(boxNumber) {
            $('#box_' + boxNumber).remove();
        }

        function generateBoxInputs(boxNumber, lengthUnits, weightUnits, products) {
            var html = '<div class="box card" id="box_' + boxNumber + '">';
            html += '<div class="close-icon" onclick="removeBox(' + boxNumber + ')">&times;</div>';
            // Start of row (Bootstrap row class)
            html += '<div class="row p-2">';
            // Box no
            html += '<div class="col-md-12"><h3>Select Box No: ' + boxNumber + '</h3></div>';
            // Package Weight
            html += '<div class="col-md-2">';
            html += '<input type="text" id="package_weight_' + boxNumber +
                '" name="package_weight[]" placeholder="Package Weight" class="form-control form-control-sm">';
            html += '</div>';

            // Select for Package Weight
            html += '<div class="col-md-2">';
            html += '<select name="package_weight_unit_' + boxNumber + '" class="form-control form-control-sm">';
            for (var weightValue in weightUnits) {
                html += '<option value="' + weightValue + '">' + weightUnits[weightValue] + '</option>';
            }
            html += '</select>';
            html += '</div>';

            // Package Length
            html += '<div class="col-md-2">';
            html += '<input type="text" id="package_length_' + boxNumber +
                '" name="package_length[]" placeholder="Package Length" class="form-control form-control-sm">';
            html += '</div>';

            // Select for Package Length
            html += '<div class="col-md-2">';
            html += '<select name="package_length_unit_' + boxNumber + '" class="form-control form-control-sm">';
            for (var unitValue in lengthUnits) {
                html += '<option value="' + unitValue + '">' + lengthUnits[unitValue] + '</option>';
            }
            html += '</select>';
            html += '</div>';


            // Package Height
            html += '<div class="col-md-2">';
            html += '<input type="text" id="package_height_' + boxNumber +
                '" name="package_height[]" placeholder="Package Height" class="form-control form-control-sm">';
            html += '</div>';

            // Select for Package Height
            html += '<div class="col-md-2">';
            html += '<select name="package_height_unit_' + boxNumber + '" class="form-control form-control-sm">';
            for (var unitValue in lengthUnits) {
                html += '<option value="' + unitValue + '">' + lengthUnits[unitValue] + '</option>';
            }
            html += '</select>';
            html += '</div>';

            // End of row
            html += '</div>';

            // Product Name and Quantity
            for (var j = 0; j < products.length; j++) {
                html += '<div class="col-md-12 row mt-2">';
                html += '<div class="col-md-8">';
                html += '<div class="custom-control custom-checkbox mt-2">';
                html += '<input type="checkbox" class="custom-control-input" id="product_name_' + j + '_' + boxNumber +
                    '">';
                html += '<label class="custom-control-label" name="product_name_' + j + '" for="product_name_' + j + '_' +
                    boxNumber + '">' + products[j]['product'].name + '</label>';
                html += '</div>';
                html += '</div>';
                html += '<div class="col-md-2">';
                html += '' + products[j]['quantity'] + '';
                html += '</div>';
                html += '<div class="col-md-2">';
                html += '<input type="text" name="product_expected_qty_' + j +
                    '" placeholder="Qty"  class="form-control form-control-sm">';
                html += '</div>';
                html += '</div>';
            }
            // End of box
            html += '</div>';
            return html;
        }

        $(document).ready(function() {
            var boxCounter = 1; // To keep track of box numbers
            var lengthUnits = <?php echo json_encode($lengthUnits); ?>;
            var weightUnits = <?php echo json_encode($weightUnits); ?>;
            var products = {!! json_encode($order->OrderDetail) !!};

            $('#package_qty').click(function() {
                var newBoxHtml = generateBoxInputs(boxCounter, lengthUnits, weightUnits, products);
                $('#box_details').append(newBoxHtml);
                boxCounter++;
            });

            var newBoxHtml = generateBoxInputs(boxCounter, lengthUnits, weightUnits, products);
            $('#box_details').append(newBoxHtml);
            boxCounter++;
        });
    </script>
@endpush
