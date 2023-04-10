<script>
    $(document).ready(function() {

        function pagination(page) {
            $.ajax({
                url: '/pagination/condition-pagination-data?page=' + page,
                success: function(data) {
                    $('.condition_content').html(data);
                }
            })
        }

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            pagination(page);
        });

        $(document).on('click', '.delete_condition', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Are you sure want to delete condition?')) {
                $.ajax({
                    url: "{{route('delete.condition')}}",
                    method: 'post',
                    data: {
                        id: id
                    },
                    enctype: 'multipart/form-data',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            $('.condition_content').load(location.href + ' .condition_content');
                            $('.paginate').load(location.href + ' .paginate');
                            Command: toastr["success"]("Condition Deleted",
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
            $('#addCondition')[0].reset();
            $('#cu_id').val(-1);
        });

        $(document).on('submit', '#addCondition', function(e) {
            e.preventDefault();
            var form = this;
            console.log(form);
            $.ajax({
                url: "{{route('add.condition')}}",
                method: 'post',
                data: new FormData(form),
                enctype: 'multipart/form-data',
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        Command: toastr["success"]("Condition Added",
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

                        $('#conditionModal').modal('hide');
                        $('#addCondition')[0].reset();
                        $('.condition_content').load(location.href + ' .condition_content');
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

    $(document).on('click', '.update_form', function(e) {

        let id = $(this).data('id');
        let title = $(this).data('title');
        let description = $(this).data('description');
        let is_active = $(this).data('is_active');
        $('#title').val(title);
        $('#description').val(description);
        $('#is_active').val(is_active);
        $('#cu_id').val(id);
    });
</script>