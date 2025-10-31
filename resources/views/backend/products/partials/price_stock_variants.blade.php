<div class="form-card">
    <h2>Price, Stock & Variants</h2>
    {{-- START: Price, Stock & Variants Section (Dynamic Daraz Style - FINAL CORRECTED SELECT-AND-ADD) --}}
    <div class="form-section variant-management-section">
        <p class="form-text text-muted mb-4">You can add variants to a product that has more than one option, such as size or color.</p>

        <div id="variantsContainer">

            {{-- VARIANT 1 BLOCK: Color Family (Multiple Input Rows with Media/Drag) --}}
            <div class="variant-block mb-4 p-3 border rounded" data-variant-index="1">
                <div class="d-flex justify-content-between align-items-center mb-3 variant-header" style="cursor: pointer;">
                    <h5 class="mb-0">
                        <i class="fas fa-chevron-down variant-toggle-icon mr-2"></i>
                        <span class="text-danger">*</span> Variant 1
                    </h5>
                    <i class="fas fa-trash text-muted remove-variant-block" style="cursor: pointer; display: none;"></i>
                </div>

                <div class="variant-content">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="variant_name_1">Variant Name</label>
                            <input type="text" name="variant_name_1" id="variant_name_1" class="form-control variant-name-input" value="Color Family" placeholder="e.g., Color Family">
                        </div>
                    </div>

                    <p class="form-text text-muted small mt-2">
                        Spot a missing attribute value? <a href="#" class="text-primary">Click me</a>
                    </p>

                    <div class="form-group variant-image-toggle d-flex align-items-center mt-3">
                        <input type="checkbox" id="addVariantImage_1" name="add_variant_image_1" class="mr-2 variant-image-checkbox">
                        <label for="addVariantImage_1" class="mb-0 font-weight-normal">Add Image (Max 8 images for each variant)</label>
                    </div>

                    <label class="d-block mt-3">Total Variants</label>
                    <div class="variant-pills-list-container" id="variantPills_1">
                        {{-- STARTING DYNAMIC INPUT ROW (Now a SELECT element) --}}
                        <div class="variant-input-row d-flex align-items-center mb-2" data-is-fixed="false">
                            <select class="form-control variant-value-select-dynamic" style="max-width: 250px;">
                                <option value="">Please type or select</option>
                                <option value="Red">Red</option>
                                <option value="Green">Green</option>
                                <option value="Blue">Blue</option>
                                <option value="Yellow">Yellow</option>
                            </select>
                            <div class="ml-2 variant-media-links" style="visibility: hidden;">
                                <a href="#">Upload</a> | <a href="#">Media Center</a>
                            </div>
                            <i class="fas fa-trash text-muted ml-3 remove-variant-value" style="cursor: pointer; display: none;"></i>
                            <i class="fas fa-bars text-muted ml-2 drag-handle" style="cursor: grab; display: none;"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- VARIANT 2 BLOCK: Size (Modal Style - No changes) --}}
            <div class="variant-block mb-4 p-3 border rounded" data-variant-index="2">
                <div class="d-flex justify-content-between align-items-center mb-3 variant-header" style="cursor: pointer;">
                    <h5 class="mb-0">
                        <i class="fas fa-chevron-up variant-toggle-icon mr-2"></i>
                        <span class="text-danger">*</span> Variant 2
                    </h5>
                    <i class="fas fa-trash text-muted remove-variant-block" style="cursor: pointer;"></i>
                </div>

                <div class="variant-content">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="variant_name_2">Variant Name</label>
                            <input type="text" name="variant_name_2" id="variant_name_2" class="form-control variant-name-input" value="Size" placeholder="e.g., Size">
                        </div>
                    </div>

                    <p class="form-text text-muted small mt-2">
                        Spot a missing attribute value? <a href="#" class="text-primary">Click me</a>
                    </p>

                    <label class="d-block mt-3">Total Variants</label>
                    <div class="d-flex align-items-center mb-3">
                        <button type="button" class="btn btn-sm btn-outline-secondary mr-3 select-variant-sizes-btn" data-toggle="modal" data-target="#sizeSelectionModal">
                            Select sizes
                        </button>
                        <div class="variant-pills-list d-flex flex-wrap" id="variantPills_2">
                            {{-- Pills generated from modal selection will appear here --}}
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary ml-3">Sort</button>
                    </div>
                </div>
            </div>

        </div>

        {{-- SIZE SELECTION MODAL (Kept from previous version) --}}
        <div class="modal fade" id="sizeSelectionModal" tabindex="-1" role="dialog" aria-labelledby="sizeSelectionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sizeSelectionModalLabel">Select Sizes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-3 border-right">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-int-tab" data-toggle="pill" href="#v-pills-int" role="tab" aria-controls="v-pills-int" aria-selected="true">Int</a>
                                    <a class="nav-link" id="v-pills-eu-tab" data-toggle="pill" href="#v-pills-eu" role="tab" aria-controls="v-pills-eu" aria-selected="false">EU</a>
                                    <a class="nav-link" id="v-pills-uk-tab" data-toggle="pill" href="#v-pills-uk" role="tab" aria-controls="v-pills-uk" aria-selected="false">UK</a>
                                    <a class="nav-link" id="v-pills-cn-tab" data-toggle="pill" href="#v-pills-cn" role="tab" aria-controls="v-pills-cn" aria-selected="false">CN</a>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-int" role="tabpanel" aria-labelledby="v-pills-int-tab">
                                        <div class="size-grid">
                                            {{-- Populated by JS for DUMMY_SIZES --}}
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-eu" role="tabpanel" aria-labelledby="v-pills-eu-tab">... EU sizes ...</div>
                                    <div class="tab-pane fade" id="v-pills-uk" role="tabpanel" aria-labelledby="v-pills-uk-tab">... UK sizes ...</div>
                                    <div class="tab-pane fade" id="v-pills-cn" role="tabpanel" aria-labelledby="v-pills-cn-tab">... CN sizes ...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between align-items-center">
                        <div class="modal-selected-count">
                            <span id="selectedSizeCount">0</span> Selected
                            <span class="text-danger ml-3">If you select another size type, original value selected will be removed.</span>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="confirmSizeSelection">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <button type="button" class="btn btn-sm btn-outline-primary mb-4 add-new-variant-btn"><i class="fas fa-plus mr-1"></i> Add New Variation</button>

        <hr class="mt-0 mb-4">

        {{-- PRICE & STOCK MANAGEMENT CONTROLS (Updated to match Image 1 style) --}}
        <div class="variant-price-stock-header">
            <h5 class="mb-3">
                <span class="text-danger">*</span> Price & Stock
            </h5>
            <div class="d-flex flex-wrap align-items-center mb-3 bulk-inputs-container">
                {{-- Select Variant --}}
                <div class="bulk-input-group">
                    <select class="form-control form-control-sm" id="bulkSelectVariant">
                        <option value="">Select Variant</option>
                        {{-- Options populated by JS --}}
                    </select>
                    <i class="fas fa-chevron-down dropdown-arrow"></i>
                </div>

                {{-- Price --}}
                <div class="bulk-input-group">
                    <i class="fas fa-taka-sign input-icon">৳</i>
                    <input type="text" class="form-control form-control-sm bulk-input" data-field="price" placeholder="Price">
                </div>

                {{-- Special Price --}}
                <div class="bulk-input-group">
                    <i class="fas fa-taka-sign input-icon">৳</i>
                    <input type="text" class="form-control form-control-sm bulk-input" data-field="special_price" placeholder="Special Price">
                </div>

                {{-- Stock --}}
                <div class="bulk-input-group">
                    <i class="fas fa-boxes input-icon"></i> {{-- Changed icon for stock --}}
                    <input type="text" class="form-control form-control-sm bulk-input" data-field="stock" placeholder="Stock">
                </div>

                {{-- Seller SKU --}}
                <div class="bulk-input-group">
                    <i class="fas fa-barcode input-icon"></i> {{-- Changed icon for SKU --}}
                    <input type="text" class="form-control form-control-sm bulk-input" data-field="sku" placeholder="Seller SKU" maxlength="200">
                    <span class="sku-char-count"><span id="skuBulkCount">0</span>/200</span>
                </div>

                <button type="button" class="btn apply-to-all-btn btn-sm" style="background: #f4631b;">Apply To All</button>
            </div>
        </div>

        {{-- DYNAMIC VARIANT TABLE CONTAINER (Initially empty) --}}
        <div class="variant-table-responsive">
            <table class="table variant-price-stock-table">
                <thead>
                    <tr id="variantTableHeader"></tr>
                </thead>
                <tbody id="variantTableBody"></tbody>
            </table>
            <p id="tablePlaceholder" class="text-center text-muted mt-4">Add at least one variant value to generate the Price & Stock table.</p>
        </div>
    </div>
    {{-- END: Price, Stock & Variants Section --}}
</div>