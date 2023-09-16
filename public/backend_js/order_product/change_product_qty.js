$(document).ready(function () {
    // Order Status Save
    $('#order_product_cancellation').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
        var url = form.attr('action');
alert(1);
        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(), // Serialize the form data
            success: function (response) {
                window.location.reload();
            },
            error: function (xhr, status, error) {
                // Handle error, e.g., show an error message
                alert('An error occurred');
            }
        });
    });
});
