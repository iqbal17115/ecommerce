<div class="tab-pane add_product_identity active" id="addProductIdentity" role="tabpanel">
    <form method="post" id="add_product_identity">
        @csrf
        <div class="row">
            <input type="hidden" name="product_identity_id" id="product_identity_id" @if($productInfo)
                value="{{$productInfo->id}}" @else value="-1" @endif />
            <!-- Start -->
            <div class="col-md-10">
                <!-- Start Content -->
                <div class="row">
                    <div class="col-md-4">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Product Id</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-4">
                        <input name="code" id="code" @if($productInfo)
                            value="{{$productInfo->code}}" @endif class="form-control"
                            placeholder="Enter product Id"/>
                    </div>
                    <div class="col-md-4">
                        <select name="type" id="type" class="form-select">
                            <option value="">Select Option</option>
                            <option @if($productInfo && $productInfo->type=='GTIN') selected
                                @endif value="GTIN">GTIN</option>
                            <option @if($productInfo && $productInfo->type=='EAN') selected
                                @endif value="EAN">EAN</option>
                            <option @if($productInfo && $productInfo->type=='GCID') selected
                                @endif value="GCID">GCID</option>
                            <option @if($productInfo && $productInfo->type=='UPC') selected
                                @endif value="UPC">UPC</option>
                            <option @if($productInfo && $productInfo->type=='ASIN') selected
                                @endif value="ASIN">ASIN</option>
                            <option @if($productInfo && $productInfo->type=='ISBN') selected
                                @endif value="ISBN">ISBN</option>
                        </select>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Product Name</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input name="name" id="name" @if($productInfo)
                            value="{{$productInfo->name}}" @endif class="form-control"
                            placeholder="Enter product Name" required />
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Category Name</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <select class="form-select" id="category_id" name="category_id"
                            onchange="variantByCategory(this)" required>
                            <option value=""></option>
                            @foreach($categories as $category)
                            <option @if($productInfo && $productInfo->
                                category_id==$category->id) selected @endif
                                value="{{$category->id}}">
                                {{$category->name}}
                            </option>
                            <!-- Start Sub-Category -->
                            @if($category->SubCategory)
                            @foreach($category->SubCategory as $subCategory)
                            <option @if($productInfo && $productInfo->
                                category_id==$subCategory->id) selected @endif
                                value="{{$subCategory->id}}">
                                --{{$subCategory->name}}
                            </option>
                            <!-- Start sub-Sub-Category -->
                            @if($subCategory->SubCategory)
                            @foreach($subCategory->SubCategory as $subSubCategory)
                            <option @if($productInfo && $productInfo->
                                category_id==$subSubCategory->id) selected @endif
                                value="{{$subSubCategory->id}}">
                                ----{{$subSubCategory->name}}
                            </option>
                            <!-- Start sub-Sub-Sub-Category -->
                            @if($subSubCategory->SubCategory)
                            @foreach($subSubCategory->SubCategory as $subSubSubCategory)
                            <option @if($productInfo && $productInfo->
                                category_id==$subSubSubCategory->id) selected @endif
                                value="{{$subSubSubCategory->id}}">
                                ------{{$subSubSubCategory->name}}
                            </option>
                            <!-- Start sub-Sub-Sub-Sub-Category -->
                            @if($subSubSubCategory->SubCategory)
                            @foreach($subSubSubCategory->SubCategory as
                            $subSubSubSubCategory)
                            <option @if($productInfo && $productInfo->
                                category_id==$subSubSubSubCategory->id) selected @endif
                                value="{{$subSubSubSubCategory->id}}">
                                --------{{$subSubSubSubCategory->name}}
                            </option>
                            <!-- Start sub-Sub-Sub-Sub-Sub-Category -->
                            @if($subSubSubSubCategory->SubCategory)
                            @foreach($subSubSubSubCategory->SubCategory as
                            $subSubSubSubSubCategory)
                            <option @if($productInfo && $productInfo->
                                category_id==$subSubSubSubSubCategory->id) selected @endif
                                value="{{$subSubSubSubSubCategory->id}}">
                                ----------{{$subSubSubSubSubCategory->name}}
                            </option>
                                <!-- Start sub-Sub-Sub-Sub-Sub-Sub-Category -->
                                @if($subSubSubSubSubCategory->SubCategory)
                            @foreach($subSubSubSubSubCategory->SubCategory as
                            $subSubSubSubSubSubCategory)
                            <option @if($productInfo && $productInfo->
                                category_id==$subSubSubSubSubSubCategory->id) selected @endif
                                value="{{$subSubSubSubSubSubCategory->id}}">
                                ----------{{$subSubSubSubSubSubCategory->name}}
                            </option>
                            @endforeach
                            @endif
                            <!-- End sub-Sub-Sub-Sub-Sub-Sub-Category -->
                            @endforeach
                            @endif
                            <!-- End sub-Sub-Sub-Sub-Sub-Category -->
                            @endforeach
                            @endif
                            <!-- End sub-Sub-Sub-Sub-Category -->
                            @endforeach
                            @endif
                            <!-- End sub-Sub-Sub-Category -->
                            @endforeach
                            @endif
                            <!-- End sub-Sub-Category -->
                            @endforeach
                            @endif
                            <!-- End Sub Category -->
                            @endforeach
                        </select>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Brand Available</label>
                         <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                         <select name="brand_available" id="brand_available" onchange="brandAvailableCheck(this)" class="form-select" required>
                            <option value="">Select Option</option>
                            <option @if($productInfo?->brand_available==1) selected @endif value="1">Yes</option>
                            <option @if($productInfo?->brand_available==0) selected @endif value="0">No</option>
                        </select>
                     </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3 brand_available_contant" style="display: {{ $productInfo?->brand_available == 1 ? 'block' : 'none' }};">
                        <label class="col-form-label float-md-right"
                            style="font-size: 14px;">Brand Name</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3 brand_available_contant" style="display: {{ $productInfo?->brand_available == 1 ? 'block' : 'none' }};">
                        <select name="brand_id" id="brand_id" class="form-select" style="width: 100%;">
                            <option value=""></option>
                            @foreach($brands as $brand)
                            <option @if($productInfo && $productInfo->brand_id==$brand->id)
                                selected @endif value="{{$brand->id}}">{{$brand->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- End -->

                    <div class="col-md-12 mt-md-3">
                        <button class="float-right btn btn-success btn-sm ml-2">Save and
                            finish</button>
                        <button type="submit"
                            class="float-right btn btn-warning btn-sm">Save as
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
