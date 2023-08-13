@extends('layouts.ecommerce')
@section('content')
    <main class="main">
        <div class="container">

            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-table-container">
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="checkbox-col">
                                        <input type="checkbox" id="selectAllProducts">
                                    </th>
                                    <td class="text-right" colspan="5" style="text-transform: capitalize;">
                                        <span class="text-dark">Standard, Estimate Delivery</span> <span
                                            style="color: #ff6600; font-weight: bold;">{{ $estimatedDeliveryDate }}</span>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                    $allStatus1 = true;
                                @endphp
                                @if ($cart_products)
                                    @foreach ($cart_products as $id => $details)
                                        @php
                                            $total += $details['status'] == 1 ? $details['sale_price'] * $details['quantity'] : 0;
                                            if ($details['status'] != 1) {
                                                $allStatus1 = false;
                                            }
                                        @endphp
                                        {{-- @php $total += $details['sale_price'] * $details['quantity'] @endphp --}}

                                        <tr class="product-row cart-{{ $id }}" data-id="{{ $id }}">
                                            <td class="checkbox-col">
                                                <input type="checkbox" class="product-checkbox"
                                                    data-product-id="{{ $id }}"
                                                    {{ $details['status'] == 1 ? 'checked' : '' }}
                                                    data-product-status="{{ $details['status'] }}">
                                            </td>
                                            <td>
                                                <figure class="product-image-container">
                                                    <a href="javascript:void(0);" class="product-image">
                                                        <img src="{{ asset('storage/product_photo/' . $details['image']) }}"
                                                            alt="product">
                                                    </a>

                                                    <a href="javascript:void(0);"
                                                        class="btn-remove remove-from-cart icon-cancel"
                                                        title="Remove Product"></a>
                                                </figure>
                                            </td>
                                            <td class="product-col">
                                                <h5 class="product-title">
                                                    <a href="javascript:void(0);">{{ $details['name'] }}</a>
                                                </h5>
                                            </td>
                                            <td>{{ $currency->icon }}{{ $details['sale_price'] }}</td>
                                            <td>
                                                <div class="product-single-qty">
                                                    <input value="{{ $details['quantity'] }}"
                                                        class="horizontal-quantity form-control product-quantity-{{ $id }}"
                                                        type="text">
                                                </div><!-- End .product-single-qty -->
                                            </td>
                                            <td class="text-right"><span
                                                    class="subtotal-price subtotal-price-{{ $id }}">{{ $details['quantity'] * $details['sale_price'] }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>

                        </table>
                    </div><!-- End .cart-table-container -->
                </div><!-- End .col-lg-8 -->

                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h3>CART TOTALS</h3>

                        <table class="table table-totals">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>{{ $currency->icon }} <span class="cart_total_price">{{ $total }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="text-left">
                                        <h4>Shipping</h4>

                                        <div class="form-group form-group-custom-control">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="radio" checked>
                                                <label class="custom-control-label">Local pickup</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-group -->

                                        <div class="form-group form-group-custom-control mb-0">
                                            <div class="custom-control custom-radio mb-0">
                                                <input type="radio" name="radio" class="custom-control-input">
                                                <label class="custom-control-label">Flat rate</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-group -->
                                    </td>
                                </tr>
                                <tr class="shipping-total">
                                    <td>
                                        <h4>Shipping Carge</h4>
                                    </td>

                                    <td class="shipping-col">
                                        <span>{{ $currency->icon }} <span class="shipping_amount"></span></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="float-left">
                                            <div class="cart-discount mb-0">
                                                <form action="#">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Coupon Code" required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-sm" type="submit">Apply Coupon</button>
                                                        </div>
                                                    </div><!-- End .input-group -->
                                                </form>
                                            </div>
                                        </div><!-- End .float-left -->
                                    </td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td>{{ $currency->icon }} <span class="total-price"></span></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="checkout-methods">
                            <a href="{{ route('checkout') }}" class="btn btn-block btn-dark">Proceed to Checkout
                                <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div><!-- End .cart-summary -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-6"></div><!-- margin -->
    </main><!-- End .main -->
    <!-- footer-area -->
    @include('ecommerce.footer')
    <!-- footer-area-end -->
    @include('ecommerce.sidebar-js')

    <script>
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
        $(document).ready(function() {
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
        });
    </script>
@endsection
@push('scripts')
    <script src="{{ asset('backend_js/cart.js') }}"></script>
    <script src="{{ asset('backend_js/shipping_charge.js') }}"></script>
    <script>
        // Check or uncheck the "selectAllProducts" checkbox on page load
        $('#selectAllProducts').prop('checked', {{ $allStatus1 ? 'true' : 'false' }});
    </script>
@endpush
