<script>
$(document).ready(function() {

    // $('.update_form').on('click', function(e) {
    //     let id = $(this).data('id');
    //     let name = $(this).data('name');
    //     let short_name = $(this).data('short_name');
    //     let is_active = $(this).data('is_active');

    //     $('#cu_id').val(id);
    //     $('#name').val(name);
    //     $('#short_name').val(short_name);
    //     $('#is_active').val(is_active);
    // });

    $('.add_unit').on('click', function(e) {
        e.preventDefault();
        let cu_id = $('#cu_id').val();
        alert(cu_id);
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
                    $('#unitModal').modal('hide');
                    $('#addUnit')[0].reset();
                    $('.table').load(location.href + '.table');
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