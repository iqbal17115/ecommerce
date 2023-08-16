$(document).ready(function () {
    function areAllProductStatusesOne() {
        var allStatusesOne = true;
        $('.product-checkbox').each(function () {
            if ($(this).data('product-status') !== 1) {
                allStatusesOne = false;
                return false;
            }
        });
        return allStatusesOne;
    }

    // Initialize the product status when the page loads
    $('.product-checkbox').each(function () {
        var productId = $(this).data('product-id');
        var productStatus = $(this).data('product-status');
        if (productStatus == 1) {
            // If the product status is 1, mark the checkbox as checked
            $(this).prop('checked', true);
        }
    });

    // Handle the "Select All" checkbox functionality
    $('#selectAllProducts').on('change', function () {
        var newStatus = this.checked ? 1 : 0;

        // Update the status of all product checkboxes and in the cart session
        $('.product-checkbox').each(function () {
            var productId = $(this).data('product-id');
            $(this).prop('checked', newStatus);

            // Update the product status in the cart session
            $.ajax({
                url: '/update-product-status',
                type: 'POST',
                data: {
                    'product_id': productId,
                    'status': newStatus
                },
                success: function (response) {
                    console.log('Product status updated successfully!');
                    calculateShippingCharges();
                },
                error: function (xhr) {
                    console.log('Error updating product status.');
                }
            });
        });
    });

    // Initialize the product status when the page loads
    $('.product-checkbox').each(function () {
        var productId = $(this).data('product-id');
        var productStatus = $(this).data('product-status');
        if (productStatus == 1) {
            // If the product status is 1, mark the checkbox as checked
            $(this).prop('checked', true);
        }
    });

    // Event handler for the change event on checkboxes
    $('.product-checkbox').on('change', function () {
        var productId = $(this).data('product-id');
        var productStatus = $(this).is(':checked') ? 1 : 0;
        // Update the product status in the cart session
        $.ajax({
            url: '/update-product-status',
            type: 'POST',
            data: {
                'product_id': productId,
                'status': productStatus
            },
            success: function (response) {
                console.log('Product status updated successfully!');
                calculateShippingCharges();
            },
            error: function (xhr) {
                console.log('Error updating product status.');
            }
        });
    });
});

function updateTotalPrice(sub_total, shipping_charge) {
    $('.cart_total_price').text(sub_total.toFixed(0)); // Assuming you want to show two decimal places
    alert(shipping_charge);
     $(".shipping_amount").text(shipping_charge);
    $('.total-price').text(sub_total + shipping_charge); // Assuming you want to show two decimal places
}

function updateSubtotalPrice(productId, quantity, salePrice) {
    var productStatus = $('.product-checkbox[data-product-id="' + productId + '"]').is(':checked');
    var subtotalPrice = productStatus ? (quantity * salePrice) : 0;
    $('.subtotal-price-' + productId).text('{{ $currency->icon }}' + subtotalPrice);
    return subtotalPrice;
}
// Function to check if all product statuses are 1




