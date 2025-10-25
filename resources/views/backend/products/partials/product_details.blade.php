<div class="product-details-content">
    
    {{-- Display Name and Category at the top --}}
    <div class="product-header-summary mb-4 p-3 border rounded bg-light">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-box text-primary mr-2"></i> Product Name: <strong id="summaryProductName">N/A</strong>
            </h5>
            <small class="text-muted">
                <i class="fas fa-tag text-secondary mr-1"></i> Category: <strong id="summaryCategoryPath">N/A</strong>
            </small>
        </div>
    </div>

    {{-- START: MAIN CONTENT WRAPPER FOR STICKY SIDEBAR --}}
    <div class="main-content-flex-wrapper d-flex">

        {{-- LEFT COLUMN: All scrollable content --}}
        <div class="col-md-9 p-0 main-form-content">
        
            {{-- START: Product Images section --}}
            <div class="form-section">
                <h2>Product Images</h2>
                <p class="form-text text-muted mb-3">Upload main product image (200px * 200px) and gallery images.</p>
                <div class="d-flex flex-column"> {{-- Adjusted to flex-column to manage internal vertical content --}}
                    <div class="form-group">
                        <label>Product Images</label>
                        <div class="image-upload-area">
                            <div class="upload-box main-image-box">
                                <i class="fas fa-plus"></i>
                                <p>Upload main image</p>
                                <input type="file" name="main_image" accept="image/*">
                            </div>
                            <div class="upload-box gallery-image-box">
                                <i class="fas fa-plus"></i>
                                <p>Upload gallery image</p>
                                <input type="file" name="gallery_images[]" multiple accept="image/*">
                            </div>
                            {{-- Placeholder for additional gallery images --}}
                            <div class="upload-box gallery-image-box">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label>Buyer Promotion Image</label>
                        <div class="image-upload-area small-upload-boxes">
                            <div class="upload-box promo-image-box">
                                <i class="fas fa-plus"></i>
                                <input type="file" name="promo_image" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label>Product Video</label>
                        <div class="d-flex align-items-center mb-2">
                            <input type="radio" name="video_source" value="youtube" id="youtubeRadio" checked> <label for="youtubeRadio" class="ml-2 mr-3">Youtube Link</label>
                            <input type="radio" name="video_source" value="media_center" id="mediaCenterRadio"> <label for="mediaCenterRadio" class="ml-2">Media Center</label>
                        </div>
                        <input type="text" name="video_link" class="form-control" placeholder="Enter Youtube URL">
                        <small class="form-text text-muted">Note: Max video length 60 seconds. Max file size: 100MB</small>
                    </div>
                </div>
            </div>
            {{-- END: Product Images section --}}
            
            {{-- START: Product Specification Section (with correct Fill Rate span) --}}
            <div class="form-section">
                <h2>Product Specification <span class="float-right"><small>Fill Rate: <span class="text-primary" id="specFillRate">0%</span></small> <span class="fill-rate-bar"></span></span></h2>
                <p class="form-text text-muted">Filling in attributes will increase product searchability, driving sales conversion. Spot a missing attribute or attribute value? <a href="#">Click me</a></p>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="brand">* Brand</label>
                        <select name="brand" id="brand" class="form-control">
                            <option value="">Select</option>
                            {{-- Options --}}
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="model">Model</label>
                        <input type="text" name="model" id="model" class="form-control" placeholder="Input here">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="display_resolution">Display Resolution</label>
                        <input type="text" name="display_resolution" id="display_resolution" class="form-control" placeholder="Input here">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="electronics_features">Electronics Features</label>
                        <input type="text" name="electronics_features" id="electronics_features" class="form-control" placeholder="Input here">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="energy_rating">Energy Rating</label>
                        <input type="text" name="energy_rating" id="energy_rating" class="form-control" placeholder="Input here">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="refresh_rate">Refresh Rate</label>
                        <select name="refresh_rate" id="refresh_rate" class="form-control">
                            <option value="">Select</option>
                            {{-- Options --}}
                        </select>
                    </div>
                </div>
                
                {{-- Collapsible More Fields Section --}}
                <div id="moreSpecifications" style="display: none;">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="required_serial">Required Serial</label>
                            <input type="text" name="required_serial" id="required_serial" class="form-control" placeholder="Input here">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="speakers_config">Speakers Config</label>
                            <input type="text" name="speakers_config" id="speakers_config" class="form-control" placeholder="Input here">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="internal_memory">Internal Memory</label>
                            <input type="text" name="internal_memory" id="internal_memory" class="form-control" placeholder="Input here">
                        </div>
                    </div>
                </div>
                
                <a href="#" class="spec-toggle-link text-primary" data-toggle-target="#moreSpecifications">
                    <span class="show-text">Show More <i class="fas fa-chevron-down"></i></span>
                    <span class="hide-text" style="display: none;">Show Less <i class="fas fa-chevron-up"></i></span>
                </a>
            </div>
            {{-- END: Product Specification Section --}}

            {{-- START: Price, Stock & Variants Section (Dynamic Daraz Style - FINAL CORRECTED SELECT-AND-ADD) --}}
