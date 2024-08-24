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
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Select Option</option>
                        
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    @if($productInfo && $productInfo->category_id == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                        
                                @if ($category->SubCategory)
                                    @foreach ($category->SubCategory as $subCategory)
                                        <option value="{{ $subCategory->id }}"
                                            @if($productInfo && $productInfo->category_id == $subCategory->id) selected @endif>
                                            {{ $category->name }} > {{ $subCategory->name }}
                                        </option>
                        
                                        @if ($subCategory->SubCategory)
                                            @foreach ($subCategory->SubCategory as $subSubCategory)
                                                <option value="{{ $subSubCategory->id }}"
                                                    @if($productInfo && $productInfo->category_id == $subSubCategory->id) selected @endif>
                                                    {{ $category->name }} > {{ $subCategory->name }} > {{ $subSubCategory->name }}
                                                </option>
                        
                                                @if ($subSubCategory->SubCategory)
                                                    @foreach ($subSubCategory->SubCategory as $subSubSubCategory)
                                                        <option value="{{ $subSubSubCategory->id }}"
                                                            @if($productInfo && $productInfo->category_id == $subSubSubCategory->id) selected @endif>
                                                            {{ $category->name }} > {{ $subCategory->name }} > {{ $subSubCategory->name }} > {{ $subSubSubCategory->name }}
                                                        </option>
                        
                                                        @if ($subSubSubCategory->SubCategory)
                                                            @foreach ($subSubSubCategory->SubCategory as $subSubSubSubCategory)
                                                                <option value="{{ $subSubSubSubCategory->id }}"
                                                                    @if($productInfo && $productInfo->category_id == $subSubSubSubCategory->id) selected @endif>
                                                                    {{ $category->name }} > {{ $subCategory->name }} > {{ $subSubCategory->name }} > {{ $subSubSubCategory->name }} > {{ $subSubSubSubCategory->name }}
                                                                </option>
                        
                                                                @if ($subSubSubSubCategory->SubCategory)
                                                                    @foreach ($subSubSubSubCategory->SubCategory as $subSubSubSubSubCategory)
                                                                        <option value="{{ $subSubSubSubSubCategory->id }}"
                                                                            @if($productInfo && $productInfo->category_id == $subSubSubSubSubCategory->id) selected @endif>
                                                                            {{ $category->name }} > {{ $subCategory->name }} > {{ $subSubCategory->name }} > {{ $subSubSubCategory->name }} > {{ $subSubSubSubCategory->name }} > {{ $subSubSubSubSubCategory->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
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
