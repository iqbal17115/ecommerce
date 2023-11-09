// Function to set the selected company ID and name in the form
function setCouponData(coupon) {
    $("#targeted_form #row_id").val(coupon['id']);
    $("#targeted_form #code").val(coupon['code']);
    $("#targeted_form #type").val(coupon['type']);
    $("#targeted_form #value").val(coupon['value']);
    $("#targeted_form #max_uses").val(coupon['max_uses']);
    $("#targeted_form #valid_from").val(coupon['valid_from']);
    $("#targeted_form #valid_to").val(coupon['valid_to']);
    $("#targeted_form #minimum_order_amount").val(coupon['minimum_order_amount']);
    $("#targeted_form #usage_limit_per_user").val(coupon['usage_limit_per_user']);
    var myModal = new bootstrap.Modal(document.getElementById("couponModal"));
    myModal.show();
}

// Attach a click event handler to the update link
$(document).on("click", ".update_row", function (event) {
    event.preventDefault();

    // Get the countries ID from the data attribute
    const row_id = $(this).data("id");

    // Get countries details and show them in a modal
    getDetails(
        "/api/coupon-products/" + row_id,
        (data) => {
            console.log(data);
            setCouponData(data.results);
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
});

$(document).on("click", "#add_new", function (event) {
    $("#targeted_form")[0].reset();
    couponsInitialize();
});

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

// Load the company data table
function loadDataTable() {
    initializeDataTable(
        `/api/coupon-products/lists`,
        [
            generateColumn('coupons', null, 'coupons'),
            generateColumn('products', (data, type, row) => products(row), 'products'),
            generateColumn('action', (data, type, row) => linkableActions(row.id), 'name'),
        ]
    );
}

function products(data) {
    const productNames = Object.values(data.products).map(product => product.products.name);
    return productNames.map(name => `<a>${name}</a>`).join(', ');
}

// Generates linkable text for a coupon with an ID and text
function linkableActions(id, text) {
    return `
       <a class="update_row btn btn-info text-light btn-sm" data-id="${id}" title="Update"><i class="mdi mdi-pencil font-size-16"></i></a>
       <a class="delete_row btn btn-danger text-light btn-sm" data-id="${id}" title="Delete"> <i class="mdi mdi-trash-can font-size-16"></i></a>
    `;
}

//Initialize divisions
function couponsInitialize() {
    select2Initialize('/api/coupons/select-lists', 'coupons', "Please Select Coupons", true);
}
