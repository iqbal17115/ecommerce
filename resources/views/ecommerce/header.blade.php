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

    <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">

        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
            <!-- <button class="mobile-menu-toggler text-dark mr-2" type="button">
            <a class="btn" id="menu-toggle"><i class="custom-icon-toggle-menu d-inline-table"></i></a>
                </button> -->
                
                <a href="demo36.html" class="logo">
                    <img src="{{ asset('aladdinne/assets/images/logo-black.png') }}" class="w-100" width="111"
                        height="44" alt="Porto Logo">
                </a>

            </div>
            <!-- End .header-left -->

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
                            <span>Welcome</span>
                            <h4 class="mb-0">My Account</h4>
                        </div>
                    </div>
                </a>

                <a href="wishlist.html" class="header-icon position-relative" title="wishlist">
                    <i class="icon-wishlist-2"></i>
                    <span class="wishlist-count badge-circle">0</span>
                </a>

                <div class="dropdown cart-dropdown">
                    <a href="#" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-cart-thick"></i>
                        <span class="cart-count badge-circle">3</span>
                    </a>

                    <div class="cart-overlay"></div>

                    <div class="dropdown-menu mobile-cart">
                        <a href="#" title="Close (Esc)" class="btn-close">×</a>

                        <div class="dropdownmenu-wrapper custom-scrollbar">
                            <div class="dropdown-cart-header">Shopping Cart</div>
                            <!-- End .dropdown-cart-header -->

                            <div class="dropdown-cart-products">
                                <div class="product">
                                    <div class="product-details">
                                        <h4 class="product-title">
                                            <a href="demo36-product.html">Ultimate 3D Bluetooth Speaker</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">1</span> × $99.00
                                        </span>
                                    </div>
                                    <!-- End .product-details -->

                                    <figure class="product-image-container">
                                        <a href="demo36-product.html" class="product-image">
                                            <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-1.jpg') }}"
                                                alt="product" width="80" height="80">
                                        </a>

                                        <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                                    </figure>
                                </div>
                                <!-- End .product -->

                                <div class="product">
                                    <div class="product-details">
                                        <h4 class="product-title">
                                            <a href="demo36-product.html">Brown Women Casual HandBag</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">1</span> × $35.00
                                        </span>
                                    </div>
                                    <!-- End .product-details -->

                                    <figure class="product-image-container">
                                        <a href="demo36-product.html" class="product-image">
                                            <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-2.jpg') }}"
                                                alt="product" width="80" height="80">
                                        </a>

                                        <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                                    </figure>
                                </div>
                                <!-- End .product -->

                                <div class="product">
                                    <div class="product-details">
                                        <h4 class="product-title">
                                            <a href="demo36-product.html">Circled Ultimate 3D Speaker</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">1</span> × $35.00
                                        </span>
                                    </div>
                                    <!-- End .product-details -->

                                    <figure class="product-image-container">
                                        <a href="demo36-product.html" class="product-image">
                                            <img src="{{ asset('aladdinne/assets/images/demoes/demo36/products/product-3.jpg') }}"
                                                alt="product" width="80" height="80">
                                        </a>
                                        <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                                    </figure>
                                </div>
                                <!-- End .product -->
                            </div>
                            <!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>SUBTOTAL:</span>

                                <span class="cart-total-price float-right">$134.00</span>
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

    <div class="header-bottom sticky-header d-none d-lg-flex" data-sticky-options="{'mobile': false}">
        <div class="container">
            <nav class="main-nav w-100">
                <ul class="menu w-100">
                    <li>
                        <a class="btn" id="menu-toggle"><i class="custom-icon-toggle-menu d-inline-table"></i></a>
                    </li>
                    <li class="active">
                        <a href="demo36.html">Home</a>
                    </li>
                    <li>
                        <a href="demo36-shop.html">Shop</a>
                        <div class="megamenu megamenu-fixed-width megamenu-3cols">
                            <div class="row">
                                <div class="col-lg-4">
                                    <a href="#" class="nolink">VARIATION 1</a>
                                    <ul class="submenu">
                                        <li><a href="demo36-shop.html">Fullwidth Banner</a></li>
                                        <li><a href="category-banner-boxed-slider.html">Boxed Slider
                                                Banner</a>
                                        </li>
                                        <li><a href="category-banner-boxed-image.html">Boxed Image
                                                Banner</a>
                                        </li>
                                        <li><a href="demo36-shop.html">Left Sidebar</a></li>
                                        <li><a href="category-sidebar-right.html">Right Sidebar</a></li>
                                        <li><a href="category-off-canvas.html">Off Canvas Filter</a></li>
                                        <li><a href="category-horizontal-filter1.html">Horizontal
                                                Filter1</a>
                                        </li>
                                        <li><a href="category-horizontal-filter2.html">Horizontal
                                                Filter2</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-4">
                                    <a href="#" class="nolink">VARIATION 2</a>
                                    <ul class="submenu">
                                        <li><a href="category-list.html">List Types</a></li>
                                        <li><a href="category-infinite-scroll.html">Ajax Infinite Scroll</a>
                                        </li>
                                        <li><a href="demo36-shop.html">3 Columns Products</a></li>
                                        <li><a href="category-4col.html">4 Columns Products</a></li>
                                        <li><a href="category-5col.html">5 Columns Products</a></li>
                                        <li><a href="category-6col.html">6 Columns Products</a></li>
                                        <li><a href="category-7col.html">7 Columns Products</a></li>
                                        <li><a href="category-8col.html">8 Columns Products</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 p-0">
                                    <div class="menu-banner">
                                        <figure>
                                            <img src="{{ asset('aladdinne/assets/images/menu-banner.jpg') }}"
                                                width="192" height="313" alt="Menu banner">
                                        </figure>
                                        <div class="banner-content">
                                            <h4>
                                                <span class="">UP TO</span><br />
                                                <b class="">50%</b>
                                                <i>OFF</i>
                                            </h4>
                                            <a href="demo36-shop.html" class="btn btn-sm btn-dark">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .megamenu -->
                    </li>
                    <li>
                        <a href="demo36-product.html">Products</a>
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
                                            <img src="{{ asset('aladdinne/assets/images/menu-banner-1.jpg') }}"
                                                alt="Menu banner" class="product-promo">
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
                    <li>
                        <a href="#">Pages</a>
                        <ul>
                            <li><a href="wishlist.html">Wishlist</a></li>
                            <li><a href="cart.html">Shopping Cart</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li><a href="dashboard.html">Dashboard</a></li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="#">Blog</a>
                                <ul>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="single.html">Blog Post</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact Us</a></li>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="forgot-password.html">Forgot Password</a></li>
                        </ul>
                    </li>
                    <li><a href="https://1.envato.market/DdLk5" target="_blank">Buy Porto</a></li>
                    <li class="float-right phone"><a href="#" class="d-flex align-items-center"><i
                                class="icon-phone-1"></i>1-800-234-5678</a>
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