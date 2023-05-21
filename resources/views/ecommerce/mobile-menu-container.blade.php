<div class="mobile-menu-overlay"></div>
<div class="sticky-navbar" style="background-color: rgb(244, 99, 27)">
    <div class="sticky-info">
        <a href="{{ route('home') }}">
            <i class="icon-home"></i>Home
        </a>
    </div>
    <div class="sticky-info">
        <a href="demo36-shop.html" class="">
            <i class="icon-bars"></i>Categories
        </a>
    </div>
    <div class="sticky-info">
        <a href="wishlist.html" class="">
            <i class="icon-wishlist-2"></i>Wishlist
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ route('checkout') }}" class="">
            <i class="icon-user-2"></i>Account
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ route('cart') }}" class="">
            <i class="icon-shopping-cart position-relative">
                <span class="cart-count badge-circle">{{ count((array) session('cart')) }}</span>
            </i>Cart
        </a>
    </div>
</div>
