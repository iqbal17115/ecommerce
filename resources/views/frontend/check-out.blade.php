@extends('layouts.front_end')
@section('content')
<div>
    <style>
        #headerOneCheckOut,
        #sticky-header,
        #headerThreeCheckout,
        #footerOneCheckOut {
            display: none;
        }

        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table tr {
            background-color: #fdfdfd;
            border: 1px solid #ddd;
            padding: .35em;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }

        /* general styling */
        body {
            font-family: "Open Sans", sans-serif;
            line-height: 1.25;
        }

        #mobileResponsiveFooter {
            display: none;
        }
    </style>
    <x-slot name="title">
        Category
    </x-slot>
    <x-slot name="header">
        Category
    </x-slot>

    <main>
        <form id="checkout" method="POST" action="{{ route('confirm-order') }}" enctype="multipart/form-data"
            class="checkout-form" accept-charset="utf-8">
            <!-- checkout-area -->
            <section class="checkout-area pb-20">
                <div class="text-center py-2 rounded"
                    style="background-color: black;position: fixed;width: 100%;z-index: 2;">
                    <a href="{{ route('home') }}" class="float-left">
                        {{-- <i class="fas fa-backspace"
                        style="color: rgb(0, 0, 0);font-size: 30px;"></i> --}}
                        <i class="fas fa-arrow-left pl-1" style="color: white;font-size: 20px;"></i>
                    </a>
                    <span class="mt-1" style="color: white;font-weight: bold; font-size: 20px;">
                        @if (isset($language->checkout_page_header_title))
                        {{$language->checkout_page_header_title}}
                        @else
                        Quick Checkout
                        @endif
                    </span>
                </div>
                {{-- <hr class="mb-0 mt-3">
                <br>
                <br> --}}
                <div class="container pt-40">

                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="checkout-wrap">
                                {{-- <h5 class="title text-center mt-2" style="color: #ff5c00;">কুইক চেকআউট</h5> --}}
                                <div class="row mt-4">
                                    @if(!Auth::user())
                                    <div class="col-sm-12">
                                        <div class="form-grp">
                                            <label for="business_name" style="color: black;">
                                                @if (isset($language->business_name_label))
                                                {{$language->business_name_label}}
                                                @else
                                                Business Name
                                                @endif
                                                <span>*</span></label>
                                            <input class="form-control" type="text" name="business_name" required
                                                value="@if(Auth::user()){{Auth::user()->Contact->business_name}}@endif"
                                                placeholder="@if (isset($language->business_name_placeholder)) {{$language->business_name_placeholder}} @else Name @endif
                                                ">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-grp">
                                            <label for="fName">
                                                @if (isset($language->your_name_label))
                                                {{$language->your_name_label}}
                                                @else
                                                Name
                                                @endif
                                                <span>*</span>
                                            </label>
                                            <input type="text" name="fName" required
                                                value="@if(Auth::user()){{Auth::user()->name}}@endif" placeholder=" @if (isset($language->your_name_placeholder)) {{$language->your_name_placeholder}} @else Name @endif
                                                ">
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-6">
                                        <div class="form-grp">
                                            <label for="fName">Last Name <span>*</span></label>
                                            <input type="text" name="lName" required>
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-12">
                                        <div class="form-grp">
                                            <label for="mobile">
                                                @if (isset($language->mobile_number_label))
                                                {{$language->mobile_number_label}}
                                                @else
                                                Mobile Number
                                                @endif
                                                <span>*</span></label>
                                            <input type="text" name="mobile" required
                                                value="@if(Auth::user()){{Auth::user()->mobile}}@endif"
                                                placeholder="@if (isset($language->your_mobile_number_placeholder)) {{$language->your_mobile_number_placeholder}} @else Your Mobile Number @endif ">
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-12">
                                        <div class="form-grp">
                                            <label>বিভাগ *</label>
                                            <select class="custom-select division" name="division_id" required>
                                                <option value="">সিলেক্ট করুন</option>
                                                @foreach ($Divisions as $item)
                                                <option value="{{$item->id}}" @if($item->bn_name=='ঢাকা') selected
                                    @endif>{{$item->bn_name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-sm-12">
                                <div class="form-grp">
                                    <label>
                                        @if (isset($language->zilla_label))
                                        {{$language->zilla_label}}
                                        @else
                                        Zila
                                        @endif
                                        *</label>
                                    <select class="custom-select district" name="district_id" required>
                                        <option value="">
                                            @if (isset($language->select_zila_option_text))
                                            --{{$language->select_zila_option_text}}--
                                            @else
                                            --Select--
                                            @endif
                                        </option>
                                     
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-sm-12">
                                        <div class="form-grp">
                                            <label>উপজেলা *</label>
                                            <select class="custom-select upazila" name="upazila_id" required>
                                                <option value="">সিলেক্ট করুন</option>
                                                @foreach ($Upazilas as $upazilla)
                                                <option value="{{ $upazilla->id}}" class="upazila-items
                            district_id_{{$upazilla->district_id}}">{{ $upazilla->bn_name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div> --}}

                    <div class="col-12">
                        <div class="form-grp">
                            <label for="shipping_address">
                                @if (isset($language->full_address_label))
                                {{$language->full_address_label}}
                                @else
                                Full address
                                @endif
                                *
                            </label>

                            <textarea id="shipping_address" name="shipping_address"
                                placeholder="@if (isset($language->full_address_placeholder)) {{$language->full_address_placeholder	}} @else Full Address @endif"
                                required>@if(Auth::user()){{Auth::user()->address}}@endif</textarea>
                        </div>
                    </div>
                    @endif
                    @if(Auth::user())
                    <div class="col-12 mt-0 mb-0 pb-0 pt-3">
                        <div class="form-grp mt-0 pt-0">
                            <label for="business_name" style="font-weight: bold;">
                                @if(isset($language->business_name_label))
                                {{$language->business_name_label}}
                                @else
                                Business Name
                                @endif
                            </label>
                            <input type="text" name="business_name" required
                                value="@if(Auth::user()) @if(Auth::user()->Contact) {{Auth::user()->Contact->business_name}} @endif @endif"
                                placeholder="@if(isset($language->business_name_placeholder)) {{$language->business_name_placeholder	}} @else Business Name @endif"
                                readonly>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-grp">
                            <label for="fName">
                                @if (isset($language->your_name_label))
                                {{$language->your_name_label}}
                                @else
                                Name
                                @endif
                                <span>*</span>
                            </label>
                            <input type="text" name="fName" required
                                value="@if(Auth::user()){{Auth::user()->name}}@endif" placeholder=" @if (isset($language->your_name_placeholder)) {{$language->your_name_placeholder}} @else Name @endif
                                ">
                        </div>
                    </div>
                    <div class="col-12 mt-0 mb-0 pb-0 pt-0">
                        <div class="form-grp mt-0 pt-0">
                            <label for="district_id" style="font-weight: bold;">
                                @if(isset($language->zilla_label))
                                {{$language->zilla_label}}
                                @else
                                Zilla
                                @endif
                            </label>
                            <select class="custom-select district" name="district_id" required>
                                <option value="">
                                    @if(isset($language->select_zila_option_text))
                                    --{{$language->select_zila_option_text}}--
                                    @else
                                    --Select--
                                    @endif
                                </option>
                           
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mt-0 mb-0 pb-0 pt-0">
                        <div class="form-grp mt-0 pt-0">
                            <label for="shipping_address" style="font-weight: bold;">
                                @if(isset($language->delivery_address_label))
                                {{$language->delivery_address_label}}
                                @else
                                Delivery address
                                @endif
                            </label>
                            {{-- <input type="text" name="shipping_address" required
                                        value="@if(Auth::user()) @if(Auth::user()->Contact) {{Auth::user()->Contact->shipping_address}}
                            @endif @endif"
                            placeholder="ডেলিভারি এড্রেস" readonly> --}}
                            {{-- <textarea id="shipping_address" class="form-control"  name="shipping_address"  placeholder="আপনার পূর্ণ ঠিকানা লিখুন" style="text-align: left;" required>
                                            @if(Auth::user()) @if(Auth::user()->Contact) {{Auth::user()->Contact->shipping_address}}
                            @endif @endif
                            </textarea> --}}
                            <textarea id="shipping_address" class="form-control" name="shipping_address"
                                placeholder="@if(isset($language->full_address_placeholder)) {{$language->full_address_placeholder	}} @else Full Address @endif"
                                required readonly
                                style="background-color: white;">@if(Auth::user()) @if(Auth::user()->Contact) {{Auth::user()->Contact->shipping_address}} @endif @endif</textarea>

                        </div>
                    </div>
                    <div class="col-12 mt-0 pt-0">
                        <div class="form-grp mt-0 pt-0">
                            <label for="mobile" style="font-weight: bold;">
                                @if(isset($language->mobile_number_label))
                                {{$language->mobile_number_label}}
                                @else
                                Mobile
                                @endif
                            </label>
                            <input type="text" name="mobile" required
                                value="@if(Auth::user()) @if(Auth::user()->Contact) {{Auth::user()->Contact->mobile}} @endif @endif"
                                placeholder="মোবাইল নাম্বার" readonly>
                        </div>
                    </div>

                    @endif
                </div>
</div>
</div>
</div>
</div>

<div class="container">
    {{-- Start Cart Product --}}
    <h5 class="text-center" style="color: #ff5c00;">
        @if (isset($language->ordered_product_title))
        {{$language->ordered_product_title}}
        @else
        Ordered Product
        @endif
    </h5>
    <div class="table-responsive-xl">
        @php $totalPrice = 0; @endphp
        @if($cardBadge['data']['products'])
        @php $totalPrice = $cardBadge['data']['total_price'] @endphp
        <table class="" style="width: 100%;">
            <thead>
                <tr>
                    <th class="product-thumbnail"></th>
                    {{-- <th scope="col" class="product-name" style="font-weight: bold;">পণ্য</th> --}}
                    <th scope="col" class="product-price" style="font-weight: bold;">Price</th>
                    <th scope="col" class="product-quantity" style="font-weight: bold;">Quantity</th>
                    <th scope="col" class="product-subtotal" style="font-weight: bold;">SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cardBadge['data']['products'] as $productId => $product)
                <tr id="row_{{ $productId }}" style="color: black;">
                    <td class="product-thumbnail" style="border-style: none;">
                        <a href="javascript:void(0)" class="wishlist-remove" data-product-id="{{ $productId }}"><i
                                class="flaticon-cancel-1 text-danger" style="font-weight: bold;"></i></a>
                        <a href="{{ route('product-details',['id'=>$productId]) }}" style="float:left;">
                            <img @if($product['Info']['image']!='blank-product-image.png' )
                                src="{{ asset('storage/photo/'.$product['Info']['image']) }}" @else
                                src="{{ asset('image-not-available.jpg') }}" @endif
                                style="height: 90px;width:103px;129px;" alt="">
                        </a>
                        {{-- </td>
                                 <td class="product-name">
                                     <h4> --}}
                        <a href="{{ route('product-details',['id'=>$productId]) }}"
                            style="text-transform: capitalize;float: left;font-weight: bold;color: black;">
                            @if(strlen($product['Info']['product_name'])>23)
                            {{ substr($product['Info']['product_name'], 0,22).'...' }}
                            @else
                            {{ $product['Info']['product_name'] }}
                            @endif
                        </a>

                        {{-- </h4> --}}
                        {{-- <p>Cramond Leopard & Pythong Anorak</p>
                                     <span>65% poly, 35% rayon</span> --}}
                    </td>
                    <td data-label="মূল্য" class="product-price" style="border-style: none;">
                        @if($currencySymbol)
                        {{ $currencySymbol->symbol }}
                        @endif
                        {{ $product['unit_price'] }}
                    </td>
                    <td data-label="সংখ্যা" class="product-quantity py-0 mt-3 pl-2" style="height: 50px;color: black;">
                        <div class="cart-plus float-right">
                            <form action="#">
                                <div class="cart-plus-minus" data-product-id="{{ $productId }}" data-device="desktop">
                                    <input type="text" class="product_quantity product-quantity-cart"
                                        id="product_quantity_{{ $productId }}" data-product-id="{{ $productId }}"
                                        data-minimum-quantity="{{ $product['minimum_order_quantity'] }}"
                                        value="{{ $product['quantity'] }}">
                                </div>
                            </form>
                        </div>
                        <br>
                    </td>
                    <td data-label="SUBTOTAL" class="product-subtotal" id="product_subtotal_{{ $productId }}"
                        style="font-weight: bold;">
                        <span>
                            @if($currencySymbol)
                            {{ $currencySymbol->symbol }}
                            @endif
                            {{ $product['total_price'] }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-warning text-center">
            @if(isset($language->no_product_in_shopping_bag_alert_text))
            {{$language->no_product_in_shopping_bag_alert_text}}
            @else
            There is no product added by you!
            @endif
        </div>
        @endif
    </div>
    {{-- End Cart Product --}}
</div>
<div class="row p-0 m-0" style="width:100%;">
    <div class="col-12 pb-3">
        <div class="shop-cart-widget py-0 my-0 pt-1">
            <h6 class="title text-center">
                @if (isset($language->bill_total_title))
                {{$language->bill_total_title}}
                @else
                Bill Total
                @endif
            </h6>
            <ul>
                {{-- <li style="color: black;"><span>SUBTOTAL:</span>
                                        @if($currencySymbol)
                                            {{ $currencySymbol->symbol }}
                @endif
                {{ $cardBadge['data']['total_price'] }}
                </li> --}}
                <li class="cart-total-amount pt-2" style="color: black;font-weight: bold;">
                    <center>
                        <span>
                            @if (isset($language->sub_total))
                            {{$language->sub_total}} -
                            @else
                            Subtotal -
                            @endif
                        </span>
                        <span class="amount cart-total-price">
                            @if($currencySymbol)
                            {{ $currencySymbol->symbol }}
                            @endif
                            {{ $totalPrice }}
                            <br>
                            <br>
                        </span>
                    </center>
                </li>
                <li style="display: none">
                    <span>SHIPPING -</span>
                    <div class="shop-check-wrap">
                        @if($shipping_charge)
                        @foreach ($shipping_charge as $shippingCharge )
                        <div class="custom-control custom-radio">
                            <input type="radio" name="shipping_charge" class="shipping-charge" id="customCheck_"
                                value="{{$shippingCharge->shipping_fee}}">{{$shippingCharge->title}}:
                            {{$shippingCharge->shipping_fee}}
                            {{--<input type="radio" name="shipping_charge" class="custom-control-input" id="customCheck_">
                                                <label class="custom-control-label" for="customCheck1">{{$shippingCharge->title}}:
                            {{$shippingCharge->shipping_fee}}</label>--}}
                        </div>
                        @endforeach
                        @else
                        <div class="custom-control custom-radio">
                            <input type="radio" name="shipping_charge" class="shipping-charge" id="customCheck_"
                                value="0" checked> FREE SHIPPING
                            {{--<input type="radio" name="shipping_charge" class="custom-control-input" id="customCheck_">
                                                <label class="custom-control-label" for="customCheck2">FREE SHIPPING</label>--}}
                        </div>
                        @endif
                    </div>
                </li>
                <li class="cart-total-amount py-1" style="color: black;">
                    <center>
                        <span>
                            @if (isset($language->discount))
                            {{$language->discount}} -
                            @else
                            Discount -
                            @endif
                        </span>
                        <span>
                            @if($currencySymbol)
                            {{ $currencySymbol->symbol }}
                            @endif
                            0
                        </span>
                    </center>
                </li>

                <li class="cart-total-amount pt-2" style="color: black;font-weight: bold;">
                    {{-- <span>সর্বমোট বিল:</span>
                                        <input type="hidden" name="check_out_total_amount"
                                            class="check-out-total-amount"
                                            value="{{ $cardBadge['data']['total_price'] }}">
                    <span class="amount check-out-total-amount">
                        @if($currencySymbol)
                        {{ $currencySymbol->symbol }}
                        @endif
                        {{ $cardBadge['data']['total_price'] }}
                    </span> --}}
                    <center>
                        <span>
                            @if (isset($language->total))
                            {{$language->total}} -
                            @else
                            Total -
                            @endif
                        </span>
                        <span class="amount cart-total-price">
                            @if($currencySymbol)
                            {{ $currencySymbol->symbol }}
                            @endif
                            {{ $totalPrice }}
                            <br>
                            <br>
                        </span>
                    </center>
                </li>
            </ul>
            <div class="bank-transfer">
                <div class="form-group">
                    <label for="basicpill-lastname-input" style="color: #ff5c00;;font-weight:bold;"><i class="fas fa-star" style=></i>গ্যারান্টিযুক্ত রিপ্লেস প্রডাক্টের নাম & সংখ্যা লিখুন:</label>
                    <textarea class="form-control" id="note" name="note" rows="3"
                        wire:model.lazy="note"
                        placeholder="এখানে আপনার পূর্বের অর্ডারের গ্যারান্টিযুক্ত ড্যামেজ প্রডাক্টগুলির নাম এবং  সংখ্যা লিখুন!"></textarea>
                </div>
                <center>
                    <input type="checkbox" class="mb-3" id="customCheck4" checked>
                    <label class="mb-3" for="customCheck4" style="color: black;">
                        @if (isset($language->cash_on_delivery_text))
                        {{$language->cash_on_delivery_text}}
                        @else
                        Cash On Delivery
                        @endif
                    </label>
                </center>
            </div>
            <div class="payment-terms py-0 my-0" style="color: black; font-size: 12px;">
                * I have read and agree to the website
                <a href="{{route('terms-conditios')}}">terms
                    and conditions</a>
            </div>
            <button class="btn btn-submit mt-2 btn-hover" type="submit" id="orderFinishCheckout">
                @if (isset($language->checkout_page_order_done_button_text))
                {{$language->checkout_page_order_done_button_text}}
                @else
                Place Order
                @endif
            </button>
            <br>
            <br>
        </div>
        <button class="btn btn-submit btn-hover" type="submit"
            style="position: fixed;bottom: 0px;right: 0px;width: 100%;background-color:red;z-index:2;"
            id="orderFinishCheckoutMobile">
            @if (isset($language->checkout_page_order_done_button_text))
            {{$language->checkout_page_order_done_button_text}}
            @else
            Place Order
            @endif
        </button>

        </aside>
    </div>
</div>
</section>
<!-- checkout-area-end -->
</form>
</main>
<!-- end row -->

</div>

@endsection
@section('script')
<script>
    $(document).ready(function (){
        $('.shipping-charge').on('change', function (){
            var subTotal = {{ $cardBadge['data']['total_price'] }}
            var shippingCharge = 0;
            if( $(this).is(":checked") ){
                shippingCharge = parseFloat($(this).val());
            }
            $(".check-out-total-amount").html(shippingCharge+subTotal)
            $(".check-out-total-amount").val(shippingCharge+subTotal)
        });

    $(document).on('change', '.division', function () {
        // console.log("It works");
            $('.district').prop('selectedIndex', 0);
            $('.upazila').prop('selectedIndex', 0);
            let Id = $(this).val();
            // console.log(Id);
            if (Id == 0) {
                $(".district-items").show();
            } else {
                $(".district-items").hide();
                $(".division_id_" + Id).show();
            }
        });
    $(document).on('change', '.district', function () {
            $('.upazila').prop('selectedIndex', 0);
            let Id = $(this).val();
            if (Id == 0) {
                $(".upazila-items").show();
            } else {
                $(".upazila-items").hide();
                $(".district_id_" + Id).show();
            }
        });

        $(document).on('change', '.upazila', function () {
            $('.union').prop('selectedIndex', 0);
            let Id = $(this).val();
            // if (Id == 0) {
                $(".upazila-items").show();
            // } else {
                // $(".union-items").hide();
                $(".upazila_id_" + Id).show();
            // }
        });

    });
</script>
@endsection
