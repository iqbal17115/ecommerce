@extends('layouts.backend_app')
@section('individual__link')
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>

<style>
.container {
    padding: 50px 10%;
}

.box {
    position: relative;
    background: #ffffff;
    width: 100%;
}

.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
    border-bottom: 1px solid #f4f4f4;
    margin-bottom: 10px;
}

.box-tools {
    position: absolute;
    right: 10px;
    top: 5px;
}

.dropzone-wrapper {
    border: 2px dashed #91b0b3;
    color: #92b0b3;
    position: relative;
    height: 150px;
}

.dropzone-desc {
    position: absolute;
    margin: 0 auto;
    left: 0;
    right: 0;
    text-align: center;
    width: 40%;
    top: 50px;
    font-size: 16px;
}

.dropzone,
.dropzone:focus {
    position: absolute;
    outline: none !important;
    width: 100%;
    height: 150px;
    cursor: pointer;
    opacity: 0;
}

.dropzone-wrapper:hover,
.dropzone-wrapper.dragover {
    background: #ecf0f5;
}

.preview-zone {
    text-align: center;
}

.preview-zone .box {
    box-shadow: none;
    border-radius: 0;
    margin-bottom: 0;
}

.btn-primary {
    background-color: crimson;
    border: 1px solid #212121;
}

