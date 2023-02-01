<script>
$(document).ready(function() {
    $('body').on('click','.parent_category',function(){
    // $('.parent_category').on('click', function() {
        var id = $(this).data('id');
        var check_sub_category=false;
        // Check SubCategory
        $.ajax({
            url: "{{route('check_sub_category')}}",
            method: 'get',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(data) {
                // check_sub_category=data;
            },
            error: function(err) {
                var error = err.responseJSON;
                console.log(error);
            }
        });

        // Get SubCategory
        $.ajax({
            url: "{{route('get_sub_category')}}",
            method: 'get',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(data) {
              console.log(data['sub_categories']);
              sub_category_list = '';
              for (var i = 0; i < data['sub_categories'].length; i++) {
                  sub_category_list += "<li style='color: white;'><a href='javascript:void(0);' class='parent_category' data-id='"+data['sub_categories'][i]['id']+"'>"+ data['sub_categories'][i]['name'] + "<i class='arrow right float-right'></i></a></li>";
              }
              $('#category_content').nextAll('li').remove();
              $("#category_show").append(sub_category_list);

              console.log(sub_category_list);
            },
            error: function(err) {
                var error = err.responseJSON;
                console.log(error);
            }
        });
    });
});
</script>