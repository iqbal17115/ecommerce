
//Set the selected parent ID
function setSelectedData(data) {
    $("#targeted_form #row_id").val(data['id']);
    $("#targeted_form #name").val(data['name']);
}

// Attach click event handler to the delete link
$(document).on("click", ".update_row", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    //Get I'd
    const row_id = $(this).data("id");
    // Get details
    getDetails(
        "/institutes/" + row_id,
        (data) => {
            setSelectedData(data.results);
            $("#targetedModal").modal("show");
        },
        (error) => {

        }
    );
});

// Attach click event handler to the delete link
$(document).on("click", ".delete_row", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    //Get Group I'd
    const row_id = $(this).data("id");

    //Delete
    deleteAction(
        '/institutes/' + row_id,
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

$(document).on("click", ".add-new", function (event) {
    $("#targeted_form #row_id").val("");
    $("#targeted_form #name").val("");
    $('#targetedModal').modal('show');
});

// Attach event listener for form submission
$("#targeted_form").submit(function (event) {
    event.preventDefault();

    //get id
    const id = $("#targeted_form #row_id").val();

    // Load the selected details and submit the form
    const data = {
        name: $("#targeted_form #name").val()
    };

    // Submit the form
    submitForm(data, id);
});



// Function to handle form submission
function submitForm(formData, selectedId = "") {
    saveAction(
        selectedId.trim() !== "" ? "update" : "store",
        "/institutes",
        formData,
        selectedId,
        (data) => {
            $('#targetedModal').modal('hide');
            $('#targetedModal form')[0].reset();
            toastrSuccessMessage(data.message);
            table.clear().draw();
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
}

//Load Data Tables
function loadDataTable() {
    initializeDataTable(
        `/institutes/lists`,
        [
            generateColumn('name', null, 'name'),
            generateColumn('created_at', null, 'created_at'),
            generateColumn('action', (data, type, row) => linkableActions(row.id), 'name'),
        ]
    );
}

//Generates linkable text for data.
function linkableActions(id, text) {
    return `
                <a class="update_row btn btn-sm btn-info" data-id="${id}" title="Update">Update</a>
                <a class="delete_row btn btn-sm btn-danger" data-id="${id}" title="Delete">Delete</a>
           `;
}
