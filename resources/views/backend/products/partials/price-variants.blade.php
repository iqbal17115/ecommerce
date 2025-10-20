<div class="card shadow-sm">
    <div class="card-header">
        <strong>Price, Stock & Variants</strong>
    </div>
    <div class="card-body">
        <div class="mb-2">
            <button type="button" class="btn btn-sm btn-outline-primary" id="add-variant">Add Variant</button>
            <small class="text-muted ml-2">You can add variants like Size and Color</small>
        </div>

        <div id="variants-container">
            {{-- render existing variants --}}
            @foreach($product->variants ?? [] as $vIndex => $variant)
                <div class="variant-row mb-2 card p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>Variant {{ $vIndex + 1 }}</strong>
                        <button type="button" class="btn btn-sm btn-danger remove-variant">Remove</button>
                    </div>

                    <div class="form-row mt-2">
                        <div class="col-5 form-group">
                            <label>Options (e.g. Color, Size)</label>
                            <input type="text" name="variants[{{ $vIndex }}][name]" class="form-control" value="{{ $variant->name }}">
                        </div>
                        <div class="col-3 form-group">
                            <label>Price</label>
                            <input type="number" name="variants[{{ $vIndex }}][price]" class="form-control" value="{{ $variant->price }}">
                        </div>
                        <div class="col-2 form-group">
                            <label>Stock</label>
                            <input type="number" name="variants[{{ $vIndex }}][stock]" class="form-control" value="{{ $variant->stock }}">
                        </div>
                        <div class="col-2 form-group d-flex align-items-end">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input variant-availability" id="avail-{{ $vIndex }}" name="variants[{{ $vIndex }}][enabled]" {{ $variant->enabled ? 'checked' : '' }}>
                                <label class="custom-control-label" for="avail-{{ $vIndex }}">Available</label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- template for new variant (hidden) --}}
        <template id="variant-template">
            <div class="variant-row mb-2 card p-2">
                <div class="d-flex justify-content-between align-items-center">
                    <strong>Variant</strong>
                    <button type="button" class="btn btn-sm btn-danger remove-variant">Remove</button>
                </div>

                <div class="form-row mt-2">
                    <div class="col-5 form-group">
                        <input type="text" name="variants[][name]" class="form-control" placeholder="Color - Size">
                    </div>
                    <div class="col-3 form-group">
                        <input type="number" name="variants[][price]" class="form-control" placeholder="Price">
                    </div>
                    <div class="col-2 form-group">
                        <input type="number" name="variants[][stock]" class="form-control" placeholder="Stock">
                    </div>
                    <div class="col-2 form-group d-flex align-items-end">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input variant-availability" id="avail-new-__RND__" name="variants[][enabled]" checked>
                            <label class="custom-control-label" for="avail-new-__RND__">Available</label>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
