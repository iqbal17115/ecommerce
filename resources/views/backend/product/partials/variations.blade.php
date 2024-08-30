<div class="tab-pane add_variant" id="variations" role="tabpanel">
    <form method="post" id="add_product_variation">
        @csrf
        <input type="hidden" name="product_id"
            @if ($productInfo) value="{{ $productInfo->id }}" @else value="-1" @endif />
        <div class="row">
            <!-- Color Selection and Table -->
            <div class="col-md-4">
                <div class="input-group">
                    <select id="colorSelect" class="form-control form-control-sm">
                        <option value="" disabled selected>Select Color</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->value }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append mt-0 pt-0">
                        <span id="addColorBtn" class="btn btn-sm btn-primary mt-0 pt-0">Add Color</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div id="colorTableContainer">
                    <table id="colorTable" class="table table-sm">
                        <thead>
                            <tr>
                                <th>Color</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamically added color rows will go here -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Size Selection and Table -->
            <div class="col-md-12 mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <div class="parent">
                            <select id="sizeSelect" class="form-select form-select-sm" multiple style="width: 100%;">
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <span id="addSizeBtn" class="btn btn-sm btn-primary pt-0 mt-0">Apply</span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div id="sizeTableContainer" class="mt-4">
                    <table id="sizeTable" class="table table-sm">
                        <thead>
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
                            <!-- Dynamically added size rows will go here -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-12 mt-3 text-right">
                <button type="submit" class="prev-btn btn-warning float-left">Previous</button>
                <button type="submit" class="next-btn  btn-success float-right">Next</button>
            </div>
            <!-- End -->
        </div>
    </form>
</div>
