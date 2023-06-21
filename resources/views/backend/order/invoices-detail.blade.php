@extends('layouts.backend_app')

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
                                {{ $order->Contact->first_name }}<br>
                                {{ $order?->Contact?->address }}<br>
                            </address>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <address class="mt-2 mt-sm-0">
                                <strong>Shipped To:</strong><br>
                                {{ $order?->Contact?->District?->name }}, {{ $order?->Contact?->Division?->name }}<br>
                                {{ $order?->Contact?->Union?->name }}, {{ $order?->Contact?->Union?->name }}<br>
                                {{ $order?->Contact?->shipping_address }}<br>
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
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th>Item</th>
                                    <th class="text-right">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($order->OrderDetail as $orderDetail)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td style="word-wrap: break-word; white-space: pre-line;">{{ $orderDetail->Product->name }}</td>
                                        <td class="text-right">{{ $currency->icon }}{{ number_format($orderDetail->unit_price, 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-right">Sub Total</td>
                                    <td class="text-right">{{ $currency->icon }}{{ number_format($order->OrderDetail->sum('unit_price'), 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-right">
                                        <strong>Shipping</strong>
                                    </td>
                                    <td class="border-0 text-right">{{ $currency->icon }}0.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-right">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="border-0 text-right">
                                        <h4 class="m-0">{{ $currency->icon }}{{ number_format($order->OrderDetail->sum('unit_price'), 2) }}</h4>
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
