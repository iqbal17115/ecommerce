<nav class="side-menu">
    <ul class="nav flex-column">
        <!-- <li class="nav-item">
            <a class="nav-link @if ($type == 'dashboard') active @endif" href="#dashboard" data-toggle="tab">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link text-danger" href="javascript:void(0);">
                <i class="fas fa-sign-out-alt" style="visibility: hidden;"></i> Edit Profile
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="/customer-logout">
               <i class="fas fa-sign-out-alt" style="visibility: hidden;"></i> Sign Out
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#orders" data-toggle="tab">
                <i class="fas fa-box-open"></i> Your Orders
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#address" data-toggle="tab">
                <i class="fas fa-map-marker-alt"></i> Your Address
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#order_status" data-toggle="tab">
                <i class="fas fa-clipboard-check"></i> Order Status
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#mobile-app" data-toggle="tab">
                <i class="fas fa-mobile-alt"></i> Mobile App
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link cart-item-tab">
                <i class="fas fa-shopping-cart"></i> Cart
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if ($type == 'wishlist') active @endif wishlist-item-tab">
                <i class="fas fa-heart"></i> Wishlist
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#reward-gift-card" data-toggle="tab">
                <i class="fas fa-gift"></i> Reward & Gift Card
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#your_payment" data-toggle="tab">
                <i class="fas fa-credit-card"></i> Your Payment
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#your_transactions" data-toggle="tab">
                <i class="fas fa-receipt"></i> Transactions
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#installation-plan" data-toggle="tab">
                <i class="fas fa-tools"></i> Installation Plan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#return_exchange" data-toggle="tab">
                <i class="fas fa-exchange-alt"></i> Return & Exchange
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#review_feedback" data-toggle="tab">
                <i class="fas fa-comment-dots"></i> Review & Feedback
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#my-account-contact-us" data-toggle="tab">
                <i class="fas fa-envelope-open-text"></i> Contact Us
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#switch-accounts" data-toggle="tab">
                <i class="fas fa-user-friends"></i> Switch Accounts
            </a>
        </li>
    </ul>
</nav>
