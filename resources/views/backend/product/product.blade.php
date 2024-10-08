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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/product.css') }}">
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
            width: 100%;
        }

        .input-form {
            width: 100%;
            height: 25px;
        }

        .cross-icon {
            position: relative;
            background-size: cover;
        }

        .cross-icon::before {
            content: "✖";
            position: absolute;
            top: 15px;
            left: 8px;
            font-size: 15px;
            color: red;
            cursor: pointer;
        }

        .variation-form {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }

        .variation-form h3 {
            margin-bottom: 5px;
        }

        .price-stock-container {
            margin-top: 10px;
        }

        .price-stock-container .row {
            margin-bottom: 10px;
        }

        .btn-secondary {
            margin-top: 10px;
        }

        .btn-primary {
            margin-top: 15px;
        }
    </style>
@endsection
@section('content')
    <!-- include summernote css/js-->

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ml-auto">
                    <p class="category h4">Add Product <span><a href="{{ route('product_list') }}"
                                class="btn btn-success text-light btn-sm float-right clean_form"
                                style="width: 100px;">List</a></span></p>
                    <!-- Nav tabs -->
                    <div class="card">
                        {{-- <div class="card-header">
                            <!-- justify-content-center -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link add_product_identity active" data-toggle="tab"
                                        href="#addProductIdentity" role="tab">
                                        <i class="now-ui-icons objects_umbrella-13"></i> Product Identity
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link add_vital_info" data-toggle="tab" href="#addVitalInfo"
                                        role="tab">
                                        <i class="now-ui-icons objects_umbrella-13"></i> Vital Info
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link add_variant" data-toggle="tab" href="#variations" role="tab">
                                        <i class="now-ui-icons shopping_cart-simple"></i> Variation
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link add_product_offer" data-toggle="tab" href="#offer" role="tab">
                                        <i class="now-ui-icons shopping_shop"></i> Offer
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#compliance" role="tab">
                                        <i class="now-ui-icons ui-2_settings-90"></i> Compliance
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link add_product_image" data-toggle="tab" href="#images" role="tab">
                                        <i class="now-ui-icons ui-2_settings-90"></i> Images
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link add_description" data-toggle="tab" href="#description"
                                        role="tab">
                                        <i class="now-ui-icons ui-2_settings-90"></i> Description
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link add_keywords" data-toggle="tab" href="#keywords" role="tab">
                                        <i class="now-ui-icons ui-2_settings-90"></i> Keywords
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link add_more_details" data-toggle="tab" href="#more_details"
                                        role="tab">
                                        <i class="now-ui-icons ui-2_settings-90"></i> More Details
                                    </a>
                                </li>
                            </ul>
                        </div> --}}
                        @php
                            // Determine the active step
                            $activeStep = $productInfo->step ?? 0; // Default to step 1 if $productInfo or step is not set
                        @endphp
                        <div class="card-body">
                            <div id="progrss-wizard" class="twitter-bs-wizard">
                                <ul class="twitter-bs-wizard-nav nav-justified">
                                    <li class="nav-item">
                                        <a href="#addProductIdentity" class="nav-link {{ $activeStep == 0 ? 'active' : '' }} disabled" data-toggle="tab">
                                            <span class="step-number mr-1"
                                                style="width: 23px; height: 23px; line-height: 18px;">1</span>
                                            Identity
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#addVitalInfo" class="nav-link {{ $activeStep == 1 ? 'active' : '' }} disabled" data-toggle="tab">
                                            <span class="step-number mr-1"
                                                style="width: 23px; height: 23px; line-height: 18px;">2</span>
                                            Vital Info
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#variations" class="nav-link {{ $activeStep == 2 ? 'active' : '' }} disabled" data-toggle="tab">
                                            <span class="step-number mr-1"
                                                style="width: 23px; height: 23px; line-height: 18px;">3</span>
                                            Variation
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#offer" class="nav-link {{ $activeStep == 3 ? 'active' : '' }} disabled" data-toggle="tab">
                                            <span class="step-number mr-1"
                                                style="width: 23px; height: 23px; line-height: 18px;">4</span>
                                            Offer
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#compliance" class="nav-link {{ $activeStep == 4 ? 'active' : '' }} disabled" data-toggle="tab">
                                            <span class="step-number mr-1"
                                                style="width: 23px; height: 23px; line-height: 18px;">5</span>
                                            Compliance
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#images" class="nav-link {{ $activeStep == 5 ? 'active' : '' }} disabled" data-toggle="tab">
                                            <span class="step-number mr-1"
                                                style="width: 23px; height: 23px; line-height: 18px;">6</span>
                                            Images
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#description" class="nav-link {{ $activeStep == 6 ? 'active' : '' }} disabled" data-toggle="tab">
                                            <span class="step-number mr-1"
                                                style="width: 23px; height: 23px; line-height: 18px;">7</span>
                                            Description
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#keywords" class="nav-link {{ $activeStep == 7 ? 'active' : '' }} disabled" data-toggle="tab">
                                            <span class="step-number mr-1"
                                                style="width: 23px; height: 23px; line-height: 18px;">8</span>
                                            Keywords
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#more_details" class="nav-link {{ $activeStep == 8 ? 'active' : '' }} disabled" data-toggle="tab">
                                            <span class="step-number mr-1"
                                                style="width: 23px; height: 23px; line-height: 18px;">9</span>
                                            More Details
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#progress-confirm-detail" class="nav-link {{ $activeStep == 9 ? 'active' : '' }} disabled" data-toggle="tab">
                                            <span class="step-number mr-1"
                                                style="width: 23px; height: 23px; line-height: 18px;">10</span>
                                            Confirm
                                        </a>
                                    </li>
                                </ul>

                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                        style="width: 0%;" id="progress-bar"></div>
                                </div>
                                <div class="tab-content twitter-bs-wizard-tab-content">
                                    <!-- Product Identity -->
                                    @include('backend.product.partials.product_identity')
                                    <!-- Vital Info -->
                                    @include('backend.product.partials.vital_info')
                                    <!-- Variant -->
                                    @include('backend.product.partials.variations')
                                    <!-- Product Offer -->
                                    @include('backend.product.partials.product_offer')
                                    <!-- Compliance -->
                                    @include('backend.product.partials.compliance')
                                    <!-- Image -->
                                    @include('backend.product.partials.product_image')
                                    <!-- Description -->
                                    @include('backend.product.partials.description')
                                    <!-- Keywords -->
                                    @include('backend.product.partials.keyword')
                                    <!-- More Details -->
                                    @include('backend.product.partials.more_detail')
                                    {{-- Confirm Detail --}}
                                    @include('backend.product.partials.confirm_detail')
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
        $('.bottom_size_map').select2({
            placeholder: 'Select An Option'
        });
        // $('.file-upload').file_upload();
        document.getElementById('sale_price').addEventListener('input', function() {
            var salePrice = this.value;
            var startDateInput = document.getElementById('sale_start_date');
            var endDateInput = document.getElementById('sale_end_date');

            startDateInput.required = endDateInput.required = salePrice !== '';
            if (salePrice === '') {
                startDateInput.value = endDateInput.value = '';
            }
        });

        (function($) {
            $.fn.commaSeparated = function() {
                return this.each(function() {
                    var block = $(this);
                    var field = block.find('input[type="text"]');

                    // Function to initialize spans based on the field's value
                    function initializeSpans() {
                        var keywords = field.val().split(",");
                        for (var i = 0; i < keywords.length; i++) {
                            var keyword = keywords[i].trim();
                            if (keyword) {
                                block.append('<span class="removeName comma_parent">' + keyword +
                                    '<small class="comma_child">x</small></span>');
                            }
                        }
                    }

                    // Initialize spans when the page loads
                    initializeSpans();

                    field.keyup(function(e) {
                        if (e.keyCode == 188) {
                            var $this = $(this);
                            var values = $this.val().split(",");
                            $this.val('');

                            // Loop through the values and create an element for each
                            for (var i = 0; i < values.length; i++) {
                                var value = values[i].trim(); // Remove leading/trailing whitespace
                                if (value) {
                                    $this.before('<span class="removeName comma_parent">' + value +
                                        '<small class="comma_child">x</small></span>');
                                }
                            }
                        }
                    });

                });
            };



            $(document).on('click', 'span.removeName small', function() {
                $(this).closest('span').remove();
            });

            // Fire commaSeparated
            $("#commaSep").commaSeparated();
        })(jQuery);

        $(document).ready(function() {
            function updateKeywordsDisplay() {
                var keywords_hidden = $('#keyword_hidden').val().split(",");
                var block = $("#commaSep");

                for (var i = 0; i < keywords_hidden.length; i++) {
                    var keyword_hidden = keywords_hidden[i].trim();
                    if (keyword_hidden) {
                        block.prepend('<span class="removeName comma_parent">' + keyword_hidden +
                            '<small class="comma_child">x</small></span>');
                    }
                }
            }
            updateKeywordsDisplay();
        });
        
    </script>
    @include('backend.product.js.product-js')
    {!! Toastr::message() !!}
@endsection
