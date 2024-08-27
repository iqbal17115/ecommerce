<div class="tab-pane add_variant" id="variations" role="tabpanel">
    {{-- <form method="post" id="add_variation">
        @csrf --}}
    <div class="row">
        <div class="col-md-4">
            <div class="input-group">
                <select id="colorSelect" class="form-control form-control-sm">
                    <option value="" disabled selected>Select Color</option>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                </select>
                <div class="input-group-append mt-0 pt-0">
                    <button id="addColorBtn" class="btn btn-sm btn-primary mt-0 pt-0">Add Color</button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <!-- Color Table -->
            <div id="colorTableContainer">
                <table id="colorTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Color</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <!-- Variant 2: Size Selection -->
            <div class="parent">
                <label for="sizeSelect" class="form-label">Select Sizes:</label>
                <select id="sizeSelect" class="form-select form-select-sm" multiple style="width: 100%;">
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <!-- Add more sizes as needed -->
                </select>
                <button id="addSizeBtn" class="btn btn-sm btn-primary mt-2">Apply Sizes</button>
            </div>
        </div>
        <div class="col-md-12">
            <!-- Size Table -->
            <div id="sizeTableContainer" class="mt-4">
                <table id="sizeTable" class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Seller SKU</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Size rows will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- </form> --}}
</div>
