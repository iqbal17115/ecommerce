<script>
$(document).ready(function() {
    check_sub_category = '';
    categoryData = [];
    $('body').on('click', '#minimizeSidebar', function() {
        // sidebar-wrapper
        $("#sidebar-wrapper").css("width", "0px");

        // Call Sidebar Content
        $.ajax({
            url: "{{route('get_sidebar_content')}}",
            method: 'get',
            async: false,
            success: function(data) {
                console.log(data);
                $('#category_show').html(data);
            },
            error: function(err) {
                var error = err.responseJSON;
                console.log(error);

            }
        });
    });

    function checkParentCategory(parent_cat_id) {
        // Check SubCategory
        $.ajax({
            url: "{{route('check_sub_category')}}",
            method: 'get',
            data: {
                id: parent_cat_id
            },
            dataType: 'json',
            async: false,
            success: function(data) {
                check_sub_category = data;
            },
            error: function(err) {
                var error = err.responseJSON;
                console.log(error);
            }
        });
        return check_sub_category;
    }
    $('body').on('click', '#category_back', function() {
        categoryData.pop();
        var lastItem = categoryData[categoryData.length - 1]
        // Get SubCategory
        $.ajax({
            url: "{{route('get_parent_category')}}",
            method: 'get',
            data: {
                id: lastItem
            },
            dataType: 'json',
            success: function(data) {
                sub_category_list = '';
                if (data['categories'][0]['parent_category_id'] == null) {
                    $("#category_back").hide();
                }
                for (var i = 0; i < data['categories'].length; i++) {

                    check_sub_category = 0;
                    if (data['categories'][i]['sub_category'].length > 0) {
                        check_sub_category = 1;
                    }
                    parent_category = check_sub_category == 1 ? 'parent_category' : '';
                    arrow_signal = check_sub_category == 1 ?
                        '<i class="arrow right float-right"></i>' : '';
                    sub_category_list +=
                        "<li style='list-style: none;padding-bottom: 2px;' class='list-group-item'><a style='font-family: inherit;' href='javascript:void(0);' class='" +
                        parent_category + "' data-id='" + data['categories'][i]['id'] +
                        "'>" + data['categories'][i]['name'] + arrow_signal +
                        "</a></li>";
                }
                $('#category_content').nextAll('li').remove();
                $("#category_show").append(sub_category_list);
            },
            error: function(err) {
                var error = err.responseJSON;
                console.log(error);
            }
        });
    });
    $('body').on('click', '.parent_category', function() {
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
                sub_category_list = '';
                var parent_category_id = [];
                // $("#category_back").css("visibility: hidden;");
                $("#category_back").show();
                for (var i = 0; i < data['sub_categories'].length; i++) {
                    check_sub_category = 0;
                    if (data['sub_categories'][i]['sub_category'].length > 0) {
                        check_sub_category = 1;
                    }
                    parent_category = check_sub_category == 1 ? 'parent_category' : '';
                    arrow_signal = check_sub_category == 1 ?
                        '<i class="arrow right float-right"></i>' : '';

                    var url = '{{ route("shop", ":id") }}';
                    url = check_sub_category == 0 ?
                        url.replace(':id', data['sub_categories'][i]['id']) :
                        'javascript:void(0)';
                    //  url = url.replace(':id', data['sub_categories'][i]['id']);
                    sub_category_list +=
                        "<li style='list-style: none;padding-bottom: 2px;' class='list-group-item'><a style='font-family: inherit;' href='" +
                        url + "' class='" +
                        parent_category + "' data-id='" + data['sub_categories'][i]['id'] +
                        "'>" + data['sub_categories'][i]['name'] + arrow_signal +
                        "</a></li>";
                    parent_category_id.push(data['sub_categories'][i]['id']);
                }
                $('#category_content').nextAll('li').remove();
                $("#category_show").append(sub_category_list);
                var category_data = $("#category_data").val();
                categoryData.push([parent_category_id]);
                $('#category_data').val(categoryData);

            },
            error: function(err) {
                var error = err.responseJSON;
                console.log(error);
            }
        });
    });
});
</script>