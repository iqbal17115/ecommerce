var selectedProductIds = [];

$('#searchInput').on('input', function () {
    var query = $(this).val();
    var data = { query: query, existingProducts: selectedProductIds };
    getSearchProducts(data);
});

function displayProducts(products) {
    var productList = $('#productList');
    productList.empty();

    products.forEach(function (product) {
        productList.append('<li data-id="' + product.id + '">' + product.name + '</li>');
    });

    productList.show();
}

$(document).on('click', '#productList li', function () {
    var productId = $(this).data('id');
    addProductToList(productId);
});

$(document).on('click', '#selectedProducts button.remove-product', function () {
    var productId = $(this).parent().data('id');
    removeProductFromList(productId);
});

function addProductToList(productId) {
    var selectedProductsList = $('#selectedProducts');
    var productItem = $('#productList li[data-id="' + productId + '"]');

    if (selectedProductIds.indexOf(productId) === -1) {
        selectedProductIds.push(productId);
        selectedProductsList.append('<li data-id="' + productId + '">' + getProductDetails(productId) + '<button class="remove-product">Remove</button></li>');
        productItem.remove();
        $("#searchInput").val("");
        $('#selectedProductIdsInput').val(selectedProductIds.join(',')); // Update the hidden input
        $('#productList').hide();
    }
}

function removeProductFromList(productId) {
    var selectedProductsList = $('#selectedProducts');
    selectedProductsList.find('li[data-id="' + productId + '"]').remove();

    selectedProductIds = selectedProductIds.filter(id => id !== productId);
    $('#selectedProductIdsInput').val(selectedProductIds.join(',')); // Update the hidden input
}

function getProductDetails(productId) {
    return $('#productList li[data-id="' + productId + '"]').text();
}

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
    const row_id = $(this).data("row_id");

    // Delete the company
    deleteAction(
        '/api/coupon-products/' + row_id,
        (data) => {
            removeProductFromList(row_id);
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
    const id = $("#targeted_form #coupon_id").val();
    // Load the selected coupon details and submit the form
    const formData = {
        coupon_id: $("#targeted_form #coupon_id").val(),
        product_id: $('#targeted_form #selectedProductIdsInput').val()
    };
    console.log(formData);

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
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
}
function setCouponData(data) {
    if (data) {
        const couponDetails = data;

        // Check if 'products' property exists in couponDetails
        if (couponDetails.products) {
            const productsList = couponDetails.products;
            // Extract product IDs from productsList
            const productIds = productsList.map(product => product.id);

            // Set the value of the hidden input
            $('#selectedProductIdsInput').val(productIds.join(','));

            // Update the selected products list
            const selectedProductsList = $('#selectedProducts');
            selectedProductsList.empty();  // Clear the existing list

            // Append product details to the list
            for (const product of productsList) {
                const productId = product.id;
                const productName = product.products.name;

                // Append product details with a remove button
                selectedProductsList.append('<li data-id="' + productId + '">' +
                    '<span>' + productName + '</span>' +
                    '<button class="delete_row" data-row_id="' + productId + '" data-id="' + productId + '">Remove</button>' +
                    '</li>');
            }
        }
    }
}
function loadData() {
    const row_id = $("#targeted_form #coupon_id").val();
    // Get countries details and show them in a modal
    getDetails(
        "/api/coupon-products/lists/" + row_id,
        (data) => {
            setCouponData(data.results);
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
}
