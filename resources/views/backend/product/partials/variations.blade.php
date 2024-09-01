<div class="tab-pane add_variant" id="variations" role="tabpanel">
    <form method="post" id="add_product_variation" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id"
            @if ($productInfo) value="{{ $productInfo->id }}" @else value="-1" @endif />
        <div class="row">
            <!-- Color Selection and Table -->
            <div class="col-md-4">
                <div class="input-group">
                    <select id="colorSelect" class="form-control form-control-sm">
                        <option value="" disabled selected>Select Color</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->value }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append mt-0 pt-0">
                        <span id="addColorBtn" class="btn btn-sm btn-primary mt-0 pt-0">Add Color</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div id="colorTableContainer">
                    <table id="colorTable" class="table table-sm">
                        <thead>
                            <tr>
                                <th>Color</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($productInfo)
                                @foreach ($productInfo->productColors as $productColor)
                                    @php
                                        // Fetch the color attribute value and media associated with this color
                                        $colorText = $productColor->attributeValue->value;
                                        $mediaFiles = $productColor->media;
                                        $colorId = $productColor->id;
                                    @endphp

                                    <tr id="colorRow-{{ $colorId }}">
                                        <td>{{ $colorText }}</td>
                                        <td>
                                            <input type="file" name="color_img_{{ $colorId }}[]"
                                                accept="image/*" multiple class="form-control form-control-sm">
                                        </td>
                                        <td>
                                            <span class="delete-icon">
                                                <i class="mdi mdi-trash-can font-size-16"
                                                    onclick="removeColor('{{ $colorId }}')"></i>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Size Selection and Table -->
            <div class="col-md-12 mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <div class="parent">
                            @php
                                // Collect all selected size IDs
                                $selectedSizeIds = $productInfo->productVariations
                                    ->flatMap(function ($variation) {
                                        return $variation->productVariationAttributes->pluck('attribute_value_id');
                                    })
                                    ->unique()
                                    ->toArray();
                            @endphp
                            <select id="sizeSelect" class="form-select form-select-sm" multiple style="width: 100%;">
                                @foreach ($sizes as $size)
                                    @php
                                        // Check if the current size ID is in the list of selected size IDs
                                        $isSelected = in_array($size->id, $selectedSizeIds);
                                    @endphp
                                    <option value="{{ $size->id }}" {{ $isSelected ? 'selected' : '' }}>
                                        {{ $size->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <span id="addSizeBtn" class="btn btn-sm btn-primary pt-0 mt-0">Apply</span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div id="sizeTableContainer" class="mt-4">
                    <table id="sizeTable" class="table table-sm">
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
                            @php
                                // Group variations by the color attribute specifically
                                $variationsGroupedByColor = $productInfo->productVariations->groupBy(function (
                                    $variation,
                                ) {
                                    // Find the color attribute for each variation
                                    $colorAttribute = $variation->productVariationAttributes->first(function ($attr) {
                                        return $attr->attributeValue->attribute->name === 'Color';
                                    });

                                    // Return the color attribute value ID for grouping
                                    return $colorAttribute ? $colorAttribute->attributeValue->id : null;
                                });
                            @endphp

                            @foreach ($variationsGroupedByColor as $colorId => $variations)
                                @foreach ($variations as $variation)
                                    @php
                                        // Get the color and size attributes for the current variation
                                        $colorAttribute = $variation->productVariationAttributes->first(function (
                                            $attr,
                                        ) {
                                            return $attr->attributeValue->attribute->name === 'Color';
                                        });

                                        $sizeAttribute = $variation->productVariationAttributes->first(function (
                                            $attr,
                                        ) {
                                            return $attr->attributeValue->attribute->name === 'Size';
                                        });

                                        // Extract necessary values
                                        $colorText = $colorAttribute ? $colorAttribute->attributeValue->value : 'N/A';
                                        $sizeText = $sizeAttribute ? $sizeAttribute->attributeValue->value : 'N/A';
                                        $sizeId = $sizeAttribute ? $sizeAttribute->attributeValue->id : null;
                                    @endphp

                                    <tr id="{{ $colorId }}-{{ $sizeId }}">
                                        @if ($loop->first)
                                            <!-- Display the color name once per group -->
                                            <td rowspan="{{ $variations->count() }}" class="color-cell">
                                                {{ $colorText }}</td>
                                        @endif
                                        <td>{{ $sizeText }}</td>
                                        <td>
                                            <input type="number" name="price_{{ $colorId }}_{{ $sizeId }}"
                                                placeholder="Price" class="form-control form-control-sm"
                                                value="{{ $variation->price }}" required>
                                        </td>
                                        <td>
                                            <input type="text" name="sku_{{ $colorId }}_{{ $sizeId }}"
                                                placeholder="Seller SKU" class="form-control form-control-sm"
                                                value="{{ $variation->sku }}" required>
                                        </td>
                                        <td>
                                            <input type="number" name="stock_{{ $colorId }}_{{ $sizeId }}"
                                                placeholder="Stock" class="form-control form-control-sm"
                                                value="{{ $variation->stock }}" required>
                                        </td>
                                        <td>
                                            <span class="delete-icon"
                                                onclick="removeSize('{{ $colorId }}', '{{ $sizeId }}')">
                                                <i class="mdi mdi-trash-can d-block font-size-16"></i>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>

            <div class="col-md-12 mt-3 text-right">
                <button type="submit" class="prev-btn btn-warning float-left">Previous</button>
                <button type="submit" class="next-btn  btn-success float-right">Next</button>
            </div>
            <!-- End -->
        </div>
    </form>
</div>
