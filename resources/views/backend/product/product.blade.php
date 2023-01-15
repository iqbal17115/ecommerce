@extends('layouts.backend_app')
@section('individual__link')
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .drop-zone {
        max-width: 200px;
        height: 200px;
        padding: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-family: "Quicksand", sans-serif;
        font-weight: 500;
        font-size: 20px;
        cursor: pointer;
        color: #cccccc;
        border: 4px dashed #009578;
        border-radius: 10px;
    }

    .drop-zone--over {
        border-style: solid;
    }

    .drop-zone__input {
        display: none;
    }

    .drop-zone__thumb {
        width: 100%;
        height: 100%;
        border-radius: 10px;
        overflow: hidden;
        background-color: #cccccc;
        background-size: cover;
        position: relative;
    }

    .drop-zone__thumb::after {
        content: attr(data-label);
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 5px 0;
        color: #ffffff;
        background: rgba(0, 0, 0, 0.75);
        font-size: 14px;
        text-align: center;
    }

    #rowAdder {
        margin-left: 17px;
    }

    #box-one,
    #box-two {
        width: 100px;
        height: 100px;
        background-color: blue;
    }

    #box-two {
        transition: transform 0.6s ease;
    }

    #button-three {
        position: relative;
        left: 200px;
    }

    div#variation_content {
        margin: 4px, 4px;
        padding: 4px;
        overflow-x: auto;
        overflow-y: hidden;
        white-space: nowrap;
    }

    .select-form {
        /* margin: 4px, 4px; */
        /* padding: 4px; */
        width: 100%;
    }

    .input-form {
        /* margin-top: 8px; */
        /* padding: 3px; */
        width: 100%;
        height: 25px;
    }
