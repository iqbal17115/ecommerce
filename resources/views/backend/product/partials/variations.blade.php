<div class="tab-pane add_variant" id="variations" role="tabpanel">
    <form method="post" id="add_product_variation" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" @if ($productInfo) value="{{ $productInfo->id }}" @else value="-1" @endif />

        <div class="row">
            <!-- Color Selection -->
            <div class="col-md-4">
                <div class="input-group">
                    <select id="colorSelect" class="form-control form-control-sm">
                        <option value="" selected>Select Color (Optional)</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->value }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append pt-0 mt-0">
                        <span id="addColorBtn" class="btn btn-sm btn-primary pt-0 mt-0">Add Color</span>
                    </div>
                </div>
            </div>

            <!-- Size Selection -->
            <div class="col-md-4">
                <div class="input-group parent">
                    <select id="sizeSelect" class="form-control form-control-sm" style="width: 80%;" multiple>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->value }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <span id="addSizeBtn" class="btn btn-sm btn-primary pt-0 mt-0" style="height: 31px;">Apply Sizes</span>
                    </div>
                </div>
            </div>

            <!-- Color and Size Table -->
            <div class="col-md-12 mt-3">
                <div id="colorSizeTableContainer">
                    <table id="colorSizeTable" class="table table-sm">
                        <thead>
                            <tr>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Seller SKU</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($productInfo)
                            @foreach ($productInfo->productVariations as $variation)
                                @php
                                    $colorAttribute = $variation->productVariationAttributes->first(function ($attr) {
                                        return $attr->attributeValue?->attribute?->name == 'Color';
                                    });
                                    $sizeAttribute = $variation->productVariationAttributes->first(function ($attr) {
                                        return $attr?->attributeValue?->attribute?->name == 'Size';
                                    });
                                @endphp
                                <tr id="variation-{{ $variation->id }}" class="variation-row" data-color-id="{{ $colorAttribute->attributeValue->id ?? 0 }}" data-size-id="{{ $sizeAttribute->attributeValue->id ?? 0 }}">
                                    <td>{{ $colorAttribute?->attributeValue?->value ?? 'N/A' }}</td>
                                    <td>{{ $sizeAttribute?->attributeValue?->value ?? 'N/A' }}</td>
                                    <td>
                                        <input type="number" name="price_{{ $variation->id }}" placeholder="Price" class="form-control form-control-sm price-input" value="{{ $variation->price }}" required>
                                    </td>
                                    <td>
                                        <input type="text" name="sku_{{ $variation->id }}" placeholder="Seller SKU" class="form-control form-control-sm sku-input" value="{{ $variation->sku }}" required>
                                    </td>
                                    <td>
                                        <input type="number" name="stock_{{ $variation->id }}" placeholder="Stock" class="form-control form-control-sm stock-input" value="{{ $variation->stock }}" required>
                                    </td>
                                    <td>
                                        <span class="delete-icon" onclick="removeVariation('{{ $variation->id }}')">
                                            <i class="mdi mdi-trash-can font-size-16"></i>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Color Image Upload Table -->
            <div class="col-md-12 mt-3">
                <div id="colorImageTableContainer">
                    <table id="colorImageTable" class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Color</th>
                                <th>Upload Image</th>
                                <th>Images</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($productInfo)
                                @foreach ($productInfo->productColors as $productColor)
                                    <tr id="colorImageRow-{{ $productColor->id }}">
                                        <td>{{ $productColor?->attributeValue?->value }}</td>
                                        <td style="width: 300px;">
                                            <input type="file" name="color_image_{{ $productColor?->attribute_value_id }}[]" data-color-id="{{ $productColor->attribute_value_id }}" accept="image/*" multiple class="form-control form-control-sm color-image-input" onchange="previewImages(event, '{{ $productColor->attribute_value_id }}')">
                                        </td>
                                        <td>
                                            <div id="imagePreview-{{ $productColor?->attribute_value_id }}"></div>
                                            @foreach ($productColor->media as $media)
                                                <img src="{{ asset('storage/' . $media->file_path) }}" alt="Image" class="rounded" style="width: 30px; height: 30px; margin: 2px;">
                                            @endforeach
                                        </td>
                                        <td>
                                            <span class="delete-icon product-color-delete" style="cursor: pointer;" data-product_color_id="{{ $productColor->id }}">
                                                <i class="mdi mdi-trash-can d-block font-size-16"></i>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="col-md-12 mt-3 text-right">
                <button type="submit" class="btn btn-success next-btn">Save Variations</button>
            </div>
        </div>
    </form>
</div>
