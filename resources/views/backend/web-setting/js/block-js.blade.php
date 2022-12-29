<script>
    $(document).ready(function() {


        $(document).on('change', '#image', function(e) {
            $('#imgPreview').show();
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#imgPreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

        function pagination(page) {
            $.ajax({
                url: '/pagination/block-pagination-data?page=' + page,
                success: function(data) {
                    $('.block_content').html(data);
                }
            })
        }
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            pagination(page);
        });
        $(document).on('click', '.delete_block', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Are you sure want to delete block?')) {
                $.ajax({
                    url: "{{route('delete.block')}}",
                    method: 'post',
                    data: {
                        id: id
                    },
                    enctype: 'multipart/form-data',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            $('.block_content').load(location.href + ' .block_content');
                            $('.paginate').load(location.href + ' .paginate');
                            Command: toastr["success"]("Block Deleted",
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
            $('#addBlock')[0].reset();
            $('#cu_id').val(-1);
            $('#imgPreview').hide();
        });

        $(document).on('submit', '#addBlock', function(e) {
            e.preventDefault();
            var form = this;
            console.log(form);
            $.ajax({
                url: "{{route('add.block')}}",
                method: 'post',
                data: new FormData(form),
                enctype: 'multipart/form-data',
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        Command: toastr["success"]("Block Added",
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

                        $('#blockModal').modal('hide');
                        $('#addBlock')[0].reset();
                        $('.block_content').load(location.href + ' .block_content');
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
        $('#imgPreview').hide();

        let id = $(this).data('id');
        let category_id = $(this).data('category_id');
        alert(category_id);
        let position = $(this).data('position');
        let style = $(this).data('style');
        let is_active = $(this).data('is_active');
        $('#category_id').val(category_id);
        $('.category_id').val(category_id).trigger("change");
        $('#style').val(style);
        $('#position').val(position);
        $('#is_active').val(is_active);
        $('#cu_id').val(id);

        if ($('#image').length) {
            let image = $(this).data('image');
            $('#imgPreview').show();
            $('#imgPreview').attr("src", 'storage/' + image);
        }

    });
</script>