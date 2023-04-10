<script>
    $(document).ready(function() {
        $('#imgPreview').hide();
        $(document).on('change', '#image', function(e) {
            $('#imgPreview').show();
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    console.log(event.target.result);
                    $('#imgPreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

        function pagination(page) {
            $.ajax({
                url: '/pagination/slider-pagination-data?page=' + page,
                success: function(data) {
                    $('.slider_content').html(data);
                }
            })
        }
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            pagination(page);
        });
        $(document).on('click', '.delete_slider', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Are you sure want to delete slider?')) {
                $.ajax({
                    url: "{{route('delete.slider')}}",
                    method: 'post',
                    data: {
                        id: id
                    },
                    enctype: 'multipart/form-data',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            $('.slider_content').load(location.href + ' .slider_content');
                            $('.paginate').load(location.href + ' .paginate');
                            Command: toastr["success"]("Slider Deleted",
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
            $('#addSlider')[0].reset();
            $('#cu_id').val(-1);
            $('#imgPreview').hide();
        });

        $(document).on('click', '.update_form', function(e) {
            let id = $(this).data('id');
            let link = $(this).data('link');
            let image = $(this).data('image');
            let position = $(this).data('position');
            let category_id = $(this).data('category_id');
            $('.category_id').val(category_id).trigger("change");
            let is_active = $(this).data('is_active');
            $('#cu_id').val(id);
            $('#link').val(link);
            if (image) {
                $('#imgPreview').show();
                $('#imgPreview').attr("src", 'storage/' + image);
            }
            $('#position').val(position);
            $('#category_id').val(category_id);
            $('#is_active').val(is_active);
        });

        $(document).on('submit', '#addSlider', function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: "{{route('add.slider')}}",
                method: 'post',
                data: new FormData(form),
                enctype: 'multipart/form-data',
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        Command: toastr["success"]("Slider Added",
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

                        $('#sliderModal').modal('hide');
                        $('#addSlider')[0].reset();
                        $('.slider_content').load(location.href + ' .slider_content');
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
</script>