@extends('layouts.backend_app')
@section('individual__link')
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
@endsection
@section('content')
<!-- include summernote css/js-->

<div class="card">
    <div class="card-body">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#productInformation" aria-expanded="true" aria-controls="productInformation">
                        Item Information
                    </button>
                </h2>
                <div id="productInformation" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        <div class="row">

                            <div class="col-md-2"><label class="col-form-label float-right">Item Name <span
                                        class="text-danger">*</span></label></div>
                            <div class="col-md-4">
                                <input class="form-control" placeholder="Item Name" id="ppp" />
                            </div>
                            <div class="col-md-2"><label class="col-form-label float-right">Category <span
                                        class="text-danger">*</span></label></div>
                            <div class="col-md-4">
                                <select class="form-select">
                                    <option value="">Select Option</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <!-- End -->
                            <div class="col-md-2"><label class="col-form-label float-right">Warrantee</label></div>
                            <div class="col-md-4 mt-md-1">
                                <input class="form-control" placeholder="Please enter number of months" />
                            </div>
                            <div class="col-md-2"><label class="col-form-label float-right">Bar Code</label></div>
                            <div class="col-md-4 mt-md-1">
                                <input class="form-control" placeholder="Please enter bar code" />
                            </div>
                            <!-- End -->
                            <div class="col-md-2"><label class="col-form-label float-right">Details</label></div>
                            <div class="col-md-10 mt-md-1">
                                <textarea class="form-control" name="details" id="details"></textarea>
                            </div>
                            <!-- End -->
                            <div class="col-md-2"><label class="col-form-label float-right">Invoice Details</label>
                            </div>
                            <div class="col-md-10 mt-md-1">
                                <textarea class="form-control" name="invoice_details" id="invoice_details"></textarea>
                            </div>
                            <!-- End -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#productWebStore" aria-expanded="false" aria-controls="productWebStore">
                        Web Store
                    </button>
                </h2>
                <div id="productWebStore" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        <div class="row">

                            <div class="col-md-2"><label class="col-form-label float-right">Unit <span
                                        class="text-danger">*</span></label></div>
                            <div class="col-md-4">
                                <select class="form-select">
                                    <option value="">Select Option</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-md-2"><label class="col-form-label float-right">Brand</label></div>
                            <div class="col-md-4">
                                <select class="form-select">
                                    <option value="">Select Option</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <!-- End -->
                            <div class="col-md-2"><label class="col-form-label float-right">Best Sale</label></div>
                            <div class="col-md-4 mt-md-1">
                                <select class="form-select">
                                    <option value="">Select Option</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-md-2"><label class="col-form-label float-right"></label></div>
                            <div class="col-md-4 mt-md-1"></div>
                            <!-- End -->
                            <div class="col-md-2 mt-md-1"><label class="col-form-label float-right">Review <span
                                        class="text-danger">*</span></label></div>
                            <div class="col-md-4 mt-md-1">
                                <textarea class="form-control" name="review" id="review"></textarea>
                            </div>
                            <div class="col-md-2 mt-md-1"><label class="col-form-label float-right">Description</label>
                            </div>
                            <div class="col-md-4 mt-md-1">
                                <textarea class="form-control" name="description" id="description"></textarea>
                            </div>
                            <!-- End -->
                            <div class="col-md-2"><label class="col-form-label float-right">Specification</label>
                            </div>
                            <div class="col-md-10 mt-md-1">
                                <textarea class="form-control" name="specification" id="specification"></textarea>
                            </div>
                            <!-- End -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#productPrice" aria-expanded="false" aria-controls="productPrice">
                        Price
                    </button>
                </h2>
                <div id="productPrice" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="col-form-label float-right">Sell Price <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" placeholder="Sell price"
                                            style="text-align: right;" />
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-4 mt-md-2">
                                        <label class="col-form-label float-right">Supplier Price <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 mt-md-2">
                                        <input class="form-control" placeholder="Supplier price"
                                            style="text-align: right;" />
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-4 mt-md-2">
                                        <label class="col-form-label float-right">Offer <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 mt-md-2">
                                        <select class="form-select">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-4 mt-md-2">
                                        <label class="col-form-label float-right">Item Code <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 mt-md-2">
                                        <input class="form-control" placeholder="Sell price" />
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-4 mt-md-2">
                                        <label class="col-form-label float-right">Variant Size <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 mt-md-2">
                                        <select class="form-select">
                                            <option value="">Select option</option>
                                            <option value="0">one</option>
                                            <option value="1">two</option>
                                        </select>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-4 mt-md-2">
                                        <label class="col-form-label float-right">Variant Color <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 mt-md-2">
                                        <select class="form-select">
                                            <option value="">Select option</option>
                                            <option value="0">one</option>
                                            <option value="1">two</option>
                                        </select>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-4 mt-md-2">

                                    </div>
                                    <div class="col-md-8 mt-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Set Variant wise Price
                                            </label>
                                        </div>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-4 mt-md-2">
                                        <label class="col-form-label float-right">Video Link</label>
                                    </div>
                                    <div class="col-md-8 mt-md-2">
                                        <input class="form-control" placeholder="Video Link" />
                                    </div>
                                    <!-- End -->
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#productImage" aria-expanded="false" aria-controls="productImage">
                        Image
                    </button>
                </h2>
                <div id="productImage" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 mt-md-2">
                                    <label class="col-form-label float-right">Default Image <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 mt-md-2">
                                        <div class="form-check">
                                        <input type="file" class="form-control" placeholder="Video Link" />
                                        </div>
                                    </div>
                                    <!-- End -->
                                    <div class="col-md-4 mt-md-2">
                                    <label class="col-form-label float-right">Gallery Image</label>
                                    </div>
                                    <div class="col-md-8 mt-md-2">
                                        <div class="form-check">
                                        <input type="file" class="form-control" placeholder="Video Link" />
                                        </div>
                                    </div>
                                    <!-- End -->
                                </div>
                            </div>
                            <div class="col-md-3"></div>
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