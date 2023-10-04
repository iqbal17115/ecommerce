<footer class="footer font2">
    <div class="container">
        <div class="widget-newsletter d-flex align-items-center align-items-sm-start flex-column flex-lg-row  justify-content-lg-between">
            <div class="widget-newsletter-info text-center text-sm-left d-flex flex-column flex-sm-row align-items-center mb-1 mb-xl-0">
                <i class="icon-envolope"></i>
                <div class="widget-info-content">
                    <h5 class="widget-newsletter-title mb-0">
                        Subscribe To Our Newsletter</h5>
                    <p class="widget-newsletter-content mb-0">Get all the latest information on Events, Sales and Offers.
                    </p>
                </div>
            </div>
            <form action="#" class="mb-0 w-lg-max mt-2 mt-md-0">
                <div class="footer-submit-wrapper d-flex align-items-center">
                    <input type="email" class="form-control mb-0" placeholder="Your E-mail Address" size="40" required>
                    <button type="submit" class="btn btn-sm brand_color">Subscribe
                        Now!</button>
                </div>
            </form>
        </div>

        <div class="footer-top">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="widget">
                        <h3 class="widget-title">Get to know us</h3>
                        <div class="widget-content">
                            <ul>
                                <li><a href="{{ route('about') }}" style="color: #777;">About Aladdine</a></li>
                                <li><a href="Javascript:void(0);" style="color: #777;">Careers</a></li>
                                <li><a href="{{ route('privacy-policy') }}" style="color: #777;">Privacy Policy</a></li>
                                <li><a href="{{ route('terms-condition') }}" style="color: #777;">Terms and condition</a></li>
                                <li><a href="{{ route('shipping-and-delivery') }}" style="color: #777;">Shipping and delivery</a></li>
                                <li><a href="{{ route('contact-us') }}" style="color: #777;">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="widget">
                        <h3 class="widget-title">Customer Service</h3>
                        <div class="widget-content">
                            <ul>
                                <li><a href="Javascript:void(0);" style="color: #777;">Your Account</a></li>
                                <li><a href="Javascript:void(0);" style="color: #777;">Your Order</a></li>
                                <li><a href="Javascript:void(0);" style="color: #777;">Track Shipment</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="widget">
                        <h3 class="widget-title">Make Money With Us</h3>
                        <div class="widget-content">
                            <ul>
                                <li><a href="Javascript:void(0);" style="color: #777;">Sell On Aladdine</a></li>
                                <li><a href="Javascript:void(0);" style="color: #777;">Blog</a></li>
                                <li><a href="Javascript:void(0);" style="color: #777;">Advertise your product</a></li>
                                <li><a href="Javascript:void(0);" style="color: #777;">Protect And Build Your Brand</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title ls-n-10 text-dark">Connect with us</h4>
                            <div class="social-icons" style="margin-bottom: 5px;">
                                <a
                                @if($company_info && $company_info->facebook_link)
                                    href="{{$company_info->facebook_link}}"
                                @endif
                                    class="social-icon social-facebook icon-facebook" target="_blank"></a>
                                <a
                                @if($company_info && $company_info->twitter_link)
                                    href="{{$company_info->twitter_link}}"
                                @endif
                                class="social-icon social-twitter icon-twitter"  target="_blank"></a>
                                <a
                                @if($company_info && $company_info->instagram_link)
                                    href="{{$company_info->instagram_link}}"
                                @endif
                                class="social-icon social-instagram icon-instagram"
                                    target="_blank"></a>
                                <a
                                @if($company_info && $company_info->linkedin_link)
                                    href="{{$company_info->linkedin_link}}"
                                @endif
                                    class="social-icon social-linkedin fab fa-linkedin-in"
                                    target="_blank"></a>
                            </div><!-- End .social-icons -->
                            <ul class="links">
                                <li><a href="Javascript:void(0);" style="color: #777;">Email: @if($company_info &&
                                        $company_info->email) {{$company_info->email}} @endif</a></li>
                                <li><a href="Javascript:void(0);" style="color: #777;">Whatsapp: @if($company_info &&
                                        $company_info->phone) {{$company_info->phone}} @endif</a></li>
                                <li>
                                    <h5>Download Your App </h5>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($company_info && $company_info->is_footer_block3_active)
    <div class="footer-bottom d-sm-flex align-items-center">
        <div class="footer-left">
            <span class="footer-copyright">© {{date("Y")}} @if($company_info && $company_info->name)
                {{$company_info->name}} @endif | All Rights
                Reserved.</span>
        </div>

        <div class="footer-right ml-auto mt-1 mt-sm-0">
            <img @if($company_info && $company_info->footer_payment_image)
            data-src="{{asset('storage/'.$company_info->footer_payment_image)}}" @endif  class="lazy-load" style="max-width: 1000px;" alt="payment">
        </div>
    </div>
    @endif
</footer>
<!-- End .footer -->
