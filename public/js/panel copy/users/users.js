$(document).on("click", ".add_user", function (event) {
    $("#user_password").show();
});
//Set the selected parent ID
function setSelectedData(data) {
    $("#targeted_form #row_id").val(data['id']);
    $("#targeted_form #name").val(data['name']);
    $("#targeted_form #email").val(data['email']);
    $("#targeted_form #phone").val(data['phone']);
    $("#targeted_form #password").val(data['password']);
    var selectedRoleIds = data['role_id'];
    console.log(selectedRoleIds);
    $("#targeted_form #role_id").val(selectedRoleIds);
}

$(document).on("click", ".add_user", function (event) {
    $("#targeted_form #row_id").val("");
    $("#targeted_form #name").val("");
    $("#targeted_form #email").val("");
    $("#targeted_form #phone").val("");
    $("#targeted_form #password").val("");
    $('#targetedModal').modal('show');
});

// Attach click event handler to the delete link
$(document).on("click", ".update_row", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately
    $("#user_password").hide();
    //Get I'd
    const row_id = $(this).data("id");
    // Get details
    getDetails(
        "/users/" + row_id,
        (data) => {
            $('#targetedModal form')[0].reset();
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
        '/users/' + row_id,
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

// Attach event listener for form submission
$("#targeted_form").submit(function (event) {
    event.preventDefault();

    //get id
    const id = $("#targeted_form #row_id").val();
    const selectedOptions = $("#role_id option:selected");

    // Load the selected details and submit the form
    const data = {
        name: $("#targeted_form #name").val(),
        email: $("#targeted_form #email").val(),
        phone: $("#targeted_form #phone").val(),
        password: $("#targeted_form #password").val(),
        role_id: selectedOptions.map(function () {
            return $(this).val();
        }).get()
    };
    console.log(data);
    // Submit the form
    submitForm(data, id);
});



// Function to handle form submission
function submitForm(formData, selectedId = "") {
    saveAction(
        selectedId.trim() !== "" ? "update" : "store",
        "/users",
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
        `/users/lists`,
        [
            generateColumn('name', null, 'name'),
            generateColumn('email', null, 'email'),
            generateColumn('phone', null, 'phone'),
            generateColumn('user_roles', null, 'user_roles'), // Add a column for user roles
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
