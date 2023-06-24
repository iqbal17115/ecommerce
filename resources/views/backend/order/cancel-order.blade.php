@extends('layouts.backend_app')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Cancel Order</h4>

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
                        <div class="col-md-6 h6">Order Cancellation</div>
                        <div class="col-md-6 text-right h6">Order ID: <span
                                class="font-weight-bold">{{ $order?->code }}</span></div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="mb-3">Order Summary</h6>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2">Order Date: {{ date('d-M-Y H:i', strtotime($order->order_date)) }}</p>
                                    <p class="mb-2">Delivery Date: {{ date('d-M-Y H:i', strtotime($order->order_date)) }}
                                    </p>
                                    <p class="mb-2">Cancel Date: {{ date('d-M-Y H:i', strtotime(now())) }}</p>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div><!-- end col -->
                        <div class="col-md-6">
                            <p class="mb-2">Fulfillment: seller</p>
                            <p class="mb-2">Sales Channel:: {{ $company_info->name }}</p>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-3">Ship To</h6>
                    <div class="address">
                        <p class="mb-2">{{ $order->Contact->first_name }}</p>
                        <p class="mb-2">{{ $order?->Contact?->District?->name }},
                            {{ $order?->Contact?->Division?->name }}</p>
                        <p class="mb-2">{{ $order?->Contact?->Union?->name }},
                            {{ $order?->Contact?->Upazila?->name }},<span class="text-danger font-weight-bold"> {{ $order?->Contact?->shipping_address }}</span></p>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title mb-4">Order Details</h5>
                    <!-- Assuming you have an array of products called 'products' -->
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Order ID</th>
                              <th>Image</th>
                              <th>Product Name</th>
                              <th>Quantity</th>
                              <th>Unit Price</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($order->OrderDetail as $orderDetail)
                            <tr>
                              <td>{{ $order->code }}</td>
                              <td>
                                <img src="{{ asset('storage/product_photo/' . $orderDetail->Product->ProductImage->first()->image) }}"
                                  style="width:70px; height: 70px;" class="img-responsive">
                              </td>
                              <td>{{ $orderDetail->Product->name }}</td>
                              <td>{{ $orderDetail->quantity }}</td>
                              <td>{{ $orderDetail->unit_price }}</td>
                              <td>{{ $orderDetail->quantity * $orderDetail->unit_price }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="6">
                                <div class="d-flex justify-content-end">
                                  <button class="btn btn-danger me-3" onclick="cancelOrder()">Order Cancel</button>
                                </div>
                                <div class="reasons-for-cancellation">
                                  <p class="mb-1">Reason For Cancellation:</p>
                                  <label class="checkbox-label mb-1">
                                    <input type="checkbox" name="reason" value="shipping_undeliverable">
                                    Shipping Address Undeliverable
                                  </label>
                                  <label class="checkbox-label mb-1">
                                    <input type="checkbox" name="reason" value="pricing_error">
                                    Pricing Error
                                  </label>
                                  <label class="checkbox-label mb-1">
                                    <input type="checkbox" name="reason" value="out_of_stock">
                                    Out of Stock
                                  </label>
                                </div>
                              </td>
                            </tr>
                          </tfoot>
                        </table>
                      </div>


                </div>
            </div>
        </div> <!-- end col -->

    </div>
    <!-- end row -->
@endsection
