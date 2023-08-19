<header class="header">
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

        .skiptranslate:contains("দ্বারা পরিচালিত") {
            display: none !important;
        }

        @media (max-width: 1960px) {
            .header-image {
                display: none;
            }
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
                @foreach ($sidebarMenuCategories as $sidebarMenuCategory)
                    <li style="list-style: none;padding-bottom: 0px;" class="list-group-item"><a
                            style="font-family: inherit;" href="javascript:void(0);"
                            @if ($sidebarMenuCategory->SubCategory) class="parent_category"
                        data-id="{{ $sidebarMenuCategory->id }}" @endif>{{ $sidebarMenuCategory->name }}
                            @if (count($sidebarMenuCategory->SubCategory) > 0)
                                <i class="arrow right float-right"></i>
                            @endif
                        </a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- End Sidebar -->

    <div class="pt-0 pb-2 header-middle sticky-header" data-sticky-options="{'mobile': true}"
        style="background-color: #f4631b;">
        <a class="btn mobile-sidebar-menu pb-0 pr-0 menu-toggle" id=""><i
                class="custom-icon-toggle-menu d-inline-table" style="color: white;"></i></a>
        <!-- <button class="mobile-menu-toggler text-dark mr-2" type="button">
            <i class="fas fa-bars"></i>
        </button> -->
        @if ($company_info && $company_info->logo)
            <a href="{{ route('home') }}" class="logo" style="max-width: 180px;">
                <img data-src="{{ asset('storage/' . $company_info->logo) }}" class="w-100 ml-sm-0 ml-md-5 lazy-load"
                    width="111" height="44"
                    style="height: 64px;width: 151px;filter: brightness(4) contrast(1.5) saturate(1.5);"
                    alt="Porto Logo">
            </a>
        @endif
        <div class="container">
            <div class="header-right w-lg-max">
                <div
                    class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mb-0">
                    <!-- <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a> -->

                    <!-- form-inline class -->
                    <form action="{{ route('search') }}" method="get">
                        <div class="header-search-wrapper" style="justify-content: center;">
                            <input type="search" class="form-control" name="q" id="q"
                                placeholder="I'm searching for..." required>
                            <button class="btn icon-magnifier bg-dark text-white" title="search"
                                type="submit"></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div>
                <!-- End .header-search -->
                <div class="text-light font-weight-bold mr-2 responsive-desktop-menu"
                    style="font-size: 14px; padding-right: 14px;">
                    <!-- <select name="" class="form-control language_switcher" style="height: 25px;">
                            <option>{{ Config::get('languages')[App::getLocale()] }}</option>
                            @foreach (Config::get('languages') as $lang => $language)
@if ($lang != App::getLocale())
<option value="{{ $lang }}"> <a class="dropdown-item" href="#"> {{ $language }}</a> </option>
@endif
@endforeach
                        </select> -->
                    <div id="google_translate_element" style="margin-top: 5px;padding:0px;"></div>
                </div>
                <div class="text-light font-weight-bold mr-2 responsive-desktop-menu"
                    style="font-size: 14px; padding-right: 14px; padding-left: 14px;">
                    Bangladesh
                </div>
                @if (!Auth::user())
                    <div class="text-light font-weight-bold mr-2 responsive-desktop-menu"
                        style="font-size: 14px; padding-right: 14px; padding-left: 14px;">
                        <a href="{{ route('customer-sign-in') }}">Sign In <i class="fas fa-user text-light"></i></a>
                    </div>
                @endif
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
                            <h4 class="mb-0" style="color: #ffffff;">
@if (Auth::user())
{{ Auth::user()->name }}
@else
My
                                Account
@endif
</h4>
                        </div>
                    </div>
                </a> -->
                <div style="" class="rounded">
                    <a href="{{ route('my.account') }}" class="header-icon position-relative" title="wishlist">
                        <i class="icon-wishlist-2"></i>
                        <span class="wishlist-count badge-circle">0</span>
                    </a>
                    <!-- Start Cart -->
                    <div class="dropdown cart-dropdown" style="display: inline-block;">
                        <div class="d-flex flex-column align-items-center">
                            <a href="javascript:void(0);" title="Cart"
                                class="dropdown-toggle dropdown-arrow cart-toggle ml-2" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-display="static" style="min-height: 30px;">

                                @if ($company_info && $company_info->icon)
                                    <img src="{{ asset('storage/' . $company_info->icon) }}" alt="Your Image"
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
                                    @if (session('cart'))
                                        @foreach (session('cart') as $id => $details)
                                            @php $total += $details['sale_price'] * $details['quantity'] @endphp
                                            <div class="product cart-{{ $id }}"
                                                data-id="{{ $id }}">
                                                <div class="product-details">
                                                    <h4 class="product-title">
                                                        <a href="#">{{ $details['name'] }}</a>
                                                    </h4>

                                                    <span class="cart-product-info">
                                                        <span
                                                            class="cart-product-qty card-product-qty-{{ $id }}">{{ $details['quantity'] }}</span>
                                                        ×
                                                        {{ $currency->icon }}{{ $details['sale_price'] }}
                                                    </span>
                                                </div>
                                                <!-- End .product-details -->

                                                <figure class="product-image-container">
                                                    <a href="#" class="product-image lazy-load">
                                                        <img data-src="{{ asset('storage/product_photo/' . $details['image']) }}"
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

                                <table class="table table-totals">
                                    <tbody>

                                    </tbody>
                                </table>

                                <div class="dropdown-cart-action">
                                    {{-- <a href="{{ route('cart') }}" class="btn btn-gray btn-block view-cart">Shopping
                                        Cart</a> --}}
                                    <a href="{{ route('cart') }}" class="btn btn-dark btn-block">Shopping Cart</a>
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
    <div class="sticky-header d-none d-lg-flex pt-0 mt-0" style="background-color: #e95d18; height: 35px;"
        data-sticky-options="{'mobile': false}">
        <!-- container class -->
        <div class="">
            <nav class="main-nav w-100">
                <ul class="menu w-100">
                    <li>
                        <a class="btn pt-1 pb-0 menu-toggle" id=""><i
                                class="custom-icon-toggle-menu d-inline-table" style="color: white;"></i><span
                                style="color: white;">All</span></a>
                    </li>
                    <li>
                        <a class="pt-1 pb-0" href="{{ route('home') }}" style="color: white;">Sell On aladdine</a>
                    </li>
                    <!-- Start Category -->
                    @foreach ($headerMenuCategories as $headerMenuCategory)
                        <li>
                            <a class="pt-1 pb-0" href="{{ route('catalog', ['id' => $headerMenuCategory->id]) }}"
                                style="color: white;">{{ $headerMenuCategory->name }}</a>
                        </li>
                    @endforeach
                    <!-- End Category -->
                    <li class="phone">
                        @if ($company_info && $company_info->is_mobile_active)
                            <a href="#" class="d-flex align-items-center pt-1 pb-0" style="color: white;"><i
                                    class="icon-phone-1" style="font-size: 1rem;"></i>{{ $company_info->mobile }}</a>
                        @endif
                    </li>
                    @if (Auth::user())
                        <li class="float-right"><a class="pt-1 pb-0" href="{{ route('customer-logout') }}"
                                style="color: white;">Logout</a></li>
                    @endif
                    <!-- <li class="float-right"><a class="pt-1 pb-0" href="#" style="color: white;">Flash Deals</a></li> -->
                    @if (isset($all_active_advertisements['Header']['1']['ads']))
                        <!-- Start Header Ads -->
                        <li class="header-image" style="">
                            <div class="">
                                <center>
                                    <img data-src="{{ asset('storage/' . $all_active_advertisements['Header']['1']['ads']) }}"
                                        class="w-100 ml-sm-0 ml-md-5 lazy-load " width="111" height="44"
                                        style="max-width: 100%; height: auto; max-height: 30px;" alt="Porto Logo">
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
