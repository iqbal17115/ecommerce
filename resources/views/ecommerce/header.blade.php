<header class="header">

    <head>
        <link rel="canonical" href="https://www.aladdinne.com">
        <script type='application/ld+json'>
            {
              "@context": "http://www.schema.org",
              "@type": "ShoppingCenter",
              "name": "Aladdinne.com",
              "url": "https://www.aladdinne.com/",
              "logo": "https://www.aladdinne.com/storage/company_info/logos/Lpzoe54rj1p8i4K6mpwVRIxdPmS6CSfP59liCSyR.png",
              "image": "https://www.aladdinne.com/storage/company_info/logos/Lpzoe54rj1p8i4K6mpwVRIxdPmS6CSfP59liCSyR.png",
              "description": "Aladdinne is an e-commerce marketplace platform that connects multiple buyers and sellers to facilitate buyers and sellers both by the buying and selling of a wide range of products and services in our marketplace, such as big brands selling items ranging from electronics, Fashion, home Decor & appliances, gadgets, garden supplies, groceries, etc. Aladdinne provides service through the aladdinne.com website, mobile app, and other platforms.",
              "address": {
                "@type": "PostalAddress",
                "streetAddress": "Office No:523, 5th Floor, Alpona Plaza",
                "addressLocality": "Dhaka",
                "addressRegion": "Dhaka",
                "postalCode": "1205",
                "addressCountry": "Bangladesh"
              },
              "geo": {
                "@type": "GeoCoordinates",
                "latitude": "23.7386671",
                "longitude": "90.381785"
              },
              "hasMap": "https://www.google.com/maps/search/https:%2F%2Fwww.google.com%2Fmaps%2Fplace%2FAladdinne.com%2F@23.7386622,90.3843599,15z%2Fdata%3D!4m6!3m5!1s0x3755b9ecc12ae8c5:0x29d5b7fd67107fe5!8m2!3d23.7386622!4d90.3843599!16s%252Fg%252F11tcg4q1dx/@23.7386671,90.381785,17z/data=!3m1!4b1",
              "openingHours": "Mo, Tu, We, Th, Fr, Sa, Su 08:00-17:00",
              "contactPoint": {
                "@type": "ContactPoint",
                "contactType": "support @aladdinne.com",
                "telephone": "+8801975340753"
              }
            }
             </script>
    </head>

    <style>
    .top-links-item {
        position: relative;
        display: inline-block;
        vertical-align: middle;
    }

    .top-links-item span {
        display: inline-block;
        padding: 5px;
        cursor: pointer;
    }

    .top-links-item .lzd-switch-popup {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        display: none;
        min-width: 160px;
        padding: 5px 0;
        margin: 2px 0 0;
        font-size: 14px;
        text-align: left;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
    }

    .top-links-item .lzd-switch-popup .top-popup-content {
        max-height: 200px;
        overflow: auto;
    }

    .top-links-item .lzd-switch-item {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: 400;
        line-height: 1.42857143;
        color: #333;
        white-space: nowrap;
        cursor: pointer;
    }

    .top-links-item .lzd-switch-item:hover,
    .top-links-item .lzd-switch-item:focus {
        color: #262626;
        background-color: #f5f5f5;
    }

    .top-links-item .lzd-switch-item.currentSelected .lzd-switch-checked {
        float: right;
        margin-top: 3px;
        margin-right: -10px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #f0ad4e;
    }

    .top-links-item .lzd-switch-item .lzd-switch-icon {
        display: inline-block;
        width: 18px;
        height: 18px;
        margin-right: 10px;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        vertical-align: middle;
    }

    .top-links-item .lzd-switch-item .lzd-switch-icon-bn {
        background-image: url('flag/bengali-flag-icon.png');
    }

    .top-links-item .lzd-switch-item .lzd-switch-icon-en {
        background-image: url('flag/english-flag-icon.png');
    }
    </style>
    <!-- Start Sidebar -->
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <input type="hidden" name="category_data[]" id="category_data" value="" />
            <ul class="sidebar-nav list-group" id="category_show">
                <li class="text-center h4" style="background-color: brown;">Aladdinne</li>
                <li id="category_content"><a style="font-weight: bold; font-size: 18px; color: black; "><i
                            id="category_back" class="fa fa-arrow-left" style="display: none;"></i> Shop By Department
                        <button id="minimizeSidebar" type="button"
                            style="font-weight: bold; font-size: 28px; color: red;" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></a></li>
                @foreach($sidebarMenuCategories as $sidebarMenuCategory)
                <li style="list-style: none;padding-bottom: 0px;" class="list-group-item"><a
                        style="font-family: inherit;" href="javascript:void(0);" @if($sidebarMenuCategory->SubCategory)
                        class="parent_category"
                        data-id="{{$sidebarMenuCategory->id}}" @endif>{{$sidebarMenuCategory->name}}
                        @if(count($sidebarMenuCategory->SubCategory) > 0)<i class="arrow right float-right"></i>
                        @endif</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- End Sidebar -->

    <div class="pt-0 pb-2 header-middle sticky-header" data-sticky-options="{'mobile': true}"
        style="background-color: #f4631b;">
        <a class="btn mobile-sidebar-menu pb-0 pr-0 menu-toggle" id=""><i class="custom-icon-toggle-menu d-inline-table"
                style="color: white;"></i></a>
        <!-- <button class="mobile-menu-toggler text-dark mr-2" type="button">
            <i class="fas fa-bars"></i>
        </button> -->
        @if($company_info && $company_info->logo)
        <a href="{{ route('home') }}" class="logo" style="max-width: 180px;">
            <img data-src="{{ asset('storage/'.$company_info->logo) }}" class="w-100 ml-sm-0 ml-md-5 lazy-load"
                width="111" height="44"
                style="height: 54px;width: 151px;filter: brightness(4) contrast(1.5) saturate(1.5);" alt="Porto Logo">
        </a>
        @endif
        <div class="container">
            <div class="header-right w-lg-max">
                <div
                    class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mb-0">
                    <!-- <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a> -->

                    <!-- form-inline class -->
                    <form action="{{ route('search') }}" class="my-2 my-lg-0" style="min-width: 40px;">
                        <div class="input-group" style="display: flex;
  justify-content: center;">
                            <input name="q" id="q" class="form-control mr-0" type="search"
                                placeholder="What are you looking for?" aria-label="Search"
                                style="background: white; border-radius: 5px 0px 0px 5px; max-width: 600px;">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon1" style="background: black;"><i
                                        class="fa fa-search" style="color: white;"></i></span>
                            </div>

                        </div>
                    </form>

                </div>
                <!-- End .header-search -->
                <div class="text-light font-weight-bold mr-2 responsive-desktop-menu"
                    style="font-size: 14px; padding-right: 14px;">
                    <!-- <select name="" class="form-control language_switcher" style="height: 25px;">
                            <option>{{ Config::get('languages')[App::getLocale()] }}</option>
                            @foreach (Config::get('languages') as $lang => $language)
                                @if ($lang != App::getLocale())
                                       <option value="{{ $lang }}"> <a class="dropdown-item" href="#"> {{$language}}</a> </option>
                                @endif
                            @endforeach
                        </select> -->
                        <div id="google_translate_element"></div>
                </div>
                <div class="text-light font-weight-bold mr-2 responsive-desktop-menu"
                    style="font-size: 14px; padding-right: 14px; padding-left: 14px;">
                    Bangladesh
                </div>
                <div class="text-light font-weight-bold mr-2 responsive-desktop-menu"
                    style="font-size: 14px; padding-right: 14px; padding-left: 14px;">
                     Sign In <i class="fas fa-user text-light"></i>
                </div>
                <div class="text-light font-weight-bold mr-2 responsive-mobile-menu" style="font-size: 16px;">
                    <div class="d-flex flex-column align-items-center">
                        <i class="text-dark">اللغة العربية</i>
                        <span class="text-dark small">Language</span>
                    </div>
                </div>
                <div class="text-light font-weight-bold mr-2 responsive-mobile-menu"
                    style="font-size: 16px; padding-right: 14px; padding-left: 14px;">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-user text-dark"></i>
                        <span class="text-dark small mt-1">Account</span>
                    </div>
                </div>
                <!-- <a href="login.html" class="d-lg-block d-none">
                    <div class="header-user">
                        <i class="icon-user-2"></i>
                        <div class="header-userinfo">
                            <span style="color: #020100d1;">Welcome</span>
                            <h4 class="mb-0" style="color: #ffffff;">@if(Auth::user()) {{Auth::user()->name}} @else My
                                Account @endif</h4>
                        </div>
                    </div>
                </a> -->
                <div style="" class="rounded">
                    <!-- Start Cart -->
                    <div class="dropdown cart-dropdown" style="display: inline-block;">
                        <div class="d-flex flex-column align-items-center">
                            <a href="javascript:void(0);" title="Cart"
                                class="dropdown-toggle dropdown-arrow cart-toggle ml-2" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"
                                style="min-height: 30px;">

                                @if($company_info && $company_info->icon)
                                <img src="{{ asset('storage/'.$company_info->icon) }}" alt="Your Image"
                                    class="img-fluid icon-cart-thick pb-0 mb-0" style="height: 20px;">
                                @endif
                                <span class="cart-count badge-circle"
                                    style="top: 5px; left: 27px; background: darkblue;">{{ count((array) session('cart')) }}</span>
                            </a>
                            <span class="text-dark small responsive-mobile-menu">Cart</span>
                        </div>
                        <div class="cart-overlay"></div>

                        <div class="dropdown-menu mobile-cart">
                            <a href="javascript:void(0);" title="Close (Esc)" class="btn-close">×</a>

                            <div class="dropdownmenu-wrapper custom-scrollbar">
                                <div class="dropdown-cart-header">Shopping Cart</div>
                                <!-- End .dropdown-cart-header -->

                                <div class="dropdown-cart-products">
                                    @php $total = 0 @endphp
                                    @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                    @php $total += $details['sale_price'] * $details['quantity'] @endphp
                                    <div class="product cart-{{ $id }}" data-id="{{ $id }}">
                                        <div class="product-details">
                                            <h4 class="product-title">
                                                <a
                                                    href="{{ route('product-detail', ['id'=>$id]) }}">{{ $details['name'] }}</a>
                                            </h4>

                                            <span class="cart-product-info">
                                                <span
                                                    class="cart-product-qty card-product-qty-{{ $id }}">{{ $details['quantity'] }}</span>
                                                ×
                                                {{$currency->icon}}{{ $details['sale_price'] }}
                                            </span>
                                        </div>
                                        <!-- End .product-details -->

                                        <figure class="product-image-container">
                                            <a href="{{ route('product-detail', ['id'=>$id]) }}"
                                                class="product-image lazy-load">
                                                <img data-src="{{ asset('storage/product_photo/'.$details['image']) }}"
                                                    alt="product" width="80" height="80">
                                            </a>

                                            <a href="javascript:void(0);" class="btn-remove"
                                                title="Remove Product"><span>×</span></a>
                                        </figure>
                                    </div>
                                    <!-- End .product -->
                                    @endforeach
                                    @endif
                                </div>
                                <!-- End .cart-product -->

                                <div class="dropdown-cart-total">
                                    <span>Sub Total:</span>

                                    <span class="cart-total-price float-right">{{$currency->icon}}{{$total}}</span>
                                </div>
                                <!-- End .dropdown-cart-total -->

                                <div class="dropdown-cart-action">
                                    <a href="{{ route('cart') }}"
                                        class="btn btn-gray btn-block view-cart">Shopping Cart</a>
                                    <a href="{{ route('checkout') }}"
                                        class="btn btn-dark btn-block">Check Out</a>
                                </div>
                                <!-- End .dropdown-cart-total -->
                            </div>
                            <!-- End .dropdownmenu-wrapper -->
                        </div>
                        <!-- End .dropdown-menu -->
                    </div>
                    <!-- End .dropdown -->
                    <!-- End Cart -->
                </div>
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-middle -->

    <!--Class Of bottom line header-bottom  -->
    <!-- border-top: 1px solid #acacac; -->
    <div class="sticky-header d-none d-lg-flex pt-0 mt-0" style="background-color: #f4631b; height: 35px;"
        data-sticky-options="{'mobile': false}">
        <!-- container class -->
        <div class="">
            <nav class="main-nav w-100">
                <ul class="menu w-100">
                    <li>
                        <a class="btn pt-1 pb-0 menu-toggle" id=""><i class="custom-icon-toggle-menu d-inline-table"
                                style="color: white;"></i><span style="color: white;">{{ __('translate.all') }}</span></a>
                    </li>
                    <li>
                        <a class="pt-1 pb-0" href="{{ route('home') }}"
                            style="color: white;">Sell On aladdine</a>
                    </li>
                    <!-- Start Category -->
                    @foreach($headerMenuCategories as $headerMenuCategory)
                    <li>
                        <a class="pt-1 pb-0" href="{{ route('catalog', ['id'=>$headerMenuCategory->id]) }}"
                            style="color: white;">{{$headerMenuCategory->name}}</a>
                    </li>
                    @endforeach
                    <!-- End Category -->
                    <li class="phone">
                        @if($company_info && $company_info->is_mobile_active)
                        <a href="#" class="d-flex align-items-center pt-1 pb-0" style="color: white;"><i
                                class="icon-phone-1" style="font-size: 1rem;"></i>{{$company_info->mobile}}</a>
                        @endif
                    </li>
                    <!-- @if(Auth::user())
                    <li class="float-right"><a class="pt-1 pb-0" href="{{ route('customer-logout') }}"
                            style="color: white;">Logout</a></li>
                    @endif -->
                    <!-- <li class="float-right"><a class="pt-1 pb-0" href="#" style="color: white;">Flash Deals</a></li> -->
                    @if(isset($all_active_advertisements['Header']['1']['ads']))
                    <!-- Start Header Ads -->
                    <li class="" style="width: 360px;">
                        <div class="float-right">
                            <center>
                                <img data-src="{{ asset('storage/'.$all_active_advertisements['Header']['1']['ads']) }}"
                                    class="w-100 ml-sm-0 ml-md-5 lazy-load" width="111" height="44"
                                    style="height: 30px;;" alt="Porto Logo">
                                <center>
                        </div>
                    </li>
                    <!-- End Header Ads -->
                    @endif

                </ul>
            </nav>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-bottom -->
</header>
<!-- End .header -->
