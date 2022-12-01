<script>
$(document).ready(function() {
    $(document).on('keyup', function(e) {
        e.preventDefault();
        let search_string = $("#search_string").val();
        $.ajax({
            url: "{{route('search.material')}}",
            method: 'get',
            data: {search_string: search_string},
            success: function(data) {
                    $('.material_content').html(data);
                    if(data.status=='nothing_found') {
                        $('.material_content').html('<div class="text-danger text-center h3 mt-3">Nothing Found!!</div>');
                    }
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

    function pagination(page) {
        $.ajax({
            url: '/pagination/material-pagination-data?page=' + page,
            success: function(data) {
                $('.material_content').html(data);
            }
        })
    }
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1]
        pagination(page);
    });
    $(document).on('click', '.delete_material', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are you sure want to delete material?')) {
            $.ajax({
                url: "{{route('delete.material')}}",
                method: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        $('.material_content').load(location.href + ' .material_content');
                        $('.paginate').load(location.href + ' .paginate');
                        Command: toastr["success"]("Material Deleted",
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
        $('#addMaterial')[0].reset();
        $('#cu_id').val(-1);
    });

    $(document).on('click', '.update_form', function(e) {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let short_name = $(this).data('short_name');
        let is_active = $(this).data('is_active');

        $('#cu_id').val(id);
        $('#name').val(name);
        $('#short_name').val(short_name);
        $('#is_active').val(is_active);
    });

    $(document).on('submit', '#addMaterial', function(e) {
        e.preventDefault();

        let formData = this;
        $.ajax({
            url: "{{route('add.material')}}",
            method: 'post',
            data: new FormData(formData),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(data) {
                if (data.status == 'success') {
                    Command: toastr["success"]("Material Added",
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

                    $('#materialModal').modal('hide');
                    $('#addMaterial')[0].reset();
                    $('.material_content').load(location.href + ' .material_content');
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