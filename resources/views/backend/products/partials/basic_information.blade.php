<div class="form-card">
    <h2>Basic Information</h2>

    {{-- START: Basic Information & Category (Always Editable in Step 2) --}}
    <div class="basic-info-editable-header mb-4 p-3 border rounded">
        <div class="row">
            {{-- 1. Editable Product Name --}}
            <div class="col-md-6 form-group mb-0">
                <label for="product_name_step2" class="mb-1 small text-muted">
                    <i class="fas fa-box text-primary mr-2"></i> Product Name <span class="text-danger">*</span>
                </label>
                <div class="input-group input-group-sm">
                    {{-- New ID, but will use the main 'product_name' name for submission --}}
                    <input type="text" name="product_name" id="product_name_step2" class="form-control" maxlength="255" required>
                    <div class="input-group-append">
                        <span class="input-group-text"><span id="productNameCountStep2">0</span>/255</span>
                    </div>
                </div>
            </div>

            {{-- 2. Editable Category Dropdown --}}
            <div class="col-md-6 form-group mb-0">
                <label for="categoryDropdownStep2" class="mb-1 small text-muted">
                    <i class="fas fa-tags text-primary mr-2"></i> Category <span class="text-danger">*</span>
                <div id="categoryDropdownWrapperStep2"></div>
            </div>
        </div>
    </div>
    {{-- END: Basic Information & Category (Always Editable in Step 2) --}}

    {{-- START: Product Images section (Updated for dynamic preview) --}}
    <div class="form-section" data-step="2" id="productImagesSection">
        <div class="form-group">
            <label>Product Images</label>
            {{-- Container for all image boxes (Main and Gallery) --}}
            <div class="image-upload-area" id="mainGalleryUploadArea">
                {{-- GALLERY IMAGE BOX 1 (Initial box, which will be the first gallery item) --}}
                <div class="upload-box-wrapper" data-type="gallery" data-index="1">
                    <div class="upload-box gallery-image-box dashed-border">
                        <i class="fas fa-plus"></i>
                        <!-- <p>Upload gallery image</p> -->
                        <input type="file" name="gallery_images[]" class="image-input" accept="image/*">
                    </div>
                </div>

            </div>
        </div>

        <div class="form-group mt-4">
            <label>Buyer Promotion Image</label>
            <div class="image-upload-area small-upload-boxes">
                <div class="upload-box promo-image-box dashed-border">
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
    {{-- END: Product Images section --}}
</div>