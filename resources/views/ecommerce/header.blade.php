<header class="header">

    <!-- Start Sidebar -->
    <div id="wrapper">
        <!-- Sidebar -->
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

    <div class="pt-2 pb-2 header-middle sticky-header" data-sticky-options="{'mobile': true}"
        style="background-color: #f4631b;">
        <a class="btn mobile-sidebar-menu pb-0 pr-0 menu-toggle" id=""><i class="custom-icon-toggle-menu d-inline-table"
                                style="color: white;"></i></a>
        <!-- <button class="mobile-menu-toggler text-dark mr-2" type="button">
            <i class="fas fa-bars"></i>
        </button> -->
        @if($company_info && $company_info->logo)
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('storage/'.$company_info->logo) }}" class="w-100 ml-sm-0 ml-md-5" width="111" height="44"
                style="height: 54px;width: 151px;" alt="Porto Logo">
        </a>
        @endif
        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
                <!-- Here Was Logo Before -->
            </div>
            <!-- End .header-left -->

            <div class="header-right w-lg-max">
                <div
                    class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mb-0">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search..." style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;" required>
                            <button class="btn icon-magnifier p-0" style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;" title="search" type="submit"></button>
                        </div>
                        <!-- End .header-search-wrapper -->
                    </form>
                </div>
                <!-- End .header-search -->

                <a href="login.html" class="d-lg-block d-none">
                    <div class="header-user">
                        <i class="icon-user-2"></i>
                        <div class="header-userinfo">
                            <span style="color: #020100d1;">Welcome</span>
                            <h4 class="mb-0" style="color: #ffffff;">@if(Auth::user()) {{Auth::user()->name}} @else My
                                Account @endif</h4>
                        </div>
                    </div>
                </a>

                <div class="dropdown cart-dropdown">
                    <a href="javascript:void(0);" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        data-display="static">
                        <i class="icon-cart-thick"></i>
                        <span class="cart-count badge-circle">{{ count((array) session('cart')) }}</span>
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
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-middle -->

    <!--Class Of bottom line header-bottom  -->
    <div class="sticky-header d-none d-lg-flex pt-0 mt-0" style="background-color: #f4631b; height: 25px;"
        data-sticky-options="{'mobile': false}">
        <div class="container">
            <nav class="main-nav w-100">
                <ul class="menu w-100">
                    <li>
                        <a class="btn pt-0 pb-0 menu-toggle" id=""><i class="custom-icon-toggle-menu d-inline-table"
                                style="color: white;"></i></a>
                    </li>
                    <li>
                        <a class="pt-0 pb-0" href="{{ route('home') }}" style="color: white;">Home</a>
                    </li>
                     <!-- Start Category -->
                     @foreach($headerMenuCategories as $headerMenuCategory)
                     <li>
                                <a class="pt-0 pb-0" href="demo36-product.html" style="color: white;">{{$headerMenuCategory->name}}</a>
                                <div class="megamenu megamenu-fixed-width">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <a href="#" class="nolink">PRODUCT PAGES</a>
                                            <ul class="submenu">
                                                <li><a href="product.html">SIMPLE PRODUCT</a></li>
                                                <li><a href="product-variable.html">VARIABLE PRODUCT</a></li>
                                                <li><a href="product.html">SALE PRODUCT</a></li>
                                                <li><a href="product.html">FEATURED & ON SALE</a></li>
                                                <li><a href="product-custom-tab.html">WITH CUSTOM TAB</a></li>
                                                <li><a href="product-sidebar-left.html">WITH LEFT SIDEBAR</a></li>
                                                <li><a href="product-sidebar-right.html">WITH RIGHT SIDEBAR</a></li>
                                                <li><a href="product-addcart-sticky.html">ADD CART STICKY</a></li>
                                            </ul>
                                        </div>
                                        <!-- End .col-lg-4 -->

                                        <div class="col-lg-4">
                                            <a href="#" class="nolink">PRODUCT LAYOUTS</a>
                                            <ul class="submenu">
                                                <li><a href="product-extended-layout.html">EXTENDED LAYOUT</a></li>
                                                <li><a href="product-grid-layout.html">GRID IMAGE</a></li>
                                                <li><a href="product-full-width.html">FULL WIDTH LAYOUT</a></li>
                                                <li><a href="product-sticky-info.html">STICKY INFO</a></li>
                                                <li><a href="product-sticky-both.html">LEFT & RIGHT STICKY</a></li>
                                                <li><a href="product-transparent-image.html">TRANSPARENT IMAGE</a>
                                                </li>
                                                <li><a href="product-center-vertical.html">CENTER VERTICAL</a></li>
                                                <li><a href="#">BUILD YOUR OWN</a></li>
                                            </ul>
                                        </div>
                                        <!-- End .col-lg-4 -->

                                        <div class="col-lg-4 p-0">
                                            <div class="menu-banner menu-banner-2">
                                                <figure>
                                                    <img src="aladdinne/assets/images/menu-banner-1.jpg" alt="Menu banner" class="product-promo">
                                                </figure>
                                                <i>OFF</i>
                                                <div class="banner-content">
                                                    <h4>
                                                        <span class="">UP TO</span><br />
                                                        <b class="">50%</b>
                                                    </h4>
                                                </div>
                                                <a href="demo36-shop.html" class="btn btn-sm btn-dark">SHOP NOW</a>
                                            </div>
                                        </div>
                                        <!-- End .col-lg-4 -->
                                    </div>
                                    <!-- End .row -->
                                </div>
                                <!-- End .megamenu -->
                        </li>
                        @endforeach
                    <!-- End Category -->
                    <li class="float-right phone">
                        @if($company_info && $company_info->is_mobile_active)
                        <a href="#" class="d-flex align-items-center pt-0 pb-0" style="color: white;"><i
                                class="icon-phone-1" style="font-size: 1.5rem;"></i>{{$company_info->mobile}}</a>
                        @endif
                    </li>
                    @if(Auth::user())
                    <li class="float-right"><a class="pt-0 pb-0" href="{{ route('customer-logout') }}"
                            style="color: white;">Logout</a></li>
                    @endif
                    <li class="float-right"><a class="pt-0 pb-0" href="#" style="color: white;">FLASH DEALS</a></li>
                </ul>
            </nav>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-bottom -->
</header>
<!-- End .header -->