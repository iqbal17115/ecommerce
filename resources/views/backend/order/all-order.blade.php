@extends('layouts.backend_app')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Orders</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Orders</li>
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
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">

                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Seller</th>
                                    <th>Payment Status</th>
                                    <th>Delivery Type</th>
                                    <th>Fullfilment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            {{ date('d-M-Y H:i', strtotime($order->order_date)) }}
                                        </td>
                                        <td><a href="javascript: void(0);"
                                                class="text-body font-weight-bold">{{ $order->code }}</a> </td>
                                        <td>{{ $order?->Contact?->first_name }}</td>
                                        <td>
                                            {{ $order->payable_amount }}
                                        </td>
                                        <td>
                                            Aladdinne
                                        </td>
                                        <td>
                                            <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                        </td>
                                        <td>
                                            <i class="fab fa-cc-mastercard mr-1"></i> Mastercard
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-success font-size-10">{{ ucwords($order->status) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $orders->links() }}

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
