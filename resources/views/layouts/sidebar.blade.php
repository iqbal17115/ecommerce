   <!-- ========== Left Sidebar Start ========== -->
   <div class="vertical-menu" style="background: #000000 !important;">

       <div data-simplebar class="h-100">

           <!--- Sidemenu -->
           <div id="sidebar-menu">
               <!-- Left Menu Start -->
               <ul class="metismenu list-unstyled" id="side-menu">
                   <li class="menu-title">Menu</li>

                   <li>
                       <a href="{{ url('/admin') }}" class="waves-effect">
                           <i class="bx bx-home-circle"></i>
                           <span>Dashboards</span>
                       </a>
                   </li>
                   <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Customers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="javascript:void(0);">Dashboard</a></li>
                        <li><a href="{{ route('manage.customer') }}">Manage Customers</a></li>
                        <li><a href="{{ route('all.customer') }}">Customers Profile</a></li>
                        <li><a href="javascript:void(0);">Customer Login</a></li>
                        <li><a href="javascript:void(0);">Customer Registration</a></li>

                    </ul>
                </li>
                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Products</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="{{ route('product-product') }}">Add Product</a></li>
                           <li><a href="javascript:void(0);">Import Product</a></li>
                           <li><a href="javascript:void(0);">Export Product List</a></li>
                           <li><a href="{{ route('product_list') }}">Manage Product</a></li>
                           <li><a href="{{ route('product-category') }}">Category</a></li>
                           <li><a href="{{ route('product-brand') }}">Brand</a></li>
                           <li><a href="{{ route('product-unit') }}">Unit</a></li>
                           <li><a href="{{ route('product-variant') }}">Variation</a></li>
                           <li><a href="{{ route('product-material') }}">Material</a></li>
                           <li><a href="{{ route('condition') }}">Condition</a></li>
                       </ul>
                   </li>
                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Shop Settings</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="{{ route('company-info') }}"> Basic Info</a></li>
                           <li><a href="javascript:void(0);"> Social Media Link</a></li>
                           <li><a href="{{ route('currency') }}">Currency</a></li>
                           <li><a href="javascript:void(0);">Language</a></li>
                       </ul>
                   </li>
                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Home & Page Settings</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="{{ route('slider') }}">Slider</a></li>
                           <li><a href="{{ route('advertisement') }}">Advertisement</a></li>
                           <li><a href="{{ route('feature-setting') }}">Feature</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Promotion</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="{{ route('coupon') }}">Coupon Codes</a></li>
                           <li><a href="javascript:void(0);">Offer</a></li>
                           <li><a href="javascript:void(0);">Reward</a></li>
                           <li><a href="javascript:void(0);">Gift Option</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>CMS Pages</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">About Us</a></li>
                           <li><a href="javascript:void(0);">Terms & Condition</a></li>
                           <li><a href="javascript:void(0);">Privacy Policy</a></li>
                           <li><a href="javascript:void(0);">Return Policy</a></li>
                           <li><a href="{{ route('shipping-charge') }}">Shipping & Delivery</a></li>
                           <li><a href="javascript:void(0);">Blog</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Marketing</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">Email</a></li>
                           <li><a href="javascript:void(0);">SMS</a></li>
                           <li><a href="javascript:void(0);">Digital Marketing</a></li>
                           <li><a href="javascript:void(0);">Analog Marketing</a></li>
                           <li><a href="javascript:void(0);">Affiliat</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Review & Feedback</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="{{ route('reviews.index') }}">Reviews</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Help & Support</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">Email</a></li>
                           <li><a href="javascript:void(0);">Hotline</a></li>
                           <li><a href="javascript:void(0);">SMS</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Ticket</span>
                       </a>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Subscribers</span>
                       </a>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Orders</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="{{ route('new-order') }}">New Order</a></li>
                           <li><a href="{{ route('all-order') }}">All Order</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Return Orders</span>
                       </a>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Payment</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">COD</a></li>
                           <li><a href="javascript:void(0);">CREDIT/DEBIT Card</a></li>
                       </ul>
                   </li>

               </ul>
           </div>
           <!-- Sidebar -->
       </div>
   </div>
   <!-- Left Sidebar End -->
