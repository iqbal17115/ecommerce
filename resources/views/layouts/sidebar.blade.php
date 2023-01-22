   <!-- ========== Left Sidebar Start ========== -->
   <div class="vertical-menu" style="background: #000000 !important;">

       <div data-simplebar class="h-100">

           <!--- Sidemenu -->
           <div id="sidebar-menu">
               <!-- Left Menu Start -->
               <ul class="metismenu list-unstyled" id="side-menu">
                   <li class="menu-title">Menu</li>

                   <li>
                       <a href="{{url('/admin')}}" class="waves-effect">
                           <i class="bx bx-home-circle"></i>
                           <span>Dashboards</span>
                       </a>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Order</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">New Order</a></li>
                           <li><a href="javascript:void(0);">Manage Order</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Product</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="{{ route('product-product') }}">Add Product</a></li>
                           <li><a href="javascript:void(0);">Import Product(CSV)</a></li>
                           <li><a href="javascript:void(0);">Import Product(EXCEL)</a></li>
                           <li><a href="{{ route('product_list') }}">Manage Product</a></li>
                           <li><a href="javascript:void(0);">Product Ledger</a></li>
                           <li><a href="{{ route('product-category') }}">Category</a></li>
                           <li><a href="{{ route('product-brand') }}">Brand</a></li>
                           <li><a href="{{ route('product-variant') }}">Variant</a></li>
                           <li><a href="{{ route('product-unit') }}">Unit</a></li>
                           <li><a href="{{ route('product-material') }}">Material</a></li>
                           <li><a href="{{ route('condition') }}">Condition</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Tax</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">Tax Setting</a></li>
                           <li><a href="javascript:void(0);">Tax Product Service</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Currency</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="{{ route('currency') }}">Currency</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Pay With</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">Pay With</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>States</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">State</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Web Settings</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="{{ route('slider') }}">Slider</a></li>
                           <li><a href="{{ route('advertisement') }}">Advertisement</a></li>
                           <li><a href="{{ route('block') }}">Block</a></li>
                           <li><a href="javascript:void(0);">Product Review</a></li>
                           <li><a href="javascript:void(0);">Web Footer</a></li>
                           <li><a href="javascript:void(0);">Link Page</a></li>
                           <li><a href="{{ route('coupon') }}">Coupon</a></li>
                           <li><a href="javascript:void(0);">Why Choose Us</a></li>
                           <li><a href="javascript:void(0);">Our Location</a></li>
                           <li><a href="javascript:void(0);">Shipping Method</a></li>
                           <li><a href="javascript:void(0);">Setting</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Software Settings</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">User</a></li>
                           <li><a href="javascript:void(0);">Language</a></li>
                           <li><a href="javascript:void(0);">Setting</a></li>
                       </ul>
                   </li>

               </ul>
           </div>
           <!-- Sidebar -->
       </div>
   </div>
   <!-- Left Sidebar End -->