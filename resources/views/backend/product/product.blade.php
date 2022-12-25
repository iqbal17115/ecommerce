@extends('layouts.backend_app')
@section('individual__link')
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
                                <a class="nav-link active" data-toggle="tab" href="#vital_info" role="tab">
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
                            <div class="tab-pane active" id="vital_info" role="tabpanel">
                                <div class="row">
                                    <!-- Start -->
                                    <div class="col-md-10">
                                        <!-- Start Content -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Product Id</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-4">
                                                <input class="form-control" placeholder="Enter product Id" name="" id="" />
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option value="1">Gtin</option>
                                                    <option value="2">Ean</option>
                                                    <option value="3">Gcid</option>
                                                    <option value="4">Upc</option>
                                                    <option value="5">asin</option>
                                                    <option value="6">ISBN</option>
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Product Name</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter product Name" name="" id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Category Name</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <select class="form-select" id="category_id" onchange="variantByCategory(this)">
                                                    <option value=""></option>
                                                    @foreach($categories as $category)
                                                    <option value="{{$category->id}}">
                                                        {{$category->name}}
                                                    </option>
                                                    <!-- Start Sub-Category -->
                                                    @if($category->SubCategory)
                                                    @foreach($category->SubCategory as $subCategory)
                                                    <option value="{{$subCategory->id}}">
                                                        --{{$subCategory->name}}
                                                    </option>
                                                    <!-- Start sub-Sub-Category -->
                                                    @if($subCategory->SubCategory)
                                                    @foreach($subCategory->SubCategory as $subSubCategory)
                                                    <option value="{{$subSubCategory->id}}">
                                                        ----{{$subSubCategory->name}}
                                                    </option>
                                                    <!-- Start sub-Sub-Sub-Category -->
                                                    @if($subSubCategory->SubCategory)
                                                    @foreach($subSubCategory->SubCategory as $subSubSubCategory)
                                                    <option value="{{$subSubSubCategory->id}}">
                                                        ------{{$subSubSubCategory->name}}
                                                    </option>
                                                    <!-- Start sub-Sub-Sub-Sub-Category -->
                                                    @if($subSubSubCategory->SubCategory)
                                                    @foreach($subSubSubCategory->SubCategory as $subSubSubSubCategory)
                                                    <option value="{{$subSubSubSubCategory->id}}">
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
                                                <select class="form-select" id="brand_id">
                                                    <option value=""></option>
                                                    @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Mobile Number</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="mobile_number"><i class="fas fa-phone"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Enter Mobile Number" aria-label="Username" aria-describedby="mobile_number">
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Outer Material</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter Outer Material" name="" id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Country/Region of Publication</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <select class="form-select">
                                                    @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Model Name</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter Model Name" name="" id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Material Type</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <select class="form-select" id="material_id">
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
                                                    <input type="date" class="form-control" placeholder="Ex: 50.00" aria-label="Username" aria-describedby="product_booking_date">
                                                </div>
                                            </div>
                                            <!-- End -->
                                        </div>
                                        <!-- End Content -->
                                    </div>
                                    <div class="col-md-2"></div>
                                    <!-- End -->
                                </div>
                            </div>
                            <div class="tab-pane" id="variations" role="tabpanel">
                                <div class="row">
                                    <input type="hidden" value="0" name="hidden_value_1" id="hidden_value_1" />
                                    <input type="hidden" value="0" name="hidden_value_2" id="hidden_value_2" />
                                    <input type="hidden" value="0" name="hidden_value_3" id="hidden_value_3" />
                                    <input type="hidden" value="0" name="hidden_value_4" id="hidden_value_4" />
                                    <input type="hidden" value="0" name="hidden_value_5" id="hidden_value_5" />
                                    <input type="hidden" value="0" name="hidden_value_6" id="hidden_value_6" />
                                    <input type="hidden" value="0" name="hidden_value_7" id="hidden_value_7" />
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
                                            <!-- Start Color -->
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4" id="add_package_qty">

                                            </div>
                                            <div class="col-md-4" id="all_package_qty"></div>
                                            <!-- End Color -->
                                            <!-- Start Color -->
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4" id="add_material_type">

                                            </div>
                                            <div class="col-md-4" id="all_material_type"></div>
                                            <!-- End Color -->
                                            <!-- Start Color -->
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4" id="add_wattage">

                                            </div>
                                            <div class="col-md-4" id="all_wattage"></div>
                                            <!-- End Color -->
                                            <!-- Start Color -->
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4" id="add_number_of_items">

                                            </div>
                                            <div class="col-md-4" id="all_number_of_items"></div>
                                            <!-- End Color -->
                                            <!-- Start Color -->
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4" id="add_style_name">

                                            </div>
                                            <div class="col-md-4" id="all_style_name"></div>
                                            <!-- End Color -->
                                        </div>
                                    </div>
                                    <!-- End Content -->
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11" id="variation_content">
                                                <!-- Start -->
                                                <!-- <div class="col-md-12" id="variation_head" style="display: flex;">
                                                    </div> -->
                                                <div class="row" id="variation_row"></div>
                                                <!-- End -->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="offer" role="tabpanel">
                                <div class="row">
                                    <!-- Start -->
                                    <div class="col-md-10">
                                        <!-- Start Content -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Seller SKU</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8">
                                                <input class="form-control" placeholder="Enter Seller SKU" name="" id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Product Tax Code</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter Product Tax Code" name="" id="" />
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
                                                    <input type="text" class="form-control" placeholder="Ex: 50.00" aria-label="Username" aria-describedby="your_price">
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
                                                    <input type="text" class="form-control" placeholder="Ex: 50.00" aria-label="Username" aria-describedby="sale_price">
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
                                                        <span class="input-group-text" id="sale_start_date"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="Ex: 50.00" aria-label="Username" aria-describedby="sale_start_date">
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
                                                        <span class="input-group-text" id="sale_end_date"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="Ex: 50.00" aria-label="Username" aria-describedby="sale_end_date">
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
                                                    <input type="text" class="form-control" placeholder="Ex: 50.00" aria-label="Username" aria-describedby="retail_price_inclusive_vat">
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Condition</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <select class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option value="New">New</option>
                                                    <option value="Used">Used</option>
                                                    <option value="Refurbished">Refurbished</option>
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Condition Note</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <textarea class="form-control" name="condition_note" id="condition_note"></textarea>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Max Order Qty</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter Max Order Qty" name="" id="" />
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
                                                <select class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Is
                                                    Gift Wrap Available?</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <select class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
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
                                                        <span class="input-group-text" id="start_selling_date"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="Ex: 50.00" aria-label="Username" aria-describedby="start_selling_date">
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
                                                        <span class="input-group-text" id="restock_date"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="Ex: 50.00" aria-label="Username" aria-describedby="restock_date">
                                                </div>
                                            </div>
                                            <!-- End -->
                                        </div>
                                        <!-- End Content -->
                                    </div>
                                    <div class="col-md-2"></div>
                                    <!-- End -->
                                </div>
                            </div>
                            <div class="tab-pane" id="compliance" role="tabpanel">
                                <!-- Start -->
                                <div class="col-md-10">
                                    <!-- Start Content -->
                                    <div class="row">
                                        <div class="col-md-4 mt-md-3">
                                            <label class="col-form-label float-md-right" style="font-size: 14px;">Battery Cell Type</label>
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
                                            <label class="col-form-label float-md-right" style="font-size: 14px;">Battery Type</label>
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
                                            <label class="col-form-label float-md-right" style="font-size: 14px;">Number
                                                of Batteries Required</label>
                                        </div>
                                        <div class="col-md-8 mt-md-3">
                                            <input class="form-control" placeholder="Number of Batteries Required" name="" id="" />
                                        </div>
                                        <!-- End -->
                                        <div class="col-md-4 mt-md-3">
                                            <label class="col-form-label float-md-right" style="font-size: 14px;">Lithium Battery Energy Content</label>
                                        </div>
                                        <div class="col-md-8 mt-md-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input class="form-control" placeholder="1, 2, 3" name="" id="" />
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End -->
                                        <div class="col-md-4 mt-md-3">
                                            <label class="col-form-label float-md-right" style="font-size: 14px;">Lithium Battery Packaging</label>
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
                                            <label class="col-form-label float-md-right" style="font-size: 14px;">Batteries are Included</label>
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
                                            <label class="col-form-label float-md-right" style="font-size: 14px;">Are
                                                Batteries Required</label>
                                        </div>
                                        <div class="col-md-8 mt-md-3">
                                            <select class="form-select">
                                                <option value="">Select Option</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <!-- End -->
                                        <div class="col-md-4 mt-md-3">
                                            <label class="col-form-label float-md-right" style="font-size: 14px;">Battery Weight</label>
                                        </div>
                                        <div class="col-md-8 mt-md-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input class="form-control" placeholder="150" name="" id="" />
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
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
                                            <input class="form-control" placeholder="1, 2, 3" name="" id="" />
                                        </div>
                                        <!-- End -->
                                        <div class="col-md-4 mt-md-3">
                                            <label class="col-form-label float-md-right" style="font-size: 14px;">Number
                                                of Lithium-ion Cells</label>
                                        </div>
                                        <div class="col-md-8 mt-md-3">
                                            <input class="form-control" placeholder="1, 2, 3" name="" id="" />
                                        </div>
                                        <!-- End -->
                                        <div class="col-md-4 mt-md-3">
                                            <label class="col-form-label float-md-right" style="font-size: 14px;">Lithium Battery Weight</label>
                                        </div>
                                        <div class="col-md-8 mt-md-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input class="form-control" placeholder="0.9" name="" id="" />
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
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
                                            <input class="form-control" placeholder="UN1950" name="" id="" />
                                        </div>
                                        <!-- End -->
                                        <div class="col-md-4 mt-md-3">
                                            <label class="col-form-label float-md-right" style="font-size: 14px;">Safety
                                                Data Sheet URL</label>
                                        </div>
                                        <div class="col-md-8 mt-md-3">
                                            <input class="form-control" placeholder="https://www.facebook.com/" name="" id="" />
                                        </div>
                                        <!-- End -->
                                        <div class="col-md-4 mt-md-3">
                                            <label class="col-form-label float-md-right" style="font-size: 14px;">Volume</label>
                                        </div>
                                        <div class="col-md-8 mt-md-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input class="form-control" placeholder="34.78" name="" id="" />
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
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
                                            <input class="form-control" placeholder="180" name="" id="" />
                                        </div>
                                        <!-- End -->
                                        <div class="col-md-4 mt-md-3">
                                            <label class="col-form-label float-md-right" style="font-size: 14px;">Item
                                                Weight</label>
                                        </div>
                                        <div class="col-md-8 mt-md-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input class="form-control" placeholder="2.33, 20.75, 10000.00" name="" id="" />
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
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
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <!-- End -->
                            </div>
                            <div class="tab-pane" id="images" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="drop-zone">
                                            <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                            <input type="file" name="myFile" class="drop-zone__input">
                                        </div>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-2">
                                        <div class="drop-zone">
                                            <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                            <input type="file" name="myFile" class="drop-zone__input">
                                        </div>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-2">
                                        <div class="drop-zone">
                                            <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                            <input type="file" name="myFile" class="drop-zone__input">
                                        </div>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-2">
                                        <div class="drop-zone">
                                            <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                            <input type="file" name="myFile" class="drop-zone__input">
                                        </div>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-2">
                                        <div class="drop-zone">
                                            <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                            <input type="file" name="myFile" class="drop-zone__input">
                                        </div>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-2">
                                        <div class="drop-zone">
                                            <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                            <input type="file" name="myFile" class="drop-zone__input">
                                        </div>
                                    </div>
                                    <!-- End -->
                                </div>
                            </div>
                            <div class="tab-pane" id="description" role="tabpanel">
                                <div class="row">
                                    <!-- Start -->
                                    <div class="col-md-10">
                                        <!-- Start Content -->
                                        <div class="row">
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Product Description</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <textarea class="form-control" name="product_description" id="product_description"></textarea>
                                            </div>
                                            <!-- End -->
                                        </div>
                                        <!-- End Content -->
                                    </div>
                                    <div class="col-md-2"></div>
                                    <!-- End -->
                                </div>
                            </div>
                            <!-- End -->
                            <div class="tab-pane" id="keywords" role="tabpanel">
                                <div class="row">
                                    <!-- Start -->
                                    <div class="col-md-10">
                                        <!-- Start Content -->
                                        <div class="row">
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Key Product Features</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div id="row">
                                                    <div class="input-group m-3">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-danger" id="DeleteRow" type="button">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </div>
                                                        <input type="text" class="form-control m-input">
                                                    </div>
                                                </div>

                                                <div id="newinput"></div>
                                                <button id="rowAdder" type="button" class="btn btn-dark">
                                                    <i class="fas fa-plus-square"></i> ADD
                                                </button>
                                            </div>
                                            <!-- End -->
                                        </div>
                                        <!-- End Content -->
                                    </div>
                                    <div class="col-md-2"></div>
                                    <!-- End -->
                                </div>
                            </div>
                            <!-- End -->
                            <div class="tab-pane" id="more_details" role="tabpanel">
                                <div class="row">
                                    <!-- Start -->
                                    <div class="col-md-10">
                                        <!-- Start Content -->
                                        <div class="row">
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Closure Type</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="zipper">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Manufacturer</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="Philips">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Manufacturer Part Number</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="SB-122">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Number of Items</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="1">
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
                                                    <input type="date" class="form-control" aria-label="Username" aria-describedby="release_date">
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Fabric Type</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="cotton, plastic">
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
                                                        <input type="text" class="form-control m-input" placeholder="10.33, 5.50, 15000.0">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option value="dm">Decimeter</option>
                                                            <option value="mm">Milimeter</option>
                                                            <option value="cm">Centimeter</option>
                                                            <option value="m">Meter</option>
                                                            <option value="Å">Angstrom</option>
                                                            <option value="mil">Mil</option>
                                                            <option value="yd">Yards</option>
                                                            <option value="pm">Picometer</option>
                                                            <option value="mi">Mile</option>
                                                            <option value="in">Inch</option>
                                                            <option value="ft">Feet</option>
                                                            <option value="hin">Hundredths Inch</option>
                                                            <option value="nm">Nanometer</option>
                                                            <option value="ft">Feet</option>
                                                            <option value="μm">Micrometre</option>
                                                            <option value="km">Kilometers</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12" style="text-align: left;">
                                                        <label class="col-form-label" style="font-size: 14px;">Width</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control m-input" placeholder="10.33, 5.50, 15000.0">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option value="dm">Decimeter</option>
                                                            <option value="mm">Milimeter</option>
                                                            <option value="cm">Centimeter</option>
                                                            <option value="m">Meter</option>
                                                            <option value="Å">Angstrom</option>
                                                            <option value="mil">Mil</option>
                                                            <option value="yd">Yards</option>
                                                            <option value="pm">Picometer</option>
                                                            <option value="mi">Mile</option>
                                                            <option value="in">Inch</option>
                                                            <option value="ft">Feet</option>
                                                            <option value="hin">Hundredths Inch</option>
                                                            <option value="nm">Nanometer</option>
                                                            <option value="ft">Feet</option>
                                                            <option value="μm">Micrometre</option>
                                                            <option value="km">Kilometers</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12" style="text-align: left;">
                                                        <label class="col-form-label" style="font-size: 14px;">Height</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control m-input" placeholder="10.33, 5.50, 15000.0">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option value="dm">Decimeter</option>
                                                            <option value="mm">Milimeter</option>
                                                            <option value="cm">Centimeter</option>
                                                            <option value="m">Meter</option>
                                                            <option value="Å">Angstrom</option>
                                                            <option value="mil">Mil</option>
                                                            <option value="yd">Yards</option>
                                                            <option value="pm">Picometer</option>
                                                            <option value="mi">Mile</option>
                                                            <option value="in">Inch</option>
                                                            <option value="ft">Feet</option>
                                                            <option value="hin">Hundredths Inch</option>
                                                            <option value="nm">Nanometer</option>
                                                            <option value="ft">Feet</option>
                                                            <option value="μm">Micrometre</option>
                                                            <option value="km">Kilometers</option>
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
                                                        <input type="text" class="form-control m-input" placeholder="3.45">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option value="dm">Decimeter</option>
                                                            <option value="mm">Milimeter</option>
                                                            <option value="cm">Centimeter</option>
                                                            <option value="m">Meter</option>
                                                            <option value="Å">Angstrom</option>
                                                            <option value="mil">Mil</option>
                                                            <option value="yd">Yards</option>
                                                            <option value="pm">Picometer</option>
                                                            <option value="mi">Mile</option>
                                                            <option value="in">Inch</option>
                                                            <option value="ft">Feet</option>
                                                            <option value="hin">Hundredths Inch</option>
                                                            <option value="nm">Nanometer</option>
                                                            <option value="ft">Feet</option>
                                                            <option value="μm">Micrometre</option>
                                                            <option value="km">Kilometers</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12" style="text-align: left;">
                                                        <label class="col-form-label" style="font-size: 14px;">Package
                                                            Length</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control m-input" placeholder="400, 2, 3, 3.54">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option value="dm">Decimeter</option>
                                                            <option value="mm">Milimeter</option>
                                                            <option value="cm">Centimeter</option>
                                                            <option value="m">Meter</option>
                                                            <option value="Å">Angstrom</option>
                                                            <option value="mil">Mil</option>
                                                            <option value="yd">Yards</option>
                                                            <option value="pm">Picometer</option>
                                                            <option value="mi">Mile</option>
                                                            <option value="in">Inch</option>
                                                            <option value="ft">Feet</option>
                                                            <option value="hin">Hundredths Inch</option>
                                                            <option value="nm">Nanometer</option>
                                                            <option value="ft">Feet</option>
                                                            <option value="μm">Micrometre</option>
                                                            <option value="km">Kilometers</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12" style="text-align: left;">
                                                        <label class="col-form-label" style="font-size: 14px;">Package
                                                            Width</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control m-input" placeholder="400, 2, 3, 3.54">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option value="dm">Decimeter</option>
                                                            <option value="mm">Milimeter</option>
                                                            <option value="cm">Centimeter</option>
                                                            <option value="m">Meter</option>
                                                            <option value="Å">Angstrom</option>
                                                            <option value="mil">Mil</option>
                                                            <option value="yd">Yards</option>
                                                            <option value="pm">Picometer</option>
                                                            <option value="mi">Mile</option>
                                                            <option value="in">Inch</option>
                                                            <option value="ft">Feet</option>
                                                            <option value="hin">Hundredths Inch</option>
                                                            <option value="nm">Nanometer</option>
                                                            <option value="ft">Feet</option>
                                                            <option value="μm">Micrometre</option>
                                                            <option value="km">Kilometers</option>
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
                                                <input class="form-control" placeholder="45" name="" id="" />
                                            </div>
                                            <div class="col-md-4 mt-md-3">
                                                <select class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option value="lb">Pound</option>
                                                    <option value="kg">Kilogram</option>
                                                    <option value="gm">Gram</option>
                                                    <option value="hlb">Hundredths Pounds</option>
                                                    <option value="mg">Milligram</option>
                                                    <option value="tn">Ton</option>
                                                    <option value="oz">Ounce</option>
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">League Name</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="MLB">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Warranty Description</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <textarea class="form-control" name="warranty_description" id="warranty_description" placeholder="Manufacturer warranty for 90 days from date of purchase"></textarea>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Target Gender</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <select class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Unisex">Unisex</option>
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Team Name</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="Arsenal">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Age Range Description</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="3 months">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Lining Description</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="with warm lining">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Strap Type</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="ankle-wrap">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Handle Type</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Number Of Compartments</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Number Of Wheels</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="4">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Pocket Description</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Sheel Type</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Wheel Type</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="">
                                            </div>
                                            <!-- End -->
                                        </div>
                                        <!-- End Content -->
                                    </div>
                                    <div class="col-md-2"></div>
                                    <!-- End -->
                                </div>
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
    $('.file-upload').file_upload();
</script>
@include('backend.product.js.product-js')
@endsection