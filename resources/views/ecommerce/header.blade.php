{{-- Start Checkout Address --}}
<!-- Address Sidebar Wrapper -->
<div id="address-wrapper" onclick="toggleSidebar()"> <!-- clicking outside will close sidebar -->
    <div id="address-right-sidebar-wrapper" onclick="event.stopPropagation()"> <!-- Prevent close on content click -->
        <div class="choose-address-wrapper bg-white p-4 rounded shadow-lg">
            <!-- Header with Title and Add New Address Link -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="font-weight-bold mb-0">Shipping Address</h5>
                <a href="javascript:;" class="text-primary font-weight-bold">Add new address</a>
            </div>

            <!-- Address 1 -->
            <div class="card border-light mb-1">
                <div class="card-body d-flex">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="address1" checked>
                    </div>
                    <div class="ml-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title mb-1">Iqbal <span class="text-muted small">1654323454</span></h6>
                        </div>
                        <span class="badge badge-secondary text-white mb-1">HOME</span>
                        <span class="mb-1">Address Info</span>
                        <p class="text-muted small mb-1">Region: Dhaka - Faridpur - Alipur</p>
                        <span class="badge badge-info">Default Shipping Address</span>
                    </div>
                </div>
            </div>

            <!-- Address 2 -->
            <div class="card border-light mb-1">
                <div class="card-body d-flex">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="address2">
                    </div>
                    <div class="ml-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title mb-1">Sadek <span class="text-muted small">1456767564</span></h6>
                        </div>
                        <span class="badge badge-secondary text-white mb-1">HOME</span>
                        <span class="mb-1">Address Info</span>
                        <p class="text-muted small mb-1">Region: Chattogram - Brahmanbaria - Kasba - Kasba Gopinathpur
                        </p>
                    </div>
                </div>
            </div>

            <!-- Address 3 -->
            <div class="card border-light mb-1">
                <div class="card-body d-flex">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="address3">
                    </div>
                    <div class="ml-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title mb-1">Rahim <span class="text-muted small">1408976543</span></h6>
                        </div>
                        <span class="badge badge-secondary text-white mb-1">HOME</span>
                        <span class="mb-1">Address Info</span>
                        <p class="text-muted small mb-1">Region: Dhaka - Dhaka - North - Aftab nagar</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-end mt-3">
                <button type="button" class="btn btn-outline-secondary btn-sm mr-2 px-3">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm px-3">Save</button>
            </div>
        </div>
    </div>
</div>
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
    <div class="header-top">
        <div class="container">
            <div class="header-left d-none d-sm-block">
                <div class="info-box info-box-icon-left text-primary justify-content-start p-0">
                    <i class="icon-shipping"></i>
                    <div class="info-box-content">
                        <h4 class="text-transform-none">FREE Express Shipping On Orders 499+ TK</h4>
                    </div>
                    <!-- End .info-box-content -->
                </div>
            </div>
            <!-- End .header-left -->

            <div class="header-right header-dropdowns ml-0 ml-sm-auto w-sm-100">
                <div class="header-dropdown">
                    {{-- <a href="#">USD</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">EUR</a></li>
                            <li><a href="#">USD</a></li>
                        </ul>
                    </div> --}}
                    <!-- End .header-menu -->
                </div>
                <!-- End .header-dropown -->

                <div class="mr-auto mr-sm-3 mr-md-0 top_header_mobile_menu">
                    <div class="header-menu d-flex justify-content-end">
                        <ul class="mb-0">
                            @if (!Auth::user())
                                <li><a href="{{ route('customer-sign-in') }}">Log In</a></li>
                            @endif
                        </ul>
                    </div>
                    <!-- End .header-menu -->
                </div>
                <!-- End .header-dropown -->
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
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
                            Sign In
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
                    <a href="#" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        data-display="static">
                        @if ($company_info && $company_info->icon)
                            <img src="{{ asset('storage/' . $company_info->icon) }}"
                                class="img-fluid icon-cart-thick pb-0 mb-0 cart_icon">
                        @endif
                        {{-- <span class="cart-count badge-circle">3</span> --}}
                        <span class="cart-count badge-circle" style="top: 5px; left: 27px; background: #111;">0</span>
                    </a>

                    <div class="cart-overlay"></div>

                    <div class="dropdown-menu mobile-cart">
                        <a href="#" title="Close (Esc)" class="btn-close">×</a>

                        <div class="dropdownmenu-wrapper custom-scrollbar">
                            <div class="dropdown-cart-header">Shopping Cart</div>
                            <!-- End .dropdown-cart-header -->

                            <div class="dropdown-cart-products" id="cart_container"></div>
                            <!-- End .cart-product -->

                            <table class="table table-totals">
                                <tbody>

                                </tbody>
                            </table>

                            <div class="dropdown-cart-action">
                                {{-- <a href="{{ route('cart') }}" class="btn btn-gray btn-block view-cart">Shopping
                                    Cart</a> --}}
                                <a href="{{ route('cart') }}" class="btn btn-block text-dark brand_color">Shopping
                                    Cart</a>
                            </div>
                            <!-- End .dropdown-cart-total -->
                        </div>
                        <!-- End .dropdownmenu-wrapper -->
                    </div>
                    <!-- End .dropdown-menu -->
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
