@extends('layouts.ecommerce')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/web/user/cart_page.css') }}">
<main class="main bg-gray py-3">
    <div class="container">
        <div id="temp_user_id" data-user_id="{{ $user_id }}"></div>
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table-container table-responsive">
                    <table class="table table-cart align-middle mb-0">
                        <thead class="bg-light">
                            @php
                            $minDate = \Carbon\Carbon::now()->addDays(config('contents.delivery.min_days'))->format('d M Y');
                            $maxDate = \Carbon\Carbon::now()->addDays(config('contents.delivery.max_days'))->format('d M Y');
                            @endphp
                            <tr>
                                <th class="checkbox-col">
                                    <input type="checkbox" id="select_all_products">
                                </th>
                                <th colspan="6" class="text-end">
                                    <span class="text-dark">Standard, Estimate Delivery</span>
                                    <span class="text-warning fw-bold">{{ $minDate }} – {{ $maxDate }}</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            {{-- Items will be injected here dynamically --}}
                        </tbody>
                    </table>
                </div>
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="cart-summary card_design shadow p-2">
                    <div class="summary-section-heading pl-2">Order Summary</div>

                    <table class="table table-totals">
                        <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td style="text-align: right;">{{ $currency?->icon }} <span class="cart_total_price"></span>
                                </td>
                            </tr>

                            <tr class="shipping-total">
                                <td>
                                    Shipping Carge
                                </td>

                                <td class="shipping-col" style="text-align: right;">
                                    <span>{{ $currency?->icon }} <span class="shipping_charge_amount"></span></span>
                                </td>
                            </tr>
                            <tr class="discount-total">
                                <td>
                                    Discount
                                </td>

                                <td class="shipping-col" style="text-align: right;">
                                    <span>{{ $currency?->icon }} <span class="coupon_discount"></span></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div>
                                        <div class="cart-discount mb-0">
                                            <form class="mb-0" id="apply_coupon">
                                                <div class="input-group">
                                                    <input type="text" name="coupon_code" id="coupon_code" class="form-control form-control-sm"
                                                        placeholder="Coupon Code" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-sm text-light" style="background-color: #25a5d8;" type="submit">Apply Coupon</button>
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
                                <td style="text-align: right;">{{ $currency?->icon }} <span class="total-price grand_total"></span></td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="checkout-methods proceed_to_checkout">
                        <a href="{{ route('checkout') }}" class="btn btn-block brand_color text-dark">Proceed to Checkout
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
@endsection
@push('scripts')
<script src="{{ asset('js/panel/users/cart/cart_page.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_drawer.js') }}"></script>
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
@endpush