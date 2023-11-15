var selectedProductIds = [];

$('#searchInput').on('input', function () {
    var query = $(this).val();
    var data = { query: query, existingProducts: selectedProductIds };
    getSearchProducts(data);
});

$(document).on('click', '#productList li', function () {
    var productId = $(this).data('id');
    addProductToList(productId);
});

$(document).on('click', '#selectedProducts button.remove-product', function () {
    var productId = $(this).parent().data('id');
    removeProductFromList(productId);
});

function displayProducts(products) {
    var productList = $('#productList');
    productList.empty();

    products.forEach(function (product) {
        productList.append('<li data-id="' + product.id + '">' + product.name + '</li>');
    });

    // Show the product list dropdown
    productList.show();
}

function addProductToList(productId) {
    var selectedProductsList = $('#selectedProducts');
    var productItem = $('#productList li[data-id="' + productId + '"]');

    // Check if the product is already in the selected list
    if (selectedProductIds.indexOf(productId) === -1) {
        // If not, add it to the list
        selectedProductIds.push(productId);
        selectedProductsList.append('<li data-id="' + productId + '">' + getProductDetails(productId) + '<button class="remove-product">Remove</button></li>');
        // Remove the product from the search list
        productItem.remove();
        $("#searchInput").val("");
        // Hide the product list dropdown
        $('#productList').hide();
    }
}

function removeProductFromList(productId) {
    // Remove the product from the selected list
    var selectedProductsList = $('#selectedProducts');
    selectedProductsList.find('li[data-id="' + productId + '"]').remove();

    // Add the product back to the search list if needed
    // (you might fetch it from the server again or use existing data)
    // Example: productList.append('<li data-id="' + productId + '">' + getProductDetails(productId) + '</li>');

    // Remove the product ID from the selectedProductIds array
    selectedProductIds = selectedProductIds.filter(id => id !== productId);
}

function getProductDetails(productId) {
    // Implement a function to get product details by ID
    // This is a placeholder; replace it with your actual logic
    return 'Product Name: ' + $('#productList li[data-id="' + productId + '"]').text();
}

// Close the product list dropdown when clicking outside of it
$(document).on('click', function (e) {
    if (!$(e.target).closest('#searchInput, #productList').length) {
        $('#productList').hide();
    }
});

// Function to handle form submission
function getSearchProducts(formData, selectedId = "") {
    saveAction(
        "store",
        "/api/search/coupon-product",
        formData,
        selectedId,
        (data) => {
            displayProducts(data);
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
}

// Attach a click event handler to the delete link
$(document).on("click", ".delete_row", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    // Get the company ID from the data attribute
    const row_id = $(this).data("id");

    // Delete the company
    deleteAction(
        '/api/coupon-products/' + row_id,
        (data) => {
            table.clear().draw();
            // Success callback
            toastrSuccessMessage(data.message);
        },
        (error) => {
            // Error callback
            toastrErrorMessage(error.responseJSON.message);
        }
    );
});

// Attach an event listener for form submission
$("#targeted_form").submit(function (event) {
    event.preventDefault();
    // Get the coupon ID
    const id = $("#targeted_form #row_id").val();

    // Load the selected coupon details and submit the form
    const formData = {
        coupon_id: $("#targeted_form #coupon_id").val(),
        product_id: $("#targeted_form #product_id").val()
    };

    // Submit the form
    submitForm(formData, id);
});

// Function to handle form submission
function submitForm(formData, selectedId = "") {
    saveAction(
        selectedId.trim() !== "" ? "update" : "store",
        "/api/coupon-products",
        formData,
        selectedId,
        (data) => {
            toastrSuccessMessage(data.message);
            document.getElementById('close_button').click();
            table.clear().draw();
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
}

//Initialize divisions
function couponsInitialize() {
    select2Initialize('/api/coupons/select-lists', 'coupons', "Please Select Coupons", true);
}
