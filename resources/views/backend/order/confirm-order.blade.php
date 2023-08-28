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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 h6">Schedule Order</div>
                        <div class="col-md-6 text-right h6">Order ID: <span
                                class="font-weight-bold">{{ $order?->code }}</span></div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Textual inputs</h4>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3">Shipping From:</h6>
                            <div class="address">
                                <p class="mb-2">{{ $company_info->name }}</p>
                                <p class="mb-2">{{ $company_info->address }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                    </div>
                </div>
            </div> <!-- end col -->

        </div> <!-- end col -->

        <div class="col-12">
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
                                    target="_blank" class="btn btn-primary">Generate
                                    Bar Code</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-md-12">
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

        <div class="col-md-12">
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
                                        <button type="button" class="btn btn-outline-primary" id="openShippingMethodModal">
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
                            <button class="btn btn-sm btn-info">Get Slot</button>
                            <input data-repeater-create type="button" data-box_no="1" id="package_qty"
                                name="package_qty" class="btn btn-sm btn-success inner float-right" value="Add Box" />
                        </div>
                    </div>
                </div>

                {{-- Start pickup slot --}}
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Pickup Slot</h5>
                        <p class="mb-3">Pickup Slot (note: indicative time; exact pickup time may vary)</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pickupDate">Pickup Day</label>
                                    <input type="date" id="pickupDate" name="pickupDate" class="form-control">
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
                {{-- End pickup slot --}}

            </div>
        </div>

        {{-- Start shipping fee --}}
        <div class="card border-0 shadow">
            <div class="card-body align-items-center">
                <div>
                    <p class="text-dark"><center class="h4">Total Shipping Charge: <span class="h3">{{ $order->shipping_charge }}</span></center></p>
                </div>
            </div>
        </div>
        {{-- End shipping fee --}}
    </div>
    <!-- end row -->
@endsection
@push('script')
    <script>
        function removeBox(boxNumber) {
            $('#box_' + boxNumber).remove();
        }

        function generateBoxInputs(boxNumber, lengthUnits, products) {
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
            for (var unitValue in lengthUnits) {
                html += '<option value="' + unitValue + '">' + lengthUnits[unitValue] + '</option>';
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
            var products = {!! json_encode($order->OrderDetail) !!};

            $('#package_qty').click(function() {
                var newBoxHtml = generateBoxInputs(boxCounter, lengthUnits, products);
                $('#box_details').append(newBoxHtml);
                boxCounter++;
            });

            var newBoxHtml = generateBoxInputs(boxCounter, lengthUnits, products);
            $('#box_details').append(newBoxHtml);
            boxCounter++;
        });
    </script>
@endpush
