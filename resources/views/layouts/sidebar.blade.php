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
                           <li><a href="{{ route('all.customer') }}">Customers</a></li>
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
                           <li><a href="{{ route('countries.view') }}">Country</a></li>
                           <li><a href="{{ route('divisions.view') }}">Division</a></li>
                           <li><a href="{{ route('districts.view') }}">District</a></li>
                           <li><a href="{{ route('upazilas.view') }}">Area</a></li>
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
                           <li>
                               <a href="javascript:void(0);" class="has-arrow">Digital Marketing</a>
                               <ul class="sub-menu" aria-expanded="true">
                                   <li>
                                       <a href="javascript: void(0);" class="has-arrow">SEO</a>
                                       <ul class="sub-menu" aria-expanded="true">
                                           <li><a href="{{ route('seo_pages_create') }}">Add Page</a></li>
                                           <li><a href="{{ route('seo-pages.index') }}">All Page</a></li>
                                       </ul>
                                   </li>
                               </ul>
                           </li>
                           <li><a href="javascript:void(0);">Analog Marketing</a></li>
                           <li><a href="javascript:void(0);">Affiliat</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Shipping</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="{{ route('shipping_charge.index') }}">Shipping Charge</a></li>
                           <li><a href="{{ route('shipping_methods.index') }}">Manage</a></li>
                           <li><a href="{{ route('shipping_method_setting.index') }}">Setting</a></li>
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
                           <li><a href="{{ route('all-order') }}">All Order</a></li>
                           <li><a href="{{ route('pending-order') }}">Pending</a></li>
                           <li><a href="{{ route('new-order') }}">Processing</a></li>
                           <li><a href="{{ route('shipped-order') }}">Shipped</a></li>
                           <li><a href="{{ route('in_transit-order') }}">In Transit</a></li>
                           <li><a href="{{ route('arrival_at_distribution_center-order') }}">Arrival At Distribution Center</a></li>
                           <li><a href="{{ route('out_for_delivery-order') }}">Out For Delivery</a></li>
                           <li><a href="{{ route('delivery_attempted-order') }}">Delivery Attempted</a></li>
                           <li><a href="{{ route('delivery_rescheduling-order') }}">Delivery Rescheduling</a></li>
                           <li><a href="{{ route('delivered-order') }}">Delivered</a></li>
                           <li><a href="{{ route('payment_collected-order') }}">Payment Collected</a></li>
                           <li><a href="{{ route('completed-order') }}">Completed</a></li>
                           <li><a href="{{ route('hold-order') }}">Hold</a></li>
                           <li><a href="{{ route('failed-order') }}">Failed</a></li>
                           <li><a href="{{ route('cancelled-order') }}">Cancelled</a></li>
                           <li><a href="{{ route('returned-order') }}">Returned</a></li>
                           <li><a href="{{ route('refunded-order') }}">Refunded</a></li>
                           <li><a href="{{ route('pre_order-order') }}">Pre Order</a></li>
                           <li><a href="{{ route('backordered-order') }}">Backordered</a></li>
                           <li><a href="{{ route('partially_shipped-order') }}">Partially Shipped</a></li>
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
