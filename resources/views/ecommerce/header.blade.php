<header class="header">

    <!-- Start Sidebar -->
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <input type="hidden" name="category_data[]" id="category_data" value="" />
            <ul class="sidebar-nav" id="category_show">
                <li class="text-center h4" style="background-color: brown;">Aladdinne</li>
                <li id="category_content"><a style="font-weight: bold; font-size: 18px; color: black;"><i
                            id="category_back" class="fa fa-arrow-left"></i> Shop By Department <button
                            id="minimizeSidebar" type="button" style="font-weight: bold; font-size: 28px; color: red;"
                            class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></a></li>
                @foreach($parentCategories as $parentCategory)
                <li style="list-style: none;padding-bottom: 2px;"><a style="font-family: inherit;"
                        href="javascript:void(0);" @if($parentCategory->SubCategory) class="parent_category"
                        data-id="{{$parentCategory->id}}" @endif>{{$parentCategory->name}}
                        @if($parentCategory->SubCategory) <i class="arrow right float-right"></i> @endif</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- End Sidebar -->

    <div class="pt-1 pb-0 header-middle sticky-header" style="background-color: #00C5D1;"
        data-sticky-options="{'mobile': true}">
        <div class="header-left col-lg-2 w-auto pl-0 pl-1 pl-md-5">
            <!-- <button class="mobile-menu-toggler text-dark mr-2" type="button">
            <a class="btn" id="menu-toggle"><i class="custom-icon-toggle-menu d-inline-table"></i></a>
                </button> -->

            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('logo.png') }}" class="w-100" width="111" height="44" style="height: 44px;"
                    alt="Porto Logo">
            </a>

        </div>
        <!-- End .header-left -->
        <div class="container">


            <div class="header-right w-lg-max">
                <div
                    class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mb-0">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
                            <!-- End .select-custom -->
                            <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
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
                            <h4 class="mb-0" style="color: #ffffff;">@if(Auth::user()) {{Auth::user()->name}} @else My Account @endif</h4>
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
                                            <a href="{{ route('product-detail', ['id'=>$id]) }}">{{ $details['name'] }}</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span
                                                class="cart-product-qty card-product-qty-{{ $id }}">{{ $details['quantity'] }}</span>
                                            ×
                                            ${{ $details['sale_price'] }}
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

                                <span class="cart-total-price float-right">${{$total}}</span>
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

    <div class="header-bottom sticky-header d-none d-lg-flex pb-0 pt-0" style="background-color: #192D2E;"
        data-sticky-options="{'mobile': false}">
        <div class="container">
            <nav class="main-nav w-100">
                <ul class="menu w-100">
                    <li>
                        <a class="btn pt-0 pb-0" id="menu-toggle"><i class="custom-icon-toggle-menu d-inline-table"
                                style="color: white;"></i></a>
                    </li>
                    <li class="active">
                        <a class="pt-0 pb-0" href="{{ route('home') }}" style="color: white;">Home</a>
                    </li>
                    <li class="float-right phone"><a href="#" class="d-flex align-items-center pt-0 pb-0"
                            style="color: white;"><i class="icon-phone-1"
                                style="font-size: 1.5rem;"></i>1-800-234-5678</a>
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