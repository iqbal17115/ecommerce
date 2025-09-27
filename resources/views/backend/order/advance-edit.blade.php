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
                        <div class="col-md-5"><span>Order Id: {{ $order?->code }}</span> - <span>
                                {{ $order ? date('M d, Y h:i A', strtotime($order->order_date)) : 'N/A' }} </span></div>
                        <div class="col-md-7 text-right h6">
                            <div class="row">
                                <div class="col-md-7">
                                    <form id="cancelReasonForm" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <select id="cancelReasonInput" class="form-control form-control-sm"
                                                    name="cancelReasonInput">
                                                    <option value="">Select</option>
                                                    @foreach ($cancel_reasons as $value => $label)
                                                        <option value="{{ $value }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button id="saveCancelReasonBtn"
                                                    class="btn btn-primary btn-sm">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-5">
                                    <form action="{{ route('confirm.order', ['order' => $order->id]) }}"
                                        id="confirmOrderForm" style="display: inline;">
                                        @csrf
                                        <button id="confirmOrderBtn" type="submit"
                                            class="btn btn-success btn-sm {{ $order->status == 'processing' ? 'disabled' : '' }}">Confirm
                                            Order</button>
                                    </form>
                                     @if($order?->courierShipment)
                    <a href="{{ route('couriers.printInvoice', $order?->courierShipment?->consignment_id) }}" target="_blank" class="btn btn-outline-primary">
                        Courier Invoice
                    </a>
                @endif
                                    <button id="cancelOrderBtn"
                                        class="btn btn-danger waves-effect waves-light btn-sm {{ $order->status == 'cancelled' ? 'disabled' : '' }}"
                                        data-toggle="modal" data-target=".cancel-order">Cancel</button>
                                        <a href="{{ route('my_order.invoice', ['order' => $order->id]) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                            <i class="mdi mdi-printer"></i> Print Invoice
                                        </a>                                        
                                </div>
                            </div>
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
                                    <span class="badge badge-pill {{ \App\Helpers\OrderHelper::getOrderStatusBadge($order->orderPayment->payment_status) }} font-size-12">
                                        {{ \App\Helpers\OrderHelper::getOrderStatusName($order?->orderPayment?->payment_status) ?? 'N/A' }}
                                    </span>
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
                                <a href="#" class="text-dark">Order Status</a>
                            </h5>
                        </div>

                        <div class="card-footer bg-transparent border-top">
                            <div class="contact-links d-flex font-size-20">
                                <div class="flex-fill">
                                    <span
                                        class="badge badge-pill order_fulfilment_status_show {{ $order->status == 'shipped' ? 'badge-success' : 'badge-danger' }} font-size-12">{{ ucwords($order->status) }}</span>
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
        <div class="col-9">
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

                        <!-- Display Mode -->
                        <div class="address d-flex align-items-center justify-content-between" id="address-view" style="border: 1px solid #e3e3e3; padding: 10px; border-radius: 5px;">
                            
                            <div>
                                <p class="mb-1" id="street_address_display">{{ $order?->orderAddress?->instruction }}</p>
                                <p class="mb-1" id="district_display">{{ \App\Helpers\AddressHelper::getFullAddress($order) }}</p>
                                <p class="mb-1 text-info" id="user_name_display">
                                    {{ $order?->orderAddress?->name }}
                                    @if($order?->orderAddress?->mobile), {{ $order?->orderAddress?->mobile }}@endif
                                    @if($order?->orderAddress?->optional_mobile), {{ $order?->orderAddress?->optional_mobile }}@endif
                                </p>
                            </div>

                            <div>
                                <button type="button" class="btn btn-sm btn-primary" id="edit-address-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </div>

                        </div>


                        <!-- Edit Mode -->
                        <div class="address" id="address-edit" style="display:none;">
                            <input type="text" id="street_address_input" class="form-control mb-2" value="{{ $order?->orderAddress?->instruction }}" placeholder="Street Address">
                            <input type="text" id="district_input" class="form-control mb-2" value="{{ $order?->orderAddress?->district_name }}" placeholder="District">
                            <input type="text" id="user_name_input" class="form-control mb-2" value="{{ $order?->orderAddress?->name }}" placeholder="Name">
                            <input type="text" id="mobile_input" class="form-control mb-2" value="{{ $order?->orderAddress?->mobile }}" placeholder="Mobile">
                            <input type="text" id="optional_mobile_input" class="form-control mb-2" value="{{ $order?->orderAddress?->optional_mobile }}" placeholder="Optional Mobile">

                            <button type="button" class="btn btn-sm btn-success" id="save-address-btn">Save</button>
                            <button type="button" class="btn btn-sm btn-secondary" id="cancel-address-btn">Cancel</button>
                        </div>
                    </div>
                  
                        <div class="col-md-2 text-info" data-toggle="modal" data-target="#shippingModal" style="cursor: pointer;">
                            <i class="fas fa-plus-circle"></i> Shipping Address
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title mb-4">Order Details</h5>

                    @foreach ($order->OrderDetail as $orderDetail)
                        <div class="row shadow-sm py-2 order-item-row" data-id="{{ $orderDetail->id }}">
                            <div class="col-md-1">
                                <img src="{{ asset('storage/product_photo/' . $orderDetail->Product?->ProductImage?->first()->image) }}"
                                    style="width:70px; height: 70px;" class="img-responsive">
                            </div>

                            <div class="col-md-4">
                                <h6 class="mb-1">{{ $orderDetail->Product->name }}</h6>
                                @if ($orderDetail?->productVariation?->productVariationAttributes)
                                    @foreach ($orderDetail->productVariation->productVariationAttributes as $variantionAttribute)
                                        <span class="text-muted">
                                            {{ $variantionAttribute?->attributeValue?->attribute->name }}: 
                                            {{ $variantionAttribute?->attributeValue?->value }}
                                        </span><br>
                                    @endforeach
                                @endif
                            </div>

                            <div class="col-md-2">
                                <input type="number" class="form-control qty-input" 
                                    value="{{ $orderDetail->quantity }}" min="1">
                            </div>

                            <div class="col-md-2">
                                <input type="number" class="form-control price-input" 
                                    value="{{ $orderDetail->unit_price }}" min="0" step="0.01">
                            </div>

                            <div class="col-md-2">
                                <p>Total: <span class="item-total">{{ $orderDetail->quantity * $orderDetail->unit_price }}</span> Taka</p>
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <!-- Shipping -->
                        <div class="mt-3 col-md-3">
                            <label>Shipping Charge</label>
                            <input type="number" class="form-control mb-2 calc-input" id="shipping-charge-input"
                                value="{{ $order->shipping_charge }}" step="0.01">
                        </div>

                        <!-- Discount -->
                        <div class="mt-3 col-md-3">
                            <label>Discount</label>
                            <input type="number" class="form-control mb-2 calc-input" id="discount-input"
                                value="{{ $order->discount ?? 0 }}" step="0.01">
                        </div>

                        <!-- Totals -->
                        <div class="mt-3 col-md-3">
                            <label>Total Amount</label>
                            <h6>Total Amount: <span id="total-amount">{{ $order->total_amount }}</span> Taka</h6>
                        </div>
                        <div class="mt-3 col-md-3">
                            <label>Payable Amount</label>
                            <h6>Payable Amount: <span id="payable-amount">{{ $order->payable_amount }}</span> Taka</h6>
                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="button" class="btn btn-success" id="save-order-details-btn">Save Changes</button>
                    </div>
                </div>

            </div>

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title mb-4">Payment Panel</h5>
                    <form action="{{ route('order_payment.submit', ['order' => $order->id]) }}" id="orderPaymentSubmit">
                        <div class="form-group row">
                            <label for="payment_type" class="col-sm-3 col-form-label">Payment Type:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="payment_type" name="payment_type" required>
                                    <option value="">Select</option>
                                    @foreach ($paymentTypes as $index => $paymentType)
                                        <option value="{{ $index }}"
                                            {{ $order?->orderPayment?->payment_type == $index ? 'selected' : '' }}>
                                            {{ $paymentType }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="payment_method" class="col-sm-3 col-form-label">Payment Method:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="payment_method" name="payment_method" required>
                                    <option value="">Select</option>
                                    @foreach ($paymentMethods as $index => $paymentMethod)
                                        <option value="{{ $index }}"
                                            {{ $order?->orderPayment?->payment_method == $index ? 'selected' : '' }}>
                                            {{ $paymentMethod }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="payment_id" class="col-sm-3 col-form-label">Payment ID:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="payment_id" name="payment_id"
                                    value="{{ $order?->orderPayment?->payment_id }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="payment_date" class="col-sm-3 col-form-label">Payment Date:</label>
                            <div class="col-sm-9">
                                <input type="datetime-local" class="form-control" id="payment_date" name="payment_date"
                                    value="{{ $order?->orderPayment?->payment_date }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-outline-primary">Submit Payment</button>
                            </div>
                        </div>
                    </form>
                </div>
                @if ($order?->orderPayment)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5>Payment Method</h5>
                                    <p class="mb-0">{{ ucwords($order?->orderPayment?->payment_method) }}</p>
                                </div>
                                <div class="col-md-4">
                                    <h5>Payment ID</h5>
                                    <p class="mb-0">{{ $order?->orderPayment?->payment_id }}</p>
                                    <p class="mb-0">{{ $order?->orderPayment?->payment_date }}</p>
                                </div>
                                <div class="col-md-4">
                                    <h5>Payment Status</h5>
                                    <p class="mb-0">Paid</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Shipping Panel</h5>
                    <form id="shippingForm">
                        @csrf
                        <input type="hidden" id="orderId" value="{{ $order->id }}">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="courier">Courier:</label>
                                <select class="form-control" id="courier" name="courier" required>
                                    <option value="steadfast">Steadfast</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="shippingMethod">Shipping Method:</label>
                                <select class="form-control" id="shippingMethod" name="shippingMethod" required>
                                    <option value="standard">Standard Delivery</option>
                                    <option value="express">Express Delivery</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="trackingId">Tracking ID:</label>
                            <input type="text" class="form-control" id="trackingId" name="trackingId">
                        </div>
                        <div class="form-group">
                            <label for="dispatchDate">Dispatch Date:</label>
                            <input type="datetime-local" class="form-control" id="dispatchDate" name="dispatchDate" required>
                        </div>

                        <button type="button" class="btn btn-success" id="sendToCourierBtn">Send to Courier</button>
                    </form>
                </div>

                <div class="card">
                    <div class="card-body">
                        @include('backend.order.partials._shipment', ['order' => $order])
                    </div>
                </div>

                <div class="card">
                    <form action="{{ route('order_package.submit', ['order' => $order->id]) }}" id="orderPackageSubmit">
                        @csrf
                        <div class="card-body">
                            <div id="package_info">
                                <div id="box_details"></div>
                            </div>
                            <div class="mt-4">
                                <input data-repeater-create type="button" data-box_no="1" id="package_qty"
                                    name="package_qty" class="btn btn-sm btn-success inner float-right"
                                    value="Add Box" />
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
                                            <p class="mb-3">Pickup Slot (note: indicative time; exact pickup time may
                                                vary)
                                            </p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pickup_day">Pickup Day</label>
                                                        <input type="date" id="pickup_day" name="pickup_day"
                                                            value="{{ $order?->orderProductBox?->first()['pickup_day'] ?? '' }}"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pickup_time" required>Pickup Time</label>
                                                        <select id="pickup_time" name="pickup_time" class="form-control">
                                                            <option value="">-- Select --</option>
                                                            <option value="10:00 AM - 11:00 AM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '10:00 AM - 11:00 AM' ? 'selected' : '' ?? '' }}>
                                                                10:00 AM - 11:00 AM
                                                            </option>
                                                            <option value="10:30 AM - 11:30 AM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '10:30 AM - 11:30 AM' ? 'selected' : '' ?? '' }}>
                                                                10:30 AM - 11:30 AM
                                                            </option>
                                                            <option value="11:00 AM - 12:00 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '11:00 AM - 12:00 PM' ? 'selected' : '' ?? '' }}>
                                                                11:00 AM - 12:00 PM
                                                            </option>
                                                            <option value="11:30 AM - 12:30 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '11:30 AM - 12:30 PM' ? 'selected' : '' ?? '' }}>
                                                                11:30 AM - 12:30 PM
                                                            </option>
                                                            <option value="12:00 PM - 1:00 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '12:00 PM - 1:00 PM' ? 'selected' : '' ?? '' }}>
                                                                12:00 PM - 1:00 PM</option>
                                                            <option value="12:30 PM - 1:30 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '12:30 PM - 1:30 PM' ? 'selected' : '' ?? '' }}>
                                                                12:30 PM - 1:30 PM</option>
                                                            <option value="1:00 PM - 2:00 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '1:00 PM - 2:00 PM' ? 'selected' : '' ?? '' }}>
                                                                1:00 PM - 2:00 PM</option>
                                                            <option value="1:30 PM - 2:30 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '1:30 PM - 2:30 PM' ? 'selected' : '' ?? '' }}>
                                                                1:30 PM - 2:30 PM</option>
                                                            <option value="2:00 PM - 3:00 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '2:00 PM - 3:00 PM' ? 'selected' : '' ?? '' }}>
                                                                2:00 PM - 3:00 PM</option>
                                                            <option value="2:30 PM - 3:30 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '2:30 PM - 3:30 PM' ? 'selected' : '' ?? '' }}>
                                                                2:30 PM - 3:30 PM</option>
                                                            <option value="3:00 PM - 4:00 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '3:00 PM - 4:00 PM' ? 'selected' : '' ?? '' }}>
                                                                3:00 PM - 4:00 PM</option>
                                                            <option value="3:30 PM - 4:30 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '3:30 PM - 4:30 PM' ? 'selected' : '' ?? '' }}>
                                                                3:30 PM - 4:30 PM</option>
                                                            <option value="4:00 PM - 5:00 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '4:00 PM - 5:00 PM' ? 'selected' : '' ?? '' }}>
                                                                4:00 PM - 5:00 PM</option>
                                                            <option value="4:30 PM - 5:30 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '4:30 PM - 5:30 PM' ? 'selected' : '' ?? '' }}>
                                                                4:30 PM - 5:30 PM</option>
                                                            <option value="5:00 PM - 6:00 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '5:00 PM - 6:00 PM' ? 'selected' : '' ?? '' }}>
                                                                5:00 PM - 6:00 PM</option>
                                                            <option value="5:30 PM - 6:30 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '5:30 PM - 6:30 PM' ? 'selected' : '' ?? '' }}>
                                                                5:30 PM - 6:30 PM</option>
                                                            <option value="6:00 PM - 7:00 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '6:00 PM - 7:00 PM' ? 'selected' : '' ?? '' }}>
                                                                6:00 PM - 7:00 PM</option>
                                                            <option value="6:30 PM - 7:30 PM"
                                                                {{ isset($order?->orderProductBox?->first()['pickup_time']) == '6:30 PM - 7:30 PM' ? 'selected' : '' ?? '' }}>
                                                                6:30 PM - 7:30 PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @if ($order?->status != 'processing')
                                                        <button id="print_package_submit" type="submit"
                                                            class="btn btn-success">Confirm & Get
                                                            Slip</button>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <a id="print_package_barcode"
                                                        href="{{ route('package_barcodes.barcodes', ['order' => $order->id]) }}"
                                                        target="_blank" class="btn btn-outline-primary float-right"
                                                        {{ $order?->status == 'processing' ? '' : 'hidden' }}>Print</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-header text-dark">
                    Order Notes
                </div>
                <div class="card-body">
                    <ul class="list-group" id="list-group-order-note">
                        @if ($order->orderNoteStatus && $order->orderNoteStatus->order_note)
                            @php
                                $notes = json_decode($order->orderNoteStatus->order_note, true);
                            @endphp

                            @if($notes)
                            @foreach ($notes as $note)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $note['note'] }}
                                    <span class="badge badge-primary badge-pill">{{ $note['note_type'] }}</span>
                                </li>
                            @endforeach
                            @endif
                        @endif
                    </ul>

                    {{-- Test --}}
                    <form action="{{ route('order.note', ['order' => $order->id]) }}" id="orderNoteSubmit">
                        @csrf
                        <div class="form-group">
                            <label for="order_note">Add Note:</label>
                            <textarea type="text" class="form-control form-control-sm" id="order_note" name="order_note"
                                placeholder="Add Note" required></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <select class="form-control form-control-sm" id="order_note_type" name="order_note_type"
                                    required>
                                    <option value="">Select</option>
                                    <option value="private"
                                        {{ $order?->orderNoteStatus?->order_note_type == 'private' ? 'selected' : '' }}>
                                        Private Note</option>
                                    <option value="note_to_customer"
                                        {{ $order?->orderNoteStatus?->order_note_type == 'note_to_customer' ? 'selected' : '' }}>
                                        Note to Customer</option>
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
                    <form action="{{ route('order_payment.status', ['order' => $order->id]) }}"
                        id="orderPaymentStatusSubmit">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <select class="form-control form-control-sm" id="payment_status" name="payment_status">
                                    <option value="">Change Status</option>
                                    @foreach ($paymentStatuses as $index => $paymentStatus)
                                        <option value="{{ $index }}"
                                            {{ $order?->orderNoteStatus?->payment_status == $index ? 'selected' : '' }}>
                                            {{ $paymentStatus }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Apply</button>
                            </div>
                        </div>
                    </form>

                    <ul class="list-group" id="list-group-payment-order-note">
                        @if ($order->orderNoteStatus && $order->orderNoteStatus->payment_note)
                            @php
                                $notes = json_decode($order->orderNoteStatus->payment_note, true);
                            @endphp
@if($notes)
                            @foreach ($notes as $note)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $note['note'] }}
                                    <span class="badge badge-primary badge-pill">{{ $note['note_type'] }}</span>
                                </li>
                            @endforeach
                        @endif
                        @endif
                    </ul>

                    <form action="{{ route('order_payment_note.submit', ['order' => $order->id]) }}"
                        id="orderPaymentNoteSubmit">
                        @csrf
                        <div class="form-group">
                            <label for="payment_note">Add Note:</label>
                            <textarea type="text" class="form-control form-control-sm" id="payment_note" name="payment_note"
                                placeholder="Add Note" required></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <select class="form-control form-control-sm" id="order_payment_note_type"
                                    name="order_payment_note_type">
                                    <option value="">Select</option>
                                    <option value="private">Private Note</option>
                                    <option value="note_to_customer">Note to Customer</option>
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
                    <ul class="list-group" id="list-group-order-tracking">
                        @foreach ($order->orderTracking as $orderTracking)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $orderTracking->status }}
                                <span
                                    class="badge badge-primary badge-pill">{{ date('d M Y', strtotime($orderTracking->created_at)) }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <form action="{{ route('track_status.order', ['order' => $order->id]) }}" id="orderStatusSubmit">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <select class="form-control form-control-sm order_fulfilment_status" id="order_status"
                                    name="order_status">
                                    <option value="">Change Status</option>
                                    @foreach ($orderStatuses as $statusValue)
                                        <option value="{{ $statusValue }}">{{ $statusValue }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Apply</button>
                            </div>
                        </div>
                    </form>

                    <ul class="list-group" id="list-group-payment-order-fulfilment-note">
                        @if ($order->orderNoteStatus && $order->orderNoteStatus->fulfilment_note)
                            @php
                                $notes = json_decode($order->orderNoteStatus->fulfilment_note, true);
                            @endphp
@if($notes)
                            @foreach ($notes as $note)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $note['note'] }}
                                    <span class="badge badge-primary badge-pill">{{ $note['note_type'] }}</span>
                                </li>
                            @endforeach
                        @endif
                        @endif
                    </ul>

                    <form action="{{ route('order_fulfilment_note.submit', ['order' => $order->id]) }}"
                        id="orderFulfilmentNoteSubmit">
                        <div class="form-group">
                            <label for="fulfilment_note">Add Note:</label>
                            <textarea type="text" class="form-control form-control-sm" id="fulfilment_note" name="fulfilment_note"
                                placeholder="Add Note" required></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <select class="form-control form-control-sm" id="order_fulfilment_note_type"
                                    name="order_fulfilment_note_type">
                                    <option value="">Select</option>
                                    <option value="private">Private Note</option>
                                    <option value="note_to_customer">Note to Customer</option>
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
                        <div class="col-md-12">
                            <ul class="list-group">
                                @foreach ($order?->OrderDetail as $orderDetail)
                                    <li class="list-group-item align-items-center">
                                        <img src="{{ asset('storage/product_photo/' . $orderDetail?->Product?->ProductImage?->first()->image) }}"
                                            style="width:40px; height: 40px;" class="img-responsive mb-1">
                                        <ul class="list-group">
                                            @foreach ($orderDetail?->orderQuantityChange as $orderQuantityChange)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span style="font-size: 12px;">{{ $orderQuantityChange->previous_quantity }}
                                                        To
                                                        {{ $orderQuantityChange->new_quantity }}
                                                    </span>
                                                    <span
                                                        class="" style="font-size: 12px; opacity: 0.7;">
                                                        {{ date('Y-m-d', strtotime($orderQuantityChange->created_at)) }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>

                        </div>

                        <div class="col-md-6">
                            <a type="submit" class="btn btn-danger"
                                href="{{ route('cancellation_product.show', ['order' => $order->id]) }}">Cancellation</a>
                        </div>
                        <div class="col-md-6">
                            <a type="submit" class="btn btn-warning"
                                href="{{ route('return_product', ['order' => $order->id]) }}">Return</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- End Content --}}
    </div>
    <!-- end row -->

    <!-- Cancel Modal -->
    <div class="modal fade cancel-order" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('cancel_order.advance_edit', ['order' => $order->id]) }}" id="canceOrderlReason">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Reason For Cancellation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="status" id="status" value="cancelled" />
                        <select id="cancelReasonInput" class="form-control form-control-sm" name="fulfilment_note"
                            required>
                            <option value="">Select</option>
                            @foreach ($cancel_reasons as $label)
                                <option value="{{ $label }}"
                                    {{ $order?->orderNoteStatus?->fulfilment_note == $label ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Ok</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

            <!-- Modal -->
            <div class="modal fade" id="shippingModal" tabindex="-1" aria-labelledby="shippingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0 brand_color">
                            <h5 class="modal-title font-weight-bold" id="shippingModalLabel">Shipping Address</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="shippingAddressForm">
                                @csrf
                                <input type="hidden" name="address_id" id="address_id" value="{{ $order?->orderAddress?->id }}">
            
                                <div class="form-group">
                                    <label for="name">Name <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $order?->orderAddress?->name }}" placeholder="Enter Name" required>
                                </div>
            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $order?->orderAddress?->mobile }}" placeholder="Enter Mobile Number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="optional_mobile">Optional Mobile</label>
                                            <input type="text" class="form-control" id="optional_mobile" name="optional_mobile" value="{{ $order?->orderAddress?->optional_mobile }}" placeholder="Enter Optional Mobile">
                                        </div>
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <label for="street_address">Street Address <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="street_address" name="street_address" value="{{ $order?->orderAddress?->street_address }}" placeholder="Enter Street Address" required>
                                </div>
            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country_name">Country <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="country_name" name="country_name" value="{{ $order?->orderAddress?->country_name }}" placeholder="Enter Country Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="division_name">Division <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="division_name" name="division_name" value="{{ $order?->orderAddress?->division_name }}" placeholder="Enter Division Name" required>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="district_name">District <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="district_name" name="district_name" value="{{ $order?->orderAddress?->district_name }}" placeholder="Enter District Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="upazila_name">Upazila <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="upazila_name" name="upazila_name" value="{{ $order?->orderAddress?->upazila_name }}" placeholder="Enter Upazila Name" required>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <label for="instruction">Special Instructions (Optional)</label>
                                    <input type="text" class="form-control" id="instruction" name="instruction" value="{{ $order?->orderAddress?->instruction }}" placeholder="Enter Special Instructions">
                                </div>
            
                                <div class="form-group">
                                    <label for="type">Address Type <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="type" name="type" value="{{ $order?->orderAddress?->type }}" placeholder="Enter Address Type (e.g., home, office)" required>
                                </div>
            
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-sm btn-outline-secondary mr-2" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            
@endsection
@push('script')
    <script src="{{ asset('backend_js/order_product/advance_edit.js') }}"></script>
    <script src="{{ asset('js/courier.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/panel/address-edit.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/panel/order-edit.js') }}?v={{ time() }}"></script>
    <script>
        function removeBox(boxNumber) {
            $('#box_' + boxNumber).remove();
        }
        var boxes = {};

        function generateBoxInputs(boxNumber, lengthUnits, weightUnits, products, order_id, box_details) {
            // Create an object to store the details of this box
            var box = {
                packageWeight: '',
                weightUnit: '',
                packageLength: '',
                lengthUnit: '',
                packageHeight: '',
                heightUnit: '',
                products: []
            };
            var productInfo = {};
            if (box_details['product_info']) {
                // Check if 'product_info' is not empty, then parse it as JSON
                productInfo = JSON.parse(box_details['product_info']);
            }

            var html = '<div class="box card" id="box_' + boxNumber + '">';
            html += '<div class="close-icon" onclick="removeBox(' + boxNumber + ')">&times;</div>';
            // Start of row (Bootstrap row class)
            html += '<div class="row p-2">';
            // Box no
            html += '<div class="col-md-12"><h3>Select Box No: ' + boxNumber + '</h3></div>';
            // Package Weight
            html += '<div class="col-md-2">';
            var packageWeightValue = box_details['weight'] ? box_details['weight'] : '';
            html +=
                '<input type="text" name="package_weight[]" placeholder="Package Weight" value="' + packageWeightValue +
                '" class="form-control form-control-sm" required>';
            html += '</div>';

            html += '<div class="col-md-2">';
            html += '<select name="weight_unit[]" class="form-control form-control-sm" required>';
            html += '<option value="">Select</option>';
            for (var weightValue in weightUnits) {
                var weightunitSelected = weightValue == box_details['weight_unit'] ? 'selected' : '';
                html += '<option ' + weightunitSelected + ' value="' + weightValue + '">' + weightUnits[weightValue] +
                    '</option>';
            }
            html += '</select>';
            html += '</div>';

            // Package Length
            html += '<div class="col-md-2">';
            var packageLengthValue = box_details['length'] ? box_details['length'] : '';
            html += '<input type="text" name="length[]" placeholder="Package Length" value="' + packageLengthValue +
                '" class="form-control form-control-sm" required>';
            html += '</div>';

            // Select for Package Length
            html += '<div class="col-md-2">';
            html += '<select name="length_unit[]" class="form-control form-control-sm" required>';
            html += '<option value="">Select</option>';
            for (var unitValue in lengthUnits) {
                var lengthUnitSelected = unitValue == box_details['length_unit'] ? 'selected' : '';
                html += '<option ' + lengthUnitSelected + ' value="' + unitValue + '">' + lengthUnits[unitValue] +
                    '</option>';
            }
            html += '</select>';
            html += '</div>';
            // Package Height
            html += '<div class="col-md-2">';
            var packageHeightValue = box_details['height'] ? box_details['height'] : '';
            html += '<input type="text" name="height[]" placeholder="Package Height" value="' + packageHeightValue +
                '" class="form-control form-control-sm" required>';
            html += '</div>';

            // Select for Package Height
            html += '<div class="col-md-2">';
            html += '<select name="height_unit[]" class="form-control form-control-sm" required>';
            html += '<option value="">Select</option>';
            for (var unitValue in lengthUnits) {
                var heightUnitSelected = unitValue == box_details['height_unit'] ? 'selected' : '';
                html += '<option ' + heightUnitSelected + ' value="' + unitValue + '">' + lengthUnits[unitValue] +
                    '</option>';
            }
            html += '</select>';
            html += '</div>';

            // Product Name and Quantity
            for (var j = 0; j < products.length; j++) {
                var product = {
                    productId: products[j]['product'].id,
                    productName: products[j]['product'].name,
                    quantity: ''
                };

                // Add product details to the box
                box.products.push(product);

                var expectedQty = ''; // Default value
                if (productInfo['products'] && productInfo['products'][j] && productInfo['products'][j]['expected_qty']) {
                    expectedQty = productInfo['products'][j]['expected_qty'];
                }

                html += '<div class="col-md-12 row mt-2">';
                html += '<div class="col-md-8 d-flex">';
                html += `<input type="checkbox" class="mr-2" name="choose_product[]">`;
                html += '<label class="" for="product_name_' + boxNumber + '">' + product.productName + '</label>';
                html +=
                    `<input type="hidden" name="box_number[]" value="${boxNumber}" class="form-control form-control-sm">`;
                html += `<input type="hidden" name="order_id[]" value="${order_id}" class="form-control form-control-sm">`;
                html +=
                    `<input type="hidden" name="product_id[]" value="${product.productId}" class="form-control form-control-sm">`;
                html +=
                    `<input type="hidden" name="product_name[]" value="${product.productName}" class="form-control form-control-sm">`;
                html += '</div>';
                html += '<div class="col-md-2">';
                html += '' + products[j]['quantity'] + '';
                html += '</div>';
                html += '<div class="col-md-2">';
                html += '<input type="text" name="product_expected_qty[]" value="' + expectedQty +
                    '" placeholder="Qty" class="form-control form-control-sm">';
                html += '</div>';
                html += '</div>';
            }

            // Add the box to the boxes object
            boxes[boxNumber] = box;

            // End of box
            html += '</div>';
            return html;
        }

        $(document).ready(function() {
            var boxCounter = 1; // To keep track of box numbers
            var order_id = <?php echo $order->id; ?>;
            var lengthUnits = <?php echo json_encode($lengthUnits); ?>;
            var weightUnits = <?php echo json_encode($weightUnits); ?>;
            var products = {!! json_encode($order->OrderDetail) !!};
            var order_product_box = {!! json_encode($order->orderProductBox) !!};


            $('#package_qty').click(function() {
                var newBoxHtml = generateBoxInputs(boxCounter, lengthUnits, weightUnits, products, order_id,
                    "");
                $('#box_details').append(newBoxHtml);
                boxCounter++;
            });
            var order_product_box = {!! json_encode($order->orderProductBox) !!};

            order_product_box.forEach(function(box) {
                var newBoxHtml = generateBoxInputs(boxCounter, lengthUnits, weightUnits, products, order_id,
                    box);
                $('#box_details').append(newBoxHtml);
                boxCounter++;
            });

            if (!order_product_box) {
                var newBoxHtml = generateBoxInputs(boxCounter, lengthUnits, weightUnits, products, order_id, "");
                $('#box_details').append(newBoxHtml);
                boxCounter++;
            }

        });
        
    </script>
@endpush
