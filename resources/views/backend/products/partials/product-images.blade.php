<div class="card mt-3 shadow-sm">
    <div class="card-header">
        <strong>Product Images</strong>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="d-block">Primary Images</label>
            <div class="d-flex flex-wrap image-uploader">
                {{-- show existing images --}}
                @foreach($product->images ?? [] as $img)
                    <div class="img-thumb">
                        <img src="{{ asset($img->path) }}" alt="img">
                        <button type="button" class="btn btn-sm btn-danger remove-img" data-id="{{ $img->id }}">×</button>
                    </div>
                @endforeach

                <div class="img-upload-placeholder">
                    <label class="uploader">
                        <input type="file" name="images[]" accept="image/*" multiple>
                        <div class="plus">+</div>
                    </label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label>Buyer Promotion Image (long)</label>
            <input type="file" name="promo_image" class="form-control-file">
            <small class="text-muted">Recommended size: long image. Max 100MB</small>
        </div>

        <div class="mb-3">
            <label>Video</label>
            <input type="file" name="video" accept="video/*" class="form-control-file">
            <small class="text-muted">mp4, max length 60s</small>
        </div>
    </div>
</div>
