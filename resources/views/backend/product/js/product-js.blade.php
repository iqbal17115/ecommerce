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

        const colorSizeMap = {}; // To track selected sizes for each color

        // Initialize colorSizeMap from Blade if needed
        @foreach ($productInfo->productVariations->groupBy('product_variation_attributes.attribute_value_id') as $colorId => $variations)
            @foreach ($variations as $variation)
                @php
                    $colorAttribute = $variation->productVariationAttributes->first(function ($attr) {
                        return $attr->attributeValue->attribute->name === 'Color';
                    });
                    $sizeAttribute = $variation->productVariationAttributes->first(function ($attr) {
                        return $attr->attributeValue->attribute->name === 'Size';
                    });
                    $colorId = $colorAttribute->attributeValue->id;
                    $sizeId = $sizeAttribute->attributeValue->id;
                @endphp
                colorSizeMap['{{ $colorId }}'] = colorSizeMap['{{ $colorId }}'] || [];
                colorSizeMap['{{ $colorId }}'].push('{{ $sizeId }}');
            @endforeach
        @endforeach

        // Add Color Row
        $('#addColorBtn').on('click', function() {
            const colorId = $('#colorSelect').val();
            const colorText = $('#colorSelect option:selected').text();

            if (colorId && !colorSizeMap[colorId]) { // Prevent adding the same color twice
                colorSizeMap[colorId] = [];
                addColorRow(colorId, colorText);
            } else {
                alert("Color already added or not selected.");
            }
        });

        // Function to add a new color row with an image input
        function addColorRow(colorId, colorText) {
            const colorRow = `
                    <tr id="colorRow-${colorId}">
                        <td>${colorText}</td>
                        <td>
                            <input type="file" name="color_img_${colorId}" accept="image/*" multiple class="form-control form-control-sm">
                        </td>
                        <td>
                            <span class="delete-icon" onclick="removeColor('${colorId}')"><i class="mdi mdi-trash-can font-size-16"></i></span>
                        </td>
                    </tr>`;
            $('#colorTable tbody').append(colorRow);
        }

        // Apply Sizes to All Colors
        $('#addSizeBtn').on('click', function() {
            const selectedSizes = $('#sizeSelect').val();
            if (selectedSizes && selectedSizes.length > 0) {
                updateSizeTable(selectedSizes);
            } else {
                alert("Please select at least one size.");
            }
        });

        // Function to update the size table based on selected colors and sizes
        function updateSizeTable(selectedSizes) {
            $('#sizeTable tbody').empty(); // Clear existing rows
            Object.keys(colorSizeMap).forEach(colorId => {
                if (selectedSizes.length > 0) {
                    colorSizeMap[colorId] = selectedSizes;
                    addSizeRows(colorId, selectedSizes);
                }
            });
        }

        // Function to add rows for sizes under each color
        function addSizeRows(colorId, sizes) {
            sizes.forEach((sizeId, index) => {
                const sizeText = $(`#sizeSelect option[value="${sizeId}"]`).text();
                const sizeRow = `
                <tr id="${colorId}-${sizeId}">
                    ${index === 0 ? `<td rowspan="${sizes.length}" class="color-cell">${$(`#colorSelect option[value="${colorId}"]`).text()}</td>` : ''}
                    <td>${sizeText}</td>
                    <td>
                        <input type="number" name="price_${colorId}_${sizeId}" placeholder="Price" class="form-control form-control-sm" required>
                    </td>
                    <td>
                        <input type="text" name="sku_${colorId}_${sizeId}" placeholder="Seller SKU" class="form-control form-control-sm" required>
                    </td>
                    <td>
                        <input type="number" name="stock_${colorId}_${sizeId}" placeholder="Stock" class="form-control form-control-sm" required>
                    </td>
                    <td>
                        <span class="delete-icon" onclick="removeSize('${colorId}', '${sizeId}')"><i class="mdi mdi-trash-can d-block font-size-16"></i></span>
                    </td>
                </tr>`;
                $('#sizeTable tbody').append(sizeRow);
            });
        }

        // Function to remove an entire color row
        window.removeColor = function(colorId) {
            $(`#colorRow-${colorId}`).remove();
            delete colorSizeMap[colorId]; // Remove color from map
            $(`#sizeTable tbody tr[id^="${colorId}-"]`).remove(); // Remove all related size rows
        };

        // Function to remove a single size row
        window.removeSize = function(colorId, sizeId) {
            const sizeRow = $(`#${colorId}-${sizeId}`);
            sizeRow.remove(); // Remove the specific size row
            colorSizeMap[colorId] = colorSizeMap[colorId].filter(s => s !==
                sizeId); // Remove size from the map

            // Update rowspan for the color cell
            const colorRows = $(`#sizeTable tbody tr[id^="${colorId}-"]`);
            const remainingSizes = colorSizeMap[colorId].length;

            if (remainingSizes > 0) {
                // Update rowspan
                colorRows.first().find('.color-cell').attr('rowspan', remainingSizes);
            } else {
                // Remove the entire color row if no sizes are left
                removeColor(colorId);
            }
        };

        // Handle form submission with AJAX
        $('#add_product_variation').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            const formData = new FormData(this);
            // Initialize an object to group variations by color
            const groupedVariations = {};

            // Group variations by color
            Object.keys(colorSizeMap).forEach(colorId => {
                colorSizeMap[colorId].forEach(sizeId => {
                    // Initialize the group for the color if not already done
                    if (!groupedVariations[colorId]) {
                        groupedVariations[colorId] = {
                            color_id: colorId,
                            variations: []
                        };
                    }

                    // Push the size and related attributes to the color group
                    groupedVariations[colorId].variations.push({
                        size_id: sizeId,
                        price: $(
                                `body input[name="price_${colorId}_${sizeId}"]`)
                            .val(),
                        sku: $(`body input[name="sku_${colorId}_${sizeId}"]`)
                            .val(),
                        stock: $(
                                `body input[name="stock_${colorId}_${sizeId}"]`)
                            .val()
                    });
                });
            });

            // Append the grouped data to formData
            Object.values(groupedVariations).forEach(group => {
                formData.append('variations[]', JSON.stringify(group));
            });

            // Append images for each color to formData
            Object.keys(colorSizeMap).forEach(colorId => {
                // Find the input element by name attribute
                const inputElement = $(`input[name="color_img_${colorId}"]`)[0];

                // Check if the input element exists and has files
                if (inputElement && inputElement.files.length > 0) {
                    // If files exist, add them to formData
                    Array.from(inputElement.files).forEach(file => {
                        formData.append(`color_images_${colorId}[]`, file);
                    });
                } else {
                    // Handle the case where no files exist
                    console.log(`No files found for color ${colorId}`);
                }
            });

            // Send AJAX request
            $.ajax({
                url: '{{ route('products.store-variations') }}', // Replace with your route name
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert('Product variations saved successfully!');
                    // Handle success response here
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                    // Handle error response here
                }
            });
        });
    });
    // End Variation JS
</script>
