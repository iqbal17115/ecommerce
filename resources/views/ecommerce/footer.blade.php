<footer>
    <div class="footer">
        @if($company_info && $company_info->is_footer_block1_active)
        <div class="footer-top" style="background: #f4631b;padding-top: 2rem;padding-bottom: 2rem;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-1">
                        @if($company_info && $company_info->footer_logo)
                        <a href="{{ route('home') }}">
                            <img data-src="{{ asset('storage/'.$company_info->footer_logo) }}" alt="Logo" class="logo lazy-load"
                                style="height: 50px;">
                        </a>
                        @endif
                    </div>

                    <div class="col-md-3">
                        <span
                            class="widget-newsletter-content d-block font-weight-bold ls-n-10 text-white">@if($company_info
                            && $company_info->footer_ads) {{$company_info->footer_ads}} @endif</span>
                    </div>

                    <div class="col-md-1">
                        <span class="widget-newsletter-content d-block font-weight-bold ls-n-10 text-white"
                            style="font-size: 18px;">বাংলা</span>
                    </div>
                    <div class="col-md-1">
                        @if($company_info && $company_info->country_flag)
                        <a href="{{ route('home') }}">
                            <img data-src="{{ asset('storage/'.$company_info->country_flag) }}" alt="Logo" class="logo lazy-load"
                                style="height: 50px;">
                        </a>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <span class="widget-newsletter-content d-block font-weight-bold ls-n-10 text-white"
                            style="font-size: 18px;">Subscribe to Newsletter</span>
                    </div>
                    <div class="col-md-4">
                        <form action="#" class="mb-0">
                            <div class="footer-submit-wrapper d-flex">
                                <input type="email" class="form-control mb-0" placeholder="Enter your Email address..."
                                    required>
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
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <div class="widget">
                            <h4 class="widget-title text-dark">{{ __('translate.get_to_know_us') }}</h4>

                            <ul class="links">
                                <li><a href="{{ route('about') }}" style="color: #777;">{{ __('translate.about') }}</a></li>
                                <li><a href="Javascript:void(0);" style="color: #777;">{{ __('translate.career') }}</a></li>
                                <li><a href="{{ route('privacy-policy') }}" style="color: #777;">{{ __('translate.privacy_policy') }}</a></li>
                                <li><a href="{{ route('terms-condition') }}" style="color: #777;">{{ __('translate.terms_and_condition') }}</a></li>
                                <li><a href="{{ route('shipping-and-delivery') }}" style="color: #777;">{{ __('translate.shipping_and_delivery') }}</a></li>
                                <li><a href="{{ route('contact-us') }}" style="color: #777;">{{ __('translate.contact_us') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="widget">
                            <h4 class="widget-title text-dark">{{ __('translate.customer_service') }}</h4>

                            <ul class="links">
                                <li><a href="Javascript:void(0);" style="color: #777;">{{ __('translate.your_account') }}</a></li>
                                <li><a href="Javascript:void(0);" style="color: #777;">{{ __('translate.your_order') }}</a></li>
                                <li><a href="Javascript:void(0);" style="color: #777;">{{ __('translate.track_shipment') }}</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="widget">
                            <h4 class="widget-title text-dark">{{ __('translate.make_money_with_us') }}</h4>

                            <ul class="links">
                                <li><a href="Javascript:void(0);" style="color: #777;">{{ __('translate.sell_on_aladdine') }}</a></li>
                                <li><a href="Javascript:void(0);" style="color: #777;">{{ __('translate.blog') }}</a></li>
                                <li><a href="Javascript:void(0);" style="color: #777;">{{ __('translate.advertise_your_product') }}</a></li>
                                <li><a href="Javascript:void(0);" style="color: #777;">{{ __('translate.protect_and_build_your_brand') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="contact-widget follow">
                            <h4 class="widget-title ls-n-10 text-dark">{{ __('translate.connect_with_us') }}</h4>
                            <div class="social-icons" style="margin-bottom: 5px;">
                                <a 
                                @if($company_info && $company_info->facebook_link) 
                                    href="{{$company_info->facebook_link}}" 
                                @endif 
                                    class="social-icon social-facebook icon-facebook text-dark" target="_blank"></a>
                                <a 
                                @if($company_info && $company_info->twitter_link) 
                                    href="{{$company_info->twitter_link}}" 
                                @endif 
                                class="social-icon social-twitter icon-twitter text-dark"  target="_blank"></a>
                                <a 
                                @if($company_info && $company_info->instagram_link) 
                                    href="{{$company_info->instagram_link}}" 
                                @endif 
                                class="social-icon social-instagram icon-instagram text-dark"
                                    target="_blank"></a>
                                <a 
                                @if($company_info && $company_info->linkedin_link) 
                                    href="{{$company_info->linkedin_link}}" 
                                @endif 
                                    class="social-icon social-linkedin fab fa-linkedin-in text-dark"
                                    target="_blank"></a>
                            </div><!-- End .social-icons -->
                            <ul class="links">
                                <li><a href="Javascript:void(0);" style="color: #777;">{{ __('translate.email') }}: @if($company_info &&
                                        $company_info->email) {{$company_info->email}} @endif</a></li>
                                <li><a href="Javascript:void(0);" style="color: #777;">{{ __('translate.whatsapp') }}: @if($company_info &&
                                        $company_info->phone) {{$company_info->phone}} @endif</a></li>
                                <li>
                                    <h5>{{ __('translate.download_your_app') }} </h5>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-2"></div>
                    
                </div>
            </div>
            @endif
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
        </div><!-- End .footer-bottom -->
    </div>
</footer>
<!-- End .footer -->