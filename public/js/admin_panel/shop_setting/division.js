// Function to set the selected company ID and name in the form
function setCompanySelectedId(divisions) {
    $("#targeted_form #row_id").val(divisions['id']);
    $("#targeted_form #name").val(divisions['name']);
    appendSelect2Option('#parent_countries #country_id', {
        'name': divisions['country_name'],
        'id': divisions['country_id']
    });

    var myModal = new bootstrap.Modal(document.getElementById("countryModal"));
    myModal.show();
}

// Attach a click event handler to the update link
$(document).on("click", ".update_row", function (event) {
    event.preventDefault(); // Prcountryhe form from submitting immediately

    // Get the divisions ID from the data attribute
    const row_id = $(this).data("id");

    // Get divisions details and show them in a modal
    getDetails(
        "/api/divisions/" + row_id,
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
        '/api/divisions/' + row_id,
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
        country_id: $("#targeted_form #country_id").val(),
        name: $("#targeted_form #name").val()
    };

    // Submit the form
    submitCountryForm(division, id);
});

// Function to handle form submission
function submitCountryForm(formData, selectedId = "") {
    saveAction(
        selectedId.trim() !== "" ? "update" : "store",
        "/api/divisions",
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
        `/api/shop-setting-divisions/lists`,
        [
            generateColumn('name', null, 'name'),
            generateColumn('country_name', null, 'country_name'),
            generateColumn('status', (data, type, row) => {
                return row.status == 1 ? 'Active' : 'Inactive';
            }, 'status'),
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

//Initialize Institutes
function divisionsInitialize() {
    select2Initialize('/api/countries/select-lists', 'countries', "Please Select Division Name", true);
}
