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
                                <p class="mb-2">{{$company_info->name}}</p>
                                <p class="mb-2">{{$company_info->address}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">Shipping To:</h6>
                            <div class="address">
                                <p class="mb-2">{{ $order->Contact->first_name }}</p>
                                <p class="mb-2">{{ $order?->Contact?->District?->name }}, {{ $order?->Contact?->Division?->name }}</p>
                                <p class="mb-2">{{ $order?->Contact?->Union?->name }}, {{ $order?->Contact?->Union?->name }}</p>
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
                    <div class="row">
                        <div class="col-md-1">
                            <img src="{{ asset('storage/product_photo/'.$orderDetail->Product?->ProductImage?->first()->image) }}" class="img-responsive">
                        </div>
                        <div class="col-md-7">
                            <h6 class="mb-3">{{ $orderDetail->Product->name }}</h6>
                            <p class="mb-2">SKU: {{ $orderDetail->Product->seller_sku }}</p>
                            <p class="mb-0">Price:  (Inclusive Tax)</p>
                        </div>
                        <div class="col-md-4">
                            <div class="price-info">
                                <p class="mb-2">{{ $orderDetail->quantity * $orderDetail->unit_price }} Taka</p>
                                <p class="mb-0">Quantity: {{ $orderDetail->quantity }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div> <!-- end col -->


    </div>
    <!-- end row -->
@endsection
