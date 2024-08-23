<div class="tab-pane add_variant" id="variations" role="tabpanel">
    {{-- <form method="post" id="add_variation">
        @csrf --}}
    <div class="row">
        <div class="col-md-12">
            <form method="POST" id="add_product_variation">
                @csrf
                <div id="variations-container">
                    <input type="hidden" name="product_variant_info_id" id="product_variant_info_id"
            @if ($productInfo) value="{{ $productInfo->id }}" @else value="-1" @endif />
                    @if (isset($productInfo->productVariations) && $productInfo->productVariations && count($productInfo->productVariations) > 0)
                        @foreach ($productInfo->productVariations as $variationKey => $variation)
                            <div class="variation-form">
                                <div class="price-stock-container">
                                    <div class="row">
                                        <div class="form-group mb-0 col-md-6">
                                            <label for="price_{{ $variationKey }}">Price</label>
                                            <input type="number" name="variations[{{ $variationKey }}][price]"
                                                id="price_{{ $variationKey }}" value="{{ $variation->price }}"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    @foreach ($variation->groupedAttributeValues as $groupNumber => $attributeValues)
                                        <div class="row attribute-set">
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
                                                    <select
                                                        name="variations[{{ $variationKey }}][attribute_values][{{ $groupNumber }}][]"
                                                        id="attribute_{{ $attribute->id }}_{{ $variationKey }}_{{ $groupNumber }}"
                                                        class="form-control form-control-sm">
                                                        <option value="">--{{ $attribute->name }}--</option>
                                                        @foreach ($attribute->values as $value)
                                                            <option value="{{ $value->id }}"
                                                                @if ($selectedValue && $selectedValue->attribute_value_id == $value->id) selected @endif>
                                                                {{ $value->value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endforeach

                                            <div class="form-group mb-0 col-md-1">
                                                <input type="number" name="variations[{{ $variationKey }}][attribute_values][{{ $groupNumber }}][stock]"
                                                    id="stock_{{ $variationKey }}" value="{{ $attributeValues->first()->stock }}"
                                                    class="form-control form-control-sm" placeholder="Stock Quantity" required>
                                            </div>

                                            <div class="form-group mb-0 col-md-1">
                                                <input type="text" name="variations[{{ $variationKey }}][attribute_values][{{ $groupNumber }}][sku]"
                                                    id="sku_{{ $variationKey }}" value="{{ $attributeValues->first()->sku }}"
                                                    class="form-control form-control-sm" placeholder="SKU" required>
                                            </div>

                                            <div class="form-group mb-0 col-md-1">
                                                <div class="custom-control custom-switch custom-switch-md mb-3" dir="ltr">
                                                    <input type="checkbox" name="variations[{{ $variationKey }}][attribute_values][{{ $groupNumber }}][status]" class="custom-control-input" id="status_{{ $variationKey }}" @if($attributeValues->first()->status == 1) checked @endif>
                                                    <label class="custom-control-label" for="status_{{ $variationKey }}"></label>
                                                </div>
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
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="price_0_0">Price</label>
                                        <input type="number" name="variations[0][price]" id="price_0_0"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="row attribute-set">
                                    @foreach ($attributes as $attribute)
                                        <div class="form-group col-md-3">
                                            <select name="variations[0][attribute_values][0_0][]"
                                                id="attribute_{{ $attribute->id }}_0_0" class="form-control form-control-sm">
                                                <option value="">--{{ $attribute->name }}--</option>
                                                @foreach ($attribute->values as $value)
                                                    <option value="{{ $value->id }}">{{ $value->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endforeach
                                    <div class="form-group col-md-1">
                                        <input type="number" name="variations[0][attribute_values][0_0][stock]" id="stock_0_0"
                                            class="form-control form-control-sm" placeholder="Stock Quantity" required>
                                    </div>

                                    <div class="form-group mb-0 col-md-1">
                                        <input type="text" name="variations[0][attribute_values][0_0][sku]"
                                            id="sku_0_0"
                                            class="form-control form-control-sm" placeholder="SKU" required>
                                    </div>

                                    <div class="form-group mb-0 col-md-1">
                                        <div class="custom-control custom-switch custom-switch-md mb-3" dir="ltr">
                                            <input type="checkbox" name="variations[0][attribute_values][0_0][status]" class="custom-control-input" id="status_0_0">
                                            <label class="custom-control-label" for="status_0_0"></label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-secondary add-multiple-variation">Add</button>
                        </div>
                    @endif
                </div>
                <button type="button" class="btn btn-secondary btn-sm" id="add-variation">Add Another Variation</button>
                <div class="col-md-12 mt-3 text-right">
                    <button type="submit" class="prev-btn btn-warning float-left">Previous</button>
                    <button type="submit" class="next-btn  btn-success float-right">Next</button>
                </div>
                <!-- End -->
            </form>
        </div>
    </div>
    {{-- </form> --}}
</div>
