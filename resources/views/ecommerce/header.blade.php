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
                <div class="header-dropdown ">
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

                <div class="header-dropdown mr-auto mr-sm-3 mr-md-0">
                    {{-- <a href="#"><i class="flag-us flag"></i>Eng</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#"><i class="flag-us flag mr-2"></i>ENG</a>
                            </li>
                            <li><a href="#"><i class="flag-fr flag mr-2"></i>FRA</a></li>
                        </ul>
                    </div> --}}
                    <!-- End .header-menu -->
                </div>
                <!-- End .header-dropown -->

                <div class="header-dropdown dropdown-expanded d-none d-lg-block">
                    <div class="header-menu">
                        <ul>
                            @if (Auth::user())
                            <li><a href="{{ route('my.account') }}">My account</a></li>
                            @endif
                            <li><a href="{{ route('cart') }}">Cart</a></li>
                            @if (!Auth::user())
                            <li><a href="{{ route('login') }}">Log In</a></li>
                            @endif
                        </ul>
                    </div>
                    <!-- End .header-menu -->
                </div>
                <!-- End .header-dropown -->

                <div class="social-icons">
                    @if($company_info && $company_info->facebook_link)
                        <a href="{{$company_info->facebook_link}}" class="social-icon social-facebook icon-facebook" target="_blank"></a>
                    @endif
                    @if($company_info && $company_info->twitter_link)
                        <a href="{{$company_info->twitter_link}}" class="social-icon social-twitter icon-twitter" target="_blank"></a>
                    @endif
                    @if($company_info && $company_info->instagram_link)
                    <a href="{{$company_info->instagram_link}}" class="social-icon social-instagram icon-instagram" target="_blank"></a>
                    @endif
                </div>
                <!-- End .social-icons -->
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
                <button class="mobile-menu-toggler-custom text-dark mr-2 menu-toggle" type="button">
                    All <i class="fas fa-bars"></i>
                </button>
                @if ($company_info && $company_info->logo)
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset('storage/' . $company_info->logo) }}" class="w-100" width="111" height="44" alt="Porto Logo">
                    @endif
                </a>
            </div>
            <!-- End .header-left -->

            <div class="header-right w-lg-max">
                <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mb-0">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                    <form action="{{ route('search') }}" method="get">
                        <div class="header-search-wrapper" style="border: 0px;">
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
                            <!-- End .select-custom -->
                            <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                        </div>
                        <!-- End .header-search-wrapper -->
                    </form>
                </div>
                <!-- End .header-search -->
                @if (!Auth::user())
                <a href="{{ route('login') }}" class="d-lg-block d-none">
                    <div class="header-user">
                        <i class="icon-user-2"></i>
                        <div class="header-userinfo">
                            <span class="text-dark">Welcome</span>
                            <h4 class="mb-0">My Account</h4>
                        </div>
                    </div>
                </a>
                @endif
                <a href="{{ route('my.account') }}" class="header-icon position-relative" title="wishlist">
                    <i class="icon-wishlist-2"></i>
                    <span class="wishlist-count badge-circle">0</span>
                </a>

                <div class="dropdown cart-dropdown">
                    <a href="#" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        @if ($company_info && $company_info->icon)
                            <img src="{{ asset('storage/' . $company_info->icon) }}" alt="Your Image"
                                        class="img-fluid icon-cart-thick pb-0 mb-0" style="height: 20px;">
                        @endif
                        {{-- <span class="cart-count badge-circle">3</span> --}}
                        <span class="cart-count badge-circle"
                                    style="top: 5px; left: 27px; background: darkblue;">{{ count((array) session('cart')) }}</span>
                    </a>

                    <div class="cart-overlay"></div>

                    <div class="dropdown-menu mobile-cart">
                        <a href="#" title="Close (Esc)" class="btn-close">×</a>

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
                                                <a href="{{ route('home') }}" class="product-image lazy-load">
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
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-middle -->

    <div class="header-bottom sticky-header d-none d-lg-flex" data-sticky-options="{'mobile': false}">
        <div class="container">
            <nav class="main-nav w-100">
                <ul class="menu w-100">
                    <li class="active">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    @foreach ($headerMenuCategories as $headerMenuCategory)
                        <li>
                            <a class="" href="{{ route('catalog', ['id' => $headerMenuCategory->id]) }}">{{ $headerMenuCategory->name }}</a>
                        </li>
                    @endforeach
                    <li class="float-right phone">

                        @if ($company_info && $company_info->is_mobile_active)
                            <a href="javascript:void(0);" class="d-flex align-items-center"><i
                                    class="icon-phone-1" style="font-size: 1rem;"></i>{{ $company_info->mobile }}</a>
                        @endif
                    </li>
                    <li class="float-right"><a href="https://1.envato.market/DdLk5" target="_blank">NEW
                            ARRIVALS</a></li>
                    <li class="float-right"><a href="#">FLASH DEALS</a></li>
                </ul>
            </nav>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-bottom -->
</header>
<!-- End .header -->
