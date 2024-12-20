<nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
    <div class="toolbox-left">
        <a href="#" class="sidebar-toggle"><svg data-name="Layer 3" id="Layer_3"
                viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                    class="cls-2"></path>
                <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                    class="cls-2"></path>
            </svg>
            <span>Filter</span>
        </a>
        <div class="toolbox-item toolbox-sort">
            <label>Sort By:</label>

            <div class="select-custom">
                <select name="orderby" class="form-control order_of_product" id="order_of_product">
                    <option value="" selected="selected">Default sorting</option>
                    <option value="asc">Sort by price: low to high</option>
                    <option value="desc">Sort by price: high to low</option>
                </select>
            </div>
            <!-- End .select-custom -->


        </div>
        <!-- End .toolbox-item -->
    </div>
    <!-- End .toolbox-left -->

    <div class="toolbox-right">
        <div class="toolbox-item toolbox-show">
            <label>Show:</label>

            <div class="select-custom">
                <select name="data_limit" id="data_limit" class="form-control data_limit">
                    <option value="12">12</option>
                    <option value="24">24</option>
                    <option value="36">36</option>
                </select>
            </div>
            <!-- End .select-custom -->
        </div>
        <!-- End .toolbox-item -->

        <div class="toolbox-item layout-modes">
            <a href="javascript:void(0);" class="layout-btn btn-grid active" title="Grid">
                <i class="icon-mode-grid"></i>
            </a>
            <a href="javascript:void(0);" class="layout-btn btn-list" title="List">
                <i class="icon-mode-list"></i>
            </a>
        </div>
        <!-- End .layout-modes -->
    </div>
    <!-- End .toolbox-right -->
</nav>
