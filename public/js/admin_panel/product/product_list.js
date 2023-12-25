$(document).on("click", "#product_stock_qty", function () {
   let product_id = $(this).data("product_id");
   $("#row_id").val(product_id);
});

// Attach an event listener for form submission
$("#stock_qty_targeted_form").submit(function (event) {
    event.preventDefault();

    // Get the
    const id = $("#stock_qty_targeted_form #row_id").val();

    // Load the selected stock details and submit the form
    const stock = {
        stock_qty: $("#stock_qty_targeted_form #stock_qty").val(),
        id: $("#stock_qty_targeted_form #row_id").val()
    };

    // Submit the form
    submitStockQtyForm(stock, id);
});

// Function to handle form submission
function submitStockQtyForm(formData, selectedId = "") {
    confirmAction('Increase product qty', 'Are you want to increase product qty?', () => {
    $.ajax({
        url: "product-stock-qty",
        method: 'post',
        data: formData,
        success: function(data) {
            $('#productStockQtyModal').modal('hide');
            $('#stock_qty_targeted_form')[0].reset();
            $(".product_stock_qty_"+data.results.id).text(data.results.stock_qty);
            toastrSuccessMessage("Updated successfully!");
        },
        error: function(err) {
            console.log(err);
        }
    });
});

}
