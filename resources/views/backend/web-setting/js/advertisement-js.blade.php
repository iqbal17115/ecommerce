<script>
    $(document).ready(function() {

        function pagination(page) {
            $.ajax({
                url: '/pagination/advertisement-pagination-data?page=' + page,
                success: function(data) {
                    $('.advertisement_content').html(data);
                }
            })
        }
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            pagination(page);
        });
        $(document).on('click', '.delete_advertisement', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Are you sure want to delete advertisement?')) {
                $.ajax({
                    url: "{{route('delete.advertisement')}}",
                    method: 'post',
                    data: {
                        id: id
                    },
                    enctype: 'multipart/form-data',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            $('.advertisement_content').load(location.href + ' .advertisement_content');
                            $('.paginate').load(location.href + ' .paginate');
                            Command: toastr["success"]("Advertisement Deleted",
                                "success")

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
                    error: function(err) {
                        let error = err.responseJSON;
                        console.log(error);
                    }
                });
            }

        });

        $(document).on('click', '.clean_form', function(e) {
            $('#addAdvertisement')[0].reset();
            $('#cu_id').val(-1);
            $('#imgPreview1').hide();
            // Get Product Feature
            $.ajax({
                url: "{{route('get-product-feature')}}",
                method: 'get',
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                        // $('#advertisementModal').modal('hide');
                        // $('#addAdvertisement')[0].reset();
                },
                error: function(err) {
                    let error = err.responseJSON;
                   
                }
            });
        });

        $(document).on('submit', '#addAdvertisement', function(e) {
            e.preventDefault();
            var form = this;
            console.log(form);
            $.ajax({
                url: "{{route('add.advertisement')}}",
                method: 'post',
                data: new FormData(form),
                enctype: 'multipart/form-data',
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        Command: toastr["success"]("Advertisement Added",
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

                        $('#advertisementModal').modal('hide');
                        $('#addAdvertisement')[0].reset();
                        $('.advertisement_content').load(location.href + ' .advertisement_content');
                        $('.paginate').load(location.href + ' .paginate');
                        $('#cu_id').val(-1);

                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(key, value) {
                        $('.err_' + key).html(value);
                    });
                }
            });
        });

    });

    $(document).on('click', '.update_form', function(e) {
        $('#imgPreview1').hide();
        $('#imgPreview2').hide();
        $('#imgPreview3').hide();

        let id = $(this).data('id');
        let page = $(this).data('page');
        let position = $(this).data('position');
        let product_feature_id = $(this).data('product_feature_id');
        let is_active = $(this).data('is_active');
     
        $('#cu_id').val(id);
        $('#page').val(page);
        $('#position').val(position);
        $('.product_feature_id').val(product_feature_id).trigger("change");
        $('#is_active').val(is_active);
        styleType();
        if ($('#embed_code_or_image1').length) {
            let embed_code_or_image1 = $(this).data('embed_code_or_image1');
            if (type == "Embed Code") {
                $('#embed_code_or_image1').val(embed_code_or_image1);
            } else {
                $('#imgPreview1').show();
                $('#imgPreview1').attr("src", 'storage/' + embed_code_or_image1);
                let url1 = $(this).data('url1');
                $('#url1').val(url1);
            }
        }

    });

    function styleType() {
        var ads_style = $('#style').val();
        $('#ads_content').empty();
        var ads_content = "";
        if (ads_style == "Style One") {
            ads_content += "<div class='col-md-6'><div class='form-group'><label for='title'>Title</label><input type='text' name='title' id='title' class='form-control'  placeholder='Title'></div></div><div class='col-md-6'><div class='form-group'><label for='sub_title'>Sub-title</label><input type='text' name='sub_title' id='sub_title' class='form-control' placeholder='Sub-title'></div></div>";
        } else if (ads_style == "Style Two") {
            ads_content += "<div class='col-md-6'><div class='form-group'><label for='title'>Title</label><input type='text' name='title' id='title' class='form-control'  placeholder='Title'></div></div><div class='col-md-6'><div class='form-group'><label for='sub_title'>Sub-title</label><input type='text' name='sub_title' id='sub_title' class='form-control' placeholder='Sub-title'></div></div><div class='col-md-6'><div class='form-group'><label for='offer'>Offer In Amount</label><input type='number' name='offer' id='offer' class='form-control' placeholder='Offer'></div></div><div class='col-md-6'><div class='form-group'><label for='image'>Image</label><input type='file' name='image' id='image' class='form-control'></div></div>";
        } else if (ads_style == "Style Three") {
            ads_content += "<div class='col-md-6'><div class='form-group'><label for='title'>Title</label><input type='text' name='title' id='title' class='form-control'  placeholder='Title'></div></div><div class='col-md-6'><div class='form-group'><label for='sub_title'>Sub-title</label><input type='text' name='sub_title' id='sub_title' class='form-control' placeholder='Sub-title'></div></div><div class='col-md-6'><div class='form-group'><label for='offer'>Offer In Percentage</label><input type='number' name='offer' id='offer' class='form-control' placeholder='Offer'></div></div><div class='col-md-6'><div class='form-group'><label for='image'>Image</label><input type='file' name='image' id='image' class='form-control'></div></div>";
        } else if (ads_style == "Style Four") {
            ads_content += "<div class='col-md-6'><div class='form-group'><label for='title'>Title</label><input type='text' name='title' id='title' class='form-control'  placeholder='Title'></div></div><div class='col-md-6'><div class='form-group'><label for='sub_title'>Sub-title</label><input type='text' name='sub_title' id='sub_title' class='form-control' placeholder='Sub-title'></div></div><div class='col-md-12'><div class='form-group'><label for='image'>Image</label><input type='file' name='image' id='image' class='form-control'></div></div>";
        }
        ads_content += "</div>";
        $("#ads_content").append(ads_content);
    }
</script>