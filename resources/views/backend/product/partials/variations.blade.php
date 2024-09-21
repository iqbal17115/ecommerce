<div class="tab-pane add_variant" id="variations" role="tabpanel">
    <form method="post" id="add_product_variation" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" @if ($productInfo) value="{{ $productInfo->id }}" @else value="-1" @endif />
        <div class="row">
            <!-- Color Selection -->
            <div class="col-md-4">
                <div class="input-group">
                    <select id="colorSelect" class="form-control form-control-sm">
                        <option value="" selected>Select Color (Optional)</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->value }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <span id="addColorBtn" class="btn btn-sm btn-primary">Add Color</span>
                    </div>
                </div>
            </div>

            <!-- Size Selection -->
            <div class="col-md-4">
                <div class="input-group">
                    <select id="sizeSelect" class="form-control form-control-sm" multiple>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->value }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <span id="addSizeBtn" class="btn btn-sm btn-primary">Apply Sizes</span>
                    </div>
                </div>
            </div>

            <!-- Color and Size Table -->
            <div class="col-md-12 mt-3">
                <div id="colorSizeTableContainer">
                    <table id="colorSizeTable" class="table table-sm">
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
                            <!-- Dynamic rows will be added here -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="col-md-12 mt-3 text-right">
                <button type="submit" class="btn btn-success">Save Variations</button>
            </div>
        </div>
    </form>
</div>
