@extends('layouts.ecommerce')
@section('content')
<main class="main main-test">
    <div class="container checkout-container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li>
                <a href="{{ route('cart') }}">Shopping Cart</a>
            </li>
            <li class="active">
                <a href="checkout.html">Checkout</a>
            </li>
            <li class="disabled">
                <a href="#">Order Complete</a>
            </li>
        </ul>

        <div class="login-form-container">
            @if(!Auth::user())
            <h4>Returning customer?
                <button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseOne" class="btn btn-link btn-toggle">Login</button>
            </h4>
            @endif
            <div id="collapseOne" class="collapse">
                <div class="login-section feature-box">
                    <div class="feature-box-content">
                        <form method="POST" action="{{ route('customer-login') }}" id="login-form">
                            @csrf
                            <p>
                                If you have shopped with us before, please enter your details below. If you are a new
                                customer, please proceed to the Billing & Shipping section.
                            </p>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mb-0 pb-1">Username or email <span
                                                class="required">*</span></label>
                                        <input type="text" name="mobile" class="form-control" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mb-0 pb-1">Password <span class="required">*</span></label>
                                        <input type="password" name="password" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn">LOGIN</button>

                            <div class="form-footer mb-1">
                                <div class="custom-control custom-checkbox mb-0 mt-0">
                                    <input type="checkbox" class="custom-control-input" id="lost-password" />
                                    <label class="custom-control-label mb-0" for="lost-password">Remember
                                        me</label>
                                </div>

                                <a href="forgot-password.html" class="forget-password">Lost your password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-7">
                <!-- Shipping Address -->
                @if(Auth::user())
                <div class="form-group">
                    <div class="custom-control custom-checkbox mt-0">
                        <input type="checkbox" checked class="custom-control-input" id="different-shipping" />
                        <label class="custom-control-label" data-toggle="collapse" data-target="#collapseFour"
                            aria-controls="collapseFour" for="different-shipping">Shipping address</label>
                    </div>
                </div>
                @endif
                <div id="collapseFour" class="collapse @if(Auth::user()) show @endif">
                    <div class="shipping-info">
                        @if(Auth::user() && Auth::user()->Contact->division_id)
                        <input type="hidden" name="shipping_division_id" id="shipping_division_id"
                            value="{{ Auth::user()->Contact->division_id }}" />
                        @endif
                        @if(Auth::user() && Auth::user()->Contact->district_id)
                        <input type="hidden" name="shipping_district_id" id="shipping_district_id"
                            value="{{ Auth::user()->Contact->district_id }}" />
                        @endif
                        @if(Auth::user() && Auth::user()->Contact->upazilla_id)
                        <input type="hidden" name="shipping_upazilla_id" id="shipping_upazilla_id"
                            value="{{ Auth::user()->Contact->upazilla_id }}" />
                        @endif
                        @if(Auth::user() && Auth::user()->Contact->union_id)
                        <input type="hidden" name="shipping_union_id" id="shipping_union_id"
                            value="{{ Auth::user()->Contact->union_id }}" />
                        @endif
                        <form action="{{ route('confirm-order') }}" method="POST" id="shipping-address-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-1 pb-2">
                                        <label>Name <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="shipping_contact_no" @if(Auth::user())
                                            value="{{Auth::user()->name}}" @endif class="form-control"
                                            placeholder="Name" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-1 pb-2">
                                        <label>Contact No. <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="shipping_contact_no" @if(Auth::user()) value="{{Auth::user()->Contact->mobile}}" @endif class="form-control"
                                            placeholder="Contact No." required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="division">Province</label>
                                        <select name="division_id" id="division" class="form-control" required>
                                            <option value="" selected="selected"></option>
                                            @foreach($divisions as $division)
                                            <option @if(Auth::user() && Auth::user()->Contact->division_id ==
                                                $division->id ) selected @endif
                                                value="{{$division->id}}">{{$division->name}}</option>
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
                                        <input type="text" name="shipping_address" @if(Auth::user())
                                            value="{{Auth::user()->Contact->shipping_address}}" @endif
                                            class="form-control" placeholder="House number and street name" required />
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
                @if(!Auth::user())
                <ul class="checkout-steps">
                    <li>
                        <h2 class="step-title">Billing details</h2>

                        <form method="POST" action="{{ route('customer-register') }}" id="checkout-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Name
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input type="text" name="name"  class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Phone <abbr class="required" title="required">*</abbr></label>
                                <input type="tel" name="mobile" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label> Password
                                    <abbr class="required" title="required">*</abbr></label>
                                <input type="password" name="password" placeholder="Password" class="form-control"
                                    required />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger btn-sm btn-block">Submit</button>
                            </div>
                        </form>
                    </li>
                </ul>
                @endif
            </div>
            <!-- End .col-lg-8 -->

            <div class="col-lg-5">
                <div class="order-summary">
                    <h3>YOUR ORDER</h3>

                    <table class="table table-mini-cart">
                        <thead>
                            <tr>
                                <th colspan="2">Product</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                            @php $total += $details['sale_price'] * $details['quantity'] @endphp
                            <tr>
                                <td class="product-col">
                                    <h3 class="product-title">
                                        {{ $details['name'] }} ×
                                        <span class="product-qty">{{ $details['quantity'] }}</span>
                                    </h3>
                                </td>
                                <td class="price-col">
                                    <span>${{ $details['quantity'] * $details['sale_price'] }}</span>
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

                                <td class="price-col">
                                    <span>${{$total}}</span>
                                </td>
                            </tr>
                            <tr class="order-shipping">
                                <td class="text-left" colspan="2">
                                    <h4 class="m-b-sm">Shipping</h4>

                                    <div class="form-group form-group-custom-control">
                                        <div class="custom-control custom-radio d-flex">
                                            <input type="radio" class="custom-control-input" name="radio" checked />
                                            <label class="custom-control-label">Local Pickup</label>
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

                            <tr class="order-total">
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <b class="total-price"><span>$0.00</span></b>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="payment-methods">
                        <h4 class="">Payment methods</h4>
                        <div class="info-box with-icon p-0">
                            <p>
                                Sorry, it seems that there are no available payment methods for your state. Please
                                contact us if you require assistance or wish to make alternate arrangements.
                            </p>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark btn-place-order" form="shipping-address-form">
                        Place order
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
@include('ecommerce.checkout-js')
@endsection