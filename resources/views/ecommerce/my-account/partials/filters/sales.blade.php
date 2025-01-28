<div class="col-md-12" style="margin-top: 20px;">
    <div class="card shadow-lg p-3 border-0" style="border-radius: 10px; background-color: #f9f9f9;">
        <!-- Header with Show/Hide Button -->
        <div class="d-flex justify-content-between align-items-center" style="border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">
            <button id="toggle-filters" class="btn btn-sm" style="font-size: 10px;">
                <span id="toggle-icon" class="fas fa-chevron-down" style="margin-right: 5px;"></span> Apply Filters
            </button>
        </div>

        <!-- Collapsible Filter Section -->
        <div id="filter-section" class="mt-3">
            <div class="row gy-4 align-items-center">
                <!-- Search Box -->
                <div class="col-md-4">
                    <div class="input-group shadow-sm">
                        <span class="input-group-text" style="background-color: #007bff; color: #fff; border-radius: 5px 0 0 5px;">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control search_parameter" id="search_value" placeholder="Type order details..." 
                            style="border-radius: 0 5px 5px 0; border: 1px solid #dee2e6;">
                    </div>
                </div>

                <!-- Date Range Picker -->
                <div class="col-md-5">
                    <div class="input-group shadow-sm">
                        <span class="input-group-text" style="background-color: #007bff; color: #fff; border-radius: 5px 0 0 5px;">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                        <input type="text" class="form-control date-range-picker" id="date_range" 
                            placeholder="MM/DD/YYYY - MM/DD/YYYY" 
                            style="border-radius: 0 5px 5px 0; border: 1px solid #dee2e6;">
                    </div>
                </div>

                <!-- Items Per Page -->
                <div class="col-md-3">
                    <select class="form-select form-select-sm shadow-sm" id="items_per_page_select" 
                        style="border-radius: 5px; border: 1px solid #dee2e6;">
                        <option value="10" selected>10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
