@extends('layouts.ecommerce')
@section('content')
    <main class="main main-test">
        <div class="container checkout-container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li>
                    <a href="{{ route('cart') }}">Shopping Cart</a>
                </li>
                <li class="active">
                    <a href="checkout.html">Check Out</a>
                </li>
                <li class="disabled">
                    <a href="#">Order Complete</a>
                </li>
            </ul>

            <div class="row">

                <div class="col-lg-7">
                    <div id="collapseFour" class="collapse @if (Auth::user()) show @endif">
                        <div class="shipping-info">
                            @if (Auth::user() && Auth::user()->Contact->division_id)
                                <input type="hidden" name="shipping_division_id" id="shipping_division_id"
                                    value="{{ Auth::user()->Contact->division_id }}" />
                            @endif
                            @if (Auth::user() && Auth::user()->Contact->district_id)
                                <input type="hidden" name="shipping_district_id" id="shipping_district_id"
                                    value="{{ Auth::user()->Contact->district_id }}" />
                            @endif
                            @if (Auth::user() && Auth::user()->Contact->upazilla_id)
                                <input type="hidden" name="shipping_upazilla_id" id="shipping_upazilla_id"
                                    value="{{ Auth::user()->Contact->upazilla_id }}" />
                            @endif
                            @if (Auth::user() && Auth::user()->Contact->union_id)
                                <input type="hidden" name="shipping_union_id" id="shipping_union_id"
                                    value="{{ Auth::user()->Contact->union_id }}" />
                            @endif


                            <!-- Shipping Address -->
                            @if (Auth::user())
                                <div class="card shipping-address-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="mb-0">Deliver to:</h6>
                                            <button type="button" class="btn btn-link btn-sm" data-toggle="modal"
                                                data-target="#shippingModal">
                                                Change
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><strong class="text-dark">1. Shipping address</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <p class="shipping-address">
                                                    <span
                                                        class="shipping-name text-dark">{{ Auth::user()->name }}</span><br>
                                                    <span
                                                        class="shipping-info text-dark">{{ Auth::user()->Contact->shipping_address }}</span><br>
                                                    <span
                                                        class="shipping-info text-dark">{{ Auth::user()->Contact->division->name }}-
                                                        {{ Auth::user()->Contact->district->name }}-
                                                        {{ Auth::user()->Contact->upazila->name }}-
                                                        {{ Auth::user()->Contact->union->name }}</span><br>
                                                    <span
                                                        class="shipping-info text-dark">{{ Auth::user()->Contact->mobile }}</span><br>
                                                    <span class="shipping-email text-dark">{{ Auth::user()->email }}</span>
                                                </p>
                                                <p class="text-dark" style="font-size: 12px;">
                                                    Collect your parcel from the nearest Aladdinne Pick-up
                                                    Point with a reduced shipping fee <a href="">Check Pick-up
                                                        Points</a>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- End .col-lg-8 -->

                <div class="col-lg-5">
                    <div class="order-summary">
                        <h3>Your Order</h3>

                        <table class="table table-mini-cart">
                            <thead>
                                <tr>
                                    <th colspan="2">Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                    $default_charge = 0;
                                @endphp
                                @if (session('cart'))
                                    @foreach (session('cart') as $id => $details)
                                        @php
                                            $total += $details['sale_price'] * $details['quantity'];
                                            $product = \App\Models\Backend\Product\Product::find($id);
                                        @endphp

                                        <tr>
                                            <td class="product-col">
                                                <h3 class="product-title">
                                                    {{ $details['name'] }} ×
                                                    <span class="product-qty">{{ $details['quantity'] }}</span>
                                                </h3>
                                            </td>
                                            <td class="price-col">
                                                <span>{{ $currency->icon }}{{ $details['quantity'] * $details['sale_price'] }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <td>
                                        <h4>Subtotal</h4>
                                    </td>
                                    <td class="price-col">{{ $currency->icon }} <span
                                            class="cart_total_price">{{ $total }}</span></td>
                                </tr>
                                <tr class="order-shipping">
                                    <td class="text-left" colspan="2">
                                        <h4 class="m-b-sm">Shipping</h4>

                                        <div class="form-group form-group-custom-control">
                                            <div class="custom-control custom-radio d-flex">
                                                <input type="radio" class="custom-control-input" name="radio" checked />
                                                <label class="custom-control-label">Local pickup</label>
                                            </div>
                                            <!-- End .custom-checkbox -->
                                        </div>
                                        <!-- End .form-group -->

                                        <div class="form-group form-group-custom-control mb-0">
                                            <div class="custom-control custom-radio d-flex mb-0">
                                                <input type="radio" name="radio" class="custom-control-input">
                                                <label class="custom-control-label">Flat Rate</label>
                                            </div>
                                            <!-- End .custom-checkbox -->
                                        </div>
                                        <!-- End .form-group -->
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
                                <tr class="order-total">
                                    <td>
                                        <h4>Total</h4>
                                    </td>
                                    <td>
                                        <b>{{ $currency->icon }}<span class="total-price">0.00</span></b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="payment-methods">
                            <h4 class="">Payment Methods</h4>
                            <div class="info-box with-icon p-0">
                                <p>
                                    Sorry, it seems that there are no available payment methods for your state. Please
                                    contact us if you require assistance or wish to make alternate arrangements.
                                </p>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark btn-place-order" form="shipping-address-form">
                            Place_order
                        </button>
                    </div>
                    <!-- End .cart-summary -->
                </div>
                <!-- End .col-lg-4 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>
    <!-- End .main -->
    <!-- Shipping Address Modal -->
    <div class="modal fade" id="shippingModal" tabindex="-1" role="dialog" aria-labelledby="shippingModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shippingModalLabel">Update Shipping Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('confirm_order') }}" method="POST" id="shipping-address-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-1 pb-2">
                                    <label>Name <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" name="shipping_contact_no"
                                        @if (Auth::user()) value="{{ Auth::user()->name }}" @endif
                                        class="form-control" placeholder="Name" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-1 pb-2">
                                    <label>Contact No. <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" name="shipping_contact_no"
                                        @if (Auth::user()) value="{{ Auth::user()->Contact->mobile }}" @endif
                                        class="form-control" placeholder="Contact No." required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="division">Province</label>
                                    <select name="division_id" id="division" class="form-control" required>
                                        <option value="" selected="selected"></option>
                                        @foreach ($divisions as $division)
                                            <option @if (Auth::user() && Auth::user()->Contact->division_id == $division->id) selected @endif
                                                value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="district">District</label>
                                    <select name="district_id" id="district" class="form-control" required>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="upazila">Upazila</label>
                                    <select name="upazilla_id" id="upazila" class="form-control" required>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="union">Union</label>
                                    <select name="union_id" id="union" class="form-control" required>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group mb-1 pb-2">
                                    <label>Street address <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" name="shipping_address"
                                        @if (Auth::user()) value="{{ Auth::user()->Contact->shipping_address }}" @endif
                                        class="form-control" placeholder="House number and street name" required />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveShippingChanges">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shipping Address Modal -->

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

    @include('ecommerce.checkout-js')
     <script src="{{ asset('backend_js/cart.js') }}"></script>
    <script src="{{ asset('backend_js/shipping_charge.js') }}"></script>
@endpush
