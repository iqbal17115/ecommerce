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
                <p class="category h4">Manage Company</p>
                <!-- Nav tabs -->
                <div class="card">
                    <div class="card-header">
                        <!-- justify-content-center -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#addVitalInfo" role="tab">
                                    <i class="now-ui-icons objects_umbrella-13"></i> 1
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#variations" role="tab">
                                    <i class="now-ui-icons shopping_cart-simple"></i> 1
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#offer" role="tab">
                                    <i class="now-ui-icons shopping_shop"></i> 3
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#compliance" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> 4
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#images" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> 5
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#description" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> 6
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#keywords" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> 7
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#more_details" role="tab">
                                    <i class="now-ui-icons ui-2_settings-90"></i> 8
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="addVitalInfo" role="tabpanel">
                                
                            </div>
                            <div class="tab-pane" id="variations" role="tabpanel">
                                
                            </div>
                            <div class="tab-pane" id="offer" role="tabpanel">
                                
                            </div>
                            <div class="tab-pane" id="compliance" role="tabpanel">
                                <!-- Start -->
                                <div class="col-md-10">
                                    <!-- Start Content -->
                                    
                                </div>
                                <div class="col-md-2"></div>
                                <!-- End -->
                            </div>
                            <div class="tab-pane" id="images" role="tabpanel">
                                
                            </div>
                            <div class="tab-pane" id="description" role="tabpanel">
                                
                            </div>
                            <!-- End -->
                            <div class="tab-pane" id="keywords" role="tabpanel">
                                <div class="row">
                                    <!-- Start -->
                                    <div class="col-md-10">
                                        <!-- Start Content -->
                                        
                                    </div>
                                    <div class="col-md-2"></div>
                                    <!-- End -->
                                </div>
                            </div>
                            <!-- End -->
                            <div class="tab-pane" id="more_details" role="tabpanel">
                                
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
    $('#product_feature_id').select2({
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