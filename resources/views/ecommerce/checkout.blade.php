@extends('layouts.ecommerce')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web/user/checkout_page.css') }}">
    <main class="main main-test bg-gray py-3">
        <div class="container checkout-container">
            <input name="user_id" id="user_id_val" value="{{ $user?->id }}" hidden />
            <div id="temp_user_id" data-user_id="{{ $user_id }}"></div>
            <div class="row">
                <div class="col-lg-7">
                    <div id="collapseFour"
                        class="collapse card_design shadow p-3 @if (Auth::user()) show @endif">
                        <div class="shipping-info">
                            <!-- Shipping Address 1-->
                            @if (Auth::user())
                                <div class="shipping-address-card">
                                    <div class="">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="mb-0">Deliver to:</h6>
                                            <button type="button" class="btn btn-link btn-sm address-menu-toggle"
                                                class="btn btn-primary" onclick="toggleSidebar()">
                                                <i class="fas fa-plus-circle"></i> Shipping Address
                                            </button>
                                        </div>
                                        <div class="row" id="default_address_content">

                                        </div>

                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- End .col-lg-8 -->

                <div class="col-lg-5 py-2 card_design shadow">
                    <div class="order-summary">
                        <div class="summary-section-heading pl-2">Order Summary</div>

                        <table class="table table-mini-cart">
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <td class="cart-total-text">Subtotal({{ count($products) }} Item{{ count($products) > 1 ? 's' : '' }})</td>
                                    <td class="price-col">{{ $currency?->icon }} <span class="cart_total_price">0</span>
                                    </td>
                                </tr>
                                <tr class="shipping-total">
                                    <td>
                                        <div class="summary-section-heading">Shipping Fee</div>
                                    </td>

                                    <td class="shipping-col">
                                        <span>{{ $currency?->icon }} <span class="shipping_charge_amount"></span></span>
                                    </td>
                                </tr>
                                <tr class="order-total">
                                    <td>Total (VAT Inclusive if Applicable)</td>
                                    <td>
                                        <b>{{ $currency?->icon }} <span class="total-price grand_total">0.00</span></b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <button type="submit" class="btn brand_color btn-place-order float-right" id="btn_place_order"
                            style="padding: .7em 1em; margin-right: 44px;">
                            Place Order
                        </button>
                    </div>
                    <!-- End .cart-summary -->
                </div>
                <!-- End .col-lg-4 -->
                {{-- Start Show Products --}}
                {{-- Start payment Method --}}
                <div class="p-4 ml-3 mt-2 card_design shadow" style="width: 100%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="cart-table-container">
                                        <form class="pb-0 mb-0" action="{{ route('confirm_order') }}" method="POST"
                                            id="checkout-form">
                                            @csrf
                                            <!-- Other form fields -->
                                            <div class="payment-methods">
                                                <h4>Select Payment Method</h4>
                                                <div class="payment-icons">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group form-group-custom-control mb-0">
                                                                <div class="custom-control custom-radio mb-0">
                                                                    <input type="radio" id="cod" name="radio"
                                                                        value="cod" class="custom-control-input" checked>
                                                                    <label class="custom-control-label" for="cod">Cash
                                                                        On Delivery</label>
                                                                </div><!-- End .custom-checkbox -->
                                                            </div><!-- End .form-group -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div><!-- End .cart-table-container -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Payment Method --}}
                <div class="p-4 ml-3 card_design shadow" style="width: 100%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="cart-table-container">
                                        <div class="review-section">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-0 text-dark">Standard Delivery Date:
                                                        {{ \Carbon\Carbon::now()->addDays(1)->format('d M Y') }}</p>
                                                    <p class="mb-0 text-dark">Items shipped from
                                                        <strong>Aladdinne.com</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>


                                        <table class="table table-cart">
                                            <tbody id="table_body"></tbody>
                                        </table>
                                    </div><!-- End .cart-table-container -->
                                </div>
                                <div class="col-md-4">
                                    <div class="delivery-options">
                                        <h4>Choose a delivery option:</h4>

                                        <div class="form-group form-group-custom-control">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="radio"
                                                    value="13eee98c-31ed-11ee-be5c-5811220534bb" checked>
                                                <label class="custom-control-label">Standard Delivery — Estimate
                                                    Delivery Date,
                                                    {{ \Carbon\Carbon::now()->addDay(3)->format('d F') }}</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-group -->

                                        <div class="form-group form-group-custom-control mb-0">
                                            <div class="custom-control custom-radio mb-0">
                                                <input type="radio" name="radio"
                                                    value="13eef465-31ed-11ee-be5c-5811220534bb"
                                                    class="custom-control-input">
                                                <label class="custom-control-label">Express Delivery – get it Tomorrow,
                                                    {{ \Carbon\Carbon::now()->addDay()->format('d F') }}</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-group -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- End Show Products --}}
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>
    <!-- End .main -->
    <!-- footer-area -->
    @include('ecommerce.footer')
    <!-- footer-area-end -->
    <!-- Shipping Address Modal -->
    @include('ecommerce.checkout.partials.address_modal')
    <!-- End Shipping Address Modal -->
@endsection
@push('scripts')
    <script src="{{ asset('js/panel/users/checkout/address.js') }}"></script>
    <script src="{{ asset('js/panel/users/cart/checkout_page_cart.js') }}"></script>
    <script src="{{ asset('js/panel/users/common.js') }}"></script>

    <script>
        var user = <?php echo json_encode($user); ?>;

        // Start Address
        function toggleSidebar() {
            document.getElementById('address-wrapper').classList.toggle('show');
        }

        $(document).ready(function() {
            $('.add-address-link').on('click', function() {
                $('#addressModal').modal('show');
            });
        });

        // End Address
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
