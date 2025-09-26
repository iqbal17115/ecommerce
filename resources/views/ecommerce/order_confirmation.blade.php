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
                    @if ($order)
                        <div class="row mb-1">
                            <div class="col-md-6 text-left">
                                <p style="font-size: 18px; font-weight: bold; margin: 0;">Order ID: <span class="order-number">{{ $order->code }}</span></p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p class="order-status">{{ $order->status }}</p>
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
                                        @foreach ($order->orderDetail as $orderDetail)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('storage/product_photo/' . $orderDetail?->Product?->ProductImage->first()->image) }}"
                                                        class="product-image" alt="Product Image">
                                                </td>
                                                <td>{{ $orderDetail?->quantity }}</td>
                                                <td>{{ $currency?->icon }} {{ $orderDetail?->unit_price }}</td>
                                                <td>{{ $currency?->icon }} {{ $orderDetail?->unit_price * $orderDetail?->quantity }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <!-- Table footer -->
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Total Amount:</th>
                                            <td>{{ $currency->icon }} {{ number_format($order->total_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Shipping Charge:</th>
                                            <td>{{ $currency->icon }} {{ number_format($order->shipping_charge, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Payable Amount:</th>
                                            <td>{{ $currency->icon }} {{ number_format($order->payable_amount, 2) }}</td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                            <p><strong>Note:</strong> {{ $order->note }}</p>
                            <!-- Add more order details as needed -->
                        </div>

                        <div class="payment-details mb-4 text-center">
                            <h5 class="mb-3">Payment Method</h5>
                            <p><strong>Payment Method Used:</strong> {{ $order->payment_method }}</p>
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
@push('scripts')
<script src="{{ asset('js/panel/users/cart/cart_drawer.js') }}?v={{ time() }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
        CartDrawer.loadCartCount(); // ✅ Now it will work

        const cartToggle = document.getElementById('cartToggle');

        if (cartToggle) {
            cartToggle.addEventListener('click', () => {
                CartDrawer.load(); // Load on demand
            });
        }
    });
    </script>
    
    <script>
        window.onload = function() {
            // Code to be executed after rendering the full layout
            function lazyLoad() {
                const lazyImages = document.querySelectorAll('.lazy-load');
                lazyImages.forEach(img => {
                    if (img.getBoundingClientRect().top <= window.innerHeight && img.getBoundingClientRect()
                        .bottom >= 0 && getComputedStyle(img).display !== 'none') {
                        img.src = img.dataset.src;
                        img.classList.remove('lazyload');
                    }
                });
            }

            // Check for visible images on page load
            document.addEventListener("DOMContentLoaded", lazyLoad);
            // Get an array of all the image elements you want to load
            var images = document.getElementsByClassName('lazy-load');

            // Set up an IntersectionObserver to detect when the images are in view
            var options = {
                rootMargin: '0px',
                threshold: 0.1
            };

            var observer = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    // If the image is in the viewport, load it by setting its `src` attribute to the appropriate URL
                    if (entry.isIntersecting) {
                        var image = entry.target;
                        var imageUrl = image.getAttribute('data-src');
                        image.src = imageUrl;
                        image.classList.remove(
                            'lazy-load'
                        ); // Remove the class to prevent the image from being loaded again
                        observer.unobserve(
                            image); // Stop observing the image once it has been loaded
                    }
                });
            }, options);

            // Loop through all the image elements and observe them with the IntersectionObserver
            for (var i = 0; i < images.length; i++) {
                var image = images[i];
                observer.observe(image);
            }
        };
    </script>
@endpush
