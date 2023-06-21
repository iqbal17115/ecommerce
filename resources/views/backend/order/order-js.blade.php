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
    $(document).ready(function() {
        $(".new-order").click(function() {
            var order_id = $(this).data("order_id");
            $.ajax({
                url: "{{ route('order-detail') }}",
                method: 'get',
                data: {
                    order_id: order_id
                },
                success: function(data) {
                    console.log(data['order_detail']);
                    modal_content =
                        '<p class="mb-2">Order Id: <span class="text-primary">' +
                        data['order']['code'] +
                        '</span></p><p class="mb-4">Billing Name: <span class="text-primary">' +
                        data['order']['contact']['first_name'] + '</span></p>';
                    modal_content +=
                        '<div class="table-responsive"><table class="table table-centered table-nowrap">';
                    modal_content +=
                        '<thead><tr><th scope="col">Product</th><th scope="col">Product Name</th><th scope="col">Price</th></tr></thead>';
                    modal_content += '<tbody>';
                    for (var i = 0; i < data['order_detail'].length; i++) {
                        modal_content += '<tr>';
                        modal_content +=
                            '<th scope="row"><div><img id="order-product-id-' + data[
                                'order_detail'][i]['id'] +
                            '" src="assets/images/product/img-7.png" alt="" class="avatar-sm"></div></th>';
                        modal_content +=
                            '<td><div><h5 class="text-truncate font-size-14" style="word-wrap: break-word;white-space: pre-line;">' +
                            data['order_detail'][i]['product']['name'] +
                            '</h5><p class="text-muted mb-0">$ ' + data['order_detail'][i][
                                'unit_price'
                            ] + ' x ' + data['order_detail'][i]['quantity'] +
                            '</p></div></td>';
                        modal_content += '<td>$ ' + (data['order_detail'][i]['unit_price'] *
                            data['order_detail'][i]['quantity']) + '</td>';
                        modal_content += '</tr>';
                        $('#order-product-id-' + data['order_detail'][i]['id']).attr("src",
                            'storage/product_photo/' + data['order_detail'][i][
                                'product_main_image'
                            ]['image']);
                    }
                    modal_content += '<tr>';
                    modal_content +=
                        '<td colspan="2"><h6 class="m-0 text-right">Sub Total:</h6></td>';
                    modal_content += '<td>$ 400</td>';
                    modal_content += '</tr>';
                    modal_content += '<tr>';
                    modal_content +=
                        '<td colspan="2"><h6 class="m-0 text-right">Shipping:</h6></td>';
                    modal_content += '<td>Free</td>';
                    modal_content += '</tr>';
                    modal_content += '<tr>';
                    modal_content +=
                        '<td colspan="2"><h6 class="m-0 text-right">Total:</h6></td>';
                    modal_content += '<td>$ 400</td>';
                    modal_content += '</tr>';
                    modal_content += '</tbody>';
                    modal_content += '</table></div>';
                    $('.order-modal-body').html(modal_content);
                    for (var i = 0; i < data['order_detail'].length; i++) {
                        $('#order-product-id-' + data['order_detail'][i]['id']).attr("src",
                            'storage/product_photo/' + data['order_detail'][i][
                                'product_main_image'
                            ]['image']);
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

    });
</script>
