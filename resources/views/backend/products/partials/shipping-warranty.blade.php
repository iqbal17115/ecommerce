<div class="card mt-3 shadow-sm">
    <div class="card-header">
        <strong>Shipping & Warranty</strong>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label>Weight (for shipping)</label>
            <input type="text" name="shipping_weight" class="form-control" value="{{ old('shipping_weight', $product->shipping_weight ?? '') }}">
        </div>

        <div class="form-group">
            <label>Warranty</label>
            <input type="text" name="warranty" class="form-control" value="{{ old('warranty', $product->warranty ?? '') }}">
        </div>
    </div>
</div>
