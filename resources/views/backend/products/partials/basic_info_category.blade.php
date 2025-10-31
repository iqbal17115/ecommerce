    <div class="d-flex justify-content-between">
        <div class="form-card">
            <h2>Basic Information</h2>
            <div class="col-md-8"> {{-- Main content area --}}
                <div class="form-group">
                    <label for="product_name">Product Name <span class="text-danger">*</span></label>
                    <p class="form-text text-muted">Multiple language title will be shown when buyers change their APPs' default language setting. Setting it up can help improve product recall in Apps targeted at different languages.</p>
                    <div class="input-group">
                        <input type="text" name="product_name" id="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name', 'Ex. Nikon Coolpix A900 Digital Camera') }}" maxlength="255">
                        <div class="input-group-append">
                            <span class="input-group-text"><span id="productNameCount">0</span>/255</span>
                        </div>
                    </div>
                    @error('product_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="category">Category <span class="text-danger">*</span></label>
                    <p class="form-text text-muted">Please select category or search with keyword</p>

                    <div class="category-dropdown-wrapper">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle form-control text-left d-flex justify-content-between align-items-center" type="button" id="categoryDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span id="selectedCategoryDisplay">Please select category or search with keyword</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu w-100" aria-labelledby="categoryDropdownButton">
                                <div class="px-3 py-2">
                                    <input type="text" class="form-control category-search-input-dropdown" placeholder="Search category...">
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="px-3 py-2 category-recently-used-tags">
                                    <span class="badge badge-secondary" data-category-id="1">wxj test leaf category 01</span>
                                    <span class="badge badge-secondary" data-category-id="2">Test FY SOP Category 1</span>
                                    <span class="badge badge-secondary" data-category-id="3">v merge in same P - SPU</span>
                                    {{-- More recently used categories --}}
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="category-list-dropdown" style="max-height: 200px; overflow-y: auto;">
                                    {{-- These would be loaded dynamically in a real app --}}
                                    <a class="dropdown-item category-item" href="#" data-category-id="4" data-category-path="Electronics > Cameras > Digital Cameras">Electronics > Cameras > Digital Cameras</a>
                                    <a class="dropdown-item category-item" href="#" data-category-id="5" data-category-path="Clothing > Men's > T-Shirts">Clothing > Men's > T-Shirts</a>
                                    <a class="dropdown-item category-item" href="#" data-category-id="6" data-category-path="Home & Kitchen > Cookware > Pans">Home & Kitchen > Cookware > Pans</a>
                                    {{-- ... more categories ... --}}
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="category_id" id="selectedCategoryId" value="">
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
        <div class="col-md-4"> {{-- Right panel --}}
            <div class="card right-panel">
                <div class="card-body">
                    <h3>Tips</h3>
                    <p>Please make sure to upload product images(s), fill product name, and select the correct category to publish a product.</p>
                    <div class="lightbulb-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>