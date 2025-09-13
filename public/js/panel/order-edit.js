// Recalculate item total on input change
$('.qty-input, .price-input').on('input', function() {
    let row = $(this).closest('.order-item-row');
    let qty = parseFloat(row.find('.qty-input').val()) || 0;
    let price = parseFloat(row.find('.price-input').val()) || 0;
    row.find('.item-total').text((qty * price));
});

// Save order details
$('#save-order-details-btn').click(function () {
    let orderId = $('#orderId').val();

    let items = [];
    $('.order-item-row').each(function () {
        let row = $(this);
        items.push({
            id: row.data('id'),
            quantity: row.find('.qty-input').val(),
            unit_price: row.find('.price-input').val()
        });
    });

    let formData = {
        items: items,
        shipping_charge: $('#shipping-charge-input').val()
    };

    saveAction(
        "update",
        `/orders/edit-items`, // Your route
        formData,
        orderId,
        function (response) {
            toastr.success(response.message);

            // Optional: update totals in UI
            $('.order-item-row').each(function (index) {
                let row = $(this);
                let qty = parseFloat(row.find('.qty-input').val());
                let price = parseFloat(row.find('.price-input').val());
                row.find('.item-total').text((qty * price));
            });
        },
        function (error) {
            toastr.error(error.responseJSON?.message || 'Something went wrong');
        }
    );
});
