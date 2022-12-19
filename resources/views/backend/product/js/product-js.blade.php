<script type="text/javascript">
    function variationManage(variation_type, val) {
        if (variation_type == 1) {
            variation_content = '<div class="col-md-12" style="display: flex;">';
            variation_content += '<div style="width: 80px; font-weight: bold;">' + val + '</div>';
            variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
            variation_content += '<div style="width: 150px;"><input name="age_range" class="input-form" /></div>';
            variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
            variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
            variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
            variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
            variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
            variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
            variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
            variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
            variation_content += '</div>';
            $("#variation_row").append(variation_content);
        }
    }

    $("body").on("click", "#add_individual_color", function() {
        let individual_color = $("#individual_color").val();

        if (individual_color != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' + individual_color + '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_color").append(badge);
            $("#individual_color").val(null);
            // variationManage(1, individual_color);
        }

        // Start Variation Head
        variation_head = '';
        variation_head += '<div style="width: 80px; font-size: 14px; font-weight: bold;">Size</div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Target Gender</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Description</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Bottom Size</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Bottom Size Map</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Seller SKU</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Product Id</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Type</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Price</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Quantity</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Condition</span></div>';
        $("#variation_head").empty();
        $("#variation_head").append(variation_head);
        // End Variation Head
    });

    $("body").on("click", "#add_individual_size", function() {
        let individual_size = $("#individual_size").val();

        if (individual_size != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' + individual_size + '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_size").append(badge);
            $("#individual_size").val(null)
            variationManage(1, individual_size);
        }

        // Start Variation Head
        variation_head = '';
        variation_head += '<div style="width: 80px; font-size: 14px; font-weight: bold;">Size</div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Target Gender</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Description</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Bottom Size</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Bottom Size Map</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Seller SKU</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Product Id</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Type</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Price</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Quantity</span></div>';
        variation_head += '<div style="width: 150px; font-size: 14px; font-weight: bold;"><span style="width: 100%;">Condition</span></div>';
        $("#variation_head").empty();
        $("#variation_head").append(variation_head);
        // End Variation Head
    });

    $('#color').on('click', function(e) {
        if ($(this).prop("checked") == true) {
            add_color = '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 18px;">Color </label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_color" placeholder="Color" aria-label="Size" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-success add_individual_color" id="add_individual_color">Add</button></div></div></div></div>';
            $("#add_color").append(add_color);
            $("#all_color").after('<div class="col-md-12 remove_color_hr"><hr></div>');
        } else if ($(this).prop("checked") == false) {
            $("#add_color").empty();
            $(".remove_color_hr").remove();
        }
    });

    $('#size').on('click', function(e) {
        if ($(this).prop("checked") == true) {
            add_size = '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 18px;">Size</label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_size" placeholder="Size" aria-label="Size" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-success add_individual_size" id="add_individual_size">Add</button></div></div></div></div>';
            $("#add_size").append(add_size);
            $("#all_size").after('<div class="col-md-12 remove_size_hr"><hr></div>');
        } else if ($(this).prop("checked") == false) {
            $("#add_size").empty();
            $(".remove_size_hr").remove();
        }
    });



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
    $('#product_description').summernote({
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
            '<input type="text" class="form-control m-input"> </div> </div>';

        $('#newinput').append(newRowAdd);
    });

    $("body").on("click", "#DeleteRow", function() {
        $(this).parents("#row").remove();
    })
</script>