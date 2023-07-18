<div class="tab-pane add_description" id="description" role="tabpanel">
    <form method="post" id="add_product_description_info">
        @csrf
        <div class="row">
            <input type="hidden" name="product_description_id" id="product_description_id"
                @if($productInfo) value="{{$productInfo->id}}" @else value="-1" @endif />
            <!-- Start -->
            <div class="col-md-10">
                <!-- Start Content -->
                <div class="row">
                <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Short Description</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <textarea class="form-control" name="short_deacription"
                            id="short_deacription">
                            @if($productInfo &&
                            $productInfo->ProductDetail)
                              {{$productInfo->ProductDetail->short_deacription}}
                            @endif
                        </textarea>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Long Description</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <textarea class="form-control" name="product_description"
                            id="product_description">
                            @if($productInfo && $productInfo->ProductDetail)
                               {{$productInfo->ProductDetail->description}}
                            @endif
                        </textarea>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Content</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <textarea class="form-control" name="product_content"
                            id="product_content">
                            @if($productInfo && $productInfo->ProductDetail)
                               {{$productInfo->ProductDetail->product_content}}
                            @endif
                        </textarea>
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
</div>
