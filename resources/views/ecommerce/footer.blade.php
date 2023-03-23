<footer class="footer font2" style="background-image: url(footer_image.png);">
    <div class="container">
        <div
            class="widget-newsletter d-flex align-items-center align-items-sm-start flex-column flex-lg-row  justify-content-lg-between">
            <div
                class="widget-newsletter-info text-center text-sm-left d-flex flex-column flex-sm-row align-items-center mb-1 mb-xl-0">
                <i class="icon-envolope"></i>
                <div class="widget-info-content">
                    <h5 class="widget-newsletter-title mb-0">
                        Subscribe To Our Newsletter</h5>
                    <p class="widget-newsletter-content mb-0">Get all the latest information on Events, Sales and
                        Offers.
                    </p>
                </div>
            </div>
            <form action="#" class="mb-0 w-lg-max mt-2 mt-md-0">
                <div class="footer-submit-wrapper d-flex align-items-center">
                    <input type="email" class="form-control mb-0" placeholder="Your E-mail Address" size="40" required>
                    <button type="submit" class="btn btn-primary btn-sm">Subscribe
                        Now!</button>
                </div>
            </form>
        </div>

        <div class="footer-top">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="widget">
                        <h3 class="widget-title">Customer Service</h3>
                        <div class="widget-content">
                            <ul>
                                <li><a href="#">Help & FAQs</a></li>
                                <li><a href="#">Order Tracking</a></li>
                                <li><a href="#">Shipping & Delivery</a></li>
                                <li><a href="#">Orders History</a></li>
                                <li><a href="#">Advanced Search</a></li>
                                <li><a href="login.html">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="widget">
                        <h3 class="widget-title">About Us</h3>
                        <div class="widget-content">
                            <ul>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Our Stores</a></li>
                                <li><a href="#">Corporate Sales</a></li>
                                <li><a href="#">Careers</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="widget">
                        <h3 class="widget-title">More Information</h3>
                        <div class="widget-content">
                            <ul>
                                <li><a href="#">Affiliates</a></li>
                                <li><a href="#">Refer a Friend</a></li>
                                <li><a href="#">Student Beans Offers</a></li>
                                <li><a href="#">Gift Vouchers</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="widget">
                        <h3 class="widget-title">Social Media</h3>
                        <div class="widget-content">
                            <div class="social-icons">
                                <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                    title="Facebook"></a>
                                <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                                    title="Twitter"></a>
                                <a href="#" class="social-icon social-instagram icon-instagram" target="_blank"
                                    title="Instagram"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom d-sm-flex align-items-center justify-content-center" style="height: 20px;">
                <img src="{{ asset('payment.png') }}" />
            </div>
        </div>
        <!-- End .footer-bottom -->
    </div>
    <div class="footer-bottom d-sm-flex align-items-center justify-content-center p-0" style="background-color: rgba(255,255,255,0.15);">
        <span class="footer-copyright" style="color: #fff;">@if($company_info && $company_info->name) {{$company_info->name}} @endif eCommerce. © {{date("Y")}}. All Rights
            Reserved</span>
    </div>
</footer>