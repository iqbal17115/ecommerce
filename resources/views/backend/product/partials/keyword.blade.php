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
                    <input type="text" id="keyword_hidden" value="{{$productInfo?->ProductMoreDetail?->product_keyword}}" hidden>
                    <div class="col-md-8 mt-md-3 sendTo" id="commaSep">
                        <input type="text" name="keyword[]" id="keyword">
                    </div>
                    <!-- End -->
                    <div class="col-md-12 mt-3 text-right">
                        <button type="submit" class="prev-btn btn-warning float-left">Previous</button>
                        <button type="submit" class="next-btn  btn-success float-right">Next</button>
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
