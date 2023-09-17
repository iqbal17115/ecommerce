$(document).ready(function () {
    $(document).on("click", "#manage_check_boxes", function (event) {
        var isChecked = $(this).is(':checked');
        $('#order_product_cancellation input[type="checkbox"]').prop('checked', isChecked);
    });

    $('#product_detail_id').on('click', function () {
        const product_detail_id = $(this).data('product_detail_id');

    });
    $('.product-return-qty').on('input', function () {
        // Find the corresponding 'new_quantity' and 'change_reason' elements
        var newQuantity = $(this).closest('.row').find('.new-quantity');
        var changeReason = $(this).closest('.row').find('.change-reason');

        if ($(this).val() !== '') {
            newQuantity.attr('required', 'required');
            changeReason.attr('required', 'required');
        } else {
            // If 'product_return_qty' is empty, remove 'required' attribute
            newQuantity.removeAttr('required');
            changeReason.removeAttr('required');
        }
    });

    // Order Status Save
    $('#order_product_cancellation').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(), // Serialize the form data
            success: function (response) {
                toastrSuccessMessage("Test");
            },
            error: function (xhr, status, error) {
                // Handle error, e.g., show an error message
                alert('An error occurred');
            }
        });
    });
});
