<div class="col-md-12" style="width: 100%;">
    <div style="background: #ffffff; border-radius: 12px; padding: 5px; box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1); border: 1px solid #ddd;">
        <!-- Header with Show/Hide Button -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h5 style="color: #333; font-weight: bold; margin: 0;">Filters</h5>
            <button onclick="toggleFilter()" style="background: #007bff; color: #fff; border: none; padding: 5px 10px; font-size: 7px; border-radius: 4px; cursor: pointer;">
                <i class="fas fa-sliders-h" style="margin-right: 5px;"></i> Toggle Filters
            </button>
        </div>

        <!-- Collapsible Filter Section -->
        <div id="filterSection" style="display: block;">
            <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                <!-- Search Box -->
                <div style="flex: 1; min-width: 250px;">
                    <input type="text" id="search_value" placeholder="Search orders..." class="search_parameter"
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;">
                </div>

                <!-- Date Range Picker -->
                <div style="flex: 1; min-width: 250px;">
                    <input type="text" id="date_range" placeholder="MM/DD/YYYY - MM/DD/YYYY"
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;">
                </div>

                <!-- Items Per Page -->
                <div style="flex: 1; min-width: 150px;">
                    <select id="items_per_page_select" 
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;">
                        <option value="10" selected>10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>