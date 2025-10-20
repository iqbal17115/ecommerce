<div class="card mt-3 shadow-sm">
    <div class="card-header">
        <strong>Basic Information</strong>
    </div>
    <div class="card-body">
        <div class="form-group mb-3">
            <label>Product Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="form-control" maxlength="255" placeholder="Product name">
        </div>

        <div class="form-group mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control">
                <option value="">Choose category</option>
                {{-- loop categories --}}
                @foreach($categories ?? [] as $cat)
                    <option value="{{ $cat->id }}" {{ (old('category_id', $product->category_id ?? '') == $cat->id) ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label>Main Material</label>
                <input type="text" name="main_material" value="{{ old('main_material', $product->main_material ?? '') }}" class="form-control">
            </div>
            <div class="col-md-6 form-group">
                <label>Brand</label>
                <select name="brand_id" class="form-control">
                    <option value="">No Brand</option>
                    @foreach($brands ?? [] as $brand)
                        <option value="{{ $brand->id }}" {{ (old('brand_id', $product->brand_id ?? '') == $brand->id) ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
