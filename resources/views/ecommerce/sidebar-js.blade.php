<script>
$(document).ready(function() {
    $('.parent_category').on('click', function() {
        let id = $(this).data('id');
        $.ajax({
            url: "{{route('get_sub_category')}}",
            method: 'get',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(data) {
              console.log(data['sub_categories']);
            },
            error: function(err) {
                let error = err.responseJSON;
                console.log(error);
            }
        });
    });
});
</script>