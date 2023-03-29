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
                <p class="category h4"> Company Info</p>
                <!-- Nav tabs -->
                <div class="card">
                    <div class="card-header">
                        <!-- justify-content-center -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#addVitalInfo" role="tab">
                                    <i class="now-ui-icons objects_umbrella-13"></i> Info
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#links" role="tab">
                                    <i class="now-ui-icons shopping_cart-simple"></i> Link
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#aboutUs" role="tab">
                                    <i class="now-ui-icons shopping_shop"></i> About Us
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#termsCondition" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> Terms & Condition
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#privacyPolicy" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> Privacy Policy
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#returnPolicy" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> Return Policy
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#activeInactiveStatus" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> Status
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="addVitalInfo" role="tabpanel">
                                <!-- Start Info -->
                                <form method="post" id="company_vital_info">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="row">

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Company Name</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="name" id="name" @if($company_info)
                                                        value="{{$company_info->name}}" @endif class="form-control"
                                                        placeholder="Company Name">
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">

                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Logo</label>
                                                    @if($company_info && $company_info->logo)
                                                    <img src="{{ asset('storage/'.$company_info->logo) }}"
                                                        class="rounded float-md-right"
                                                        style="width: 55px; height: 30px; background: black;"
                                                        alt="ff" />
                                                    @endif
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="file" name="logo" id="logo" class="form-control">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">

                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Footer Logo</label>
                                                    @if($company_info && $company_info->logo)
                                                    <img src="{{ asset('storage/'.$company_info->footer_logo) }}"
                                                        class="rounded float-md-right"
                                                        style="width: 55px; height: 30px;"
                                                        alt="ff" />
                                                    @endif
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="file" name="footer_logo" id="footer_logo" class="form-control">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Icon</label>
                                                    @if($company_info && $company_info->icon)
                                                    <img src="{{ asset('storage/'.$company_info->icon) }}"
                                                        class="rounded float-md-right"
                                                        style="width: 55px; height: 30px;"
                                                        alt="ff" />
                                                    @endif
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="file" name="icon" id="icon" class="form-control">
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Footer Image</label>
                                                    @if($company_info && $company_info->footer_image)
                                                    <img src="{{ asset('storage/'.$company_info->footer_image) }}"
                                                        class="rounded float-md-right"
                                                        style="width: 55px; height: 30px;"
                                                        alt="ff" />
                                                    @endif
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="file" name="footer_image" id="icon"
                                                        class="form-control">
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Footer Payment Image</label>
                                                    @if($company_info && $company_info->footer_payment_image)
                                                    <img src="{{ asset('storage/'.$company_info->footer_payment_image) }}"
                                                        class="rounded float-md-right"
                                                        style="width: 55px; height: 30px; background: black;"
                                                        alt="ff" />
                                                    @endif
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="file" name="footer_payment_image" id="icon"
                                                        class="form-control">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Flag</label>
                                                    @if($company_info && $company_info->country_flag)
                                                    <img src="{{ asset('storage/'.$company_info->country_flag) }}"
                                                        class="rounded float-md-right"
                                                        style="width: 55px; height: 30px; background: black;"
                                                        alt="ff" />
                                                    @endif
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="file" name="country_flag" id="icon"
                                                        class="form-control">
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Phone</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="phone" id="phone" @if($company_info)
                                                        value="{{$company_info->phone}}" @endif class="form-control"
                                                        placeholder="Phone">
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Mobile</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="mobile" id="mobile" @if($company_info)
                                                        value="{{$company_info->mobile}}" @endif class="form-control"
                                                        placeholder="Mobile">
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Email</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="email" name="email" id="email" @if($company_info)
                                                        value="{{$company_info->email}}" @endif class="form-control"
                                                        placeholder="Email">
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Hotline</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="hotline" id="hotline" @if($company_info)
                                                        value="{{$company_info->hotline}}" @endif class="form-control"
                                                        placeholder="Hotline">
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Address</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="address" id="address" @if($company_info)
                                                        value="{{$company_info->address}}" @endif class="form-control"
                                                        placeholder="Address">
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Google map</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="google_map_location" @if($company_info)
                                                        value="{{$company_info->google_map_location}}" @endif
                                                        id="google_map_location" class="form-control"
                                                        placeholder="Google map">
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Website</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="web" id="web" @if($company_info)
                                                        value="{{$company_info->web}}" @endif class="form-control"
                                                        placeholder="Website">
                                                </div>
                                                <!-- End -->


                                                <div class="col-md-12 mt-md-3">
                                                    <button class="float-right btn btn-success btn-sm">Save</button>
                                                </div>
                                                <!-- End -->
                                            </div>
                                        </div>
                                        <div class="col-md-2">

                                        </div>
                                        <!-- End -->
                                    </div>
                                </form>
                                <!-- End Info -->
                            </div>
                            <div class="tab-pane" id="links" role="tabpanel">
                                <!-- Start Link -->
                                <form method="post" id="add_link">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="row">

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Video Link</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="video_link" @if($company_info)
                                                        value="{{$company_info->video_link}}" @endif id="video_link"
                                                        class="form-control" placeholder="Video Link">
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Video Title</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="video_title" @if($company_info)
                                                        value="{{$company_info->video_title}}" @endif id="video_title"
                                                        class="form-control" placeholder="Video Title">
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Facebook Link</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="facebook_link" @if($company_info)
                                                        value="{{$company_info->facebook_link}}" @endif
                                                        id="facebook_link" class="form-control"
                                                        placeholder="Facebook Link">
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Youtube Link</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <input type="text" name="youtube_link" @if($company_info)
                                                        value="{{$company_info->youtube_link}}" @endif id="youtube_link"
                                                        class="form-control" placeholder="Youtube Link">
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-12 mt-md-3">
                                                    <button class="float-right btn btn-success btn-sm">Save</button>
                                                </div>
                                                <!-- End -->
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <!-- End -->
                                    </div>
                                </form>
                                <!-- End Link -->
                            </div>
                            <div class="tab-pane" id="aboutUs" role="tabpanel">
                                <!-- Start About Us -->
                                <form method="post" id="add_about_us">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">About Us</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <textarea class="form-control" name="about_us" id="about_us"
                                                        placeholder="About Us">
                                                        @if($company_info && $company_info->about_us)
                                                        {!! $company_info->about_us !!}
                                                        @endif 
                                                    </textarea>
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-12 mt-md-3">
                                                    <button class="float-right btn btn-success btn-sm">Save</button>
                                                </div>
                                                <!-- End -->
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <!-- End -->
                                    </div>
                                </form>
                                <!-- End About Us -->
                            </div>
                            <div class="tab-pane" id="termsCondition" role="tabpanel">
                                <!-- Start Terms & Condition -->
                                <form method="post" id="add_term_condition">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Terms & Condition</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <textarea class="form-control" name="terms_condition"
                                                        id="terms_condition" placeholder="Terms & Condition">
                                                        @if($company_info && $company_info->terms_condition)
                                                        {!! $company_info->terms_condition !!}
                                                        @endif 
                                                    </textarea>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-12 mt-md-3">
                                                    <button class="float-right btn btn-success btn-sm">Save</button>
                                                </div>
                                                <!-- End -->
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <!-- End -->
                                    </div>
                                </form>
                                <!-- End Terms & Condition -->
                            </div>
                            <div class="tab-pane" id="privacyPolicy" role="tabpanel">
                                <!-- Start Privacy Policy -->
                                <form method="post" id="add_privacy_policy">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Privacy Policy</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <textarea class="form-control" name="privacy_policy"
                                                        id="privacy_policy" placeholder="Privacy Policy">
                                                        @if($company_info && $company_info->privacy_policy)
                                                        {!! $company_info->privacy_policy !!}
                                                        @endif 
                                                    </textarea>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-12 mt-md-3">
                                                    <button class="float-right btn btn-success btn-sm">Save</button>
                                                </div>
                                                <!-- End -->
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <!-- End -->
                                    </div>
                                </form>
                                <!-- End Privacy Policy -->
                            </div>
                            <div class="tab-pane" id="returnPolicy" role="tabpanel">
                                <!-- Start Return Policy -->
                                <form method="post" id="add_return_policy">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-4 mt-md-3">
                                                    <label class="col-form-label float-md-right"
                                                        style="font-size: 14px;">Return Policy</label>
                                                </div>
                                                <div class="col-md-8 mt-md-3">
                                                    <textarea class="form-control" name="return_policy"
                                                        id="return_policy" placeholder="Return Policy">
                                                        @if($company_info && $company_info->return_policy)
                                                        {!! $company_info->return_policy !!}
                                                        @endif 
                                                    </textarea>
                                                </div>
                                                <!-- End -->
                                                <div class="col-md-12 mt-md-3">
                                                    <button class="float-right btn btn-success btn-sm">Save</button>
                                                </div>
                                                <!-- End -->
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <!-- End -->
                                    </div>
                                </form>
                                <!-- End Return Policy -->
                            </div>
                            <!-- End -->
                            <div class="tab-pane" id="activeInactiveStatus" role="tabpanel">
                                <!-- Start Return Policy -->
                                <form method="post" id="add_status">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12 mt-md-3">
                                                    <div class="form-check form-switch">
                                                        <input @if($company_info && $company_info->is_phone_active)
                                                        checked @endif class="form-check-input" type="checkbox"
                                                        name="is_phone_active"
                                                        id="is_phone_active">
                                                        <label class="form-check-label" for="is_phone_active">Phone
                                                            Active</label>
                                                    </div>
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-12 mt-md-3">
                                                    <div class="form-check form-switch">
                                                        <input @if($company_info && $company_info->is_mobile_active)
                                                        checked @endif class="form-check-input" type="checkbox"
                                                        name="is_mobile_active"
                                                        id="is_mobile_active">
                                                        <label class="form-check-label" for="is_mobile_active">Mobile
                                                            Active</label>
                                                    </div>
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-12 mt-md-3">
                                                    <div class="form-check form-switch">
                                                        <input @if($company_info && $company_info->is_email_active)
                                                        checked @endif class="form-check-input" type="checkbox"
                                                        name="is_email_active"
                                                        id="is_email_active">
                                                        <label class="form-check-label" for="is_email_active">Email
                                                            Active</label>
                                                    </div>
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-12 mt-md-3">

                                                    <div class="form-check form-switch">
                                                        <input @if($company_info && $company_info->is_hotline_active)
                                                        checked @endif class="form-check-input" type="checkbox"
                                                        name="is_hotline_active"
                                                        id="is_hotline_active">
                                                        <label class="form-check-label" for="is_hotline_active">Hotline
                                                            Active</label>
                                                    </div>
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-12 mt-md-3">
                                                    <div class="form-check form-switch">
                                                        <input @if($company_info &&
                                                            $company_info->is_footer_block1_active) checked @endif
                                                        class="form-check-input" type="checkbox"
                                                        name="is_footer_block1_active"
                                                        id="is_footer_block1_active">
                                                        <label class="form-check-label"
                                                            for="is_footer_block1_active">Footer Block 1</label>
                                                    </div>
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-12 mt-md-3">
                                                    <div class="form-check form-switch">
                                                        <input @if($company_info &&
                                                            $company_info->is_footer_block2_active) checked @endif
                                                        class="form-check-input" type="checkbox"
                                                        name="is_footer_block2_active"
                                                        id="is_footer_block2_active">
                                                        <label class="form-check-label"
                                                            for="is_footer_block2_active">Footer Block 2</label>
                                                    </div>
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-12 mt-md-3">
                                                    <div class="form-check form-switch">
                                                        <input @if($company_info &&
                                                            $company_info->is_footer_block3_active) checked @endif
                                                        class="form-check-input" type="checkbox"
                                                        name="is_footer_block3_active"
                                                        id="is_footer_block3_active">
                                                        <label class="form-check-label"
                                                            for="is_footer_block3_active">Footer Block 3</label>
                                                    </div>
                                                </div>
                                                <!-- End -->

                                                <div class="col-md-12 mt-md-3">
                                                    <button class="btn btn-success btn-sm btn-block">Save</button>
                                                </div>
                                                <!-- End -->
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <!-- End -->
                                    </div>
                                </form>
                                <!-- End Return Policy -->
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
<script>
$('#about_us').summernote({
    height: 120
});

$('#terms_condition').summernote({
    height: 120
});

$('#privacy_policy').summernote({
    height: 120
});

$('#return_policy').summernote({
    height: 120
});
// $('.file-upload').file_upload();
</script>
@include('backend.setting.setting-js')
{!! Toastr::message() !!}
@endsection