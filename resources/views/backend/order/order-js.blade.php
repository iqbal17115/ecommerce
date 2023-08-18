<script>
    // Function to handle the delete request
    function deleteOrder(orderId) {
        // Show a confirmation dialog
        if (confirm("Are you sure you want to delete this order?")) {
            // Send an AJAX request to the delete route
            $.ajax({
                url: '/orders/' + orderId,
                method: 'get',
                success: function(response) {
                    // If the request is successful, remove the row from the table
                    $('#order-row-' + orderId).remove();
                    // Display a success message
                    console.log(response.message);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    // Display an error message
                    alert('An error occurred while deleting the order.');
                }
            });
        }
    }
</script>
