<script>
    $(document).ready(function() {
        $("#search_string").on('keyup', function(e) {
            e.preventDefault();
            let search_string = $("#search_string").val();
            $.ajax({
                url: "{{route('search.attribute')}}",
                method: 'get',
                data: {
                    search_string: search_string
                },
                success: function(data) {
                    $('.attribute_content').html(data);
                    if (data.status == 'nothing_found') {
                        $('.attribute_content').html(
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
                url: '/pagination/attribute-pagination-data?page=' + page,
                success: function(data) {
                    $('.attribute_content').html(data);
                }
            })
        }
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            pagination(page);
        });

        $(document).on('click', '.delete_attribute', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Are you sure want to delete attribute?')) {
                $.ajax({
                    url: "{{route('delete.attribute')}}",
                    method: 'post',
                    data: {
                        id: id
                    },
                    enctype: 'multipart/form-data',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            $('.attribute_content').load(location.href + ' .attribute_content');
                            $('.paginate').load(location.href + ' .paginate');
                            Command: toastr["success"]("Attribute Deleted",
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
            $('#addAttribute')[0].reset();
            $('#cu_id').val(-1);
            $('#imgPreview').hide();
        });

        $(document).on('click', '.update_form', function(e) {
            let id = $(this).data('id');
            let name = $(this).data('name');

            $('#cu_id').val(id);
            $('#name').val(name);
        });

        $(document).on('submit', '#addAttribute', function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: "{{route('add.attribute')}}",
                method: 'post',
                data: new FormData(form),
                enctype: 'multipart/form-data',
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        Command: toastr["success"]("Attribute Added",
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

                        $('#attributeModal').modal('hide');
                        $('#addAttribute')[0].reset();
                        $('.attribute_content').load(location.href + ' .attribute_content');
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
