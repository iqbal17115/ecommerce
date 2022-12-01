<script>
$(document).ready(function() {
    function colorContent(type) {
        if(type=="Color") {
            $('.color_code_content').show();
        }else if(type == "" || type=="Size") {
            $('.color_code_content').hide();
        }
    }
    $(document).on('change', '.type', function(e) {
        let type = $("#type").val();
        colorContent(type);
    });
    $(document).on('keyup', function(e) {
        e.preventDefault();
        let search_string = $("#search_string").val();
        $.ajax({
            url: "{{route('search.variant')}}",
            method: 'get',
            data: {search_string: search_string},
            success: function(data) {
                    $('.variant_content').html(data);
                    if(data.status=='nothing_found') {
                        $('.variant_content').html('<div class="text-danger text-center h3 mt-3">Nothing Found!!</div>');
                    }
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

    function pagination(page) {
        $.ajax({
            url: '/pagination/variant-pagination-data?page=' + page,
            success: function(data) {
                $('.variant_content').html(data);
            }
        })
    }
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        pagination(page);
    });
    $(document).on('click', '.delete_variant', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are you sure want to delete variant?')) {
            $.ajax({
                url: "{{route('delete.variant')}}",
                method: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        $('.variant_content').load(location.href + ' .variant_content');
                        $('.paginate').load(location.href + ' .paginate');
                        Command: toastr["success"]("Variant Deleted",
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
        $('#addVariant')[0].reset();
        $('#cu_id').val(-1);
        $('.color_code_content').hide();
    });

    $(document).on('click', '.update_form', function(e) {
        let id = $(this).data('id');
        let type = $(this).data('type');
        let name = $(this).data('name');
        let color_code = $(this).data('color_code');
        let is_active = $(this).data('is_active');
        colorContent(type);
        $('#cu_id').val(id);
        $('#type').val(type);
        $('#name').val(name);
        $('#color_code').val(color_code);
        $('#is_active').val(is_active);
    });

    $(document).on('click', '.add_variant', function(e) {
        e.preventDefault();
        let cu_id = $('#cu_id').val();
        let name = $('#name').val();
        let type = $('#type').val();
        let color_code = $('#color_code').val();
        let is_active = $('#is_active').val();
        let formData = {
            cu_id: cu_id,
            name: name,
            type: type,
            color_code: color_code,
            is_active: is_active
        };

        $.ajax({
            url: "{{route('add.variant')}}",
            method: 'post',
            data: formData,
            dataType: 'json',
            success: function(data) {
                if (data.status == 'success') {
                    Command: toastr["success"]("Variant Added",
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

                    $('#variantModal').modal('hide');
                    $('#addVariant')[0].reset();
                    $('.variant_content').load(location.href + ' .variant_content');
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