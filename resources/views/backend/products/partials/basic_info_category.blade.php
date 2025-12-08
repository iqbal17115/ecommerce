    <div class="d-flex justify-content-between">
        <div class="form-card">
            <h2>Basic Information</h2>
            <div class="col-md-8"> {{-- Main content area --}}
                <div class="form-group">
                    <label for="product_name">Product Name <span class="text-danger">*</span></label>
                    <p class="form-text text-muted">Multiple language title will be shown when buyers change their APPs' default language setting. Setting it up can help improve product recall in Apps targeted at different languages.</p>
                    <div class="input-group">
                        <input type="text" name="product_name" id="product_name" class="form-control @error('product_name') is-invalid @enderror" placeholder="Product Name" maxlength="255">
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
                        <div class="category-dropdown">
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle form-control text-left d-flex justify-content-between align-items-center"
                                id="categoryDropdownButton">
                                <span id="selectedCategoryDisplay">Please select category or search with keyword</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>

                            <div class="category-dropdown-menu">
                                <div class="px-3 py-2">
                                    <input type="text" class="form-control category-search-input-dropdown" placeholder="Search category...">
                                </div>
                                <div class="category-list-dropdown"></div>
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