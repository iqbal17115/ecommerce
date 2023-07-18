<div class="tab-pane add_keywords" id="keywords" role="tabpanel">
    <div class="row">
        <!-- Start -->
        <div class="col-md-10">
            <!-- Start Content -->
            <form method="post" id="add_product_keyword">
                @csrf
                <div class="row">
                    <input type="hidden" name="product_keyword_id" id="product_keyword_id"
                        @if($productInfo) value="{{$productInfo->id}}" @else value="-1"
                        @endif />
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Key Product Features</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    @if($productInfo && count($productInfo->ProductKeyword) > 0)
                    <div class="col-md-8 mt-md-3">
                        @foreach($productInfo->ProductKeyword as $ProductKeyword)

                        <div id="row">
                            <div class="input-group m-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-danger" id="DeleteRow"
                                        type="button">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                                <input type="text" name="keyword[]" id="keyword"
                                    value="{{$ProductKeyword->keyword}}"
                                    class="form-control m-input">
                            </div>
                        </div>
                        @endforeach

                        <div id="newinput"></div>
                        <button id="rowAdder" type="button" class="btn btn-dark">
                            <i class="fas fa-plus-square"></i> ADD
                        </button>
                    </div>
                    <!-- End -->
                    @else
                    <div class="col-md-8 mt-md-3">
                        <div id="row">
                            <div class="input-group m-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-danger" id="DeleteRow"
                                        type="button">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                                <input type="text" name="keyword[]" id="keyword"
                                    class="form-control m-input">
                            </div>
                        </div>

                        <div id="newinput"></div>
                        <button id="rowAdder" type="button" class="btn btn-dark">
                            <i class="fas fa-plus-square"></i> ADD
                        </button>
                    </div>
                    <!-- End -->
                    @endif
                    <div class="col-md-12 mt-md-3">
                        <button class="float-right btn btn-success btn-sm ml-2">Save and
                            finish</button>
                        <button class="float-right btn btn-warning btn-sm">Save as
                            draft</button>
                    </div>
                    <!-- End -->
                </div>
            </form>
            <!-- End Content -->
        </div>
        <div class="col-md-2"></div>
        <!-- End -->
    </div>
</div>
