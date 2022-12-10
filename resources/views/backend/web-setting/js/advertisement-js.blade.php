<script>
    $(document).ready(function() {

        $(document).on('change', '#embed_code_or_image1', function(e) {
            $('#imgPreview1').show();
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#imgPreview1').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
        $(document).on('change', '#embed_code_or_image2', function(e) {
            $('#imgPreview2').show();
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#imgPreview2').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
        $(document).on('change', '#embed_code_or_image3', function(e) {
            $('#imgPreview3').show();
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#imgPreview3').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

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
            $('#imgPreview2').hide();
            $('#imgPreview3').hide();
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
        let style = $(this).data('style');
        let type = $(this).data('type');
        let is_active = $(this).data('is_active');
        $('#style').val(style);
        $('#type').val(type);
        $('#cu_id').val(id);
        $('#page').val(page);
        $('#position').val(position);
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
        if ($('#embed_code_or_image2').length) {
            let embed_code_or_image2 = $(this).data('embed_code_or_image2');
            if (type == "Embed Code") {
                $('#embed_code_or_image2').val(embed_code_or_image2);
            } else {
                $('#imgPreview2').show();
                $('#imgPreview2').attr("src", 'storage/' + embed_code_or_image2);
                let url2 = $(this).data('url2');
                $('#url2').val(url2);
            }
        }
        if ($('#embed_code_or_image3').length) {
            let embed_code_or_image3 = $(this).data('embed_code_or_image3');
            if (type == "Embed Code") {
                $('#embed_code_or_image3').val(embed_code_or_image3);
            } else {
                $('#imgPreview3').show();
                $('#imgPreview3').attr("src", 'storage/' + embed_code_or_image3);
                let url3 = $(this).data('url3');
                $('#url3').val(url3);
            }
        }

    });

    function styleType() {
        var ads_style = $('#style').val();
        var ads_type = $('#type').val();
        $('#ads_content').empty();
        var ads_content = "";
        if (ads_style == "Style One" && ads_type == "Image Ads") {
            ads_content += "<div class='col-md-6'><div class='form-group'><label for='embed_code_or_image1'>Image1</label><input type='file' name='embed_code_or_image1' id='embed_code_or_image1' class='form-control'></div></div><div class='col-md-6'><div class='form-group'><label for='url1'>URL1</label><input type='text' name='url1' id='url1' class='form-control' placeholder='e.g. http://zainsoft.com'></div></div>";
        } else if (ads_style == "Style Two" && ads_type == "Image Ads") {
            ads_content += "<div class='col-md-6'><div class='form-group'><label for='embed_code_or_image1'>Image1</label><input type='file' name='embed_code_or_image1' id='embed_code_or_image1' class='form-control'></div></div><div class='col-md-6'><div class='form-group'><label for='url1'>URL1</label><input type='text' name='url1' id='url1' class='form-control' placeholder='e.g. http://zainsoft.com'></div></div><div class='col-md-6'><div class='form-group'><label for='embed_code_or_image2'>Image2</label><input type='file' name='embed_code_or_image2' id='embed_code_or_image2' class='form-control'></div></div><div class='col-md-6'><div class='form-group'><label for='url2'>URL2</label><input type='text' name='url2' id='url2' class='form-control' placeholder='e.g. http://zainsoft.com'></div></div>";
        } else if (ads_style == "Style Three" && ads_type == "Image Ads") {
            ads_content += "<div class='col-md-6'><div class='form-group'><label for='embed_code_or_image1'>Image1</label><input type='file' name='embed_code_or_image1' id='embed_code_or_image1' class='form-control'></div></div><div class='col-md-6'><div class='form-group'><label for='url1'>URL1</label><input type='text' name='url1' id='url1' class='form-control' placeholder='e.g. http://zainsoft.com'></div></div><div class='col-md-6'><div class='form-group'><label for='embed_code_or_image2'>Image2</label><input type='file' name='embed_code_or_image2' id='embed_code_or_image2' class='form-control'></div></div><div class='col-md-6'><div class='form-group'><label for='url2'>URL2</label><input type='text' name='url2' id='url2' class='form-control' placeholder='e.g. http://zainsoft.com'></div></div><div class='col-md-6'><div class='form-group'><label for='embed_code_or_image3'>Image3</label><input type='file' name='embed_code_or_image3' id='embed_code_or_image3' class='form-control'></div></div><div class='col-md-6'><div class='form-group'><label for='url3'>URL3</label><input type='text' name='url3' id='url3' class='form-control' placeholder='e.g. http://zainsoft.com'></div></div>";
        } else if (ads_style == "Style One" && ads_type == "Embed Code") {
            ads_content += "<div class='col-md-12'><div class='form-group'><label for='ads_type'>Embed Code1</label><textarea name='embed_code_or_image1' id='embed_code_or_image1' class='form-control' placeholder='Embed Code'></textarea></div></div>";
        } else if (ads_style == "Style Two" && ads_type == "Embed Code") {
            ads_content += "<div class='col-md-12'><div class='form-group'><label for='ads_type'>Embed Code1</label><textarea name='embed_code_or_image1' id='embed_code_or_image1' class='form-control' placeholder='Embed Code'></textarea></div></div><div class='col-md-12'><div class='form-group'><label for='embed_code_or_image2'>Embed Code2</label><textarea name='embed_code_or_image2' id='embed_code_or_image2' class='form-control' placeholder='Embed Code'></textarea></div></div>";
        } else if (ads_style == "Style Three" && ads_type == "Embed Code") {
            ads_content += "<div class='col-md-12'><div class='form-group'><label for='ads_type'>Embed Code1</label><textarea name='embed_code_or_image1' id='embed_code_or_image1' class='form-control' placeholder='Embed Code'></textarea></div></div><div class='col-md-12'><div class='form-group'><label for='embed_code_or_image2'>Embed Code2</label><textarea name='embed_code_or_image2' id='embed_code_or_image2' class='form-control' placeholder='Embed Code'></textarea></div></div><div class='col-md-12'><div class='form-group'><label for='embed_code_or_image3'>Embed Code3</label><textarea name='embed_code_or_image3' id='embed_code_or_image3' class='form-control' placeholder='Embed Code'></textarea></div></div>";
        }
        ads_content += "</div>";
        $("#ads_content").append(ads_content);
    }
</script>