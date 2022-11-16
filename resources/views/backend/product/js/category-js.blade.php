<script>
$(document).ready(function() {
    $(document).on('keyup', function(e) {
        e.preventDefault();
        let search_string = $("#search_string").val();
        $.ajax({
            url: "{{route('search.category')}}",
            method: 'get',
            data: {
                search_string: search_string
            },
            success: function(data) {
                $('.category_content').html(data);
                if (data.status == 'nothing_found') {
                    $('.category_content').html(
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
            url: '/pagination/category-pagination-data?page=' + page,
            success: function(data) {
                $('.category_content').html(data);
            }
        })
    }
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1]
        pagination(page);
    });
    $(document).on('click', '.delete_category', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are you sure want to delete category?')) {
            $.ajax({
                url: "{{route('delete.category')}}",
                method: 'post',
                data: {
                    id: id
                },
                enctype: 'multipart/form-data',
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        $('.category_content').load(location.href + ' .category_content');
                        $('.paginate').load(location.href + ' .paginate');
                        Command: toastr["success"]("Category Deleted",
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
        $('#addCategory')[0].reset();
        $('#cu_id').val(-1);
    });

    $(document).on('click', '.update_form', function(e) {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let image = $(this).data('image');
        let website = $(this).data('website');
        let is_active = $(this).data('is_active');

        $('#cu_id').val(id);
        $('#name').val(name);
        $('#image').val(image);
        $('#website').val(website);
        $('#is_active').val(is_active);
    });

    $(document).on('submit', '#addCategory', function(e) {
        e.preventDefault();
        var form = this;
        alert("OK");
        $.ajax({
            url: "{{route('add.category')}}",
            method: 'post',
            data: new FormData(form),
            enctype: 'multipart/form-data',
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(data) {
                if (data.status == 'success') {
                    Command: toastr["success"]("Category Added",
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

                    $('#categoryModal').modal('hide');
                    $('#addCategory')[0].reset();
                    $('.category_content').load(location.href + ' .category_content');
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