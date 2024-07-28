<div class="tab-pane add_variant" id="variations" role="tabpanel">
    {{-- <form method="post" id="add_variation">
        @csrf --}}
    <div class="row">
        <input type="hidden" name="product_variant_info_id" id="product_variant_info_id"
            @if ($productInfo) value="{{ $productInfo->id }}" @else value="-1" @endif />
        <div class="col-md-12">
            <form method="POST" id="add_product_variation">
                @csrf
                <div id="variations-container">
                    @if ($productInfo->productVariations && count($productInfo->productVariations) > 0)
                        @foreach ($productInfo->productVariations as $variationKey => $variation)
                            <div class="variation-form">
                                <div class="price-stock-container">
                                    <div class="row attribute-set">
                                        <div class="form-group mb-0 col-md-6">
                                            <label for="price_{{ $variationKey }}">Price</label>
                                            <input type="number" name="variations[{{ $variationKey }}][price]"
                                                id="price_{{ $variationKey }}" value="{{ $variation->price }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    @foreach ($variation->groupedAttributeValues as $groupNumber => $attributeValues)
                                        <div class="row">
                                            @foreach ($attributes as $attribute)
                                                @php
                                                    // Find the selected value for the current attribute
                                                    $selectedValue = $attributeValues->firstWhere(
                                                        'attributeValue.attribute_id',
                                                        $attribute->id,
                                                    );
                                                @endphp
                                                <div class="form-group mb-0 col-md-3">
                                                    <input type="hidden" name="groups[{{ $groupNumber }}][]" value="{{ $groupNumber }}">
                                                    <label
                                                        for="attribute_{{ $attribute->id }}_{{ $variationKey }}_{{ $groupNumber }}">{{ $attribute->name }}</label>
                                                    <select
                                                        name="variations[{{ $variationKey }}][attribute_values][{{ $groupNumber }}][]"
                                                        id="attribute_{{ $attribute->id }}_{{ $variationKey }}_{{ $groupNumber }}"
                                                        class="form-control" required>
                                                        <option value="">-- Select --</option>
                                                        @foreach ($attribute->values as $value)
                                                            <option value="{{ $value->id }}"
                                                                @if ($selectedValue && $selectedValue->attribute_value_id == $value->id) selected @endif>
                                                                {{ $value->value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endforeach

                                            <div class="form-group mb-0 col-md-3">
                                                <label for="stock_{{ $variationKey }}">Stock Quantity</label>
                                                <input type="number" name="variations[{{ $variationKey }}][stock]"
                                                    id="stock_{{ $variationKey }}" value="{{ $variation->stock }}"
                                                    class="form-control" required>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-secondary add-multiple-variation btn-sm">Add</button>
                            </div>
                        @endforeach
                    @else
                        <div class="variation-form">
                            <div class="price-stock-container">
                                <div class="row attribute-set">
                                    <div class="form-group col-md-6">
                                        <label for="price_0_0">Price</label>
                                        <input type="number" name="variations[0][price]" id="price_0_0"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="stock_0_0">Stock Quantity</label>
                                        <input type="number" name="variations[0][stock]" id="stock_0_0"
                                            class="form-control" required>
                                    </div>
                                    @foreach ($attributes as $attribute)
                                        <div class="form-group col-md-3">
                                            <label
                                                for="attribute_{{ $attribute->id }}_0_0">{{ $attribute->name }}</label>
                                            <select name="variations[0][attribute_values][0_0][]"
                                                id="attribute_{{ $attribute->id }}_0_0" class="form-control" required>
                                                <option value="">-- Select --</option>
                                                @foreach ($attribute->values as $value)
                                                    <option value="{{ $value->id }}">{{ $value->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary add-multiple-variation">Add Another
                                Price/Stock</button>
                        </div>
                    @endif
                </div>
                <button type="button" class="btn btn-secondary btn-sm" id="add-variation">Add Another Variation</button>
                <div class="col-md-12 mt-md-3">
                    <button type="submit" class="float-right btn btn-success btn-sm ml-2">Save and finish</button>
                    <button type="button" class="float-right btn btn-warning btn-sm">Save as draft</button>
                </div>
            </form>
        </div>
    </div>
    {{-- </form> --}}
</div>
