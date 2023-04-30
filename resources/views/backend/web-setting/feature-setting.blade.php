@extends('layouts.backend_app')
@section('individual__link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
<!-- include summernote css/js-->

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 ml-auto">
                <p class="category h4">Add Feature Setting</p>
                <!-- Nav tabs -->
                <div class="card">
                    <div class="card-header">
                        <!-- justify-content-center -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link add_product_identity active" data-toggle="tab"
                                    href="#addProductIdentity" role="tab">
                                    <i class="now-ui-icons objects_umbrella-13"></i> Feature Setting
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane add_product_identity active" id="addProductIdentity" role="tabpanel">
                                <form method="post" id="add_product_identity">
                                    @csrf
                                    <div class="row">
                                        <!-- Start -->
                                        <div class="col-md-10">
                                            <!-- Start Content -->
                                            <div class="row">

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Feature Name</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <select class="form-select" name="condition_id" id="condition_id"
                                                        style="width: 100%;" required>
                                                        <option value="">Select Option</option>
                                                        @foreach($all_features AS $feature)
                                                        <option value="{{ $feature->id }}">{{ $feature->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Feature Location</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <select name="quantity_unit" id="quantity_unit" class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option value="home_page">Home Page</option>
                                                        <option value="product_details_page">Product Details Page
                                                        </option>
                                                        <option value="cart_page">Cart Page</option>
                                                    </select>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Category</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <select class="form-select" id="select-options">
                                                        <option value="">Select An Option</option>
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
                                                        @foreach($subSubSubCategory->SubCategory as
                                                        $subSubSubSubCategory)
                                                        <option value="{{$subSubSubSubCategory->id}}">
                                                            --------{{$subSubSubSubCategory->name}}
                                                        </option>
                                                        <!-- Start sub-Sub-Sub-Sub-Sub-Category -->
                                                        @if($subSubSubSubCategory->SubCategory)
                                                        @foreach($subSubSubSubCategory->SubCategory as
                                                        $subSubSubSubSubCategory)
                                                        <option value="{{$subSubSubSubSubCategory->id}}">
                                                            ----------{{$subSubSubSubSubCategory->name}}
                                                        </option>
                                                        <!-- Start sub-Sub-Sub-Sub-Sub-Sub-Category -->
                                                        @if($subSubSubSubSubCategory->SubCategory)
                                                        @foreach($subSubSubSubSubCategory->SubCategory as
                                                        $subSubSubSubSubSubCategory)
                                                        <option value="{{$subSubSubSubSubSubCategory->id}}">
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

                                                    <div>
                                                        <table class="table">
                                                            <tbody id="selected-options">

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Apply For Offer</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-1">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="is_phone_active" id="is_phone_active"
                                                            style="width: 50px; height: 20px;">
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Apply For Coupon</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-1">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="is_phone_active" id="is_phone_active"
                                                            style="width: 50px; height: 20px;">
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Status</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <select name="quantity_unit" id="quantity_unit" class="form-select">
                                                        <option value="">Select An Option</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-12 mt-md-3">
                                                    <button
                                                        class="float-right btn btn-success btn-sm ml-2">Submit</button>
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
                            <!-- End Product Identity -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$('#category_id').select2({
    placeholder: 'Select An Option'
});
$('#brand_id').select2({
    placeholder: 'Select An Option'
});
$('#product_feature_id').select2({
    placeholder: 'Select An Option'
});
$('#material_id').select2({
    placeholder: 'Select An Option'
});
$('#material_type_id').select2({
    placeholder: 'Select An Option'
});
$('#product_condition_id').select2({
    placeholder: 'Select An Option'
});
$('#condition_id').select2({
    placeholder: 'Select An Option'
});
$('#select-options').select2({
    placeholder: 'Select An Option'
});
$('.bottom_size_map').select2({
    placeholder: 'Select An Option'
});
// $('.file-upload').file_upload();
</script>
@include('backend.web-setting.js.feature-setting-js')
{!! Toastr::message() !!}
@endsection