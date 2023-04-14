<header class="header">

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
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('storage/'.$company_info->logo) }}" class="w-100 ml-sm-0 ml-md-5" width="111" height="44"
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
                                placeholder="What are you looking for?" aria-label="Search" style="background: white; border-radius: 5px 0px 0px 5px; max-width: 500px;">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon1" style="background: black;"><i
                                        class="fa fa-search" style="color: white;"></i></span>
                            </div>
                            <!-- Start Header Ads -->
                            @if(isset($all_active_advertisements['Header']['ads'])) 
                            <div class="">
                                <center>
                            <img src="{{ asset('storage/'.$all_active_advertisements['Header']['ads']) }}" class="w-100 ml-sm-0 ml-md-5" width="111" height="44"
                                 style="height: 40px;;" alt="Porto Logo">
                                 <center>
                            </div>
                            @endif
                            <!-- End Header Ads -->
                        </div>
                    </form>

                </div>
                <!-- End .header-search -->
                <div class="text-light font-weight-bold mr-2"
                    style="font-size: 14px; border-right: 1px solid white; padding-right: 14px;">
                    বাংলা
                </div>
                <div class="text-light font-weight-bold mr-2"
                    style="font-size: 14px; border-right: 1px solid white; padding-right: 14px; padding-left: 14px;">
                    Bangladesh
                </div>
                <div class="text-light font-weight-bold mr-2"
                    style="font-size: 14px; border-right: 1px solid white; padding-right: 14px; padding-left: 14px;">
                    Sign In <i class="fas fa-user text-light"></i>
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
                        <a href="javascript:void(0);" title="Cart"
                            class="dropdown-toggle dropdown-arrow cart-toggle ml-2" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" data-display="static">

                            @if($company_info && $company_info->icon)
                            <img src="{{ asset('storage/'.$company_info->icon) }}" alt="Your Image"
                                class="img-fluid icon-cart-thick" style="height: 20px;">
                            @endif
                            <span class="cart-count badge-circle"
                                style="top: 5px; left: 27px; background: darkblue;">{{ count((array) session('cart')) }}</span>
                        </a>

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
                                            <a href="{{ route('product-detail', ['id'=>$id]) }}" class="product-image">
                                                <img src="{{ asset('storage/product_photo/'.$details['image']) }}"
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
                                    <span>SUBTOTAL:</span>

                                    <span class="cart-total-price float-right">{{$currency->icon}}{{$total}}</span>
                                </div>
                                <!-- End .dropdown-cart-total -->

                                <div class="dropdown-cart-action">
                                    <a href="{{ route('cart') }}" class="btn btn-gray btn-block view-cart">View
                                        Cart</a>
                                    <a href="{{ route('checkout') }}" class="btn btn-dark btn-block">Checkout</a>
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
                                style="color: white;"></i><span style="color: white;">All</span></a>
                    </li>
                    <li>
                        <a class="pt-1 pb-0" href="{{ route('home') }}" style="color: white;">Sell On @if($company_info
                            &&
                            $company_info->name) {{$company_info->name}} @endif</a>
                    </li>
                    <!-- Start Category -->
                    @foreach($headerMenuCategories as $headerMenuCategory)
                    <li>
                        <a class="pt-1 pb-0" href="{{ route('catalog', ['id'=>$headerMenuCategory->id]) }}"
                            style="color: white;">{{$headerMenuCategory->name}}</a>
                    </li>
                    @endforeach
                    <!-- End Category -->
                    <li class="float-right phone">
                        @if($company_info && $company_info->is_mobile_active)
                        <a href="#" class="d-flex align-items-center pt-1 pb-0" style="color: white;"><i
                                class="icon-phone-1" style="font-size: 1rem;"></i>{{$company_info->mobile}}</a>
                        @endif
                    </li>
                    <!-- @if(Auth::user())
                    <li class="float-right"><a class="pt-1 pb-0" href="{{ route('customer-logout') }}"
                            style="color: white;">Logout</a></li>
                    @endif -->
                    <li class="float-right"><a class="pt-1 pb-0" href="#" style="color: white;">Flash Deals</a></li>
                </ul>
            </nav>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-bottom -->
</header>
<!-- End .header -->