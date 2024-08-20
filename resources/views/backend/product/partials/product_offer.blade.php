<div class="tab-pane add_product_offer" id="offer" role="tabpanel">
    <form method="post" id="add_product_detail_info">
        @csrf
        <div class="row">
            <input type="hidden" name="product_offer_id" id="product_offer_id"
                @if($productInfo) value="{{$productInfo->id}}" @else value="-1" @endif />
            <!-- Start -->
            <div class="col-md-10">
                <!-- Start Content -->
                <div class="row">
                   <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Seller SKU</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input name="seller_sku" id="seller_sku" @if($productInfo)
                            value="{{$productInfo->seller_sku}}" @endif class="form-control"
                            placeholder="Enter Seller SKU" required />
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Quantity</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-4 mt-md-3">
                        <input name="stock_qty" id="stock_qty" @if($productInfo)
                            value="{{$productInfo->stock_qty}}" @endif
                            class="form-control" placeholder="Opening Qty" name=""
                            id="" required/>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
            <select name="quantity_unit" id="quantity_unit"
                class="form-select" required>
                <option value="">Select Option</option>
                <option @if($productInfo && $productInfo->quantity_unit=='pcs') selected @endif value="pcs">PCS</option>
                <option @if($productInfo && $productInfo->quantity_unit=='kg') selected @endif value="kg">Kg</option>
                <option @if($productInfo && $productInfo->quantity_unit=='gram') selected @endif value="gram">Gram</option>
            </select>
        </div>
        <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Regular Price</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="your_price">{{$currency? $currency->icon : ''}}</span>
                            </div>
                            <input type="text" name="your_price" id="your_price"
                                @if($productInfo) value="{{$productInfo->your_price}}"
                                @endif class="form-control" placeholder="Ex: 50.00"
                                aria-describedby="your_price" required>
                        </div>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Offer Price</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{$currency? $currency->icon : ''}}</span>
                            </div>
                            <input type="text" name="sale_price" id="sale_price"
                                @if($productInfo) value="{{$productInfo->sale_price}}"
                                @endif class="form-control" placeholder="Ex: 50.00"
                                aria-describedby="sale_price">
                        </div>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Offer Start Date</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="sale_start_date1"><i
                                        class="fa fa-calendar"
                                        aria-hidden="true"></i></span>
                            </div>
                            <input type="date" name="sale_start_date" id="sale_start_date"
                                @if($productInfo) value="{{$productInfo->sale_start_date}}"
                                @endif class="form-control"
                                aria-describedby="sale_start_date1">
                        </div>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Offer End Date</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="sale_end_date1"><i
                                        class="fa fa-calendar"
                                        aria-hidden="true"></i></span>
                            </div>
                            <input type="date" name="sale_end_date" id="sale_end_date"
                                @if($productInfo) value="{{$productInfo->sale_end_date}}"
                                @endif class="form-control"
                                aria-describedby="sale_end_date1">
                        </div>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Retail Price (Inclusive VAT)</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"
                                    id="retail_price_inclusive_vat">{{$currency? $currency->icon : ''}}</span>
                            </div>
                            <input type="text" name="retail_price" id="retail_price"
                                @if($productInfo) value="{{$productInfo->retail_price}}"
                                @endif class="form-control" placeholder="Ex: 50.00"
                                aria-label="Username"
                                aria-describedby="retail_price_inclusive_vat">
                        </div>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Max Order Qty</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input name="max_order_qty" id="max_order_qty" @if($productInfo)
                            value="{{$productInfo->max_order_qty}}" @endif
                            class="form-control" placeholder="Enter Max Order Qty" name=""
                            id="" />
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Product Tax Code</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input name="tax_code" id="tax_code" @if($productInfo &&
                            $productInfo->ProductDetail) value="{{$productInfo->tax_code}}"
                        @endif class="form-control" placeholder="Enter Product Tax Code" />
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Handling Time</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input class="form-control" placeholder="Enter Handling Time"
                            name="" id="" />
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Offering Can Be Gift Messaged</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <select name="offering_gift_message" id="offering_gift_message"
                            class="form-select">
                            <option value="">Select Option</option>
                            <option @if($productInfo && $productInfo->
                                offering_gift_message==1) selected @endif value="1">Yes
                            </option>
                            <option @if($productInfo && $productInfo->
                                offering_gift_message==0) selected @endif value="0">No
                            </option>
                        </select>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Is
                            Gift Wrap Available?</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <select name="gift_wrap_available" id="gift_wrap_available"
                            class="form-select">
                            <option value="">Select Option</option>
                            <option @if($productInfo && $productInfo->
                                gift_wrap_available==1) selected @endif value="1">Yes
                            </option>
                            <option @if($productInfo && $productInfo->
                                gift_wrap_available==0) selected @endif value="0">No
                            </option>
                        </select>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Start Selling Date</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="start_selling_date1"><i
                                        class="fa fa-calendar"
                                        aria-hidden="true"></i></span>
                            </div>
                            <input type="date" name="start_selling_date"
                                id="start_selling_date" @if($productInfo)
                                value="{{$productInfo->start_selling_date}}" @endif
                                class="form-control" aria-describedby="start_selling_date1" required>
                        </div>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Restock Date</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="restock_date1"><i
                                        class="fa fa-calendar"
                                        aria-hidden="true"></i></span>
                            </div>
                            <input type="date" name="restock_date" id="restock_date"
                                @if($productInfo && $productInfo->ProductDetail)
                            value="{{$productInfo->restock_date}}" @endif
                            class="form-control" aria-describedby="restock_date1">
                        </div>
                    </div>
                    <!-- End -->

                </div>
                <!-- End Content -->
            </div>
            <div class="col-md-2"></div>
            <!-- End -->
            <div class="col-md-12 mt-3 text-right">
                <button type="submit" class="prev-btn btn-warning float-left">Previous</button>
                <button type="submit" class="next-btn  btn-success float-right">Next</button>
            </div>
            <!-- End -->
        </div>
    </form>
</div>
