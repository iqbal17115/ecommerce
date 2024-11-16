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

    // Function to handle form submission
    function submitForm(formData) {
        saveAction(
            "store",
            "/user-cancellation-product",
            formData,
            '',
            (data) => {
                window.location.reload();
            },
            (error) => {

            }
        );
    }

    // Order Status Save
    $('#order_product_cancellation').submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        const orderDetailIds = $("input[name='order_detail_id[]']").map(function () {
            return {
                id: $(this).val(),
                checked: $(this).is(":checked")
            };
        }).get();

        const previousQuantities = $("input[name='previous_quantity[]']").map(function () {
            return $(this).val();
        }).get();

        const newQuantities = $("input[name='new_quantity[]']").map(function () {
            return $(this).val();
        }).get();

        const data = {
            order_detail_ids: orderDetailIds,
            previous_quantities: previousQuantities,
            new_quantities: newQuantities
        };


        console.log(data);
        // Submit the form
        submitForm(data);
    });
});