<div class="form-section variant-management-section">
    <h2>Price, Stock & Variants</h2>
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
            
            <div class="variant-content" style="display: none;">
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

    {{-- PRICE & STOCK MANAGEMENT CONTROLS --}}
    <div class="variant-price-stock-header d-flex align-items-center mb-3">
        <h5 class="mb-0 mr-3"><i class="fas fa-dollar-sign text-success mr-2"></i> Price & Stock</h5>
        <select class="form-control form-control-sm w-auto mr-2" id="bulkSelectVariant" style="min-width: 150px;">
            <option value="">Select Variant</option>
            {{-- Options populated by JS --}}
        </select>
        <input type="text" class="form-control form-control-sm w-auto mr-2 bulk-input" data-field="price" placeholder="Price">
        <input type="text" class="form-control form-control-sm w-auto mr-2 bulk-input" data-field="special_price" placeholder="Special Price">
        <input type="text" class="form-control form-control-sm w-auto mr-2 bulk-input" data-field="stock" placeholder="Stock">
        <input type="text" class="form-control form-control-sm w-auto mr-2 bulk-input" data-field="sku" placeholder="Seller SKU">
        <button type="button" class="btn btn-sm btn-info apply-to-all-btn">Apply To All</button>
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

            {{-- START: Product Description Section --}}
            <div class="form-section">
                <h2>Product Description</h2>
                <div class="description-editor-wrapper">
                    {{-- Placeholder for Rich Text Editor --}}
                    <textarea name="description" class="form-control" rows="8"></textarea>
                    <div class="description-footer d-flex justify-content-end align-items-center mt-2">
                        <button type="button" class="btn btn-sm btn-info mr-2">Markdown Preview</button>
                        <button type="button" class="btn btn-sm btn-light">HTML</button>
                    </div>
                </div>
            </div>
            {{-- END: Product Description Section --}}

            {{-- START: Shipping & Warranty Section --}}
            <div class="form-section">
                <h2>Shipping & Warranty</h2>
                <p class="form-text text-muted">Watch out if you want different dimensions & weight for variations</p>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Package Weight</label>
                        <div class="input-group">
                            <input type="number" name="package_weight" class="form-control">
                            <div class="input-group-append">
                                <select name="weight_unit" class="form-control">
                                    <option value="kg">kg</option>
                                    <option value="g">g</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Package Length/Width/Height</label>
                        <div class="d-flex">
                            <input type="number" name="length" class="form-control mr-1" placeholder="L">
                            <input type="number" name="width" class="form-control mr-1" placeholder="W">
                            <input type="number" name="height" class="form-control mr-1" placeholder="H">
                            <select name="dimension_unit" class="form-control w-25">
                                <option value="cm">cm</option>
                                <option value="inch">inch</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <label class="mt-3">Dangerous Goods</label>
                <div class="d-flex align-items-center">
                    <input type="radio" name="dangerous_goods" value="yes" id="dgYes"> <label for="dgYes" class="ml-2 mr-3">Yes</label>
                    <input type="radio" name="dangerous_goods" value="no" id="dgNo" checked> <label for="dgNo" class="ml-2">No</label>
                </div>

                <a href="#" class="mt-3 d-block">View Warranty Settings</a>
            </div>
            {{-- END: Shipping & Warranty Section --}}

        </div>

        {{-- RIGHT COLUMN: Sticky Panel --}}
        <div class="col-md-3 p-0 sticky-sidebar">
            {{-- Current Score Panel (Right Sidebar) --}}
            <div class="card current-score-panel ml-3">
                <div class="card-body">
                    <h4 class="card-title">Current Score</h4>
                    <div class="score-indicator">
                        <div class="score-circle">75</div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="fas fa-check-circle text-success"></i> Basic Information</li>
                        <li class="list-group-item"><i class="fas fa-check-circle text-success"></i> Product Images</li>
                        <li class="list-group-item"><i class="fas fa-exclamation-circle text-warning"></i> Product Specification</li>
                        <li class="list-group-item"><i class="fas fa-times-circle text-danger"></i> Price, Stock & Variants</li>
                        <li class="list-group-item"><i class="fas fa-times-circle text-danger"></i> Product Description</li>
                        <li class="list-group-item"><i class="fas fa-times-circle text-danger"></i> Shipping & Warranty</li>
                    </ul>
                    <h4 class="card-title mt-4">Price & Stock</h4>
                    <p class="card-text">Once product images(s), fill product name, and active category(s), will show price and stock.</p>
                </div>
            </div>
        </div>

    </div>
    {{-- END: MAIN CONTENT WRAPPER FOR STICKY SIDEBAR --}}
    
</div>