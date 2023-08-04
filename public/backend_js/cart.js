// Select all products when the header checkbox is clicked
$('#selectAllProducts').on('change', function () {
    $('.product-checkbox').prop('checked', this.checked);
});

// Check if all product checkboxes are checked and update the header checkbox accordingly
$('.product-checkbox').on('change', function () {
    if ($('.product-checkbox:checked').length === $('.product-checkbox').length) {
        $('#selectAllProducts').prop('checked', true);
    } else {
        $('#selectAllProducts').prop('checked', false);
    }
});
