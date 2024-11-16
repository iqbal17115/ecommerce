<script>
    $(document).ready(function() {
        function pagination(page) {
            $.ajax({
                url: '/pagination/attribute-value-pagination-data?page=' + page,
                success: function(data) {
                    $('.attribute_value_content').html(data);
                }
            })
        }
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            pagination(page);
        });

        $(document).on('click', '.delete_attribute_value', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Are you sure want to delete attribute value?')) {
                $.ajax({
                    url: "{{route('delete.attribute_value')}}",
                    method: 'post',
                    data: {
                        id: id
                    },
                    enctype: 'multipart/form-data',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            $('.attribute_value_content').load(location.href + ' .attribute_value_content');
                            $('.paginate').load(location.href + ' .paginate');
                            Command: toastr["success"]("Attribute vALUE Deleted",
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
            $('#addAttributeValue')[0].reset();
            $('#cu_id').val(-1);
        });

        $(document).on('click', '.update_form', function(e) {
            let id = $(this).data('id');
            let attribute_id = $(this).data('attribute_id');
            let value = $(this).data('value');

            $('#cu_id').val(id);
            $('#attribute_id').val(attribute_id);
            $('#value').val(value);
        });

        $(document).on('submit', '#addAttributeValue', function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: "{{route('add.attribute_value')}}",
                method: 'post',
                data: new FormData(form),
                enctype: 'multipart/form-data',
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        Command: toastr["success"]("Attribute Value Added",
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

                        $('#attributeValueModal').modal('hide');
                        $('#addAttributeValue')[0].reset();
                        $('.attribute_value_content').load(location.href + ' .attribute_value_content');
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
