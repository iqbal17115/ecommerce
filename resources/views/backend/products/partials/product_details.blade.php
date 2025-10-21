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

            {{-- START: Price, Stock & Variants Section (from image bf6bfe.png) --}}
            <div class="form-section">
                <h2>Price, Stock & Variants</h2>
                <button type="button" class="btn btn-sm btn-outline-primary mb-3"><i class="fas fa-plus mr-1"></i> Add Variation</button>
                <div class="variant-table-responsive">
                    <table class="table variant-table">
                        <thead>
                            <tr>
                                <th>Price & Stock</th>
                                <th>Special Price</th>
                                <th>Stock</th>
                                <th>SKU/Item No.</th>
                                <th>Max Items</th>
                                <th>Available</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="number" name="price" class="form-control" placeholder="Price"></td>
                                <td><input type="number" name="special_price" class="form-control" placeholder="Special Price"></td>
                                <td><input type="number" name="stock" class="form-control" placeholder="Stock"></td>
                                <td><input type="text" name="sku" class="form-control" placeholder="Enter SKU"></td>
                                <td><input type="number" name="max_items" class="form-control" placeholder="Max Items"></td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="is_available" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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