@extends('layouts.ecommerce')
@section('content')
    <style>
        .payment-icon {
            display: inline-block;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 0.3s;
        }

        .payment-icon.active {
            opacity: 1;
        }
    </style>
    <main class="main main-test">
        <div class="container checkout-container">

            <div class="row">

                <div class="col-lg-7">
                    <div id="collapseFour" class="collapse @if (Auth::user()) show @endif">
                        <div class="shipping-info">

                            <!-- Shipping Address -->
                            @if (Auth::user())
                                <div class="card shipping-address-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="mb-0">Deliver to:</h6>
                                            <button type="button" class="btn btn-link btn-sm" class="btn btn-primary"
                                                data-toggle="modal" data-target="#myModal">
                                                <i class="fas fa-plus-circle"></i> Shipping Address
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><strong class="text-dark">1. Shipping address</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <p class="shipping-address">
                                                    <span
                                                        class="shipping-name text-dark">{{ Auth::user()?->name }}</span><br>
                                                    <span
                                                        class="shipping-info text-dark">{{ Auth::user()?->Contact?->shipping_address }}</span><br>
                                                    <span
                                                        class="shipping-info text-dark">{{ Auth::user()?->Contact?->division?->name }}-
                                                        {{ Auth::user()?->Contact?->district?->name }}-
                                                        {{ Auth::user()?->Contact?->upazila?->name }}-
                                                        {{ Auth::user()?->Contact?->union?->name }}</span><br>
                                                    <span
                                                        class="shipping-info text-dark">{{ Auth::user()?->Contact?->mobile }}</span><br>
                                                    <span class="shipping-email text-dark">{{ Auth::user()?->email }}</span>
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
                        <h3>Order Summary</h3>

                        <table class="table table-mini-cart">
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <td>
                                        <h4>Subtotal({{ count($products) }} Item{{ count($products) > 1 ? 's' : '' }})
                                        </h4>
                                    </td>
                                    <td class="price-col">{{ $currency?->icon }} <span class="cart_total_price">0</span>
                                    </td>
                                </tr>
                                <tr class="shipping-total">
                                    <td>
                                        <h4>Shipping Fee</h4>
                                    </td>

                                    <td class="shipping-col">
                                        <span>{{ $currency?->icon }} <span class="shipping_amount"></span></span>
                                    </td>
                                </tr>
                                <tr class="order-total">
                                    <td>
                                        <h4>Total (VAT Inclusive if Applicable)</h4>
                                    </td>
                                    <td>
                                        <b>{{ $currency?->icon }} <span class="total-price">0.00</span></b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <button type="submit" class="btn btn-dark btn-place-order" id="btn-place-order">
                            Place Order
                        </button>
                    </div>
                    <!-- End .cart-summary -->
                </div>
                <!-- End .col-lg-4 -->
                {{-- Start Show Products --}}
                @if ($products)
                    {{-- Start payment Method --}}
                    <div class="card p-4 mx-3" style="width: 100%;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="cart-table-container">
                                            <form action="{{ route('confirm_order') }}" method="POST" id="checkout-form">
                                                @csrf
                                                <!-- Other form fields -->
                                                <div class="payment-methods">
                                                    <h4>Select Payment Method</h4>
                                                    <div class="payment-icons">
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <a href="javascript:void(0);" class="payment-icon"
                                                                    data-payment="bkash">
                                                                    <img style="height: 50px;"
                                                                        src="{{ asset('payments/path_to_bkash_icon.png') }}"
                                                                        alt="bKash">
                                                                </a>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <a href="javascript:void(0);" class="payment-icon"
                                                                    data-payment="rocket">
                                                                    <img style="height: 50px;"
                                                                        src="{{ asset('payments/path_to_rocket_icon.png') }}"
                                                                        alt="Rocket">
                                                                </a>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <a href="javascript:void(0);" class="payment-icon"
                                                                    data-payment="nogod">
                                                                    <img style="height: 50px;"
                                                                        src="{{ asset('payments/path_to_nogod_icon.png') }}"
                                                                        alt="Nogod">
                                                                </a>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <a href="javascript:void(0);" class="payment-icon"
                                                                    data-payment="cod">
                                                                    <img style="height: 50px;"
                                                                        src="{{ asset('payments/path_to_cod_icon.png') }}"
                                                                        alt="Cash on Delivery">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="selected_payment" id="selected-payment"
                                                    value="" required>
                                            </form>
                                        </div><!-- End .cart-table-container -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Payment Method --}}
                    <div class="card p-4 mx-3" style="width: 100%;">
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
                                                <tbody>
                                                    @php
                                                        $total = 0;
                                                        $allStatus1 = true;
                                                    @endphp
                                                    @if ($products)
                                                        @foreach ($products as $id => $details)
                                                            <tr class="product-row cart-{{ $id }}"
                                                                data-id="{{ $id }}">
                                                                <td>
                                                                    <figure class="product-image-container">
                                                                        <a href="javascript:void(0);"
                                                                            class="product-image">
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
                                                                        <a
                                                                            href="javascript:void(0);">{{ $details['name'] }}</a>
                                                                    </h5>
                                                                </td>
                                                                <td>{{ $currency?->icon }}{{ $details['sale_price'] }}
                                                                </td>
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
                @endif
                {{-- End Show Products --}}
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </main>
    <!-- End .main -->
    <!-- Shipping Address Modal -->
    @include('ecommerce.checkout.partials.address_modal')
    <!-- End Shipping Address Modal -->

    <!-- footer-area -->
    @include('ecommerce.footer')
    <!-- footer-area-end -->
    <script src="{{ asset('js/panel/address/address.js') }}"></script>

    <script>
        function userAddress() {
            loadUserAddress(@json($user->id ?? null));
        }
        $(document).ready(function() {


            userAddress();

            function setAddressData(data) {
                // Initialize an empty variable to store the card HTML
                let cardHTML = '';
                cardHTML += `
    <div class="col-md-3 mb-3">
    <div class="card text-center dashed-border-card address_modal" id="address_modal" data-toggle="modal"
        data-target="#userAddressModal">
        <div class="card-body">
            <i class="fas fa-plus-circle plus-icon"></i>
            <p class="card-text add-address-text">Add Address</p>
        </div>
    </div>
    </div>
`;
                // Loop through the dataArray
                data.forEach(data => {
                    const address = data.is_default == 1 ? 'Default' : '';
                    const set_as_default_address = data.is_default == 0 ?
                        `<span class="mx-1">|</span><a href="javascript:void(0);" class="text-sm" id="set_as_default_address" data-address_id="${data.id}">Set As Default</a>` :
                        '';
                    const remove_address = data.is_default == 0 ?
                        `<span class="mx-1">|</span><a href="javascript:void(0);" class="text-sm" id="remove_address" data-address_id="${data.id}">Remove</a>` :
                        '';

                    cardHTML += `
        <div class="col-md-3 mb-3">
        <div class="card bg-light mb-3">
        <div class="card-header">
        <div class="d-flex justify-content-between">
  <span class="mr-3">Address</span>
  <span class="mx-auto">${address}</span>
  <span class="ml-auto">${data.type}</span>
</div>

      </div>

            <div class="card-body">
                <h4 class="card-title">${data.name}</h4>
                <div class="card-text">${data.street_address}</div>
                <div class="card-text">${data.building_name}</div>
                <div class="card-text">${data.nearest_landmark}</div>
                <div class="card-text">${data.district}, ${data.division}</div>
                <div class="card-text">${data.country}</div>
                <div class="card-text">Phone No: ${data.mobile}</div>
                <div class="card-text">Additional No: ${data.optional_mobile}</div>
                <a href="javascript:void(0);" id="instruction_modal" class="text-info mt-1 text-decoration-none" data-toggle="modal" data-id="${data.id}" data-target="#exampleModal">Add delivery instructions<a>
            </div>
            <div class="card-footer">
                <a href="javascript:void(0);" class="text-sm edit_address" id="edit_address" data-address_id="${data.id}">Edit</a>
                ${remove_address}
                ${set_as_default_address}
            </div>
        </div>
        </div>
    `;
                });
                cardHTML += ``;

                $("#address_content").html(cardHTML);
            }

            function loadUserAddress(user_id) {
                getDetails(
                    "/api/user-address/lists?user_id=" + user_id,
                    (data) => {
                        console.log(data.results.data);
                        setAddressData(data.results.data);
                    },
                    (error) => {

                    }
                );
            }
        });

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
    <script src="{{ asset('js/panel/web/checkout/address.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#btn-place-order").click(function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Validate save_shipping_address form
                if ($("#shipping-address-add-form")[0].checkValidity()) {
                    // If the save_shipping_address form is valid, submit it
                    submitShippingAddressForm();
                } else {
                    // Show validation errors for save_shipping_address form
                    $("#shipping-address-add-form").addClass('was-validated');
                }
            });

            function submitShippingAddressForm() {
                var shippingFormData = $("#shipping-address-add-form").serialize();

                $.ajax({
                    type: "POST",
                    url: "{{ route('save_shipping_address') }}",
                    data: shippingFormData,
                    success: function(response) {
                        var selectedPayment = $('.payment-icon.active').data('payment');
                        if (selectedPayment) {
                            // If the selected payment option is validated, proceed to submitShippingAddressForm
                            // submitCheckoutForm();
                        } else {
                            alert('Select payment Method Please');
                        }
                    },
                    error: function(error) {
                        // Handle error response here
                        console.log(error);
                    }
                });
            }

            function submitCheckoutForm() {
                // Validate checkout-form
                if ($("#checkout-form")[0].checkValidity()) {
                    var selectedPayment = $('.payment-icon.active').data('payment');
                    var checkoutFormData = $("#checkout-form").serialize();
                    var selectedValue = $('input.custom-control-input:checked').val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('confirm_order') }}",
                        data: checkoutFormData + '&selected_payment=' + selectedPayment +
                            '&shipping_method=' + selectedValue,
                        success: function(response) {
                            if (response.status === 'success') {
                                window.location.href =
                                    "{{ route('order_confirmation') }}"; // Redirect to order_confirmation page
                            }
                        },
                        error: function(error) {
                            // Handle error response here
                            console.log(error);
                        }
                    });
                } else {
                    // Show validation errors for checkout-form
                    $("#checkout-form").addClass('was-validated');
                }
            }



            $('.payment-icon').click(function(event) {
                event.preventDefault();
                $('.payment-icon').removeClass('active');
                $(this).addClass('active');

                var selectedPayment = $(this).data('payment');

                $('#selected-payment').val(selectedPayment);
            });

            $("#shipping-address-add-form").submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                var formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ route('save_shipping_address') }}",
                    data: formData,
                    success: function(response) {
                        // Handle success response here
                        window.location.reload();
                    },
                    error: function(error) {
                        // Handle error response here
                        console.log(error);
                    }
                });
            });

            // Shipping Method Checked
            $(".custom-control-input").on('change', function(event) {
                shipping_method_id = $(this).val();
                calculateShippingCharges(shipping_method_id);
            });
        });
        // calculateShippingCharges();
    </script>
@endpush
