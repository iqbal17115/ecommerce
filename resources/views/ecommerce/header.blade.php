<!-- Address Sidebar Wrapper -->
<div id="address-wrapper" class="overlay"></div>

{{-- End Checkout Address --}}
<!-- Start Sidebar -->
<div id="wrapper">
    <div id="sidebar-wrapper">
        <input type="hidden" name="category_data[]" id="category_data" value="" />
        <ul class="sidebar-nav list-group" id="category_show">
            <li class="text-center h4  d-flex justify-content-center align-items-center"
                style="background-color: #f4631b;">
                @if ($company_info && $company_info->logo)
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ asset('storage/' . $company_info->logo) }}" class="w-100" width="111"
                            height="44" alt="{{ $company_info->name }}">
                    </a>
                @endif
            </li>
            <li id="category_content"><a style="font-weight: bold; font-size: 18px; color: black; "><i
                        id="category_back" class="fa fa-arrow-left" style="display: none;"></i> Shop By Department
                    <button id="minimizeSidebar" type="button" style="font-weight: bold; font-size: 28px; color: red;"
                        class="close" aria-label="Close">
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

<header class="header">
    <div class="header-top" style="background-color: #f1f1f1; padding: 10px 0; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
        <div class="container d-flex justify-content-between align-items-center flex-wrap">
            <!-- Left Content: Free Shipping Text -->
            <div class="header-left d-flex align-items-center">
                <i class="icon-shipping text-primary mr-2" style="font-size: 1.4rem;"></i>
                <span class="text-dark" style="font-size: 1.1rem; font-weight: bold;">
                    FREE Express Shipping On Orders 499+ TK
                </span>
            </div>
    
            <!-- Right Content: Log In (Visible only on mobile devices) -->
            <div class="header-right d-flex align-items-center d-md-none">
                @if (!Auth::user())
                    <a href="{{ route('customer-sign-in') }}" 
                       class="btn btn-outline-primary py-1 px-4 position-relative" 
                       style="font-size: 1rem; font-weight: bold; border-radius: 25px; text-transform: uppercase; transition: all 0.3s;">
                        <span style="z-index: 2; position: relative;">Log In</span>
                        <div class="btn-highlight" 
                             style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(45deg, #007bff, #0056b3); z-index: 1; border-radius: 25px; opacity: 0; transition: opacity 0.3s;">
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>    
    <!-- End .header-top -->

    <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
                {{-- when need only for mobile then use class mobile-menu-toggler and remove custom css --}}
                <button class="mobile-menu-toggler-custom text-dark mr-2 menu-toggle menu_toggle_desgn" type="button"
                    style="cursor: pointer;">
                    {{-- <i class="fas fa-bars"></i> --}}
                </button>
                @if ($company_info && $company_info->logo)
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ asset('storage/' . $company_info->logo) }}" class="w-100" width="111"
                            height="44" alt="{{ $company_info->name }}">
                @endif
                </a>
            </div>
            <!-- End .header-left -->

            <div class="header-right w-lg-max">
                <div
                    class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mb-0">
                    <a href="javascript::void(0);" class="search-toggle" role="button"><i
                            class="icon-search-3"></i></a>
                    <form action="{{ route('catalog.show') }}" method="get">
                        <div class="header-search-wrapper" style="border: 0px;">
                            <input type="search" class="form-control" name="search" id="search"
                                placeholder="Search..." required>
                            <!-- End .select-custom -->
                            <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                        </div>
                        <!-- End .header-search-wrapper -->
                    </form>
                </div>
                <!-- End .header-search -->
                <div class="header-user d-lg-block d-none profile-container" id="user_profile_info"></div>
                @if (!Auth::user())
                    <div class="header-user d-lg-block d-none profile-container">
                        <a href="{{ route('customer-sign-in') }}"
                            class="header-icon position-relative mb-0 text-white font-weight-bold mr-0">
                            Sign In1
                        </a>
                        <span class="mx-2 text-white">|</span>
                        <a href="{{ route('sign-up') }}"
                            class="header-icon position-relative mb-0 text-white font-weight-bold">
                            Sign Up
                        </a>
                    </div>
                @endif
                <a href="{{ route('my.account', ['type' => 'wishlist']) }}"
                    class="header-icon position-relative mb-0" title="wishlist">
                    <i class="icon-wishlist-2 wishlist_icon"></i>
                    <span class="wishlist-count badge-circle" style="background: #111;">0</span>
                </a>

                <div class="dropdown cart-dropdown">
                    <a href="#" id="cartToggle" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        data-display="static">
                        @if ($company_info && $company_info->icon)
                            <img src="{{ asset('storage/' . $company_info->icon) }}"
                                class="img-fluid icon-cart-thick pb-0 mb-0 cart_icon">
                        @endif
                        <span class="cart-count badge-circle" style="top: 5px; left: 27px; background: #111;">0</span>
                    </a>

                    <div class="cart-overlay"></div>

                    @include('ecommerce.cart_drawer')
                </div>
                <!-- End .dropdown -->
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-middle -->

    <div class="header-bottom sticky-header d-none d-lg-flex" data-sticky-options="{'mobile': false}">
        {{-- container class of below --}}
        <div class="container" style="max-width: 81%;">
            <nav class="main-nav w-100">
                <ul class="menu w-100">
                    <li class="active">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    @foreach ($headerMenuCategories as $headerMenuCategory)
                        <li>
                            <a class=""
                                href="{{ route('catalog', ['id' => $headerMenuCategory->id]) }}">{{ $headerMenuCategory->name }}</a>
                        </li>
                    @endforeach
                    <li class="phone">
                        @if ($company_info && $company_info->is_mobile_active)
                            <a href="javascript:void(0);" class="d-flex align-items-center"><i class="icon-phone-1"
                                    style="font-size: 1rem;"></i>{{ $company_info->mobile }}</a>
                        @endif
                    </li>
                    {{-- <li class=""><a href="https://1.envato.market/DdLk5" target="_blank">New
                            Arrivals</a></li>
                    <li class=""><a href="#">Flash Deals</a></li> --}}
                </ul>
            </nav>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-bottom -->
</header>
<!-- End .header -->
