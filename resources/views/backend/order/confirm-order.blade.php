@extends('layouts.backend_app')

@section('content')
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

        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div>
                        <label for="package_qty">Package Box Quantity</label>
                        <input type="number" id="package_qty" name="package_qty" class="form-control">
                    </div>

                    <div id="package_info" style="display: none;">
                        <h5>Package Box Quantity <span id="box_qty"></span></h5>
                        <div id="box_details"></div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        {{-- Start package handover --}}
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label>Schedule</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="scheduleDropOff" name="scheduleType"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="scheduleDropOff">Schedule DropOff</label>
                                </div>
                                <div class="form-group" id="dropOffDescription">
                                    <p>I will prepare the package and I will drop it off at the courier location.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="schedulePickup" name="scheduleType"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="schedulePickup">Schedule Pickup</label>
                                </div>
                                <div class="form-group" id="pickupDescription">
                                    <p>I will prepare the package and I want Aladdin to pickup the items from my location.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center>
                        <button id="getSlotButton" class="btn btn-primary">Get Slot</button>
                    </center>
                </div>
            </div>
        </div><!-- end col -->
        {{-- End package handover --}}

        {{-- Start pickup slot --}}
        <div class="col-12">
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
        </div><!-- end col -->
        {{-- End pickup slot --}}

        {{-- Start shipping fee --}}
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Total Easy Ship Fee: </h3>
                        </div>
                        <div class="col-md-6 text-center">
                            <h2 class="bg-info">{{ $order->shipping_charge }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        {{-- End shipping fee --}}
{{-- gy --}}
    </div>
    <!-- end row -->
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#package_qty').on('change', function() {
                var packageQty = $(this).val();
                if (packageQty > 0) {
                    $('#box_qty').text(packageQty + ' BOX');
                    $('#box_details').empty();

                    var products = {!! json_encode($order->OrderDetail) !!};
                    for (var i = 1; i <= packageQty; i++) {
                        var boxHtml = '<div class="box border p-3 mb-3">';
                        boxHtml += '<h6>Select Box Number Box no: ' + i + '</h6>';
                        boxHtml += '<div class="row">';
                        boxHtml += '<div class="col-md-3">';
                        boxHtml += '<div class="package">';
                        boxHtml += '<label for="weight_' + i + '">Package Weight</label>';
                        boxHtml += '<input type="number" id="weight_' + i + '" name="weight_' + i +
                            '" class="form-control">';
                        boxHtml += '</div>';
                        boxHtml += '</div>';
                        boxHtml += '<div class="col-md-3">';
                        boxHtml += '<div class="package">';
                        boxHtml += '<label for="length_' + i + '">Length</label>';
                        boxHtml += '<input type="number" id="length_' + i + '" name="length_' + i +
                            '" class="form-control">';
                        boxHtml += '</div>';
                        boxHtml += '</div>';
                        boxHtml += '<div class="col-md-3">';
                        boxHtml += '<div class="package">';
                        boxHtml += '<label for="width_' + i + '">Width</label>';
                        boxHtml += '<input type="number" id="width_' + i + '" name="width_' + i +
                            '" class="form-control">';
                        boxHtml += '</div>';
                        boxHtml += '</div>';
                        boxHtml += '<div class="col-md-3">';
                        boxHtml += '<div class="package">';
                        boxHtml += '<label for="height_' + i + '">Height</label>';
                        boxHtml += '<input type="number" id="height_' + i + '" name="height_' + i +
                            '" class="form-control">';
                        boxHtml += '</div>';
                        boxHtml += '</div>';
                        boxHtml += '<div class="col-md-12">';
                        boxHtml += '<div class="package">';
                        boxHtml += '<label for="product_' + i + '">Select Product</label>';
                        boxHtml += '<select id="product_' + i + '" name="product_' + i +
                            '" class="form-control" multiple>';

                        var optionsHtml = '';
                        for (var j = 0; j < products.length; j++) {
                            optionsHtml += '<option value="' + products[j].id + '">' + products[j][
                                'product'
                            ].name + '</option>';
                        }
                        boxHtml += optionsHtml;

                        boxHtml += '</select>';
                        boxHtml += '</div>';
                        boxHtml += '</div>';
                        boxHtml += '</div>'; // end row
                        boxHtml += '</div>'; // end box

                        $('#box_details').append(boxHtml);
                    }

                    $('#package_info').show();
                } else {
                    $('#package_info').hide();
                }
            });
        });
    </script>
@endpush
