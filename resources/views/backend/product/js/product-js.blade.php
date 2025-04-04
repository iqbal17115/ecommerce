<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const wizardNav = document.querySelectorAll('.twitter-bs-wizard-nav .nav-link');
        const progressBar = document.getElementById('progress-bar');
        let currentStep = 0;

        function updateProgressBar() {
            const percentage = ((currentStep + 1) / wizardNav.length) * 100;
            progressBar.style.width = `${percentage}%`;
        }

        function showStep(index) {
            wizardNav[currentStep].classList.remove('active');
            wizardNav[index].classList.add('active');

            const tabs = document.querySelectorAll('.tab-pane');
            tabs[currentStep].classList.remove('active');
            tabs[index].classList.add('active');

            currentStep = index;
            updateProgressBar();
        }

        function validateCurrentStep() {
            const currentForm = document.querySelector('.tab-pane.active form');
            if (currentForm) {
                return currentForm.checkValidity();
            }
            return false;
        }

        function handleNext() {
            if (validateCurrentStep()) {
                if (currentStep < wizardNav.length - 1) {
                    showStep(currentStep + 1);
                }
            } else {
                const currentForm = document.querySelector('.tab-pane.active form');
                if (currentForm) {
                    currentForm.reportValidity();
                }
            }
        }

        function handlePrev() {
            if (currentStep > 0) {
                showStep(currentStep - 1);
            }
        }

        document.querySelectorAll('.next-btn').forEach(btn => {
            btn.addEventListener('click', handleNext);
        });

        document.querySelectorAll('.prev-btn').forEach(btn => {
            btn.addEventListener('click', handlePrev);
        });

        // Initialize first step as active and progress bar
        showStep(0);
    });

    // End Product Validation According to wizard
    function getKeywords() {
        var keywords = [];
        $('#commaSep span.removeName').each(function() {
            var keyword = $(this).text().replace('x', '').trim();
            keywords.push(keyword);
        });
        return keywords;
    }

    function brandAvailableCheck(brand_available) {
        brand_available = $("#" + brand_available.id).val();
        if (brand_available == 1) {
            $(".brand_available_contant").show();
            $("#brand_id").attr("required", "true");
        } else {
            $(".brand_available_contant").hide();
            $("#brand_id").removeAttr("required");

        }
    }
    var tab_menu = [];
    var selected_variation = [];

    function updateVariationType(variation) {
        const manage_variation = JSON.parse(variation);
        let pp = 1;
        for (let property in manage_variation[0]) {
            var b = parseInt(property);
            var temp_variation = '';
            // console.log(manage_variation[b+1]);
            let myArr = Object.values(manage_variation[b + 1]);
            arr = myArr.filter((item,
                index) => myArr.indexOf(item) === index);
            console.log(arr);
            for (let i = 0; i < arr.length; i++) {

                variationManage(manage_variation[0][property], arr[i]);

            }
        }
    }

    function pagination(page) {
        $.ajax({
            url: '/pagination/product-pagination-data?page=' + page,
            success: function(data) {
                $('.product_content').html(data);
            }
        })
    }
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1]
        pagination(page);
    });

    // Start Product Variant Add
    $(document).on('submit', '#add_variant_variant', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: "{{ route('add.add_variant_variant') }}",
            method: 'post',
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(data) {
                console.log(data);
                if (data.status == 201) {

                }
            },
        });
    });
    // End Product Variant Add
    // Start More Product Detail Add
    $(document).on('submit', '#add_product_more_detail', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: "{{ route('add.add_product_more_detail') }}",
            method: 'post',
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(data) {
                if (data.status == 201) {

                }
            },
        });
    });
    // End More Product Detail Add
    // Start Product Compliance Add
    $(document).on('submit', '#add_product_compliance', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: "{{ route('add.add_product_compliance') }}",
            method: 'post',
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(data) {
                if (data.status == 201) {
                    Command: toastr["success"]("Product Compliance Saved Successfully",
                        "Success")
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                }
            },
        });
    });
    // End Product Compliance Add

    // Start Product Keyword Add
    $(document).on('submit', '#add_product_keyword', function(e) {
        e.preventDefault();
        var allKeywords = getKeywords();

        var keywordsInput = $("<input>")
            .attr("type", "hidden")
            .attr("name", "keyword")
            .val(allKeywords.join(","));

        $(this).append(keywordsInput);
        var form = this;
        $.ajax({
            url: "{{ route('add.add_product_keyword') }}",
            method: 'post',
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(data) {
                Command: toastr["success"]("Product Keyword Saved Successfully",
                    "Success")
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            },
        });
    });
    // End Product Keyword Add
    // Start Product Description Add
    $(document).on('submit', '#add_product_description_info', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: "{{ route('add.add_product_description_info') }}",
            method: 'post',
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(data) {
                if (data.status == 201) {
                    Command: toastr["success"]("Product Description Saved Successfully",
                        "Success")
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                }
            },
        });
    });
    // End Product Description Add
    // Start Product Image Add
    $(document).on('submit', '#add_product_image_info', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: "{{ route('add.add_product_image_info') }}",
            method: 'post',
            data: new FormData(form),
            enctype: 'multipart/form-data',
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(data) {
                if (data.status == 201) {
                    if (!tab_menu.includes(5)) {
                        tab_menu.push(5);
                    }
                    if (!tab_menu.includes(6)) {
                        tab_menu.push(6);
                    }
                    if (!tab_menu.includes(7)) {
                        tab_menu.push(7);
                    }
                    if (!tab_menu.includes(8)) {
                        tab_menu.push(8);
                    }

                }
            },
        });
    });
    // End Product Image Add
    // Start Product Details Add
    $(document).on('submit', '#add_product_detail_info', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: "{{ route('add.add_product_detail_info') }}",
            method: 'post',
            data: new FormData(form),
            enctype: 'multipart/form-data',
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(data) {
                if (data.status == 201) {
                    if (!tab_menu.includes(4)) {
                        tab_menu.push(4);
                    }
                    Command: toastr["success"]("Product Detail Saved Successfully",
                        "Success")
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                }
            },
        });
    });
    // End Product Details Add
    // Start Product Identity
    $(document).on('submit', '#add_product_identity', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: "{{ route('add.product_identity') }}",
            method: 'post',
            data: new FormData(form),
            enctype: 'multipart/form-data',
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(data) {
                if (data.status == 201) {
                    Command: toastr["success"]("Product Identity Saved Successfully",
                        "Success")
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }

                    $("#product_identity_id").val(data.product_id);
                    $("#vital_info_id").val(data.product_id);
                    $("#product_offer_id").val(data.product_id);
                    $("#product_image_id").val(data.product_id);
                    $("#product_description_id").val(data.product_id);
                    $("#product_keyword_id").val(data.product_id);
                    $("#product_compliance_id").val(data.product_id);
                    $("#product_more_detail_id").val(data.product_id);
                    $("#product_variant_info_id").val(data.product_id);
                    $(".product_id").val(data.product_id);
                }
            },
            error: (error) => {
                alert('Something went wrong to fetch datas...');
            }
        });
    });
    // End Product Identity
    // Start Product Vital Info Add
    $(document).on('submit', '#add_vital_info', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: "{{ route('add.vital_info') }}",
            method: 'post',
            data: new FormData(form),
            enctype: 'multipart/form-data',
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(data) {
                if (data.status == 201) {
                    if (!tab_menu.includes(2)) {
                        tab_menu.push(2);
                    }
                    if (!tab_menu.includes(3)) {
                        tab_menu.push(3);
                    }

                    $("#product_identity_id").val(data.product_id);
                    $("#vital_info_id").val(data.product_id);
                    $("#product_offer_id").val(data.product_id);
                    $("#product_image_id").val(data.product_id);
                    $("#product_description_id").val(data.product_id);
                    $("#product_keyword_id").val(data.product_id);
                    $("#product_compliance_id").val(data.product_id);
                    $("#product_more_detail_id").val(data.product_id);
                    $("#product_variant_info_id").val(data.product_id);

                    Command: toastr["success"]("Vital Info Saved Successfully",
                        "Success")
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                }
            },
            error: (error) => {
                alert('Something went wrong to fetch datas...');
            }
        });
    });
    // End Product Vital Info Add
    function getAllCondition() {
        $.ajax({
            method: "GET",
            url: "{{ url('/get-condition') }}",
            success: (result) => {
                condition = '';
                Object.entries(result).forEach(([key, value]) => {
                    condition += '<option value="' + value['id'] + '">' + value['title'] +
                        '</option>';
                });
                console.log(condition);
                $('.product_condition').empty();
                $('.product_condition').append(condition);
            },
            error: (error) => {
                alert('Something went wrong to fetch datas...');
            }
        });
    }

    $("body").on("click", "#add_style_name", function() {
        let individual_style_name = $("#individual_style_name").val();

        if (individual_style_name != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' +
                individual_style_name +
                '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_style_name").append(badge);
            $("#individual_style_name").val(null);
            variationManage(6, individual_style_name);
        }
    });

    $("body").on("click", "#add_number_of_items", function() {
        let individual_number_of_items = $("#individual_number_of_items").val();

        if (individual_number_of_items != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' +
                individual_number_of_items +
                '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_number_of_items").append(badge);
            $("#individual_number_of_items").val(null);
            variationManage(6, individual_number_of_items);
        }
    });

    $("body").on("click", "#add_individual_wattage", function() {
        let individual_wattage = $("#individual_wattage").val();

        if (individual_wattage != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' +
                individual_wattage +
                '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_wattage").append(badge);
            $("#individual_wattage").val(null);
            variationManage(5, individual_wattage);
        }
    });

    $("body").on("click", "#add_individual_material_type", function() {
        let individual_material_type = $("#individual_material_type").val();
        let individual_material_type_val = '';
        if (individual_material_type != null) {
            // Ajax Start
            $.ajax({
                method: "GET",
                url: "{{ url('/variant') }}" + '/' + individual_material_type,
                success: (result) => {
                    individual_material_type_val = result['name'];
                    let badge =
                        '<button type="button" class="btn btn-secondary position-relative m-2">' +
                        individual_material_type_val +
                        '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
                    $("#all_material_type").append(badge);
                    $("#individual_material_type").val(null);
                    variationManage(4, individual_material_type_val);
                },
                error: (error) => {
                    alert('Something went wrong to fetch datas...');
                }
            });
            // Ajax End

        }
    });

    $("body").on("click", "#add_individual_package_qty", function() {
        let individual_package_qty = $("#individual_package_qty").val();

        if (individual_package_qty != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' +
                individual_package_qty +
                '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_package_qty").append(badge);
            $("#individual_package_qty").val(null);
            variationManage(3, individual_package_qty);
        }
    });

    $("body").on("click", "#add_individual_color", function() {
        let individual_color = $("#individual_color").val();

        if (individual_color != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' +
                individual_color +
                '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_color").append(badge);
            $("#individual_color").val(null);
            variationManage(2, individual_color);
        }
    });

    $("body").on("click", "#add_individual_size", function() {
        let individual_size = $("#individual_size").val();

        if (individual_size != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' +
                individual_size +
                '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_size").append(badge);
            $("#individual_size").val(null)
            variationManage(1, individual_size);
        }
    });

    $("body").on("click", ".variation_specify", function() {
        if (this.value == 1) {
            if ($(this).prop("checked") == true) {
                add_size =
                    '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 18px;">Size </label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_size" placeholder="Size" aria-label="Size" aria-describedby="basic-addon2"><div class="input-group-append"><button type="button" class="btn btn-success add_individual_size" id="add_individual_size">Add</button></div></div></div></div>';
                $("#add_size").append(add_size);
                $("#all_size").after('<div class="col-md-12 remove_sizer_hr"><hr></div>');
            } else if ($(this).prop("checked") == false) {
                $("#add_size").empty();
                $(".remove_size_hr").remove();
            }
        } else if (this.value == 2) {
            if ($(this).prop("checked") == true) {
                add_color =
                    '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 18px;">Color </label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_color" placeholder="Color" aria-label="Size" aria-describedby="basic-addon2"><div class="input-group-append"><button type="button" class="btn btn-success add_individual_color" id="add_individual_color">Add</button></div></div></div></div>';
                $("#add_color").append(add_color);
                $("#all_color").after('<div class="col-md-12 remove_color_hr"><hr></div>');
            } else if ($(this).prop("checked") == false) {
                $("#add_color").empty();
                $(".remove_color_hr").remove();
            }
        } else if (this.value == 3) {
            if ($(this).prop("checked") == true) {
                add_package_qty =
                    '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 14px;">P. Qty </label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_package_qty" placeholder="Package Qty" aria-label="Package Qty" aria-describedby="basic-addon2"><div class="input-group-append"><button type="button" class="btn btn-success add_individual_package_qty" id="add_individual_package_qty">Add</button></div></div></div></div>';
                $("#add_package_qty").append(add_package_qty);
                $("#all_package_qty").after('<div class="col-md-12 remove_package_qty_hr"><hr></div>');
            } else if ($(this).prop("checked") == false) {
                $("#add_package_qty").empty();
                $(".remove_package_qty_hr").remove();
            }
        } else if (this.value == 4) {
            if ($(this).prop("checked") == true) {
                add_material_type =
                    '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 14px;">M. Type </label></div><div class="col-md-6"><div class="input-group mb-3"><select class="form-control" id="individual_material_type" aria-label="Material Type" aria-describedby="basic-addon2"></select><div class="input-group-append"><button type="button" class="btn btn-success add_individual_material_type" id="add_individual_material_type">Add</button></div></div></div></div>';
                $("#add_material_type").append(add_material_type);
                $("#all_material_type").after('<div class="col-md-12 remove_material_type_hr"><hr></div>');
                getMaterialTypeVariant();
            } else if ($(this).prop("checked") == false) {
                $("#add_material_type").empty();
                $(".remove_material_type_hr").remove();
            }
        } else if (this.value == 5) {
            if ($(this).prop("checked") == true) {
                add_wattage =
                    '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 18px;">Wattage </label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_wattage" placeholder="Wattage" aria-label="Wattage" aria-describedby="basic-addon2"><div class="input-group-append"><button type="button" class="btn btn-success add_individual_wattage" id="add_individual_wattage">Add</button></div></div></div></div>';
                $("#add_wattage").append(add_wattage);
                $("#all_wattage").after('<div class="col-md-12 remove_wattage_hr"><hr></div>');
            } else if ($(this).prop("checked") == false) {
                $("#add_wattage").empty();
                $(".remove_wattage_hr").remove();
            }
        } else if (this.value == 6) {
            if ($(this).prop("checked") == true) {
                add_number_of_items =
                    '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 18px;">Number Of Items </label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_number_of_items" placeholder="Number Of Items" aria-label="Number Of Items" aria-describedby="basic-addon2"><div class="input-group-append"><button type="button" class="btn btn-success add_individual_number_of_items" id="add_individual_number_of_items">Add</button></div></div></div></div>';
                $("#add_number_of_items").append(add_number_of_items);
                $("#all_number_of_items").after('<div class="col-md-12 remove_number_of_items_hr"><hr></div>');
            } else if ($(this).prop("checked") == false) {
                $("#add_number_of_items").empty();
                $(".remove_number_of_items_hr").remove();
            }
        } else if (this.value == 7) {
            if ($(this).prop("checked") == true) {
                add_style_name =
                    '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 18px;">Style Name </label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_style_name" placeholder="Style Name" aria-label="Style Name" aria-describedby="basic-addon2"><div class="input-group-append"><button  class="btn btn-success add_individual_style_name" id="add_individual_style_name">Add</button></div></div></div></div>';
                $("#add_style_name").append(add_style_name);
                $("#all_style_name").after('<div class="col-md-12 remove_style_name_hr"><hr></div>');
            } else if ($(this).prop("checked") == false) {
                $("#add_style_name").empty();
                $(".remove_style_name_hr").remove();
            }
        }
    });

    $('#size').on('click', function(e) {
        if ($(this).prop("checked") == true) {
            add_size =
                '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 18px;">Size</label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_size" placeholder="Size" aria-label="Size" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-success add_individual_size" id="add_individual_size">Add</button></div></div></div></div>';
            $("#add_size").append(add_size);
            $("#all_size").after('<div class="col-md-12 remove_size_hr"><hr></div>');
        } else if ($(this).prop("checked") == false) {
            $("#add_size").empty();
            $(".remove_size_hr").remove();
        }
    });


    function updateVariantByCategory(category_id) {
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: 'get-category/' + category_id,
            success: function(data) {
                const obj = JSON.parse(data['variation_type']);
                variation_option = '';

                variation_option +=
                    '<div class="col-md-4"><label class="float-md-right">Choose variation type</label></div>';
                for (const prop in obj) {
                    if (obj[prop] == 1) {
                        variation_option +=
                            '<div class="col-md-1"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="size" value="1" /><label class="form-check-label" for="size">Size</label></div></div>';
                    } else if (obj[prop] == 2) {
                        variation_option +=
                            '<div class="col-md-1"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="color" value="2" /><label class="form-check-label" for="color">Color</label></div></div>';
                    } else if (obj[prop] == 3) {
                        variation_option +=
                            '<div class="col-md-2"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="package_quantity" value="3" /><label class="form-check-label" for="package_quantity">Package Quantity</label></div></div>';
                    } else if (obj[prop] == 4) {
                        variation_option +=
                            '<div class="col-md-2"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="material_type" value="4" /><label class="form-check-label" for="material_type">Material Type</label></div></div>';
                    } else if (obj[prop] == 5) {
                        variation_option +=
                            '<div class="col-md-1"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="wattage" value="5" /><label class="form-check-label" for="wattage">Wattage</label></div></div>';
                    } else if (obj[prop] == 6) {
                        variation_option +=
                            '<div class="col-md-2"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="number_of_items" value="6" /><label class="form-check-label" for="number_of_items">Number Of Items</label></div></div>';
                    } else if (obj[prop] == 7) {
                        variation_option +=
                            '<div class="col-md-2"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="style_name" value="7" /><label class="form-check-label" for="style_name">Style Name</label></div></div>';
                    }
                }
                $("#variation_type_content").empty();
                $("#variation_type_content").append(variation_option);
            },
            error: function(err) {
                console.log(err);
            }
        });
    };

    function variantByCategory(category) {
        let category_id = $("#" + category.id).val();
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: 'get-category/' + category_id,
            success: function(data) {
                const obj = JSON.parse(data['variation_type']);
                variation_option = '';

                variation_option +=
                    '<div class="col-md-4"><label class="float-md-right">Choose variation type</label></div>';
                for (const prop in obj) {
                    if (obj[prop] == 1) {
                        variation_option +=
                            '<div class="col-md-1"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="size" value="1" /><label class="form-check-label" for="size">Size</label></div></div>';
                    } else if (obj[prop] == 2) {
                        variation_option +=
                            '<div class="col-md-1"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="color" value="2" /><label class="form-check-label" for="color">Color</label></div></div>';
                    } else if (obj[prop] == 3) {
                        variation_option +=
                            '<div class="col-md-2"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="package_quantity" value="3" /><label class="form-check-label" for="package_quantity">Package Quantity</label></div></div>';
                    } else if (obj[prop] == 4) {
                        variation_option +=
                            '<div class="col-md-2"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="material_type" value="4" /><label class="form-check-label" for="material_type">Material Type</label></div></div>';
                    } else if (obj[prop] == 5) {
                        variation_option +=
                            '<div class="col-md-1"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="wattage" value="5" /><label class="form-check-label" for="wattage">Wattage</label></div></div>';
                    } else if (obj[prop] == 6) {
                        variation_option +=
                            '<div class="col-md-2"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="number_of_items" value="6" /><label class="form-check-label" for="number_of_items">Number Of Items</label></div></div>';
                    } else if (obj[prop] == 7) {
                        variation_option +=
                            '<div class="col-md-2"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="style_name" value="7" /><label class="form-check-label" for="style_name">Style Name</label></div></div>';
                    }
                }
                $("#variation_type_content").empty();
                $("#variation_type_content").append(variation_option);
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
        const dropZoneElement = inputElement.closest(".drop-zone");
        dropZoneElement.addEventListener("click", (e) => {
            inputElement.click();
        });

        inputElement.addEventListener("change", (e) => {
            if (inputElement.files.length) {
                updateThumbnail(dropZoneElement, inputElement.files[0]);
            }
        });

        dropZoneElement.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropZoneElement.classList.add("drop-zone--over");
        });

        ["dragleave", "dragend"].forEach((type) => {
            dropZoneElement.addEventListener(type, (e) => {
                dropZoneElement.classList.remove("drop-zone--over");
            });
        });

        dropZoneElement.addEventListener("drop", (e) => {
            e.preventDefault();

            if (e.dataTransfer.files.length) {
                inputElement.files = e.dataTransfer.files;
                updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
            }

            dropZoneElement.classList.remove("drop-zone--over");
        });
    });

    /**
     * Updates the thumbnail on a drop zone element.
     *
     * @param {HTMLElement} dropZoneElement
     * @param {File} file
     */
    function updateThumbnail(dropZoneElement, file) {
        let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

        // First time - remove the prompt
        if (dropZoneElement.querySelector(".drop-zone__prompt")) {
            dropZoneElement.querySelector(".drop-zone__prompt").remove();
        }

        // First time - there is no thumbnail element, so lets create it
        if (!thumbnailElement) {
            thumbnailElement = document.createElement("div");
            thumbnailElement.classList.add("drop-zone__thumb");
            dropZoneElement.appendChild(thumbnailElement);
        }

        thumbnailElement.dataset.label = file.name;

        // Show thumbnail for image files
        if (file.type.startsWith("image/")) {
            const reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = () => {
                thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
            };
        } else {
            thumbnailElement.style.backgroundImage = null;
        }
    }

    function pro1(val) {
        document.getElementById(val).click();
    }

    $('#condition_note').summernote({
        height: 120
    });
    $('#short_deacription').summernote({
        height: 120
    });
    $('#product_description').summernote({
        height: 120
    });
    $('#product_content').summernote({
        height: 120
    });
    $('#warranty_description').summernote({
        height: 120
    });

    $("#rowAdder").click(function() {
        newRowAdd =
            '<div id="row"> <div class="input-group m-3">' +
            '<div class="input-group-prepend">' +
            '<button class="btn btn-danger" id="DeleteRow" type="button">' +
            '<i class="mdi mdi-delete"></i></button> </div>' +
            '<input name="keyword[]" id="keyword" type="text" class="form-control m-input"> </div> </div>';

        $('#newinput').append(newRowAdd);
    });

    $("body").on("click", "#DeleteRow", function() {
        $(this).parents("#row").remove();
    })


    // Start Variation JS
    $(document).ready(function() {
        // Initialize Select2 for size selection
        $("#sizeSelect").select2({
            dropdownParent: $(".parent"),
        });

        const colorSizeMap = {};

        // Add Color Event
        $('#addColorBtn').on('click', function() {
            const colorId = $('#colorSelect').val();
            const colorText = $('#colorSelect option:selected').text();

            if (colorId && !colorSizeMap[colorId]) {
                colorSizeMap[colorId] = [];
                addColorRow(colorId, colorText);
                addColorImageRow(colorId, colorText);
            } else {
                alert("Color already added or not selected.");
            }
        });

        // Add Sizes Event
        $('#addSizeBtn').on('click', function() {
            const selectedSizes = $('#sizeSelect').val();
            if (selectedSizes && selectedSizes.length > 0) {
                updateSizeTable(selectedSizes);
            } else {
                alert("Please select at least one size.");
            }
        });

        // Add color row (without size)
        function addColorRow(colorId, colorText) {
            const row = `
        <tr id="colorRow-${colorId}" class="variation-row" data-color-id="${colorId}" data-size-id="0">
            <td>${colorText}</td>
            <td>N/A</td>
            <td><input type="number" name="price_${colorId}" placeholder="Price" class="form-control form-control-sm price-input" required></td>
            <td><input type="text" name="sku_${colorId}" placeholder="Seller SKU" class="form-control form-control-sm sku-input" required></td>
            <td><input type="number" name="stock_${colorId}" placeholder="Stock" class="form-control form-control-sm stock-input" required></td>
            <td><span class="delete-icon" onclick="removeColor('${colorId}')"><i class="mdi mdi-trash-can font-size-16"></i></span></td>
        </tr>`;
            $('#colorSizeTable tbody').append(row);
        }

        // Add color image upload row
        function addColorImageRow(colorId, colorText) {
            const row = `
        <tr id="colorImageRow-${colorId}">
            <td>${colorText}</td>
            <td style="width: 300px;"><input type="file" name="color_image_${colorId}" accept="image/*" class="form-control form-control-sm color-image-input" data-color-id="${colorId}" onchange="previewImages(event, '${colorId}" required></td>
            <td>
                <div id="imagePreview-${colorId}"></div>
                </td>
            <td><span class="delete-icon" onclick="removeColorImage('${colorId}')"><i class="mdi mdi-trash-can font-size-16"></i></span></td>
        </tr>`;
            $('#colorImageTable tbody').append(row);
        }

        // Remove color
        function removeColor(colorId) {
            delete colorSizeMap[colorId];
            $('#colorRow-' + colorId).remove();
            removeColorImage(colorId);
        }

        // Remove color image
        function removeColorImage(colorId) {
            $('#colorImageRow-' + colorId).remove();
        }

        $('.product-color-delete').on('click', function() {

        });
        // Remove variation
        window.removeVariation = function(variationId) {
            $('#variation-' + variationId).remove();
        };

        function generateSku(category, productName, attributes = []) {
            // Sanitize and standardize inputs
            let categoryCode = category.substring(0, 4).toUpperCase(); // Limit category to 4 characters
            let productCode = productName.replace(/\s+/g, '-').substring(0, 3)
        .toUpperCase(); // Use first 3 letters of product name and replace spaces with hyphen

            // Process attributes (ensure uppercase and limit length)
            let attributeCode = '';
            if (attributes.length > 0) {
                attributeCode = attributes.map(attr => {
                    return attr.replace(/\s+/g, '-')
                .toUpperCase(); // Replace spaces with hyphen and convert to uppercase
                }).join('-'); // Join multiple attributes with '-'
            }

            // Generate a short, unique identifier based on the timestamp
            let uniqueId = Math.random().toString(36).substring(2, 8)
        .toUpperCase(); // 6-character random string

            // Construct the SKU
            let skuParts = [categoryCode, productCode];
            if (attributeCode) {
                skuParts.push(attributeCode);
            }
            skuParts.push(uniqueId); // Append unique ID

            return skuParts.join('-');
        }

        // Add or update size table for colors
        function updateSizeTable(selectedSizes) {
            const colorId = $('#colorSelect').val();
            const colorText = $('#colorSelect option:selected').text();

            // Check if colorImageRow for the selected colorId exists in the colorImageTable
            if (colorId && !$('#colorImageRow-' + colorId).length) {
                addColorImageRow(colorId,
                    colorText); // Call the function to add the image row if it doesn't exist
            }

            selectedSizes.forEach(sizeId => {
                const sizeText = $('#sizeSelect option[value="' + sizeId + '"]').text();
                const rowId = `colorSizeRow-${colorId}-${sizeId}`;
                let productName = $('#name').val();
                const categoryId = $('#category_id').val(); // Get the selected category ID
                const categoryText = $('#category_id option:selected').text(); // Get the selected category name
                let sku = generateSku(categoryText, productName, [colorText, sizeText]);

                // Check if row already exists
                if (!$('#' + rowId).length) {
                    const row = `
        <tr id="${rowId}" class="variation-row" data-color-id="${colorId}" data-size-id="${sizeId}">
            <td>${colorText}</td>
            <td>${sizeText}</td>
            <td><input type="number" name="price_${colorId}_${sizeId}" placeholder="Price" class="form-control form-control-sm price-input" required></td>
            <td><input type="text" name="sku_${colorId}_${sizeId}" value="${sku}" placeholder="Seller SKU" class="form-control form-control-sm sku-input" required></td>
            <td><input type="number" name="stock_${colorId}_${sizeId}" placeholder="Stock" class="form-control form-control-sm stock-input" required></td>
            <td><span class="delete-icon" onclick="removeColorSize('${colorId}', '${sizeId}')"><i class="mdi mdi-trash-can font-size-16"></i></span></td>
        </tr>`;
                    $('#colorSizeTable tbody').append(row);
                }
            });
        }

        // Handle form submission with AJAX
        $('#add_product_variation').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            // Prepare data structure for grouped variations
            const groupedVariations = {};

            // Loop through each variation row
            $('.variation-row').each(function() {
                const colorId = $(this).data('color-id');
                const sizeId = $(this).data('size-id');
                const price = $(this).find('.price-input').val();
                const sku = $(this).find('.sku-input').val();
                const stock = $(this).find('.stock-input').val();

                if (!groupedVariations[colorId]) {
                    groupedVariations[colorId] = {
                        color_id: colorId,
                        variations: []
                    };
                }

                groupedVariations[colorId].variations.push({
                    size_id: sizeId,
                    price: price,
                    sku: sku,
                    stock: stock
                });
            });

            // Append grouped variations data to formData
            for (const key in groupedVariations) {
                formData.append('variations[]', JSON.stringify(groupedVariations[key]));
            }

            // Handle color image uploads for each color group
            $('.color-image-input').each(function() {
                const colorId = $(this).data('color-id');
                console.log(colorId);
                const files = $(this)[0].files;
                if (files.length > 0) {
                    for (let i = 0; i < files.length; i++) {
                        formData.append(`color_images_${colorId}[]`, files[i]);
                    }
                }
            });

            // AJAX request to save variations
            $.ajax({
                url: '{{ route('products.store-variations') }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Command: toastr["success"]("Product Variation Saved Successfully",
                        "Success")
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        });
    });

    // Remove color-size variation
    function removeColorSize(colorId, sizeId) {
        $('#colorSizeRow-' + colorId + '-' + sizeId).remove();
    }

    function previewImages(event, colorId) {
        const imagePreviewDiv = document.getElementById('imagePreview-' + colorId);
        imagePreviewDiv.innerHTML = ''; // Clear previous previews

        const files = event.target.files; // Get selected files

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'rounded';
                img.style.width = '30px';
                img.style.height = '30px';
                img.style.margin = '2px';
                imagePreviewDiv.appendChild(img); // Append the image to the preview div
            }

            reader.readAsDataURL(file); // Read the file as a data URL
        }
    }
    // End Variation JS
</script>
