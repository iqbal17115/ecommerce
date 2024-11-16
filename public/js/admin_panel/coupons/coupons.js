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
        "/api/coupons/" + row_id,
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
});

// Attach a click event handler to the delete link
$(document).on("click", ".delete_row", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    // Get the company ID from the data attribute
    const row_id = $(this).data("id");

    // Delete the company
    deleteAction(
        '/api/coupons/' + row_id,
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
        code: $("#targeted_form #code").val(),
        max_uses: $("#targeted_form #max_uses").val(),
        valid_from: $("#targeted_form #valid_from").val(),
        valid_to: $("#targeted_form #valid_to").val(),
        type: $("#targeted_form #type").val(),
        value: $("#targeted_form #value").val(),
        minimum_order_amount: $("#targeted_form #minimum_order_amount").val(),
        usage_limit_per_user: $("#targeted_form #usage_limit_per_user").val(),
    };

    // Submit the form
    submitForm(formData, id);
});

// Function to handle form submission
function submitForm(formData, selectedId = "") {
    saveAction(
        selectedId.trim() !== "" ? "update" : "store",
        "/api/coupons",
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

function submitChangeStatus(formData, selectedId = "") {
    confirmAction('Change Status', 'Are you sure want to change status', () => {
        saveAction(
            "update",
            "/api/coupons-status",
            formData,
            selectedId,
            (data) => {
                toastrSuccessMessage(data.message);
                table.clear().draw();
            },
            (error) => {
                toastrErrorMessage(error.responseJSON.message);
            }
        );
    });
}

$(document).on("click", ".change_status", function (event) {
    const row_id = $(this).data("id");
    const is_active = $(this).data("is_active");

    const form_data = {
        is_active: is_active
    };

    // Submit the form
    submitChangeStatus(form_data, row_id);
});

function changeStatus(id, is_active) {
    const statusButton = is_active == 1
        ? `
            <button data-is_active="0" data-id="${id}" class="btn btn-sm btn-outline-danger change_status">
                <span class="">Inactive</span>
            </button>
          `
        : `
            <button data-is_active="1" data-id="${id}" class="btn btn-sm btn-outline-success change_status">
                <span class="">Active</span>
            </button>
          `;

    return statusButton;
}

// Load the company data table
function loadDataTable() {
    initializeDataTable(
        `/api/coupons/lists`,
        [
            generateColumn('code', null, 'code'),
            generateColumn('valid_from', null, 'valid_from'),
            generateColumn('valid_to', null, 'valid_to'),
            generateColumn('type', null, 'type'),
            generateColumn('value', null, 'value'),
            generateColumn('max_uses', null, 'max_uses'),
            generateColumn('change_status', (data, type, row) => changeStatus(row.id, row.is_active), 'name'),
            generateColumn('is_active', (data, type, row) => {
                return row.is_active == 1 ? 'Active' : 'Inactive';
            }, 'is_active'),
            generateColumn('action', (data, type, row) => linkableActions(row.id), 'name'),
        ]
    );
}

// Generates linkable text for a coupon with an ID and text
function linkableActions(id, text) {
    return `
       <a class="update_row btn btn-info text-light btn-sm" data-id="${id}" title="Update"><i class="mdi mdi-pencil font-size-16"></i></a>
       <a class="delete_row btn btn-danger text-light btn-sm" data-id="${id}" title="Delete"> <i class="mdi mdi-trash-can font-size-16"></i></a>
       <a href="coupon-products/${id}/view" class="btn btn-warning text-light btn-sm" data-id="${id}" title="">Product</a>
    `;
}
