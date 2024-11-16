<script>
    $(document).ready(function() {

        function pagination(page) {
            $.ajax({
                url: '/pagination/currency-pagination-data?page=' + page,
                success: function(data) {
                    $('.currency_content').html(data);
                }
            })
        }
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            pagination(page);
        });
        $(document).on('click', '.delete_currency', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Are you sure want to delete currency?')) {
                $.ajax({
                    url: "{{route('delete.currency')}}",
                    method: 'post',
                    data: {
                        id: id
                    },
                    enctype: 'multipart/form-data',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            $('.currency_content').load(location.href + ' .currency_content');
                            $('.paginate').load(location.href + ' .paginate');
                            Command: toastr["success"]("Currency Deleted",
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
            $('#addCurrency')[0].reset();
            $('#cu_id').val(-1);
        });

        $(document).on('submit', '#addCurrency', function(e) {
            e.preventDefault();
            var form = this;
            console.log(form);
            $.ajax({
                url: "{{route('add.currency')}}",
                method: 'post',
                data: new FormData(form),
                enctype: 'multipart/form-data',
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        Command: toastr["success"]("Currency Added",
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

                        $('#currencyModal').modal('hide');
                        $('#addCurrency')[0].reset();
                        $('.currency_content').load(location.href + ' .currency_content');
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
        let name = $(this).data('name');
        let icon1 = $(this).data('icon1');
        let position = $(this).data('position');
        let conversion_rate = $(this).data('conversion_rate');
        let is_default = $(this).data('is_default');
        let is_active = $(this).data('is_active');
        $('#cu_id').val(id);
        $('#name').val(name);
        $('#icon').val(icon1);
        $('#position').val(position);
        $('#conversion_rate').val(conversion_rate);
        $('#is_default').val(is_default);
        $('#is_active').val(is_active);

    });

</script>