// Function to set the selected company ID and name in the form
function setCompanySelectedId(company) {
    $("#company_form #company_id").val(company['id']);
    $("#company_form #name").val(company['name']);
}

// Attach a click event handler to the update link
$(document).on("click", ".update_company", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    // Get the company ID from the data attribute
    const company_id = $(this).data("id");

    // Get company details and show them in a modal
    getDetails(
        "/companies/" + company_id,
        (data) => {
            console.log(data);
            setCompanySelectedId(data.results);
            $("#companyModal").modal("show");
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
});

$(document).on("click", ".add-new", function (event) {
    $("#company_form #company_id").val("");
    $("#company_form #name").val("");
    $('#companyModal').modal('show');
});

// Attach a click event handler to the delete link
$(document).on("click", ".delete_company", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    // Get the company ID from the data attribute
    const company_id = $(this).data("id");

    // Delete the company
    deleteAction(
        '/companies/' + company_id,
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
$("#company_form").submit(function (event) {
    event.preventDefault();

    // Get the company ID
    const id = $("#company_form #company_id").val();

    // Load the selected company details and submit the form
    const company = {
        name: $("#company_form #name").val()
    };

    // Submit the form
    submitCompanyForm(company, id);
});

// Function to handle form submission
function submitCompanyForm(formData, selectedId = "") {
    saveAction(
        selectedId.trim() !== "" ? "update" : "store",
        "/companies",
        formData,
        selectedId,
        (data) => {
            $('#companyModal').modal('hide');
            toastrSuccessMessage(data.message);
            table.clear().draw();
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
}

// Load the company data table
function loadCompanyDataTable() {
    initializeDataTable(
        `/companies/lists`,
        [
            generateColumn('name', null, 'name'),
            generateColumn('created_at', null, 'created_at'),
            generateColumn('action', (data, type, row) => linkableActions(row.id), 'name'),
        ]
    );
}

// Generates linkable text for a company with an ID and text
function linkableActions(id, text) {
    return `
       <a class="update_company btn btn-sm btn-info" data-id="${id}" title="Update">Update</a>
       <a class="delete_company btn btn-sm btn-danger" data-id="${id}" title="Delete">Delete</a>
    `;
}
