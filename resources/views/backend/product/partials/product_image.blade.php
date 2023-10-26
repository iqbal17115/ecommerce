<div class="tab-pane add_product_image" id="images" role="tabpanel">
    <form action="" method="post" id="add_product_image_info" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <input type="hidden" name="product_image_id" id="product_image_id"
                @if($productInfo) value="{{$productInfo->id}}" @else value="-1" @endif />
            <div class="col-md-2">
                <div class="drop-zone drop-zone_0" style="background-size: 100%; background-size: cover;">
                    <span class="drop-zone__prompt"></span>
                    <input type="file" name="product_image[]" id="product_image"
                        class="drop-zone__input">
                </div>
            </div>
            <!-- End -->
            <div class="col-md-2">
                <div class="drop-zone drop-zone_1" style="background-size: 100%; background-size: cover;">
                    <span class="drop-zone__prompt"></span>
                    <input type="file" name="product_image[]" id="product_image"
                        class="drop-zone__input">
                </div>
            </div>
            <!-- End -->
            <div class="col-md-2">
                <div class="drop-zone drop-zone_2" style="background-size: 100%; background-size: cover;">
                    <span class="drop-zone__prompt"></span>
                    <input type="file" name="product_image[]" id="product_image"
                        class="drop-zone__input">
                </div>
            </div>
            <!-- End -->
            <div class="col-md-2">
                <div class="drop-zone drop-zone_3" style="background-size: 100%; background-size: cover;">
                    <span class="drop-zone__prompt"></span>
                    <input type="file" name="product_image[]" id="product_image"
                        class="drop-zone__input">
                </div>
            </div>
            <!-- End -->
            <div class="col-md-2">
                <div class="drop-zone drop-zone_4" style="background-size: 100%; background-size: cover;">
                    <span class="drop-zone__prompt"></span>
                    <input type="file" name="product_image[]" id="product_image"
                        class="drop-zone__input">
                </div>
            </div>
            <!-- End -->
            <div class="col-md-2">
                <div class="drop-zone drop-zone_5" style="background-size: 100%; background-size: cover;">
                    <span class="drop-zone__prompt"></span>
                    <input type="file" name="product_image[]" id="product_image"
                        class="drop-zone__input">
                </div>
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
    </form>
</div>
