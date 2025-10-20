<div class="card mt-3 shadow-sm">
    <div class="card-header">
        <strong>Product Description</strong>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label>Main Description</label>
            <textarea name="description" rows="8" class="form-control wysiwyg">{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        <div class="form-group mt-3">
            <label>Highlights</label>
            <textarea name="highlights" rows="5" class="form-control">{{ old('highlights', $product->highlights ?? '') }}</textarea>
        </div>

        <div class="form-row">
            <div class="col form-group">
                <label>What's in the box</label>
                <input type="text" name="whats_in_box" class="form-control" value="{{ old('whats_in_box', $product->whats_in_box ?? '') }}">
            </div>
        </div>
    </div>
</div>
