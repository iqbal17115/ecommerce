<div class="tab-pane add_more_details" id="more_details" role="tabpanel">
    <form method="post" id="add_product_more_detail">
        @csrf
        <div class="row">
            <input type="hidden" name="product_more_detail_id" id="product_more_detail_id"
                @if($productInfo) value="{{$productInfo->id}}" @else value="-1" @endif />
            <!-- Start -->
            <div class="col-md-10">
                <!-- Start Content -->
                <div class="row">
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Closure Type</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="closure_type" id="closure_type"
                            @if($productInfo && $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->closure_type}}" @endif
                        class="form-control m-input" placeholder="zipper">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Manufacturer</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="manufacturer" id="manufacturer"
                            @if($productInfo && $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->manufacturer}}" @endif
                        class="form-control m-input" placeholder="Philips">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Manufacturer Part Number</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="manufacturer_part_number"
                            id="manufacturer_part_number" @if($productInfo &&
                            $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->manufacturer_part_number}}"
                        @endif class="form-control m-input" placeholder="SB-122">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Number of Items</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="number_of_item" id="number_of_item"
                            @if($productInfo && $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->number_of_item}}" @endif
                        class="form-control m-input" placeholder="1">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Release Date</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="release_date"><i
                                        class="fa fa-calendar"
                                        aria-hidden="true"></i></span>
                            </div>
                            <input type="date" name="release_date" id="release_date"
                                @if($productInfo && $productInfo->ProductMoreDetail)
                            value="{{$productInfo->ProductMoreDetail->release_date}}" @endif
                            class="form-control" aria-describedby="release_date">
                        </div>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Fabric Type</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="fabric_type" id="fabric_type"
                            @if($productInfo && $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->fabric_type}}" @endif
                        class="form-control m-input" placeholder="cotton, plastic">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Item Dimensions</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <div class="row">
                            <div class="col-md-12" style="text-align: left;">
                                <label class="col-form-label"
                                    style="font-size: 14px;">Length</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="item_length" id="item_length"
                                    @if($productInfo && $productInfo->ProductMoreDetail)
                                value="{{$productInfo->ProductMoreDetail->item_length}}"
                                @endif class="form-control m-input" placeholder="10.33,
                                5.50, 15000.0">
                            </div>
                            <div class="col-md-6">
                                <select name="item_length_unit" id="item_length_unit"
                                    class="form-select">
                                    <option value="">Select Option</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="dm")
                                        selected @endif value="dm">Decimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="mm")
                                        selected @endif value="mm">Milimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="cm")
                                        selected @endif value="cm">Centimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="m")
                                        selected @endif value="m">Meter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="Å")
                                        selected @endif value="Å">Angstrom</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="mil")
                                        selected @endif value="mil">Mil</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="yd")
                                        selected @endif value="yd">Yards</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="pm")
                                        selected @endif value="pm">Picometer</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="mi")
                                        selected @endif value="mi">Mile</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="in")
                                        selected @endif value="in">Inch</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="ft")
                                        selected @endif value="ft">Feet</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="hin")
                                        selected @endif value="hin">Hundredths Inch</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="nm")
                                        selected @endif value="nm">Nanometer</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="ft")
                                        selected @endif value="ft">Feet</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="μm")
                                        selected @endif value="μm">Micrometre</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_length_unit=="km")
                                        selected @endif value="km">Kilometers</option>
                                </select>
                            </div>
                            <div class="col-md-12" style="text-align: left;">
                                <label class="col-form-label"
                                    style="font-size: 14px;">Width</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="item_width" id="item_width"
                                    @if($productInfo && $productInfo->ProductMoreDetail)
                                value="{{$productInfo->ProductMoreDetail->item_width}}"
                                @endif class="form-control m-input" placeholder="10.33,
                                5.50, 15000.0">
                            </div>
                            <div class="col-md-6">
                                <select name="item_width_unit" id="item_width_unit"
                                    class="form-select">
                                    <option value="">Select Option</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="dm")
                                        selected @endif value="dm">Decimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="mm")
                                        selected @endif value="mm">Milimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="cm")
                                        selected @endif value="cm">Centimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="m")
                                        selected @endif value="m">Meter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="Å")
                                        selected @endif value="Å">Angstrom</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="mil")
                                        selected @endif value="mil">Mil</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="yd")
                                        selected @endif value="yd">Yards</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="pm")
                                        selected @endif value="pm">Picometer</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="mi")
                                        selected @endif value="mi">Mile</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="in")
                                        selected @endif value="in">Inch</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="ft")
                                        selected @endif value="ft">Feet</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="hin")
                                        selected @endif value="hin">Hundredths Inch</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="nm")
                                        selected @endif value="nm">Nanometer</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="ft")
                                        selected @endif value="ft">Feet</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="μm")
                                        selected @endif value="μm">Micrometre</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_width_unit=="km")
                                        selected @endif value="km">Kilometers</option>
                                </select>
                            </div>
                            <div class="col-md-12" style="text-align: left;">
                                <label class="col-form-label"
                                    style="font-size: 14px;">Height</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="item_height" id="item_height"
                                    @if($productInfo && $productInfo->ProductMoreDetail)
                                value="{{$productInfo->ProductMoreDetail->item_height}}"
                                @endif class="form-control m-input" placeholder="10.33,
                                5.50, 15000.0">
                            </div>
                            <div class="col-md-6">
                                <select name="item_height_unit" id="item_height_unit"
                                    class="form-select">
                                    <option value="">Select Option</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="dm")
                                        selected @endif value="dm">Decimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="mm")
                                        selected @endif value="mm">Milimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="cm")
                                        selected @endif value="cm">Centimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="m")
                                        selected @endif value="m">Meter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="Å")
                                        selected @endif value="Å">Angstrom</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="mil")
                                        selected @endif value="mil">Mil</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="yd")
                                        selected @endif value="yd">Yards</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="pm")
                                        selected @endif value="pm">Picometer</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="mi")
                                        selected @endif value="mi">Mile</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="in")
                                        selected @endif value="in">Inch</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="ft")
                                        selected @endif value="ft">Feet</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="hin")
                                        selected @endif value="hin">Hundredths Inch</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="nm")
                                        selected @endif value="nm">Nanometer</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="ft")
                                        selected @endif value="ft">Feet</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="μm")
                                        selected @endif value="μm">Micrometre</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->item_height_unit=="km")
                                        selected @endif value="km">Kilometers</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- End -->

                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Package Dimensions</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <div class="row">
                            <div class="col-md-12" style="text-align: left;">
                                <label class="col-form-label"
                                    style="font-size: 14px;">Package
                                    Height</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="package_height" id="package_height"
                                    @if($productInfo && $productInfo->ProductMoreDetail)
                                value="{{$productInfo->ProductMoreDetail->package_height}}"
                                @endif class="form-control m-input" placeholder="3.45">
                            </div>
                            <div class="col-md-6">
                                <select name="package_height_unit" id="package_height_unit"
                                    class="form-select">
                                    <option value="">Select Option</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="dm")
                                        selected @endif value="dm">Decimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="mm")
                                        selected @endif value="mm">Milimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="cm")
                                        selected @endif value="cm">Centimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="m")
                                        selected @endif value="m">Meter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="Å")
                                        selected @endif value="Å">Angstrom</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="mil")
                                        selected @endif value="mil">Mil</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="yd")
                                        selected @endif value="yd">Yards</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="pm")
                                        selected @endif value="pm">Picometer</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="mi")
                                        selected @endif value="mi">Mile</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="in")
                                        selected @endif value="in">Inch</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="ft")
                                        selected @endif value="ft">Feet</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="hin")
                                        selected @endif value="hin">Hundredths Inch</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="nm")
                                        selected @endif value="nm">Nanometer</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="ft")
                                        selected @endif value="ft">Feet</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="μm")
                                        selected @endif value="μm">Micrometre</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_height_unit=="km")
                                        selected @endif value="km">Kilometers</option>
                                </select>
                            </div>
                            <div class="col-md-12" style="text-align: left;">
                                <label class="col-form-label"
                                    style="font-size: 14px;">Package
                                    Length</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="package_length" id="package_length"
                                    @if($productInfo && $productInfo->ProductMoreDetail)
                                value="{{$productInfo->ProductMoreDetail->package_length}}"
                                @endif class="form-control m-input" placeholder="400, 2, 3,
                                3.54">
                            </div>
                            <div class="col-md-6">
                                <select name="package_length_unit" id="package_length_unit"
                                    class="form-select">
                                    <option value="">Select Option</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="dm")
                                        selected @endif value="dm">Decimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="mm")
                                        selected @endif value="mm">Milimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="cm")
                                        selected @endif value="cm">Centimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="m")
                                        selected @endif value="m">Meter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="Å")
                                        selected @endif value="Å">Angstrom</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="mil")
                                        selected @endif value="mil">Mil</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="yd")
                                        selected @endif value="yd">Yards</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="pm")
                                        selected @endif value="pm">Picometer</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="mi")
                                        selected @endif value="mi">Mile</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="in")
                                        selected @endif value="in">Inch</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="ft")
                                        selected @endif value="ft">Feet</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="hin")
                                        selected @endif value="hin">Hundredths Inch</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="nm")
                                        selected @endif value="nm">Nanometer</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="ft")
                                        selected @endif value="ft">Feet</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="μm")
                                        selected @endif value="μm">Micrometre</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_length_unit=="km")
                                        selected @endif value="km">Kilometers</option>
                                </select>
                            </div>
                            <div class="col-md-12" style="text-align: left;">
                                <label class="col-form-label"
                                    style="font-size: 14px;">Package
                                    Width</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="package_width" id="package_width"
                                    @if($productInfo && $productInfo->ProductMoreDetail)
                                value="{{$productInfo->ProductMoreDetail->package_width}}"
                                @endif class="form-control m-input" placeholder="400, 2, 3,
                                3.54">
                            </div>
                            <div class="col-md-6">
                                <select name="package_width_unit" id="package_width_unit"
                                    class="form-select">
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="dm")
                                        selected @endif value="dm">Decimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="mm")
                                        selected @endif value="mm">Milimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="cm")
                                        selected @endif value="cm">Centimeter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="m")
                                        selected @endif value="m">Meter</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="Å")
                                        selected @endif value="Å">Angstrom</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="mil")
                                        selected @endif value="mil">Mil</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="yd")
                                        selected @endif value="yd">Yards</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="pm")
                                        selected @endif value="pm">Picometer</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="mi")
                                        selected @endif value="mi">Mile</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="in")
                                        selected @endif value="in">Inch</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="ft")
                                        selected @endif value="ft">Feet</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="hin")
                                        selected @endif value="hin">Hundredths Inch</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="nm")
                                        selected @endif value="nm">Nanometer</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="ft")
                                        selected @endif value="ft">Feet</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="μm")
                                        selected @endif value="μm">Micrometre</option>
                                    <option @if($productInfo && $productInfo->
                                        ProductMoreDetail &&
                                        $productInfo->ProductMoreDetail->package_width_unit=="km")
                                        selected @endif value="km">Kilometers</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Package Weight</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-4 mt-md-3">
                        <input name="package_weight" id="package_weight" @if($productInfo &&
                            $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->package_weight}}" @endif
                        class="form-control" placeholder="45" />
                    </div>
                    <div class="col-md-4 mt-md-3">
                        <select name="package_weight_unit" id="package_weight_unit"
                            class="form-select">
                            <option value="">Select Option</option>
                            <option @if($productInfo && $productInfo->ProductMoreDetail &&
                                $productInfo->ProductMoreDetail->package_weight_unit=="lb")
                                selected @endif value="lb">Pound</option>
                            <option @if($productInfo && $productInfo->ProductMoreDetail &&
                                $productInfo->ProductMoreDetail->package_weight_unit=="kg")
                                selected @endif value="kg">Kilogram</option>
                            <option @if($productInfo && $productInfo->ProductMoreDetail &&
                                $productInfo->ProductMoreDetail->package_weight_unit=="gm")
                                selected @endif value="gm">Gram</option>
                            <option @if($productInfo && $productInfo->ProductMoreDetail &&
                                $productInfo->ProductMoreDetail->package_weight_unit=="hlb")
                                selected @endif value="hlb">Hundredths Pounds</option>
                            <option @if($productInfo && $productInfo->ProductMoreDetail &&
                                $productInfo->ProductMoreDetail->package_weight_unit=="mg")
                                selected @endif value="mg">Milligram</option>
                            <option @if($productInfo && $productInfo->ProductMoreDetail &&
                                $productInfo->ProductMoreDetail->package_weight_unit=="tn")
                                selected @endif value="tn">Ton</option>
                            <option @if($productInfo && $productInfo->ProductMoreDetail &&
                                $productInfo->ProductMoreDetail->package_weight_unit=="oz")
                                selected @endif value="oz">Ounce</option>
                        </select>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">League Name</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="league_name" id="league_name"
                            @if($productInfo && $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->league_name}}" @endif
                        class="form-control m-input" placeholder="MLB">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Warranty</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <input name="warranty"
                                id="warranty" @if($productInfo &&
                                $productInfo->ProductMoreDetail)
                            value="{{$productInfo->ProductMoreDetail->warranty}}"
                            @endif class="form-control" placeholder="1, 2, 3, 4, 5" />
                        </div>
                        <div class="col-md-6">
                            <select name="warranty_unit"
                                id="warranty_unit"
                                class="form-select">
                                <option value="">Select Option</option>
                                <option @if($productInfo && $productInfo->ProductMoreDetail
                                    &&
                                    $productInfo->ProductMoreDetail->warranty_unit=='day') selected @endif value="day">Day</option>
                                <option @if($productInfo && $productInfo->ProductMoreDetail
                                    &&
                                    $productInfo->ProductMoreDetail->warranty_unit=='month')
                                    selected @endif value="month">Month</option>
                                <option @if($productInfo && $productInfo->ProductMoreDetail
                                    &&
                                    $productInfo->ProductMoreDetail->warranty_unit=='year') selected @endif value="year">Year</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Warranty Description</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <textarea class="form-control" name="warranty_description"
                            id="warranty_description" @if($productInfo &&
                            $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->warranty_description}}" @endif placeholder="Manufacturer warranty for 90 days from date of purchase"></textarea>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Target Gender</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <select name="target_gender" id="target_gender" class="form-select">
                            <option value="">Select Option</option>
                            <option @if($productInfo && $productInfo->ProductDetail &&
                                $productInfo->ProductDetail->target_gender=="Male") selected
                                @endif value="Male">Male</option>
                            <option @if($productInfo && $productInfo->ProductDetail &&
                                $productInfo->ProductDetail->target_gender=="Female")
                                selected @endif value="Female">Female</option>
                            <option @if($productInfo && $productInfo->ProductDetail &&
                                $productInfo->ProductDetail->target_gender=="Unisex")
                                selected @endif value="Unisex">Unisex</option>
                        </select>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Team Name</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="team_name" id="team_name" @if($productInfo
                            && $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->team_name}}" @endif
                        class="form-control m-input" placeholder="Arsenal">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Age Range Description</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="age_range_description"
                            id="age_range_description" @if($productInfo &&
                            $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->age_range_description}}"
                        @endif class="form-control m-input" placeholder="3 months">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Lining Description</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="lining_description" id="lining_description"
                            @if($productInfo && $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->lining_description}}"
                        @endif class="form-control m-input" placeholder="with warm lining">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Strap Type</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="strap_type" id="strap_type"
                            @if($productInfo && $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->strap_type}}" @endif
                        class="form-control m-input" placeholder="ankle-wrap">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Handle Type</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="handle_type" id="handle_type"
                            @if($productInfo && $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->handle_type}}" @endif
                        class="form-control m-input" placeholder="">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Number Of Compartments</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="number_of_compartment"
                            id="number_of_compartment" @if($productInfo &&
                            $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->number_of_compartment}}"
                        @endif class="form-control m-input" placeholder="">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Number Of Wheels</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="number_of_wheel" id="number_of_wheel"
                            @if($productInfo && $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->number_of_wheel}}" @endif
                        class="form-control m-input" placeholder="4">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Pocket Description</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="pocket_description" id="pocket_description"
                            @if($productInfo && $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->pocket_description}}"
                        @endif class="form-control m-input" placeholder="">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Sheel Type</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="sheel_type" id="sheel_type"
                            @if($productInfo && $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->sheel_type}}" @endif
                        class="form-control m-input" placeholder="">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Wheel Type</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input type="text" name="wheel_type" id="wheel_type"
                            @if($productInfo && $productInfo->ProductMoreDetail)
                        value="{{$productInfo->ProductMoreDetail->wheel_type}}" @endif
                        class="form-control m-input" placeholder="">
                    </div>
                    <!-- End -->
                    <div class="col-md-12 mt-md-3">
                        <button class="float-right btn btn-success btn-sm ml-2">Save and
                            finish</button>
                        <button class="float-right btn btn-warning btn-sm">Save as
                            draft</button>
                    </div>
                    <!-- End -->
                </div>
                <!-- End Content -->
            </div>
            <div class="col-md-2"></div>
            <!-- End -->
        </div>
    </form>
    @if($productInfo)
    <!-- variantByCategory -->
    <input type="hidden" name="category" id="get_category_id"
        value="{{$productInfo->category_id}}">
    <input type="hidden" name="variation" id="variation"
        value="{{$productInfo->variation}}">
    @foreach($productInfo->ProductImage as $product_info_image)
    <input type="text" name="product_info_image[]"
        id="product_info_image_{{$product_info_image->serial}}"
        value="{{$product_info_image->image}}">
    @endforeach
    <script>
    $(document).ready(function() {

        var variation = $("#variation").val();
        var get_category_id = $("#get_category_id").val();
        var imageUrl0 = 'storage/product_photo/' + $("#product_info_image_0").val();
        var imageUrl1 = 'storage/product_photo/' + $("#product_info_image_1").val();
        var imageUrl2 = 'storage/product_photo/' + $("#product_info_image_2").val();
        var imageUrl3 = 'storage/product_photo/' + $("#product_info_image_3").val();
        var imageUrl4 = 'storage/product_photo/' + $("#product_info_image_4").val();
        var imageUrl5 = 'storage/product_photo/' + $("#product_info_image_5").val();

        $(".drop-zone_0").css("background-image", "url(" + imageUrl0 + ")");
        $(".drop-zone_1").css("background-image", "url(" + imageUrl1 + ")");
        $(".drop-zone_2").css("background-image", "url(" + imageUrl2 + ")");
        $(".drop-zone_3").css("background-image", "url(" + imageUrl3 + ")");
        $(".drop-zone_4").css("background-image", "url(" + imageUrl4 + ")");
        $(".drop-zone_5").css("background-image", "url(" + imageUrl5 + ")");
        updateVariantByCategory(get_category_id);
        updateVariationType(variation);
    });
    </script>
    @endif
</div>
