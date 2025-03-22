<div class="mobile-menu-overlay"></div>
<div class="sticky-navbar">
    <div class="sticky-info">
        <a href="{{ route('home') }}">
            <i class="icon-home"></i>Home
        </a>
    </div>
    <div class="sticky-info">
        <a href="javascript::void();">
            <i class="fas fa-bell pt-2"></i> 
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ route('my.account', ['type' => 'wishlist']) }}" class="">
            <i class="icon-wishlist-2 position-relative">
                <span class="wishlist-count badge-circle">{{ count((array) session('wishlist')) }}</span>
            </i>Wishlist
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ route('my.account') }}" class="">
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
