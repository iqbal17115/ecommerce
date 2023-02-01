<script>
$(document).ready(function() {
    // function checkSubCategory(id) {
    //     $.ajax({
    //         url: "{{route('check_sub_category')}}",
    //         method: 'get',
    //         data: {
    //             id: id
    //         },
    //         dataType: 'json',
    //         success: function(data) {
    //             return data['sub_category'];
    //         },
    //         error: function(err) {
    //             let error = err.responseJSON;
    //             console.log(error);
    //         }
    //     });
    // }
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
              sub_category_list = '';
              for (let i = 0; i < data['sub_categories'].length; i++) {
                //   var aa = checkSubCategory(data['sub_categories'][i]['id']);
                //   console.log(aa);
                  sub_category_list += "<li><a>"+ data['sub_categories'][i]['name'] + "<i class='arrow right float-right'></i></a></li>";
              }
            },
            error: function(err) {
                let error = err.responseJSON;
                console.log(error);
            }
        });
    });
});
</script>