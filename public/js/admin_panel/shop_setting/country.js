// Function to set the selected company ID and name in the form
function setCompanySelectedId(countries) {
    $("#targeted_form #row_id").val(countries['id']);
    $("#targeted_form #name").val(countries['name']);
    var myModal = new bootstrap.Modal(document.getElementById("countryModal"));
    myModal.show();
}

// Attach a click event handler to the update link
$(document).on("click", ".update_row", function (event) {
    event.preventDefault(); // Prcountryhe form from submitting immediately

    // Get the countries ID from the data attribute
    const row_id = $(this).data("id");

    // Get countries details and show them in a modal
    getDetails(
        "/api/countries/" + row_id,
        (data) => {
            console.log(data);
            setCompanySelectedId(data.results);
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
});

$(document).on("click", ".add-new", function (event) {
    $("#targeted_form #row_id").val("");
    $("#targeted_form #name").val("");
});

// Attach a click event handler to the delete link
$(document).on("click", ".delete_row", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    // Get the company ID from the data attribute
    const row_id = $(this).data("id");

    // Delete the company
    deleteAction(
        '/api/countries/' + row_id,
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
    const country = {
        name: $("#targeted_form #name").val()
    };

    // Submit the form
    submitCountryForm(country, id);
});

// Function to handle form submission
function submitCountryForm(formData, selectedId = "") {
    saveAction(
        selectedId.trim() !== "" ? "update" : "store",
        "/api/countries",
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
        `/api/shop-setting-countries/lists`,
        [
            generateColumn('name', null, 'name'),
            generateColumn('status', (data, type, row) => {
                return row.status == 1 ? 'Active' : 'Inactive';
            }, 'status'),
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
            "/api/countries-status",
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
