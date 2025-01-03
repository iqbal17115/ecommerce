@extends('layouts.backend_app')
@push('css')

@endpush
@section('content')
<!-- start page title -->
<div class="row d-print-none">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Detail</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="invoice-title">
                    <h4 class="float-right font-size-16">Order # 12345</h4>
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $company_info->logo) }}" alt="logo" height="20" />
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <address>
                            <strong>Billed To:</strong><br>
                            Aladdinne.com<br>
                            House No#65/1,choyhisa ,pirojpur,Sonargaon,Narayangonj,Dhaka,Bangladesh<br>
                        </address>
                    </div>
                    <div class="col-sm-6 text-sm-right">
                        <address class="mt-2 mt-sm-0">
                            <strong>Shipped To:</strong><br>
                            {{ $order?->orderAddress?->name }}<br>
                            {{ $order?->orderAddress?->street_address }}<br>
                            {{ $order?->orderAddress?->division_name }}, {{ $order?->orderAddress?->district_name }}, {{ $order?->orderAddress?->upazila_name }}<br>
                            {{ $order?->orderAddress?->shipping_address }}<br>
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mt-3">
                        <address>
                            <strong>Payment Method:</strong><br>
                            Visa ending **** 4242<br>
                            jsmith@email.com
                        </address>
                    </div>
                    <div class="col-sm-6 mt-3 text-sm-right">
                        <address>
                            <strong>Order Date:</strong><br>
                            {{ date('d-M-Y H:i', strtotime($order->order_date)) }}<br><br>
                        </address>
                    </div>
                </div>
                <div class="py-2 mt-3">
                    <h3 class="font-size-15 font-weight-bold">Order summary</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 70px;">SI.</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Qty.</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach ($order->OrderDetail as $orderDetail)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td style="word-wrap: break-word; white-space: pre-line;">
                                    {{ $orderDetail->Product->name }}</td>
                                <td class="text-right">{{ $orderDetail->unit_price }}</td>
                                <td class="text-right">{{ $orderDetail->quantity }}</td>
                                <td class="text-right">{{ $orderDetail->quantity * $orderDetail->unit_price }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-right">Sub Total</td>
                                <td class="text-right">
                                    {{ $order->OrderDetail->sum('unit_price') }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="border-0 text-right">
                                    <strong>Shipping</strong>
                                </td>
                                <td class="border-0 text-right">0.00</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="border-0 text-right">
                                    <strong>Total</strong>
                                </td>
                                <td class="border-0 text-right">
                                    <h4 class="m-0">
                                        {{
                                            $order->OrderDetail->sum(function ($orderDetail) {
                                               return $orderDetail->quantity * $orderDetail->unit_price;
                                           })
                                        }}
                                    </h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-print-none">
                    <div class="float-right">
                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i
                                class="fa fa-print"></i></a>
                        <a href="#" class="btn btn-primary w-md waves-effect waves-light">Send</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->


<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                document.write(new Date().getFullYear())
                </script> © Skote.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-right d-none d-sm-block">
                    Design & Develop by Themesbrand
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end main content-->
@endsection
