<div class="card mt-3 shadow-sm">
    <div class="card-header">
        <strong>Product Specification</strong>
        <span class="badge badge-success ml-2">Fill Rate: 100%</span>
    </div>
    <div class="card-body">
        <div class="form-row">
            <div class="col-6 form-group">
                <label>Color Family</label>
                <input type="text" name="color_family" value="{{ old('color_family', $product->color_family ?? '') }}" class="form-control">
            </div>
            <div class="col-6 form-group">
                <label>Size</label>
                <input type="text" name="size" value="{{ old('size', $product->size ?? '') }}" class="form-control">
            </div>
        </div>

        <div class="form-group mt-2">
            <a class="btn btn-link p-0" data-toggle="collapse" href="#moreAttributes" role="button" aria-expanded="false">Show More</a>
            <div class="collapse mt-2" id="moreAttributes">
                <div class="form-row">
                    <div class="col-6 form-group">
                        <label>Weight (g)</label>
                        <input type="number" name="weight" value="{{ old('weight', $product->weight ?? '') }}" class="form-control">
                    </div>
                    <div class="col-6 form-group">
                        <label>Package Dimensions</label>
                        <input type="text" name="dimensions" value="{{ old('dimensions', $product->dimensions ?? '') }}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
