<script>
$(document).ready(function() {

    $(document).on('click', '.delete_unit', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are you sure want to delete unit?')) {
            $.ajax({
                url: "{{route('delete.unit')}}",
                method: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        $('.table').load(location.href + ' .table');
                        $('.paginate').load(location.href + ' .paginate');
                        Command: toastr["success"]("Unit Deleted",
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
        $('#addUnit')[0].reset();
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

    $(document).on('click', '.add_unit', function(e) {
        e.preventDefault();
        let cu_id = $('#cu_id').val();
        let name = $('#name').val();
        let short_name = $('#short_name').val();
        let is_active = $('#is_active').val();

        let formData = {
            cu_id: cu_id,
            name: name,
            short_name: short_name,
            is_active: is_active
        };

        $.ajax({
            url: "{{route('add.unit')}}",
            method: 'post',
            data: formData,
            dataType: 'json',
            success: function(data) {
                if (data.status == 'success') {
                    Command: toastr["success"]("Unit Added",
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
                        
                    $('#unitModal').modal('hide');
                    $('#addUnit')[0].reset();
                    $('.table').load(location.href + ' .table');
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