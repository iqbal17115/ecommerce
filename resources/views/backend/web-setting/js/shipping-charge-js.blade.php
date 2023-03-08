<script>

function changeType($this) {
    if ($this.value == "Default") {
        $(".shipping-charge-style").css("display", "none");
    } else {
        $(".shipping-charge-style").css("display", "block");
        $('#from_range').html($this.value + ' From');
        $('#to_range').html($this.value + ' To');
    }
}
$(document).ready(function() {

    function pagination(page) {
        $.ajax({
            url: '/pagination/shipping-charge-pagination-data?page=' + page,
            success: function(data) {
                $('.block_content').html(data);
            }
        })
    }
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1]
        pagination(page);
    });
    $(document).on('click', '.delete_shipping_charge', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are you sure want to delete shipping charge?')) {
            $.ajax({
                url: "{{route('delete.shipping-charge')}}",
                method: 'post',
                data: {
                    id: id
                },
                enctype: 'multipart/form-data',
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        $('.block_content').load(location.href + ' .block_content');
                        $('.paginate').load(location.href + ' .paginate');
                        Command: toastr["success"]("Shipping Charge Deleted",
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
        $('#addShippingCharge')[0].reset();
        $('#cu_id').val(-1);
    });

    $(document).on('submit', '#addShippingCharge', function(e) {
        e.preventDefault();
        var form = this;
        console.log(form);
        $.ajax({
            url: "{{route('add.shipping-charge')}}",
            method: 'post',
            data: new FormData(form),
            enctype: 'multipart/form-data',
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(data) {
                if (data.status == 'success') {
                    Command: toastr["success"]("Shipping Charge Added",
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

                    $('#blockModal').modal('hide');
                    $('#addShippingCharge')[0].reset();
                    $('.block_content').load(location.href + ' .block_content');
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
    let type = $(this).data('type');
    let start = $(this).data('start');
    let end = $(this).data('end');
    let inside_amount = $(this).data('inside_amount');
    let outside_amount = $(this).data('outside_amount');
    let is_active = $(this).data('is_active');

    $('#type').val(type);
    $('#start').val(start);
    $('#end').val(end);
    $('#inside_amount').val(inside_amount);
    $('#outside_amount').val(outside_amount);
    $('#is_active').val(is_active);
    $('#cu_id').val(id);

});
</script>