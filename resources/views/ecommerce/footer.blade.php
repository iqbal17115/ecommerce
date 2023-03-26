<footer>
            <div class="footer">
            @if($company_info && $company_info->is_footer_block1_active)
                <div class="footer-top" style="background: #f4631b;padding-top: 2rem;padding-bottom: 2rem;">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-lg-3">
                                <h4 class="widget-newsletter-title font1 font-weight-bold text-white ls-n-10">Sign Up to
                                    Newsletter</h4>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <p class="widget-newsletter-content ls-n-10 text-white mb-0">Get all the latest
                                    information on Events, Sales and Offers.</p>
                                <span
                                    class="widget-newsletter-content d-block font-weight-bold ls-n-10 text-white">Receive
                                    $10 coupon for first shopping.</span>
                            </div>
                            <div class="col-md-10 col-lg-5">
                                <form action="#" class="mb-0">
                                    <div class="footer-submit-wrapper d-flex">
                                        <input type="email" class="form-control mb-0"
                                            placeholder="Enter your Email address..." required>
                                        <button type="submit" class="btn btn-md btn-dark">Subscribe</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endif
                <div class="container">
                @if($company_info && $company_info->is_footer_block2_active)
                    <div class="footer-middle">
                        <div class="row">
                            <div class="col-lg-6 mb-1">
                            @if($company_info && $company_info->logo)
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('storage/'.$company_info->logo) }}" alt="Logo" class="logo mb-3 mb-lg-6">
                                </a>
                            @endif
                                <div class="row no-gutters m-0">
                                    <div class="col-md-4 mb-2">
                                    @if($company_info && $company_info->hotline)  
                                        <div class="contact-widget phone">
                                            <h4 class="widget-title">call us now:</h4>
                                            <a href="javascript:void(0);">{{$company_info->hotline}}</a>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mb-2">
                                    @if($company_info && $company_info->email)  
                                        <div class="contact-widget email">
                                            <h4 class="widget-title">e-mail address:</h4>
                                            <a href="mailto:{{$company_info->email}}">{{$company_info->email}}</a>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="contact-widget follow">
                                            <h4 class="widget-title ls-n-10">follow us</h4>
                                            <div class="social-icons">
                                                <a href="#" class="social-icon social-facebook icon-facebook"
                                                    target="_blank"></a>
                                                <a href="#" class="social-icon social-twitter icon-twitter"
                                                    target="_blank"></a>
                                                <a href="#" class="social-icon social-linkedin fab fa-linkedin-in"
                                                    target="_blank"></a>
                                            </div><!-- End .social-icons -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="widget">
                                    <h4 class="widget-title">Categories</h4>

                                    <ul class="links">
                                        <li><a href="demo21-shop.html">Electronics</a></li>
                                        <li><a href="demo21-shop.html">Fashion</a></li>
                                        <li><a href="demo21-shop.html">Gifts</a></li>
                                        <li><a href="demo21-shop.html">Music</a></li>
                                        <li><a href="demo21-shop.html">Trousers</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="widget">
                                    <h4 class="widget-title">About</h4>

                                    <ul class="links">
                                        <li><a href="demo21-about.html">About us</a></li>
                                        <li><a href="demo21-contact.html">Contact us</a></li>
                                        <li><a href="#">All Collections</a></li>
                                        <li><a href="#">Privacy policy</a></li>
                                        <li><a href="#">Terms &amp; Conditions</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="widget">
                                    <h4 class="widget-title">Customer Care</h4>

                                    <ul class="links">
                                        <li><a href="dashboard.html">My Account</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                        <li><a href="cart.html">Shopping Cart</a></li>
                                        <li><a href="#">Terms &amp; Conditions</a></li>
                                        <li><a href="#">FAQs</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
@endif
@if($company_info && $company_info->is_footer_block3_active)
                    <div class="footer-bottom d-sm-flex align-items-center">
                        <div class="footer-left">
                            <span class="footer-copyright">© {{date("Y")}} @if($company_info && $company_info->name) {{$company_info->name}} @endif | All Rights
            Reserved.</span>
                        </div>

                        <div class="footer-right ml-auto mt-1 mt-sm-0">
                            <img @if($company_info && $company_info->footer_payment_image) src="{{asset('storage/'.$company_info->footer_payment_image)}}"  @endif alt="payment">
                        </div>
                    </div>
                    @endif
                </div><!-- End .footer-bottom -->
            </div>
        </footer>
         <!-- End .footer -->