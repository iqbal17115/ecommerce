<script type="text/javascript">
    $(document).ready(function() {
        $("#search_string").on('keyup', function(e) {
            e.preventDefault();
            let search_string = $("#search_string").val();
            $.ajax({
                url: "{{route('search.product')}}",
                method: 'get',
                data: {
                    search_string: search_string
                },
                success: function(data) {
                    $('.product_content').html(data);
                    if (data.status == 'nothing_found') {
                        $('.product_content').html(
                            '<div class="text-danger text-center h3 mt-3">Nothing Found!!</div>'
                        );
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
    });

    function pagination(page) {
        $.ajax({
            url: '/pagination/product-pagination-data?page=' + page,
            success: function(data) {
                $('.product_content').html(data);
            }
        })
    }
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1]
        pagination(page);
    });
</script>