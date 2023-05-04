@extends('layouts.backend_app')
@section('individual__link')
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
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
                <p class="category h4">Add Feature Setting <a class="btn btn-info btn-sm float-right"
                        href="{{ route('feature') }}">List</a></p>

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
                                <form method="post" id="add_feature_setting">
                                    @csrf
                                    <div class="row">
                                        <!-- Start -->
                                        <div class="col-md-10">
                                            <!-- Start Content -->
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Feature Type</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-1">
                                                    <select name="card_feature" id="card_feature"
                                                        class="form-select" onchange="featureTypeCheck(this)" required>
                                                        <option value="">Select Option</option>
                                                        <option value="1" @if($featureInfo &&
                                                            $featureInfo->card_feature == 1)
                                                            selected @endif>Box Feature</option>
                                                        <option value="0" @if($featureInfo &&
                                                            $featureInfo->card_feature == 0)
                                                            selected @endif>Card Feature</option>
                                                    </select>
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Top Menu</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-1">
                                                    <select name="top_menu" id="top_menu"
                                                        class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option value="1" @if($featureInfo &&
                                                            $featureInfo->top_menu == 1)
                                                            selected @endif>Yes</option>
                                                        <option value="0" @if($featureInfo &&
                                                            $featureInfo->top_menu == 0)
                                                            selected @endif>No</option>
                                                    </select>
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3 feature-menu">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;"> Feature Area (After)</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3 feature-menu">
                                                    <select class="form-select" name="parent_product_feature_id"
                                                        id="parent_product_feature_id" style="width: 100%;">
                                                        <option value="">Select Option</option>
                                                        @foreach($all_card_features AS $card_feature)
                                                        <option value="{{ $card_feature->id }}" @if($featureSettingInfo
                                                            && $featureSettingInfo->parent_product_feature_id ==
                                                            $card_feature->id)
                                                            selected @endif>{{ $card_feature->name }}
                                                            ({{$card_feature->card_feature == 1? 'Box Feature' : 'Cart Feature'}})
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Feature Name</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <select class="form-select" name="feature_id" id="feature_id"
                                                        style="width: 100%;">
                                                        <option value="">Select Option</option>
                                                        @foreach($all_features AS $feature)
                                                        <option value="{{ $feature->id }}" @if($featureSettingInfo &&
                                                            $featureSettingInfo->product_feature_id == $feature->id)
                                                            selected @endif>{{ $feature->name }}
                                                            ({{$feature->card_feature == 1? 'Box Feature' : 'Cart Feature'}})
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
                                                <div class="col-md-4 mt-md-3 feature-menu">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Category</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-3 feature-menu">
                                                    <select class="form-select" id="select-options" name="select-options">
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

                                                    <div class="feature-menu">
                                                        <table class="table table-bordered">
                                                            <tbody id="selected-options">
                                                                @if($featureSettingInfo)
                                                                @foreach($featureSettingInfo->FeatureSettingDetail as
                                                                $feature_setting_detail)
                                                                <tr>
                                                                    <td class="text-danger">
                                                                        <input name="category_id[]" id="category_id"
                                                                            class="form-control"
                                                                            value="{{$feature_setting_detail->category_id}}"
                                                                            hidden />
                                                                        @if($feature_setting_detail->Category)
                                                                        {{$feature_setting_detail->Category->name}}
                                                                        @endif
                                                                    </td>
                                                                    <td><input name="position[]" id="position"
                                                                            class="form-control form-control-sm"
                                                                            value="{{$feature_setting_detail->position}}"
                                                                            placeholder="Position" required />
                                                                    </td>
                                                                    <td>
                                                                        <button type="button"
                                                                            class="btn btn-danger text-light btn-sm ml-1 p-1 remove-btn"><i
                                                                                class="mdi mdi-trash-can font-size-16"></i></button>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Feature Position</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-1">
                                                    <input name="feature_position"
                                                        id="feature_position" @if($featureInfo &&
                                                            $featureInfo->position)
                                                            value="{{$featureInfo->position}}" @endif class="form-control"  placeholder="Position" />
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 feature-menu">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Apply For Offer</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-1 feature-menu">
                                                    <select name="apply_for_offer" id="apply_for_offer"
                                                        class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option value="1" @if($featureSettingInfo &&
                                                            $featureSettingInfo->apply_for_offer == 1) selected
                                                            @endif>Yes</option>
                                                        <option value="0" @if($featureSettingInfo &&
                                                            $featureSettingInfo->apply_for_offer == 0) selected
                                                            @endif>No</option>
                                                    </select>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 feature-menu">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Apply For Coupon</label>
                                                    <span class="text-danger float-md-right">*</span>
                                                </div>
                                                <div class="col-md-8 mt-md-1 feature-menu">
                                                    <select name="apply_for_coupon" id="apply_for_coupon"
                                                        class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option value="1" @if($featureSettingInfo &&
                                                            $featureSettingInfo->apply_for_coupon == 1) selected
                                                            @endif>Yes</option>
                                                        <option value="0" @if($featureSettingInfo &&
                                                            $featureSettingInfo->apply_for_coupon == 0) selected
                                                            @endif>No</option>
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

$('#feature_id').select2({
    placeholder: 'Select An Option'
});
$('#parent_product_feature_id').select2({
    placeholder: 'Select An Option'
});

$('#select-options').select2({
    placeholder: 'Select An Option'
});

// $('.file-upload').file_upload();
</script>
@include('backend.web-setting.js.feature-setting-js')

@endsection