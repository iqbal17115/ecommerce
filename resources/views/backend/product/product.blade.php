@extends('layouts.backend_app')
@section('individual__link')
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
<style>

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
                                <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                    <i class="now-ui-icons shopping_cart-simple"></i> Variations
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                                    <i class="now-ui-icons shopping_shop"></i> Offer
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> Compliance
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> Images
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> Description
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> Keywords
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
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
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Product Id</label>
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
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Product Name</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter product Name" name=""
                                                    id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Brand Name</label>
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
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Mobile Number</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter Mobile Number" name=""
                                                    id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Outer Material</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter Outer Material" name=""
                                                    id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Country/Region of Publication</label>
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
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Model Name</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input class="form-control" placeholder="Enter Model Name" name=""
                                                    id="" />
                                            </div>
                                            <!-- End -->
                                            <div class="col-md-4 mt-md-3">
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Material Type</label>
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
                                                <label class="col-form-label float-md-right" style="font-size: 14px;">Item Booking Date</label>
                                                <span class="text-danger float-md-right">*</span>
                                            </div>
                                            <div class="col-md-8 mt-md-3">
                                                <input type="date" class="form-control" placeholder="Enter Model Name" name=""
                                                    id="" />
                                            </div>
                                            <!-- End -->
                                        </div>
                                        <!-- End Content -->
                                    </div>
                                    <div class="col-md-2"></div>
                                    <!-- End -->
                                </div>
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel">
                                <p> I will be the leader of a company that ends up being worth billions of dollars,
                                    because I got the answers. I understand culture. I am the nucleus. I think
                                    that’s a responsibility that I have, to push possibilities, to show people, this
                                    is the level that things could be at. I think that’s a responsibility that I
                                    have, to push possibilities, to show people, this is the level that things could
                                    be at. </p>
                            </div>
                            <div class="tab-pane" id="messages" role="tabpanel">
                                <p>I think that’s a responsibility that I have, to push possibilities, to show
                                    people, this is the level that things could be at. So when you get something
                                    that has the name Kanye West on it, it’s supposed to be pushing the furthest
                                    possibilities. I will be the leader of a company that ends up being worth
                                    billions of dollars, because I got the answers. I understand culture. I am the
                                    nucleus.</p>
                            </div>
                            <div class="tab-pane" id="settings" role="tabpanel">
                                <p>
                                    "I will be the leader of a company that ends up being worth billions of dollars,
                                    because I got the answers. I understand culture. I am the nucleus. I think
                                    that’s a responsibility that I have, to push possibilities, to show people, this
                                    is the level that things could be at."
                                </p>
                            </div>
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
<script type="text/javascript">
$('#details').summernote({
    height: 200
});
$('#review').summernote({
    height: 200
});
$('#description').summernote({
    height: 200
});
$('#specification').summernote({
    height: 200
});
</script>
@endsection