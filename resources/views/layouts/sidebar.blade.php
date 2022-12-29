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
                           <span>Sales</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">New Sale</a></li>
                           <li><a href="javascript:void(0);">Manage Sale</a></li>
                           <li><a href="javascript:void(0);">POS Sale</a></li>
                       </ul>
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
                           <li><a href="javascript:void(0);">Manage Product</a></li>
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
                           <span>Customer</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">Customer</a></li>
                           <li><a href="javascript:void(0);">Customer Ledger</a></li>
                           <li><a href="javascript:void(0);">Customer Balance Report</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Supplier</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">Supplier</a></li>
                           <li><a href="javascript:void(0);">Supplier Ledger</a></li>
                           <li><a href="javascript:void(0);">Supplier Balance Report</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Purchase</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">Purchase</a></li>
                           <li><a href="javascript:void(0);">Manage Purchase Return</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Product Image Gallery</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">Add Product Image</a></li>
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
                           <li><a href="javascript:void(0);">Currency</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Accounting</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">Fiscal Year</a></li>
                           <li><a href="javascript:void(0);">Fiscal Year Ending</a></li>
                           <li><a href="javascript:void(0);">Chart of Accounting</a></li>
                           <li><a href="javascript:void(0);">Opening Balance</a></li>
                           <li><a href="javascript:void(0);">Supplier Payment</a></li>
                           <li><a href="javascript:void(0);">Cash Adjustment</a></li>
                           <li><a href="javascript:void(0);">Debit Voucher</a></li>
                           <li><a href="javascript:void(0);">Credit Voucher</a></li>
                           <li><a href="javascript:void(0);">Contra Voucher</a></li>
                           <li><a href="javascript:void(0);">Journal Voucher</a></li>
                           <li><a href="javascript:void(0);">Voucher Approval</a></li>
                           <li><a href="javascript:void(0);">Receipt Voucher</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Account Report</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">Reports By Voucher</a></li>
                           <li><a href="javascript:void(0);">General ledger</a></li>
                           <li><a href="javascript:void(0);">Profit Loss</a></li>
                           <li><a href="javascript:void(0);">Balance Sheet</a></li>
                           <li><a href="javascript:void(0);">Trial Balance</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Stock</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">Stock Report</a></li>
                           <li><a href="javascript:void(0);">Stock Report(Supplier Wise)</a></li>
                           <li><a href="javascript:void(0);">Stock Report(Product Wise)</a></li>
                           <li><a href="javascript:void(0);">Stock Report(Store Wise)</a></li>
                           <li><a href="javascript:void(0);">Stock Adjustment</a></li>
                           <li><a href="javascript:void(0);">Batch Wise Stock</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Bank</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">Bank</a></li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="has-arrow waves-effect">
                           <i class="bx bx-layout"></i>
                           <span>Report</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li><a href="javascript:void(0);">Sales Report</a></li>
                           <li><a href="javascript:void(0);">Sales Report(Store Wise)</a></li>
                           <li><a href="javascript:void(0);">Purchase Report</a></li>
                           <li><a href="javascript:void(0);">Tax Report(Store Wise)</a></li>
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
                           <li><a href="javascript:void(0);">Coupon</a></li>
                           <li><a href="javascript:void(0);">Contact Form</a></li>
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