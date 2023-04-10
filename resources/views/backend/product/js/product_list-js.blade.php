<script type="text/javascript">
    $(document).on('click', '.delete_product', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Are you sure want to Delete Product?')) {
                $.ajax({
                    url: "{{route('delete.product')}}",
                    method: 'post',
                    data: {
                        id: id
                    },
                    enctype: 'multipart/form-data',
                    dataType: 'json',
                    success: function(data) {

                        if (data.status == 201) {
                            $('.product_content').load(location.href + ' .product_content');
                            $('.paginate').load(location.href + ' .paginate');
                            Command: toastr["success"]("Product Deleted",
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