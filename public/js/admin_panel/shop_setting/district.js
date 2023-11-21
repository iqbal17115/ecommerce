// Function to set the selected company ID and name in the form
function setCompanySelectedId(districts) {
    $("#targeted_form #row_id").val(districts['id']);
    $("#targeted_form #name").val(districts['name']);
    appendSelect2Option('#parent_divisions #division_id', {
        'name': districts['division_name'],
        'id': districts['division_id']
    });

    var myModal = new bootstrap.Modal(document.getElementById("countryModal"));
    myModal.show();
}

// Attach a click event handler to the update link
$(document).on("click", ".update_row", function (event) {
    event.preventDefault(); // Prcountryhe form from submitting immediately

    // Get the districts ID from the data attribute
    const row_id = $(this).data("id");
    // Get districts details and show them in a modal
    getDetails(
        "/api/districts/" + row_id,
        (data) => {
            setCompanySelectedId(data.results);
            divisionsInitialize();
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
});

$(document).on("click", ".add-new", function (event) {
    $("#targeted_form #row_id").val("");
    $("#targeted_form #name").val("");

    divisionsInitialize();
});

// Attach a click event handler to the delete link
$(document).on("click", ".delete_row", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    // Get the company ID from the data attribute
    const row_id = $(this).data("id");

    // Delete the division
    deleteAction(
        '/api/districts/' + row_id,
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
    const division = {
        division_id: $("#targeted_form #division_id").val(),
        name: $("#targeted_form #name").val()
    };

    // Submit the form
    submitCountryForm(division, id);
});

// Function to handle form submission
function submitCountryForm(formData, selectedId = "") {
    saveAction(
        selectedId.trim() !== "" ? "update" : "store",
        "/api/districts",
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
            "/api/districts-status",
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
    const status = $(this).data("status");

    const form_data = {
        status: status
    };

    // Submit the form
    submitChangeStatus(form_data, row_id);
});

function submitChangeLocation(formData, selectedId = "") {
    confirmAction('Change Location', 'Are you sure want to change location', () => {
        saveAction(
            "update",
            "/api/districts-location",
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

$(document).on("click", ".change_location", function (event) {
    const row_id = $(this).data("id");
    const location = $(this).data("location");

    const form_data = {
        location: location
    };

    // Submit the form
    submitChangeLocation(form_data, row_id);
});

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

function changeLocation(id, location) {
    const locationButton = location == 'inside'
        ? `
            <button data-location="outside" data-id="${id}" class="btn btn-sm btn-outline-danger change_location">
                <span class="">Outside</span>
            </button>
          `
        : `
            <button data-location="inside" data-id="${id}" class="btn btn-sm btn-outline-success change_location">
                <span class="">Inside</span>
            </button>
          `;

    return locationButton;
}

// Load the company data table
function loadDataTable() {
    initializeDataTable(
        `/api/shop-setting-districts/lists`,
        [
            generateColumn('name', null, 'name'),
            generateColumn('division_name', null, 'division_name'),
            generateColumn('country_name', null, 'country_name'),
            generateColumn('location', (data, type, row) => {
                return row.location == 'inside' ? 'Inside' : 'Outside';
            }, 'location'),
            generateColumn('change_location', (data, type, row) => changeLocation(row.id, row.location), 'name'),
            generateColumn('status', (data, type, row) => {
                return row.status == 1 ? 'Active' : 'Inactive';
            }, 'status'),
            generateColumn('change_status', (data, type, row) => changeStatus(row.id, row.status), 'name'),
            generateColumn('action', (data, type, row) => linkableActions(row.id), 'name'),
        ]
    );
}

// Generates linkable text for a company with an ID and text
function linkableActions(id, text) {
    return `
       <a class="update_row btn btn-info text-light btn-sm" data-id="${id}" title="Update"><i class="mdi mdi-pencil font-size-16"></i></a>
       <a class="delete_row btn btn-danger text-light btn-sm" data-id="${id}" title="Delete"> <i class="mdi mdi-trash-can font-size-16"></i></a>
    `;
}

//Initialize divisions
function divisionsInitialize() {
    select2Initialize('/api/divisions/select-lists', 'divisions', "Please Select Division Name", true);
}
