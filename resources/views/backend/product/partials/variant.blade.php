<div class="tab-pane add_variant" id="variations" role="tabpanel">
    <form method="post" id="add_variant_variant">
        @csrf
        <div class="row">
            <input type="hidden" value="0" name="hidden_value_1" id="hidden_value_1" />
            <input type="hidden" value="0" name="hidden_value_2" id="hidden_value_2" />
            <input type="hidden" value="0" name="hidden_value_3" id="hidden_value_3" />
            <input type="hidden" value="0" name="hidden_value_4" id="hidden_value_4" />
            <input type="hidden" value="0" name="hidden_value_5" id="hidden_value_5" />
            <input type="hidden" value="0" name="hidden_value_6" id="hidden_value_6" />
            <input type="hidden" value="0" name="hidden_value_7" id="hidden_value_7" />
            <input class="selected_variation" type="hidden" name="selected_variation[]"
                id="selected_variation[]" />
            <input type="hidden" name="product_variant_info_id" id="product_variant_info_id"
                @if($productInfo) value="{{$productInfo->id}}" @else value="-1" @endif />

            <div class="col-md-12">
                <div class="row" id="variation_type_content"></div>
            </div>

            <!-- End Content -->
            <div class="col-md-12">
                <hr class="m-0">
            </div>
            <!-- End Content -->
            <div class="col-md-12">
                <div class="row">
                    <!-- Start Size -->
                    <div class="col-md-4"></div>
                    <div class="col-md-4" id="add_size">

                    </div>
                    <div class="col-md-4" id="all_size"></div>
                    <!-- End Size -->
                    <!-- Start Color -->
                    <div class="col-md-4"></div>
                    <div class="col-md-4" id="add_color">

                    </div>
                    <div class="col-md-4" id="all_color"></div>
                    <!-- End Color -->
                    <!-- Start Color -->
                    <div class="col-md-4"></div>
                    <div class="col-md-4" id="add_package_qty">

                    </div>
                    <div class="col-md-4" id="all_package_qty"></div>
                    <!-- End Color -->
                    <!-- Start Material -->
                    <div class="col-md-4"></div>
                    <div class="col-md-4" id="add_material_type">

                    </div>
                    <div class="col-md-4" id="all_material_type"></div>
                    <!-- End Material -->
                    <!-- Start Wattage -->
                    <div class="col-md-4"></div>
                    <div class="col-md-4" id="add_wattage">

                    </div>
                    <div class="col-md-4" id="all_wattage"></div>
                    <!-- End Wattage -->
                    <!-- Start Number Of Item -->
                    <div class="col-md-4"></div>
                    <div class="col-md-4" id="add_number_of_items">

                    </div>
                    <div class="col-md-4" id="all_number_of_items"></div>
                    <!-- End Number Of Item -->
                    <!-- Start Style Name -->
                    <div class="col-md-4"></div>
                    <div class="col-md-4" id="add_style_name">

                    </div>
                    <div class="col-md-4" id="all_style_name"></div>
                    <!-- End Style Name -->
                </div>
            </div>
            <!-- End Content -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11" id="variation_content">
                        <!-- Start -->
                        <div class="col-md-12" id="variation_head" style="display: flex;">
                            <div class="text-center" style="width: 150px; font-size: 12px;"
                                id="gender_header"><span style="width: 100%;">Target
                                    Gender</span></div>
                            <div class="text-center div_size"
                                style="display: none; width: 150px; font-size: 12px;"><span
                                    style="width: 100%;">Bottom Size</span></div>
                            <div class="text-center div_size"
                                style="display: none; width: 150px; font-size: 12px;"><span
                                    style="width: 100%;">Bottom Size Map</span></div>
                            <div class="text-center div_color"
                                style="display: none; width: 150px; font-size: 12px;"><span
                                    style="width: 100%;">Color Map</span></div>
                            <div class="text-center" style="width: 150px; font-size: 12px;">
                                <span style="width: 100%;">Description</span>
                            </div>
                            <div class="text-center" style="width: 150px; font-size: 12px;">
                                <span style="width: 100%;">Seller SKU</span>
                            </div>
                            <div class="text-center" style="width: 150px; font-size: 12px;">
                                <span style="width: 100%;">Product Id</span>
                            </div>
                            <div class="text-center" style="width: 150px; font-size: 12px;">
                                <span style="width: 100%;">Type</span>
                            </div>
                            <div class="text-center" style="width: 150px; font-size: 12px;">
                                <span style="width: 100%;">Price</span>
                            </div>
                            <div class="text-center" style="width: 150px; font-size: 12px;">
                                <span style="width: 100%;">Quantity</span>
                            </div>
                            <div class="text-center" style="width: 150px; font-size: 12px;">
                                <span style="width: 100%;">Condition</span>
                            </div>
                        </div>

                        <div class="row" id="variation_row"></div>
                        <!-- End -->
                        <div class="col-md-12 mt-md-3">
                            <button class="float-right btn btn-success btn-sm ml-2">Save and
                                finish</button>
                            <button class="float-right btn btn-warning btn-sm">Save as
                                draft</button>
                        </div>
                        <!-- End -->
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
