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

// Load the company data table
function loadDataTable() {
    initializeDataTable(
        `/api/shop-setting-districts/lists`,
        [
            generateColumn('name', null, 'name'),
            generateColumn('division_name', null, 'division_name'),
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

//Initialize divisions
function divisionsInitialize() {
    select2Initialize('/api/divisions/select-lists', 'divisions', "Please Select Division Name", true);
}