</style>
@endsection
@section('content')
<!-- include summernote css/js-->

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 ml-auto">
                <p class="category h4">Add Product</p>
                <!-- Nav tabs -->
                <div class="card">
                    <div class="card-header">
                        <!-- justify-content-center -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#addVitalInfo" role="tab">
                                    <i class="now-ui-icons objects_umbrella-13"></i> Vital Info
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#variations" role="tab">
                                    <i class="now-ui-icons shopping_cart-simple"></i> Variation
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#offer" role="tab">
                                    <i class="now-ui-icons shopping_shop"></i> Offer
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#compliance" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> Compliance
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#images" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> Images
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#description" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> Description
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#keywords" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> Keywords
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#more_details" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> More Details
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="addVitalInfo" role="tabpanel">
                                <form method="post" id="add_vital_info">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="vital_info_id" id="vital_info_id" @if($productInfo) value="{{$productInfo->id}}" @else value="-1" @endif/>
                                        <!-- Start -->
                                        <div class="col-md-10">
                                            <!-- Start Content -->
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Product Id</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="code" id="code" @if($productInfo) value="{{$productInfo->code}}" @endif class="form-control" placeholder="Enter product Id" />
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="type" id="type" class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option @if($productInfo && $productInfo->type=='GTIN') selected @endif value="GTIN">GTIN</option>
                                                        <option @if($productInfo && $productInfo->type=='EAN') selected @endif value="EAN">EAN</option>
                                                        <option @if($productInfo && $productInfo->type=='GCID') selected @endif value="GCID">GCID</option>
                                                        <option @if($productInfo && $productInfo->type=='UPC') selected @endif value="UPC">UPC</option>
                                                        <option @if($productInfo && $productInfo->type=='ASIN') selected @endif value="ASIN">ASIN</option>
                                                        <option @if($productInfo && $productInfo->type=='ISBN') selected @endif value="ISBN">ISBN</option>
                                                    </select>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Product Name</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input name="name" id="name" @if($productInfo) value="{{$productInfo->name}}" @endif class="form-control" placeholder="Enter product Name" required />
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Category Name</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <select class="form-select" id="category_id" name="category_id" onchange="variantByCategory(this)" required>
                                                        <option value=""></option>
                                                        @foreach($categories as $category)
                                                        <option @if($productInfo && $productInfo->category_id==$category->id) selected @endif value="{{$category->id}}">
                                                            {{$category->name}}
                                                        </option>
                                                        <!-- Start Sub-Category -->
                                                        @if($category->SubCategory)
                                                        @foreach($category->SubCategory as $subCategory)
                                                        <option @if($productInfo && $productInfo->category_id==$subCategory->id) selected @endif value="{{$subCategory->id}}">
                                                            --{{$subCategory->name}}
                                                        </option>
                                                        <!-- Start sub-Sub-Category -->
                                                        @if($subCategory->SubCategory)
                                                        @foreach($subCategory->SubCategory as $subSubCategory)
                                                        <option @if($productInfo && $productInfo->category_id==$subSubCategory->id) selected @endif value="{{$subSubCategory->id}}">
                                                            ----{{$subSubCategory->name}}
                                                        </option>
                                                        <!-- Start sub-Sub-Sub-Category -->
                                                        @if($subSubCategory->SubCategory)
                                                        @foreach($subSubCategory->SubCategory as $subSubSubCategory)
                                                        <option @if($productInfo && $productInfo->category_id==$subSubSubCategory->id) selected @endif value="{{$subSubSubCategory->id}}">
                                                            ------{{$subSubSubCategory->name}}
                                                        </option>
                                                        <!-- Start sub-Sub-Sub-Sub-Category -->
                                                        @if($subSubSubCategory->SubCategory)
                                                        @foreach($subSubSubCategory->SubCategory as
                                                        $subSubSubSubCategory)
                                                        <option @if($productInfo && $productInfo->category_id==$subSubSubSubCategory->id) selected @endif value="{{$subSubSubSubCategory->id}}">
                                                            --------{{$subSubSubSubCategory->name}}
                                                        </option>
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
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Brand Name</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <select name="brand_id" id="brand_id" class="form-select">
                                                        <option value=""></option>
                                                        @foreach($brands as $brand)
                                                        <option @if($productInfo && $productInfo->brand_id==$brand->id) selected @endif value="{{$brand->id}}">{{$brand->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Model Number</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input name="model_number" id="model_number" type="text" @if($productInfo) value="{{$productInfo->model_number}}" @endif class="form-control" placeholder="Enter Model Number" aria-label="Username" aria-describedby="model_number">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Outer Material</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input name="outer_material" id="outer_material" @if($productInfo && $productInfo->ProductDetail) value="{{$productInfo->outer_material}}" @endif class="form-control" placeholder="Enter Outer Material" />
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Country/Region of Publication</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <select name="region_publication_id" id="region_publication_id" class="form-select">
                                                        <option @if($productInfo && $productInfo->region_publication_id==1) selected @endif value="1">Bangladesh</option>
                                                    </select>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Model Name</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input name="model_name" id="model_name" @if($productInfo) value="{{$productInfo->model_name}}" @endif class="form-control" placeholder="Enter Model Name" />
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Material Type</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <select name="material_type_id" id="material_type_id" class="form-select">
                                                        <option value=""></option>
                                                        @foreach($materials as $material)
                                                        <option value="{{$material->id}}">{{$material->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Item Booking Date</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="product_booking_date"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                        </div>
                                                        <input type="date" name="booking_date" id="booking_date" @if($productInfo) value="{{$productInfo->booking_date}}" @endif class="form-control" aria-label="Username" aria-describedby="product_booking_date">
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-12 mt-md-3">
                                                    <button class="float-right btn btn-success btn-sm ml-2">Save and
                                                        finish</button>
                                                    <button type="submit" class="float-right btn btn-warning btn-sm">Save as
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
                            <div class="tab-pane" id="variations" role="tabpanel">
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
                                        <input class="selected_variation" type="hidden" name="selected_variation[]" id="selected_variation[]" />
                                        <input type="hidden" name="product_variant_info_id" id="product_variant_info_id" @if($productInfo) value="{{$productInfo->id}}" @else value="-1" @endif />

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
                                                        <div class="text-center" style="width: 150px; font-size: 12px;" id="gender_header"><span style="width: 100%;">Target
                                                                Gender</span></div>
                                                        <div class="text-center div_size" style="display: none; width: 150px; font-size: 12px;"><span style="width: 100%;">Bottom Size</span></div>
                                                        <div class="text-center div_size" style="display: none; width: 150px; font-size: 12px;"><span style="width: 100%;">Bottom Size Map</span></div>
                                                        <div class="text-center div_color" style="display: none; width: 150px; font-size: 12px;"><span style="width: 100%;">Color Map</span></div>
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
                            <div class="tab-pane" id="offer" role="tabpanel">
                                <form method="post" id="add_product_detail_info">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="product_offer_id" id="product_offer_id" @if($productInfo) value="{{$productInfo->id}}" @else value="-1" @endif/>
                                        <!-- Start -->
                                        <div class="col-md-10">
                                            <!-- Start Content -->
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Seller SKU</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input name="seller_sku" id="seller_sku" @if($productInfo && $productInfo->ProductDetail) value="{{$productInfo->seller_sku}}" @endif class="form-control" placeholder="Enter Seller SKU" />
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Product Tax Code</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input name="tax_code" id="tax_code" @if($productInfo && $productInfo->ProductDetail) value="{{$productInfo->tax_code}}" @endif class="form-control" placeholder="Enter Product Tax Code" />
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Your Price</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="your_price">AED</span>
                                                        </div>
                                                        <input type="text" name="your_price" id="your_price" @if($productInfo) value="{{$productInfo->your_price}}" @endif class="form-control" placeholder="Ex: 50.00" aria-describedby="your_price" required>
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Sale Price</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="sale_price">AED</span>
                                                        </div>
                                                        <input type="text" name="sale_price" id="sale_price" @if($productInfo) value="{{$productInfo->sale_price}}" @endif class="form-control" placeholder="Ex: 50.00" aria-describedby="sale_price" required>
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Sale Start Date</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="sale_start_date1"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                        </div>
                                                        <input type="date" name="sale_start_date" id="sale_start_date" @if($productInfo) value="{{$productInfo->sale_start_date}}" @endif class="form-control" aria-describedby="sale_start_date1">
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Sale End Date</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="sale_end_date1"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                        </div>
                                                        <input type="date" name="sale_end_date" id="sale_end_date" @if($productInfo) value="{{$productInfo->sale_end_date}}" @endif class="form-control" aria-describedby="sale_end_date1">
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Retail Price (Inclusive VAT)</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="retail_price_inclusive_vat">AED</span>
                                                        </div>
                                                        <input type="text" name="retail_price" id="retail_price" @if($productInfo) value="{{$productInfo->retail_price}}" @endif class="form-control" placeholder="Ex: 50.00" aria-label="Username" aria-describedby="retail_price_inclusive_vat">
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Condition</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <select class="form-select" name="condition_id" id="condition_id" style="width: 100%;">
                                                        <option value="">Select Option</option>
                                                        @foreach($conditions AS $condition)
                                                        <option value="{{ $condition->id }}" @if($productInfo && $productInfo->ProductDetail && $productInfo->ProductDetail->condition_id==$condition->id) selected @endif>{{ $condition->title }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Condition Note</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <textarea class="form-control" name="condition_note" id="condition_note" @if($productInfo && $productInfo->ProductDetail) value="{{$productInfo->condition_note}}"  @endif></textarea>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Max Order Qty</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input name="max_order_qty" id="max_order_qty" @if($productInfo) value="{{$productInfo->max_order_qty}}" @endif class="form-control" placeholder="Enter Max Order Qty" name="" id="" />
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Handling Time</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input class="form-control" placeholder="Enter Handling Time" name="" id="" />
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Offering Can Be Gift Messaged</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <select name="offering_gift_message" id="offering_gift_message" class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option @if($productInfo && $productInfo->offering_gift_message==1) selected @endif value="1">Yes</option>
                                                        <option @if($productInfo && $productInfo->offering_gift_message==0) selected @endif value="0">No</option>
                                                    </select>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Is
                                                        Gift Wrap Available?</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <select name="gift_wrap_available" id="gift_wrap_available" class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option @if($productInfo && $productInfo->gift_wrap_available==1) selected @endif value="1">Yes</option>
                                                        <option @if($productInfo && $productInfo->gift_wrap_available==0) selected @endif value="0">No</option>
                                                    </select>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Start Selling Date</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="start_selling_date1"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                        </div>
                                                        <input type="date" name="start_selling_date" id="start_selling_date" @if($productInfo) value="{{$productInfo->start_selling_date}}" @endif class="form-control" aria-describedby="start_selling_date1">
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Restock Date</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="restock_date1"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                        </div>
                                                        <input type="date" name="restock_date" id="restock_date" @if($productInfo && $productInfo->ProductDetail) value="{{$productInfo->restock_date}}" @endif class="form-control" aria-describedby="restock_date1">
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
                                            <!-- End Content -->
                                        </div>
                                        <div class="col-md-2"></div>
                                        <!-- End -->
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="compliance" role="tabpanel">
                                <!-- Start -->
                                <div class="col-md-10">
                                    <!-- Start Content -->
                                    <form method="post" id="add_product_compliance">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="product_compliance_id" id="product_compliance_id" @if($productInfo) value="{{$productInfo->id}}" @else value="-1" @endif/>
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Battery Cell Type</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <select name="battery_cell_type" id="battery_cell_type" class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Polymer Lithium Ion') selected @endif value="Polymer Lithium Ion">Polymer Lithium Ion</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lithium Ion') selected @endif value="Lithium Ion">Lithium Ion</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Alkaline') selected @endif value="Alkaline">Alkaline</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lithium Manganese Dioxide') selected @endif value="Lithium Manganese Dioxide">Lithium Manganese Dioxide</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Manganese') selected @endif value="Manganese">Manganese</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Sealed Lead Acid') selected @endif value="Sealed Lead Acid">Sealed Lead Acid</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lithium Polymer') selected @endif value="Lithium Polymer">Lithium Polymer</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Nicad') selected @endif value="Nicad">Nicad</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lithium Metal') selected @endif value="Lithium Metal">Lithium Metal</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Nimh') selected @endif value="Nimh">Nimh</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lead Calcium') selected @endif value="Lead Calcium">Lead Calcium</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Aluminium Oxygen') selected @endif value="Aluminium Oxygen">Aluminium Oxygen</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Zinc') selected @endif value="Zinc">Zinc</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lead Acid') selected @endif value="Lead Acid">Lead Acid</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Silver Zinc') selected @endif value="Silver Zinc">Silver Zinc</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Zinc Chloride') selected @endif value="Zinc Chloride">Zinc Chloride</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lithium Cobalt') selected @endif value="Lithium Cobalt">Lithium Cobalt</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lithium Phosphate') selected @endif value="Lithium Phosphate">Lithium Phosphate</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lead Acid Agm') selected @endif value="Lead Acid Agm">Lead Acid Agm</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lithium Thionyl Chloride') selected @endif value="Lithium Thionyl Chloride">Lithium Thionyl Chloride</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lithium') selected @endif value="Lithium">Lithium</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lithium Nickel Cobalt Aluminum') selected @endif value="Lithium Nickel Cobalt Aluminum">Lithium Nickel Cobalt Aluminum</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lithium Nickel Manganese Cobalt') selected @endif value="Lithium Nickel Manganese Cobalt">Lithium Nickel Manganese Cobalt</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Mercury Oxide') selected @endif value="Mercury Oxide">Mercury Oxide</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Nickel Iron') selected @endif value="Nickel Iron">Nickel Iron</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lithium Air') selected @endif value="Lithium Air">Lithium Air</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Nickel Oxyhydroxide') selected @endif value="Nickel Oxyhydroxide">Nickel Oxyhydroxide</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Zinc Carbon') selected @endif value="Zinc Carbon">Zinc Carbon</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Nickel Zinc') selected @endif value="Nickel Zinc">Nickel Zinc</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Lithium Titanate') selected @endif value="Lithium Titanate">Lithium Titanate</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Silver Calcium') selected @endif value="Silver Calcium">Silver Calcium</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_cell_type=='Zinc Air') selected @endif value="Zinc Air">Zinc Air</option>
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Battery Type</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <select name="battery_type" id="battery_type" class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='Aa') selected @endif value="Aa">Aa</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='Aaa') selected @endif value="Aaa">Aaa</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='Lithium Ion') selected @endif value="Lithium Ion">Lithium Ion</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='A') selected @endif value="A">A</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='Cr2') selected @endif value="Cr2">Cr2</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='C') selected @endif value="C">C</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='D') selected @endif value="D">D</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='Cr5') selected @endif value="Cr5">Cr5</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='Aaaa') selected @endif value="Aaaa">Aaaa</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='P76') selected @endif value="P76">P76</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='Product Specific') selected @endif value="Product Specific">Product Specific</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='Lithium Metal') selected @endif value="Lithium Metal">Lithium Metal</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='Cr123A') selected @endif value="Cr123A">Cr123A</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='12V') selected @endif value="12V">12V</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='9V') selected @endif value="9V">9V</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='CR2032') selected @endif value="CR2032">CR2032</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_type=='CR2430') selected @endif value="CR2430">CR2430</option>
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Number
                                                    of Batteries Required</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input name="number_of_battery_require" id="number_of_battery_require" @if($productInfo && $productInfo->ProductCompliance) value="{{$productInfo->ProductCompliance->number_of_battery_require}}" @endif class="form-control" placeholder="Number of Batteries Required" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Lithium Battery Energy Content</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input name="lithium_battery_energy_content" id="lithium_battery_energy_content" @if($productInfo && $productInfo->ProductCompliance) value="{{$productInfo->ProductCompliance->lithium_battery_energy_content}}" @endif class="form-control" placeholder="1, 2, 3" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="lithium_battery_energy_content_unit" id="lithium_battery_energy_content_unit" class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Kilowatt Hours') selected @endif value="Kilowatt Hours">Kilowatt Hours</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Joules') selected @endif value="Joules">Joules</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Cubic Feet') selected @endif value="Cubic Feet">Cubic Feet</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Watt Hours') selected @endif value="Watt Hours">Watt Hours</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Milliampere Hour (mAh)') selected @endif value="Milliampere Hour (mAh)">Milliampere Hour (mAh)</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Cubic Meters') selected @endif value="Cubic Meters">Cubic Meters</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Milliamp Hours (mAh)') selected @endif value="Milliamp Hours (mAh)">Milliamp Hours (mAh)</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Milliampere Second (mAs)') selected @endif value="Milliampere Second (mAs)">Milliampere Second (mAs)</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='British Thermal Units (BTUs)') selected @endif value="British Thermal Units (BTUs)">British Thermal Units (BTUs)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Lithium Battery Packaging</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <select name="lithium_battery_packaging" id="lithium_battery_packaging" class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_packaging==1) selected @endif value="1">Batteries Packed With Equipment</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_packaging==2) selected @endif value="2">Batteries Contained In Equipment</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_packaging==3) selected @endif value="3">Batteries Only</option>
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Batteries are Included</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <select name="battery_include" id="battery_include" class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_include==1) selected @endif value="1">Yes</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_include==0) selected @endif value="0">No</option>
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Are
                                                    Batteries Required</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <select name="battery_require" id="battery_require" class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_include==1) selected @endif value="1">Yes</option>
                                                    <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_include==0) selected @endif value="0">No</option>
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Battery Weight</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input name="battery_weight" id="battery_weight" @if($productInfo && $productInfo->ProductCompliance) value="{{$productInfo->ProductCompliance->battery_weight}}" @endif class="form-control" placeholder="150" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="battery_weight_unit" id="battery_weight_unit" class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_weight_unit=="Pounds") selected @endif value="Pounds">Pounds</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_weight_unit=="Kilograms") selected @endif value="Kilograms">Kilograms</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_weight_unit=="Grams") selected @endif value="Grams">Grams</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_weight_unit=="Hundredths") selected @endif value="Hundredths Pounds">Hundredths Pounds</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_weight_unit=="Milligrams") selected @endif value="Milligrams">Milligrams</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_weight_unit=="Tons") selected @endif value="Tons">Tons</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->battery_weight_unit=="Ounces") selected @endif value="Ounces">Ounces</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Number
                                                    of Lithium Metal Cells</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input name="number_of_lithium_metal_cell" id="number_of_lithium_metal_cell" @if($productInfo && $productInfo->ProductCompliance) value="{{$productInfo->ProductCompliance->number_of_lithium_metal_cell}}" @endif class="form-control" placeholder="1, 2, 3" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Number
                                                    of Lithium-ion Cells</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input name="number_of_lithium_ion_cell" id="number_of_lithium_ion_cell" @if($productInfo && $productInfo->ProductCompliance) value="{{$productInfo->ProductCompliance->number_of_lithium_ion_cell}}" @endif class="form-control" placeholder="1, 2, 3" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Lithium Battery Weight</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input name="lithium_battery_weight" id="lithium_battery_weight" @if($productInfo && $productInfo->ProductCompliance) value="{{$productInfo->ProductCompliance->lithium_battery_weight}}" @endif class="form-control" placeholder="0.9" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="lithium_battery_weight_unit" id="lithium_battery_weight_unit" class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_weight_unit=="Pounds") selected @endif value="Pounds">Pounds</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_weight_unit=="Kilograms") selected @endif value="Kilograms">Kilograms</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_weight_unit=="Grams") selected @endif value="Grams">Grams</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_weight_unit=="Hundredths") selected @endif value="Hundredths Pounds">Hundredths Pounds</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_weight_unit=="Milligrams") selected @endif value="Milligrams">Milligrams</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_weight_unit=="Tons") selected @endif value="Tons">Tons</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->lithium_battery_weight_unit=="Ounces") selected @endif value="Ounces">Ounces</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Hazmat
                                                    United Nations Regulatory Id</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input name="regulatory_id" id="regulatory_id" @if($productInfo && $productInfo->ProductCompliance) value="{{$productInfo->ProductCompliance->regulatory_id}}" @endif class="form-control" placeholder="UN1950" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Safety
                                                    Data Sheet URL</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input name="safety_data_sheet_url" id="safety_data_sheet_url" @if($productInfo && $productInfo->ProductCompliance) value="{{$productInfo->ProductCompliance->safety_data_sheet_url}}" @endif class="form-control" placeholder="https://www.facebook.com/" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Volume</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input name="volume" id="volume" @if($productInfo && $productInfo->ProductCompliance) value="{{$productInfo->ProductCompliance->volume}}" @endif class="form-control" placeholder="34.78" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="volume_unit" id="volume_unit" class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Cups") selected @endif value="Cups">Cups</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Microliters") selected @endif value="Microliters">Microliters</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Cubic Feet") selected @endif value="Cubic Feet">Cubic Feet</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Centiliters") selected @endif value="Centiliters">Centiliters</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Gallons") selected @endif value="Gallons">Gallons</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Quarts") selected @endif value="Quarts">Quarts</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Nanoliters") selected @endif value="Nanoliters">Nanoliters</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Liters") selected @endif value="Liters">Liters</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Picoliters") selected @endif value="Picoliters">Picoliters</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Fluid Ounces") selected @endif value="Fluid Ounces">Fluid Ounces</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Cubic Meters") selected @endif value="Cubic Meters">Cubic Meters</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Pints") selected @endif value="Pints">Pints</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Cubic Yards") selected @endif value="Cubic Yards">Cubic Yards</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Cubic Inches") selected @endif value="Cubic Inches">Cubic Inches</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Imperial Gallons") selected @endif value="Imperial Gallons">Imperial Gallons</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Milliliters") selected @endif value="Milliliters">Milliliters</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Cubic Centimeters") selected @endif value="Cubic Centimeters">Cubic Centimeters</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->volume_unit=="Deciliters") selected @endif value="Deciliters">Deciliters</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Flash
                                                    Point</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input name="flash_point" id="flash_point" @if($productInfo && $productInfo->ProductCompliance) value="{{$productInfo->ProductCompliance->flash_point}}" @endif class="form-control" placeholder="180" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Item
                                                    Weight</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input name="item_weight" id="item_weight" @if($productInfo && $productInfo->ProductCompliance) value="{{$productInfo->ProductCompliance->item_weight}}" @endif class="form-control" placeholder="2.33, 20.75, 10000.00" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="item_weight_unit" id="item_weight_unit" class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->item_weight_unit=="Pounds") selected @endif value="Pounds">Pounds</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->item_weight_unit=="Kilograms") selected @endif value="Kilograms">Kilograms</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->item_weight_unit=="Grams") selected @endif value="Grams">Grams</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->item_weight_unit=="Hundredths") selected @endif value="Hundredths Pounds">Hundredths Pounds</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->item_weight_unit=="Milligrams") selected @endif value="Milligrams">Milligrams</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->item_weight_unit=="Tons") selected @endif value="Tons">Tons</option>
                                                            <option @if($productInfo && $productInfo->ProductCompliance && $productInfo->ProductCompliance->item_weight_unit=="Ounces") selected @endif value="Ounces">Ounces</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">GHS
                                                    Classification</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <select class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Applicable Dangerous Goods Regulations</label>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <select class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
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
                                <div class="col-md-2"></div>
                                <!-- End -->
                            </div>
                            <div class="tab-pane" id="images" role="tabpanel">
                                <form action="" method="post" id="add_product_image_info" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="product_image_id" id="product_image_id" @if($productInfo) value="{{$productInfo->id}}" @else value="-1" @endif/>
                                        <div class="col-md-2">
                                            <div class="drop-zone">
                                                <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                                <input type="file" name="product_image[]" id="product_image" class="drop-zone__input">
                                            </div>
                                        </div>
                                        <!-- End -->
                                        <div class="col-md-2">
                                            <div class="drop-zone">
                                                <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                                <input type="file" name="product_image[]" id="product_image" class="drop-zone__input">
                                            </div>
                                        </div>
                                        <!-- End -->
                                        <div class="col-md-2">
                                            <div class="drop-zone">
                                                <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                                <input type="file" name="product_image[]" id="product_image" class="drop-zone__input">
                                            </div>
                                        </div>
                                        <!-- End -->
                                        <div class="col-md-2">
                                            <div class="drop-zone">
                                                <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                                <input type="file" name="product_image[]" id="product_image" class="drop-zone__input">
                                            </div>
                                        </div>
                                        <!-- End -->
                                        <div class="col-md-2">
                                            <div class="drop-zone">
                                                <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                                <input type="file" name="product_image[]" id="product_image" class="drop-zone__input">
                                            </div>
                                        </div>
                                        <!-- End -->
                                        <div class="col-md-2">
                                            <div class="drop-zone">
                                                <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                                <input type="file" name="product_image[]" id="product_image" class="drop-zone__input">
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
                            <div class="tab-pane" id="description" role="tabpanel">
                                <form method="post" id="add_product_description_info">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="product_description_id" id="product_description_id" @if($productInfo) value="{{$productInfo->id}}" @else value="-1" @endif/>
                                        <!-- Start -->
                                        <div class="col-md-10">
                                            <!-- Start Content -->
                                            <div class="row">
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Product Description</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <textarea class="form-control" name="product_description" id="product_description" @if($productInfo && $productInfo->ProductDetail) value="{{$productInfo->description}}"  @endif></textarea>
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
                            <!-- End -->
                            <div class="tab-pane" id="keywords" role="tabpanel">
                                <div class="row">
                                    <!-- Start -->
                                    <div class="col-md-10">
                                        <!-- Start Content -->
                                        <form method="post" id="add_product_keyword">
                                            @csrf
                                            <div class="row">
                                                <input type="hidden" name="product_keyword_id" id="product_keyword_id" @if($productInfo) value="{{$productInfo->id}}" @else value="-1" @endif/>
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Key Product Features</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                @if($productInfo && count($productInfo->ProductKeyword) > 0)
                                                <div class="col-md-8 mt-md-3">
                                                    @foreach($productInfo->ProductKeyword as $ProductKeyword)

                                                    <div id="row">
                                                        <div class="input-group m-3">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-danger" id="DeleteRow" type="button">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button>
                                                            </div>
                                                            <input type="text" name="keyword[]" id="keyword" value="{{$ProductKeyword->keyword}}" class="form-control m-input">
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
                                                                <button class="btn btn-danger" id="DeleteRow" type="button">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button>
                                                            </div>
                                                            <input type="text" name="keyword[]" id="keyword" class="form-control m-input">
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
                            <!-- End -->
                            <div class="tab-pane" id="more_details" role="tabpanel">
                                <form method="post" id="add_product_more_detail">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="product_more_detail_id" id="product_more_detail_id" @if($productInfo) value="{{$productInfo->id}}" @else value="-1" @endif/>
                                        <!-- Start -->
                                        <div class="col-md-10">
                                            <!-- Start Content -->
                                            <div class="row">
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Closure Type</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="closure_type" id="closure_type" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->closure_type}}" @endif class="form-control m-input" placeholder="zipper">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Manufacturer</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="manufacturer" id="manufacturer" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->manufacturer}}" @endif class="form-control m-input" placeholder="Philips">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Manufacturer Part Number</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="manufacturer_part_number" id="manufacturer_part_number" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->manufacturer_part_number}}" @endif class="form-control m-input" placeholder="SB-122">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Number of Items</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="number_of_item" id="number_of_item" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->number_of_item}}" @endif class="form-control m-input" placeholder="1">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Release Date</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="release_date"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                        </div>
                                                        <input type="date" name="release_date" id="release_date" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->release_date}}" @endif class="form-control" aria-describedby="release_date">
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Fabric Type</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="fabric_type" id="fabric_type" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->fabric_type}}" @endif class="form-control m-input" placeholder="cotton, plastic">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Item Dimensions</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <div class="row">
                                                        <div class="col-md-12" style="text-align: left;">
                                                            <label class="col-form-label" style="font-size: 14px;">Length</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" name="item_length" id="item_length" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->item_length}}" @endif class="form-control m-input" placeholder="10.33, 5.50, 15000.0">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select name="item_length_unit" id="item_length_unit" class="form-select">
                                                                <option value="">Select Option</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="dm") selected @endif value="dm">Decimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="mm") selected @endif value="mm">Milimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="cm") selected @endif value="cm">Centimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="m") selected @endif value="m">Meter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="Å") selected @endif value="Å">Angstrom</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="mil") selected @endif value="mil">Mil</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="yd") selected @endif value="yd">Yards</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="pm") selected @endif value="pm">Picometer</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="mi") selected @endif value="mi">Mile</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="in") selected @endif value="in">Inch</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="ft") selected @endif value="ft">Feet</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="hin") selected @endif value="hin">Hundredths Inch</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="nm") selected @endif value="nm">Nanometer</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="ft") selected @endif value="ft">Feet</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="μm") selected @endif value="μm">Micrometre</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_length_unit=="km") selected @endif value="km">Kilometers</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12" style="text-align: left;">
                                                            <label class="col-form-label" style="font-size: 14px;">Width</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" name="item_width" id="item_width" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->item_width}}" @endif class="form-control m-input" placeholder="10.33, 5.50, 15000.0">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select name="item_width_unit" id="item_width_unit" class="form-select">
                                                                <option value="">Select Option</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="dm") selected @endif value="dm">Decimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="mm") selected @endif value="mm">Milimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="cm") selected @endif value="cm">Centimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="m") selected @endif value="m">Meter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="Å") selected @endif value="Å">Angstrom</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="mil") selected @endif value="mil">Mil</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="yd") selected @endif value="yd">Yards</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="pm") selected @endif value="pm">Picometer</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="mi") selected @endif value="mi">Mile</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="in") selected @endif value="in">Inch</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="ft") selected @endif value="ft">Feet</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="hin") selected @endif value="hin">Hundredths Inch</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="nm") selected @endif value="nm">Nanometer</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="ft") selected @endif value="ft">Feet</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="μm") selected @endif value="μm">Micrometre</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_width_unit=="km") selected @endif value="km">Kilometers</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12" style="text-align: left;">
                                                            <label class="col-form-label" style="font-size: 14px;">Height</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" name="item_height" id="item_height" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->item_height}}" @endif class="form-control m-input" placeholder="10.33, 5.50, 15000.0">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select name="item_height_unit" id="item_height_unit" class="form-select">
                                                                <option value="">Select Option</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="dm") selected @endif value="dm">Decimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="mm") selected @endif value="mm">Milimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="cm") selected @endif value="cm">Centimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="m") selected @endif value="m">Meter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="Å") selected @endif value="Å">Angstrom</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="mil") selected @endif value="mil">Mil</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="yd") selected @endif value="yd">Yards</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="pm") selected @endif value="pm">Picometer</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="mi") selected @endif value="mi">Mile</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="in") selected @endif value="in">Inch</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="ft") selected @endif value="ft">Feet</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="hin") selected @endif value="hin">Hundredths Inch</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="nm") selected @endif value="nm">Nanometer</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="ft") selected @endif value="ft">Feet</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="μm") selected @endif value="μm">Micrometre</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->item_height_unit=="km") selected @endif value="km">Kilometers</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Package Dimensions</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <div class="row">
                                                        <div class="col-md-12" style="text-align: left;">
                                                            <label class="col-form-label" style="font-size: 14px;">Package
                                                                Height</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" name="package_height" id="package_height" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->package_height}}" @endif class="form-control m-input" placeholder="3.45">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select name="package_height_unit" id="package_height_unit" class="form-select">
                                                                <option value="">Select Option</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="dm") selected @endif value="dm">Decimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="mm") selected @endif value="mm">Milimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="cm") selected @endif value="cm">Centimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="m") selected @endif value="m">Meter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="Å") selected @endif value="Å">Angstrom</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="mil") selected @endif value="mil">Mil</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="yd") selected @endif value="yd">Yards</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="pm") selected @endif value="pm">Picometer</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="mi") selected @endif value="mi">Mile</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="in") selected @endif value="in">Inch</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="ft") selected @endif value="ft">Feet</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="hin") selected @endif value="hin">Hundredths Inch</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="nm") selected @endif value="nm">Nanometer</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="ft") selected @endif value="ft">Feet</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="μm") selected @endif value="μm">Micrometre</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_height_unit=="km") selected @endif value="km">Kilometers</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12" style="text-align: left;">
                                                            <label class="col-form-label" style="font-size: 14px;">Package
                                                                Length</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" name="package_length" id="package_length" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->package_length}}" @endif class="form-control m-input" placeholder="400, 2, 3, 3.54">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select name="package_length_unit" id="package_length_unit" class="form-select">
                                                                <option value="">Select Option</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="dm") selected @endif value="dm">Decimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="mm") selected @endif value="mm">Milimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="cm") selected @endif value="cm">Centimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="m") selected @endif value="m">Meter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="Å") selected @endif value="Å">Angstrom</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="mil") selected @endif value="mil">Mil</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="yd") selected @endif value="yd">Yards</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="pm") selected @endif value="pm">Picometer</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="mi") selected @endif value="mi">Mile</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="in") selected @endif value="in">Inch</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="ft") selected @endif value="ft">Feet</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="hin") selected @endif value="hin">Hundredths Inch</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="nm") selected @endif value="nm">Nanometer</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="ft") selected @endif value="ft">Feet</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="μm") selected @endif value="μm">Micrometre</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_length_unit=="km") selected @endif value="km">Kilometers</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12" style="text-align: left;">
                                                            <label class="col-form-label" style="font-size: 14px;">Package
                                                                Width</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" name="package_width" id="package_width" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->package_width}}" @endif class="form-control m-input" placeholder="400, 2, 3, 3.54">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select name="package_width_unit" id="package_width_unit" class="form-select">
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="dm") selected @endif value="dm">Decimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="mm") selected @endif value="mm">Milimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="cm") selected @endif value="cm">Centimeter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="m") selected @endif value="m">Meter</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="Å") selected @endif value="Å">Angstrom</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="mil") selected @endif value="mil">Mil</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="yd") selected @endif value="yd">Yards</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="pm") selected @endif value="pm">Picometer</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="mi") selected @endif value="mi">Mile</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="in") selected @endif value="in">Inch</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="ft") selected @endif value="ft">Feet</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="hin") selected @endif value="hin">Hundredths Inch</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="nm") selected @endif value="nm">Nanometer</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="ft") selected @endif value="ft">Feet</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="μm") selected @endif value="μm">Micrometre</option>
                                                                <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_width_unit=="km") selected @endif value="km">Kilometers</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Package Weight</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-4 mt-md-3">
                                                    <input name="package_weight" id="package_weight" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->package_weight}}" @endif class="form-control" placeholder="45" />
                                                </div>
                                                <div class="col-md-4 mt-md-3">
                                                    <select name="package_weight_unit" id="package_weight_unit" class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_weight_unit=="lb") selected @endif value="lb">Pound</option>
                                                        <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_weight_unit=="kg") selected @endif value="kg">Kilogram</option>
                                                        <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_weight_unit=="gm") selected @endif value="gm">Gram</option>
                                                        <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_weight_unit=="hlb") selected @endif value="hlb">Hundredths Pounds</option>
                                                        <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_weight_unit=="mg") selected @endif value="mg">Milligram</option>
                                                        <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_weight_unit=="tn") selected @endif value="tn">Ton</option>
                                                        <option @if($productInfo && $productInfo->ProductMoreDetail && $productInfo->ProductMoreDetail->package_weight_unit=="oz") selected @endif value="oz">Ounce</option>
                                                    </select>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">League Name</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="league_name" id="league_name" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->league_name}}" @endif class="form-control m-input" placeholder="MLB">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Warranty Description</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <textarea class="form-control" name="warranty_description" id="warranty_description" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->warranty_description}}" @endif placeholder="Manufacturer warranty for 90 days from date of purchase"></textarea>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Target Gender</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <select name="target_gender" id="target_gender" class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option @if($productInfo && $productInfo->ProductDetail && $productInfo->ProductDetail->target_gender=="Male") selected @endif value="Male">Male</option>
                                                        <option @if($productInfo && $productInfo->ProductDetail && $productInfo->ProductDetail->target_gender=="Female") selected @endif value="Female">Female</option>
                                                        <option @if($productInfo && $productInfo->ProductDetail && $productInfo->ProductDetail->target_gender=="Unisex") selected @endif value="Unisex">Unisex</option>
                                                    </select>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Team Name</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="team_name" id="team_name" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->team_name}}" @endif class="form-control m-input" placeholder="Arsenal">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Age Range Description</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="age_range_description" id="age_range_description" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->age_range_description}}" @endif class="form-control m-input" placeholder="3 months">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Lining Description</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="lining_description" id="lining_description" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->lining_description}}" @endif class="form-control m-input" placeholder="with warm lining">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Strap Type</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="strap_type" id="strap_type" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->strap_type}}" @endif class="form-control m-input" placeholder="ankle-wrap">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Handle Type</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="handle_type" id="handle_type" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->handle_type}}" @endif class="form-control m-input" placeholder="">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Number Of Compartments</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="number_of_compartment" id="number_of_compartment" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->number_of_compartment}}" @endif class="form-control m-input" placeholder="">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Number Of Wheels</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="number_of_wheel" id="number_of_wheel" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->number_of_wheel}}" @endif class="form-control m-input" placeholder="4">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Pocket Description</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="pocket_description" id="pocket_description" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->pocket_description}}" @endif class="form-control m-input" placeholder="">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Sheel Type</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="sheel_type" id="sheel_type" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->sheel_type}}" @endif class="form-control m-input" placeholder="">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right" style="font-size: 14px;">Wheel Type</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="wheel_type" id="wheel_type" @if($productInfo && $productInfo->ProductMoreDetail) value="{{$productInfo->ProductMoreDetail->wheel_type}}" @endif class="form-control m-input" placeholder="">
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
                            <!-- End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#category_id').select2({
        placeholder: 'Select An Option'
    });
    $('#brand_id').select2({
        placeholder: 'Select An Option'
    });
    $('#material_id').select2({
        placeholder: 'Select An Option'
    });
    $('#product_condition_id').select2({
        placeholder: 'Select An Option'
    });
    $('.bottom_size_map').select2({
        placeholder: 'Select An Option'
    });
    // $('.file-upload').file_upload();
</script>
@include('backend.product.js.product-js')
{!! Toastr::message() !!}
@endsection