#rowAdder {
    margin-left: 17px;
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
                                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
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
                                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
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
                        <div class="tab-content text-center">
                            <div class="tab-pane active" id="vital_info" role="tabpanel">
                                <div class="row">
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
                                                <input class="form-control" placeholder="Enter product Id" name=""
                                                    id="" />
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
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Product Name</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter product Name" name=""
                                                    id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Brand Name</label>
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
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Mobile Number</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="mobile_number"><i
                                                                class="fas fa-phone"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Mobile Number" aria-label="Username"
                                                        aria-describedby="mobile_number">
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Outer Material</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter Outer Material" name=""
                                                    id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Country/Region of Publication</label>
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
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Model Name</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter Model Name" name=""
                                                    id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Material Type</label>
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
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Item Booking Date</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="product_booking_date"><i
                                                                class="fa fa-calendar" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="Ex: 50.00"
                                                        aria-label="Username" aria-describedby="product_booking_date">
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
                                <p>I think that’s a responsibility that I have, to push possibilities, to show
                                    people, this is the level that things could be at. So when you get something
                                    that has the name Kanye West on it, it’s supposed to be pushing the furthest
                                    possibilities. I will be the leader of a company that ends up being worth
                                    billions of dollars, because I got the answers. I understand culture. I am the
                                    nucleus.</p>
                            </div>
                            <div class="tab-pane" id="offer" role="tabpanel">
                                <div class="row">
                                    <!-- Start -->
                                    <div class="col-md-10">
                                        <!-- Start Content -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Seller SKU</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8">
                                                <input class="form-control" placeholder="Enter Seller SKU" name=""
                                                    id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Product Tax Code</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter Product Tax Code" name=""
                                                    id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Your Price</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="your_price">AED</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Ex: 50.00"
                                                        aria-label="Username" aria-describedby="your_price">
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Sale Price</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="sale_price">AED</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Ex: 50.00"
                                                        aria-label="Username" aria-describedby="sale_price">
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Sale Start Date</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="sale_start_date"><i
                                                                class="fa fa-calendar" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="Ex: 50.00"
                                                        aria-label="Username" aria-describedby="sale_start_date">
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Sale End Date</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="sale_end_date"><i
                                                                class="fa fa-calendar" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="Ex: 50.00"
                                                        aria-label="Username" aria-describedby="sale_end_date">
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Retail Price (Inclusive VAT)</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"
                                                            id="retail_price_inclusive_vat">AED</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Ex: 50.00"
                                                        aria-label="Username"
                                                        aria-describedby="retail_price_inclusive_vat">
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Condition</label>
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
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Condition Note</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <textarea class="form-control" name="condition_note"
                                                    id="condition_note"></textarea>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Max Order Qty</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter Max Order Qty" name=""
                                                    id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Handling Time</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter Handling Time" name=""
                                                    id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Offering Can Be Gift Messaged</label>
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
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Start Selling Date</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="start_selling_date"><i
                                                                class="fa fa-calendar" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="Ex: 50.00"
                                                        aria-label="Username" aria-describedby="start_selling_date">
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Restock Date</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="restock_date"><i
                                                                class="fa fa-calendar" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="Ex: 50.00"
                                                        aria-label="Username" aria-describedby="restock_date">
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

                            </div>
                            <div class="tab-pane" id="images" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="dropzone-wrapper">
                                                <div class="dropzone-desc">
                                                    <i class="fas fa-camera-retro text-dark"
                                                        style="font-size: 20px;"></i>
                                                    <p>Upload</p>
                                                </div>
                                                <input type="file" name="img_logo" class="dropzone">
                                            </div>
                                            <div class="preview-zone hidden">
                                                <div class="box box-solid">
                                                    <div class="box-header with-border">
                                                        <div><b>Preview</b></div>
                                                        <div class="box-tools pull-right">
                                                        </div>
                                                    </div>
                                                    <div class="box-body"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="dropzone-wrapper">
                                                <div class="dropzone-desc">
                                                    <i class="fas fa-camera-retro text-dark"
                                                        style="font-size: 20px;"></i>
                                                    <p>Upload</p>
                                                </div>
                                                <input type="file" name="img_logo" class="dropzone">
                                            </div>
                                            <div class="preview-zone hidden">
                                                <div class="box box-solid">
                                                    <div class="box-header with-border">
                                                        <div><b>Preview</b></div>
                                                        <div class="box-tools pull-right">
                                                        </div>
                                                    </div>
                                                    <div class="box-body"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="dropzone-wrapper">
                                                <div class="dropzone-desc">
                                                    <i class="fas fa-camera-retro text-dark"
                                                        style="font-size: 20px;"></i>
                                                    <p>Upload</p>
                                                </div>
                                                <input type="file" name="img_logo" class="dropzone">
                                            </div>
                                            <div class="preview-zone hidden">
                                                <div class="box box-solid">
                                                    <div class="box-header with-border">
                                                        <div><b>Preview</b></div>
                                                        <div class="box-tools pull-right">
                                                        </div>
                                                    </div>
                                                    <div class="box-body"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="dropzone-wrapper">
                                                <div class="dropzone-desc">
                                                    <i class="fas fa-camera-retro text-dark"
                                                        style="font-size: 20px;"></i>
                                                    <p>Upload</p>
                                                </div>
                                                <input type="file" name="img_logo" class="dropzone">
                                            </div>
                                            <div class="preview-zone hidden">
                                                <div class="box box-solid">
                                                    <div class="box-header with-border">
                                                        <div><b>Preview</b></div>
                                                        <div class="box-tools pull-right">
                                                        </div>
                                                    </div>
                                                    <div class="box-body"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="dropzone-wrapper">
                                                <div class="dropzone-desc">
                                                    <i class="fas fa-camera-retro text-dark"
                                                        style="font-size: 20px;"></i>
                                                    <p>Upload</p>
                                                </div>
                                                <input type="file" name="img_logo" class="dropzone">
                                            </div>
                                            <div class="preview-zone hidden">
                                                <div class="box box-solid">
                                                    <div class="box-header with-border">
                                                        <div><b>Preview</b></div>
                                                        <div class="box-tools pull-right">
                                                        </div>
                                                    </div>
                                                    <div class="box-body"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="dropzone-wrapper">
                                                <div class="dropzone-desc">

                                                    <i class="fas fa-camera-retro text-dark"
                                                        style="font-size: 20px;"></i>
                                                    <p>Upload</p>
                                                </div>
                                                <input type="file" name="img_logo" class="dropzone">
                                            </div>
                                            <div class="preview-zone hidden">
                                                <div class="box box-solid">
                                                    <div class="box-header with-border">
                                                        <div><b>Preview</b></div>
                                                        <div class="box-tools pull-right">
                                                        </div>
                                                    </div>
                                                    <div class="box-body"></div>
                                                </div>
                                            </div>
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
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Product Description</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <textarea class="form-control" name="product_description"
                                                    id="product_description"></textarea>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Key Product Features</label>
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
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Closure Type</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="zipper">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Manufacturer</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="Philips">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Manufacturer Part Number</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="SB-122">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Number of Items</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input" placeholder="1">
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
                                                                class="fa fa-calendar" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" aria-label="Username"
                                                        aria-describedby="release_date">
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Fabric Type</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input"
                                                    placeholder="cotton, plastic">
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
                                                        <input type="text" class="form-control m-input"
                                                            placeholder="10.33, 5.50, 15000.0">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12" style="text-align: left;">
                                                        <label class="col-form-label"
                                                            style="font-size: 14px;">Width</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control m-input"
                                                            placeholder="10.33, 5.50, 15000.0">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12" style="text-align: left;">
                                                        <label class="col-form-label"
                                                            style="font-size: 14px;">Height</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control m-input"
                                                            placeholder="10.33, 5.50, 15000.0">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
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
                                                            style="font-size: 14px;">Package Height</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control m-input"
                                                            placeholder="3.45">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12" style="text-align: left;">
                                                        <label class="col-form-label"
                                                            style="font-size: 14px;">Package Length</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control m-input"
                                                            placeholder="400, 2, 3, 3.54">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12" style="text-align: left;">
                                                        <label class="col-form-label"
                                                            style="font-size: 14px;">Package Width</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control m-input"
                                                            placeholder="400, 2, 3, 3.54">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select">
                                                            <option value="">Select Option</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
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
                                                <input class="form-control" placeholder="45" name=""
                                                    id="" />
                                            </div>
                                            <div class="col-md-4 mt-md-3">
                                                <select class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">League Name</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="text" class="form-control m-input"
                                                    placeholder="MLB">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Warranty Description</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <textarea class="form-control" name="warranty_description"
                                                    id="warranty_description" placeholder="Manufacturer warranty for 90 days from date of purchase"></textarea>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Target Gender</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <select class="form-select">
                                                    <option value="">Select Option</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                </select>
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Team Name</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                            <input type="text" class="form-control m-input"
                                                    placeholder="Arsenal">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Age Range Description</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                            <input type="text" class="form-control m-input"
                                                    placeholder="3 months">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Lining Description</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                            <input type="text" class="form-control m-input"
                                                    placeholder="with warm lining">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Strap Type</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                            <input type="text" class="form-control m-input"
                                                    placeholder="ankle-wrap">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Handle Type</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                            <input type="text" class="form-control m-input"
                                                    placeholder="">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Number Of Compartments</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                            <input type="text" class="form-control m-input"
                                                    placeholder="">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Number Of Wheels</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                            <input type="text" class="form-control m-input"
                                                    placeholder="4">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Pocket Description</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                            <input type="text" class="form-control m-input"
                                                    placeholder="">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Sheel Type</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                            <input type="text" class="form-control m-input"
                                                    placeholder="">
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right"
                                                    style="font-size: 14px;">Wheel Type</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                            <input type="text" class="form-control m-input"
                                                    placeholder="">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@include('backend.product.js.product-js')
@endsection