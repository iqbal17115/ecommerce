<script>
$(document).ready(function() {
    $("#search_string").on('keyup', function(e) {
        e.preventDefault();
        let search_string = $("#search_string").val();
        $.ajax({
            url: "{{route('search.feature')}}",
            method: 'get',
            data: {
                search_string: search_string
            },
            success: function(data) {
                $('.product_feature_content').html(data);
                if (data.status == 'nothing_found') {
                    $('.product_feature_content').html(
                        '<div class="text-danger text-center h3 mt-3">Nothing Found!!</div>'
                        );
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

    function pagination(page) {
        $.ajax({
            url: '/pagination/feature-pagination-data?page=' + page,
            success: function(data) {
                $('.product_feature_content').html(data);
            }
        })
    }
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1]
        pagination(page);
    });
    $(document).on('click', '.delete_product_feature', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are you sure want to delete feature?')) {
            $.ajax({
                url: "{{route('delete.feature')}}",
                method: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        $('.product_feature_content').load(location.href + ' .product_feature_content');
                        $('.paginate').load(location.href + ' .paginate');
                        Command: toastr["success"]("Feature Deleted",
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
        $('#addProductFeature')[0].reset();
        $('#cu_id').val(-1);
    });

    $(document).on('click', '.update_form', function(e) {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let card_feature = $(this).data('card_feature');
        let top_menu = $(this).data('top_menu');
        let position = $(this).data('position');
        let is_active = $(this).data('is_active');
        
        $('#cu_id').val(id);
        $('#name').val(name);
        $('#card_feature').val(card_feature);
        $('#top_menu').val(top_menu);
        $('#position').val(position);
        $('#is_active').val(is_active);
    });
    $(document).on('submit', '#addProductFeature', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: "{{route('add.feature')}}",
            method: 'post',
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
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

                    $('#productFeatureModal').modal('hide');
                    $('#addProductFeature')[0].reset();
                    $('.product_feature_content').load(location.href + ' .product_feature_content');
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