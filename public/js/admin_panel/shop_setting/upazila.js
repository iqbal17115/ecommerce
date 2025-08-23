// Function to set the selected company ID and name in the form
function setUpazilaSelectedId(districts) {
    $("#targeted_form #row_id").val(districts['id']);
    $("#targeted_form #name").val(districts['name']);
    appendSelect2Option('#parent_districts #district_id', {
        'name': districts['district_name'],
        'id': districts['district_id']
    });

    var myModal = new bootstrap.Modal(document.getElementById("countryModal"));
    myModal.show();
}

// Attach a click event handler to the update link
$(document).on("click", ".update_row", function (event) {
    event.preventDefault(); // Prcountryhe form from submitting immediately

    // Get the upazilas ID from the data attribute
    const row_id = $(this).data("id");
    // Get upazilas details and show them in a modal
    getDetails(
        "/api/upazilas/" + row_id,
        (data) => {
            setUpazilaSelectedId(data.results);
            upazilasInitialize();
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
});

$(document).on("click", ".add-new", function (event) {
    $("#targeted_form #row_id").val("");
    $("#targeted_form #name").val("");
    upazilasInitialize();
});

// Attach a click event handler to the delete link
$(document).on("click", ".delete_row", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    // Get the company ID from the data attribute
    const row_id = $(this).data("id");

    // Delete the upazilas
    deleteAction(
        '/api/upazilas/' + row_id,
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

    // Get the country ID
    const id = $("#targeted_form #row_id").val();

    // Load the selected country details and submit the form
    const district = {
        district_id: $("#targeted_form #district_id").val(),
        name: $("#targeted_form #name").val()
    };

    // Submit the form
    submitUpazilaForm(district, id);
});

// Function to handle form submission
function submitUpazilaForm(formData, selectedId = "") {
    saveAction(
        selectedId.trim() !== "" ? "update" : "store",
        "/api/upazilas",
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
        `/api/shop-setting-upazilas/lists`,
        [
            generateColumn('name', null, 'name'),
            generateColumn('district_name', null, 'district_name'),
            generateColumn('change_status', (data, type, row) => changeStatus(row.id, row.status), 'name'),
            generateColumn('action', (data, type, row) => linkableActions(row.id), 'name'),
        ]
    );
}

function changeStatus(id, location) {
    const locationButton = location == 1
        ? `
            <button data-status="0" data-id="${id}" class="btn btn-sm btn-outline-danger change_status">
                <span class="">Inactive</span>
            </button>
          `
        : `
            <button data-status="1" data-id="${id}" class="btn btn-sm btn-outline-success change_status">
                <span class="">Active</span>
            </button>
          `;

    return locationButton;
}

$(document).on("click", ".change_status", function (event) {
    const row_id = $(this).data("id");
    const status = $(this).data("status");

    const form_data = {
        status: status
    };

    // Submit the form
    submitChangeStatus(form_data, row_id);
});

function submitChangeStatus(formData, selectedId = "") {
    confirmAction('Change Status', 'Are you sure want to change status', () => {
        saveAction(
            "update",
            "/api/upazila-status",
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

// Generates linkable text for a company with an ID and text
function linkableActions(id, text) {
    return `
       <a class="update_row btn btn-info text-light btn-sm" data-id="${id}" title="Update"><i class="mdi mdi-pencil font-size-16"></i></a>
       <a class="delete_row btn btn-danger text-light btn-sm" data-id="${id}" title="Delete"> <i class="mdi mdi-trash-can font-size-16"></i></a>
    `;
}

//Initialize upazilas
function upazilasInitialize() {
    select2Initialize('/api/districts/select-lists', 'districts', "Please Select District Name", true);
}
