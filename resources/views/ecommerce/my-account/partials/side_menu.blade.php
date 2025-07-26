<nav class="side-menu">
    <ul class="nav flex-column">
        <!-- <li class="nav-item">
            <a class="nav-link @if ($type == 'dashboard') active @endif" href="#dashboard" data-toggle="tab">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link font-weight-bold text-danger" href="javascript:void(0);">
                <i class="fas fa-sign-out-alt" style="visibility: hidden;"></i> Edit Profile
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold text-danger" href="/customer-logout">
               <i class="fas fa-sign-out-alt" style="visibility: hidden;"></i> Sign Out
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="#orders" data-toggle="tab">
                <i class="fas fa-box-open" style="color: #f4631b;"></i> My Orders
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="#your_payment" data-toggle="tab">
                <i class="fas fa-credit-card" style="color: #f4631b;"></i> My Payment
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="#order_status" data-toggle="tab">
                <i class="fas fa-clipboard-check" style="color: #f4631b;"></i> Order Status
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="#your_transactions" data-toggle="tab">
                <i class="fas fa-receipt" style="color: #f4631b;"></i> Transactions
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold cart-item-tab">
                <i class="fas fa-shopping-cart" style="color: #f4631b;"></i> My Cart
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="#installation-plan" data-toggle="tab">
                <i class="fas fa-tools" style="color: #f4631b;"></i> Installation Plan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold @if ($type == 'wishlist') active @endif wishlist-item-tab">
                <i class="fas fa-heart" style="color: #f4631b;"></i> Wishlist
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="#review_feedback" data-toggle="tab">
                <i class="fas fa-comment-dots" style="color: #f4631b;"></i> Review & Feedback
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="#address" data-toggle="tab">
                <i class="fas fa-map-marker-alt" style="color: #f4631b;"></i> My Address
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="#mobile-app" data-toggle="tab">
                <i class="fas fa-mobile-alt" style="color: #f4631b;"></i> Mobile App
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="#return_exchange" data-toggle="tab">
                <i class="fas fa-exchange-alt" style="color: #f4631b;"></i> Return & Exchange
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="#my-account-contact-us" data-toggle="tab">
                <i class="fas fa-envelope-open-text" style="color: #f4631b;"></i> Contact Us
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="#reward-gift-card" data-toggle="tab">
                <i class="fas fa-gift" style="color: #f4631b;"></i> Reward & Gift Card
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="#switch-accounts" data-toggle="tab">
                <i class="fa-solid fa-right-left" style="color: #f4631b;"></i> Switch Accounts
            </a>
        </li>
        <br>
    </ul>
</nav>
