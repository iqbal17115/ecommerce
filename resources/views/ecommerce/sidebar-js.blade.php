<script>
$(document).ready(function() {
    check_sub_category = '';
    
    function checkParentCategory(parent_cat_id) {
         // Check SubCategory
         $.ajax({
            url: "{{route('check_sub_category')}}",
            method: 'get',
            data: {
                id: parent_cat_id
            },
            dataType: 'json',
            async : false,
            success: function(data) {
                check_sub_category=data;
            },
            error: function(err) {
                var error = err.responseJSON;
                console.log(error);
            }
        });
        return check_sub_category;
    }
    $('body').on('click','.parent_category',function(){
    // $('.parent_category').on('click', function() {
        var id = $(this).data('id');

        // Get SubCategory
        $.ajax({
            url: "{{route('get_sub_category')}}",
            method: 'get',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(data) {
            //   console.log(data);
            // alert(data['sub_categories'].length);
              sub_category_list = '';
              for (var i = 0; i < data['sub_categories'].length; i++) {
                check_sub_category = checkParentCategory(data['sub_categories'][i]['id']);
                parent_category = check_sub_category==1 ? 'parent_category' : '';
                arrow_signal = check_sub_category==1 ? '<i class="arrow right float-right"></i>' : '';
                  sub_category_list += "<li style='list-style: none;padding-bottom: 2px;'><a style='font-family: inherit;' href='javascript:void(0);' class='" + parent_category + "' data-id='"+data['sub_categories'][i]['id']+"'>"+ data['sub_categories'][i]['name'] + arrow_signal+"</a></li>";
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