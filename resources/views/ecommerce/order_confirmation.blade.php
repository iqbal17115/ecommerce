@extends('layouts.ecommerce')

@push('css')
<style>
    .card {
        border-radius: 10px;
    }

    .order-details,
    .payment-details {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
    }

    .order-details p,
    .payment-details p {
        margin-bottom: 10px;
    }

    .btn-primary {
        background-color: #4caf50;
        border-color: #4caf50;
    }

    .btn-primary:hover {
        background-color: #45a049;
        border-color: #45a049;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    /* Additional styles for order number and status */
    .order-number {
        font-size: 18px;
        font-weight: bold;
        color: #4caf50; /* Green color for order number */
    }

    .order-status {
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase; /* Capitalize the status */
        color: #ff6600; /* Orange color for status */
    }

    /* Center align the image */
    .product-image {
        display: block;
        margin: 0 auto;
        width: 70px;
        height: 70px;
    }
</style>
@endpush

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow p-4">
                <div class="card-body">
                    <h4 class="mb-2 text-center">Thank You for Your Order!</h4>
                    @if ($confirmedOrder)
                        <div class="row mb-1">
                            <div class="col-md-6 text-left">
                                <p class="order-number">{{ $confirmedOrder->code }}</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p class="order-status">{{ $confirmedOrder->status }}</p>
                            </div>
                        </div>

                        <div class="order-details mb-4 text-center">
                            <h5 class="mb-3">Order Details</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <!-- Table header -->
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table data -->
                                        @foreach ($confirmedOrder->orderDetail as $orderDetail)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('storage/product_photo/' . $orderDetail->Product->ProductImage->first()->image) }}"
                                                        class="product-image" alt="Product Image">
                                                </td>
                                                <td>{{ $orderDetail->quantity }}</td>
                                                <td>${{ $orderDetail->unit_price }}</td>
                                                <td>${{ $orderDetail->unit_price * $orderDetail->quantity }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <!-- Table footer -->
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Total Amount:</th>
                                            <td>${{ $confirmedOrder->total_amount }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <p><strong>Note:</strong> {{ $confirmedOrder->note }}</p>
                            <!-- Add more order details as needed -->
                        </div>

                        <div class="payment-details mb-4 text-center">
                            <h5 class="mb-3">Payment Method</h5>
                            <p><strong>Payment Method Used:</strong> {{ $confirmedOrder->payment_method }}</p>
                            <!-- Add more payment method details as needed -->
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                        </div>
                    @else
                        <div class="alert alert-danger mb-4" role="alert">
                            <strong>Oops!</strong> No order data found.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
