function recalcTotals() {
    let total = 0;

    $('.order-item-row').each(function () {
        let qty = parseFloat($(this).find('.qty-input').val()) || 0;
        let price = parseFloat($(this).find('.price-input').val()) || 0;
        let rowTotal = qty * price;
        total += rowTotal;
        $(this).find('.item-total').text(rowTotal.toFixed(2));
    });

    let shipping = parseFloat($('#shipping-charge-input').val()) || 0;
    let discount = parseFloat($('#discount-input').val()) || 0;
    let payable = total + shipping - discount;

    $('#total-amount').text(total.toFixed(2));
    $('#payable-amount').text(payable.toFixed(2));
}

// Trigger recalculation on qty/price/shipping/discount change
$(document).on('input', '.qty-input, .price-input, .calc-input', function () {
    recalcTotals();
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
        shipping_charge: $('#shipping-charge-input').val(),
        discount: $('#discount-input').val()
    };

    saveAction(
        "update",
        `/orders/edit-items`,
        formData,
        orderId,
        function (response) {
            toastr.success(response.message);
            recalcTotals();
        },
        function (error) {
            toastr.error(error.responseJSON?.message || 'Something went wrong');
        }
    );
});

// Initial load
$(document).ready(function () {
    recalcTotals();
});
