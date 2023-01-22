<script>
    $(document).ready(function() {

        function pagination(page) {
            $.ajax({
                url: '/pagination/coupon-pagination-data?page=' + page,
                success: function(data) {
                    $('.coupon_content').html(data);
                }
            })
        }
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            pagination(page);
        });
        $(document).on('click', '.delete_coupon', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Are you sure want to delete coupon?')) {
                $.ajax({
                    url: "{{route('delete.coupon')}}",
                    method: 'post',
                    data: {
                        id: id
                    },
                    enctype: 'multipart/form-data',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            $('.coupon_content').load(location.href + ' .coupon_content');
                            $('.paginate').load(location.href + ' .paginate');
                            Command: toastr["success"]("Coupon Deleted",
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
            $('#addCoupon')[0].reset();
            $('#cu_id').val(-1);
        });

        $(document).on('submit', '#addCoupon', function(e) {
            e.preventDefault();
            var form = this;
            console.log(form);
            $.ajax({
                url: "{{route('add.coupon')}}",
                method: 'post',
                data: new FormData(form),
                enctype: 'multipart/form-data',
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        Command: toastr["success"]("Coupon Added",
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

                        $('#couponModal').modal('hide');
                        $('#addCoupon')[0].reset();
                        $('.coupon_content').load(location.href + ' .coupon_content');
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
        let type = $(this).data('type');
        let amount = $(this).data('amount');
        let start_date = $(this).data('start_date');
        let end_date = $(this).data('end_date');
        let is_active = $(this).data('is_active');
        $('#cu_id').val(id);
        $('#name').val(name);
        $('#type').val(type);
        $('#discount_amount').val(amount);
        $('#start_date').val(start_date);
        $('#end_date').val(end_date);
        $('#is_active').val(is_active);
        discountType(amount);

    });

    function discountType(amount = null) {
        alert(val);
        var discount_type = $('#type').val();
        $('#discount_content').empty();
        var discount_content = "";
        if (discount_type == 1) {
            discount_content += "<div class='col-md-12'><div class='form-group'><label for='discount_amount'>Discount Amount</label><input type='number' name='discount_amount' id='discount_amount' value='"+amount+"' class='form-control' placeholder='Discount Amount'></div></div>";
        } else if (discount_type == 0) {
            discount_content += "<div class='col-md-12'><div class='form-group'><label for='discount_percentage'>Discount Percentage</label><input type='number' name='discount_percentage' id='discount_percentage' value='"+amount+"' class='form-control' placeholder='Discount Percentage'></div></div>";
        }
        discount_content += "</div>";
        $("#discount_content").append(discount_content);
    }
</script>