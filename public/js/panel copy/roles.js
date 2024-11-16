$(document).on("click", "#manage_check_boxes", function (event) {
    var isChecked = $(this).is(':checked');
    $('#assign_role_form input[type="checkbox"]').prop('checked', isChecked);
});

function submitRoleForm(formData, selectedId = "") {
    saveAction(
        "update",
        "/assign-permissions",
        formData,
        selectedId,
        (data) => {
            toastrSuccessMessage(data.message);
            $("#roleModalXl").modal("hide");
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
}

// Form submission
$("#assign_role_form").submit(function (event) {
    event.preventDefault();

    const permissions = [];

    // Permission checkboxes
    $("input[name='permission_id[]']").each(function () {
        const permissionId = $(this).val();
        const isChecked = $(this).is(":checked");
        if(isChecked){
            permissions.push(permissionId);
        }
    });

    // Load the selected details and submit the form
    const data = {
        permissions: permissions
    };

    submitRoleForm(data, $("#role_id").val());
});

$(document).on("click", ".add-new", function (event) {
    $("#targeted_form #row_id").val("");
    $("#targeted_form #name").val("");
    $('#targetedModal').modal('show');
});

function setAssignRole(data) {

    data.forEach(item => {
        const permissionId = item.permission_id;
        $(`#checkbox${permissionId}`).prop('checked', true);
    });

    var allChecked = true;

    $("input[name='permission_id[]']").each(function () {
        if (!$(this).is(":checked")) {
            allChecked = false;
            return false; // Break out of the loop early if one is unchecked
        }
    });

    if (allChecked) {
        $(`#manage_check_boxes`).prop('checked', true);
    }
}

function getAssignRole(role_id) {
    $.ajax({
        type: "GET",
        url: `/role-permissions/${role_id}`,
        dataType: "json",
        success: function (response) {
            setAssignRole(response.results);
        },
        error: function (xhr, status, error) {
            // Handle any errors that occur during the request
            console.error(error);
        }
    });
}

// Set permission for issue
function setPermissionData(data, role_id) {
    let html = `
        <input type="hidden" name="role_id" id="role_id" value="${role_id}">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <ul class="list-group list-group-flush list-group-lg">
                <li class="list-group-item">
                    <input type="checkbox" class="custom-control-input" name="manage_check_boxes" id="manage_check_boxes">
                </li>
            </ul>
        </div>
    `;

    for (const key in data) {
        if (data.hasOwnProperty(key)) {
            html += `
            <div class="col-md-6" style="font-size: 24px;">${key}</div>
            <div class="col-md-6"></div>
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <ul class="list-group list-group-flush list-group-lg">
            `;

            data[key].forEach(permission => {
                html += `
                <li class="list-group-item">
                    <div class="custom-control custom-checkbox custom-control-lg">
                        <input type="checkbox" class="custom-control-input" id="checkbox${permission.id}" name="permission_id[]" value="${permission.id}">
                        <label class="custom-control-label" for="checkbox${permission.id}">${permission.name}</label>
                    </div>
                </li>
            `;
            });

            html += `
                </ul>
            </div>
            `;
        }
    }

    $('#assign_role').html(html);
}

// Attach click event handler to the delete link
$(document).on("click", ".show_permissions", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately
    //Get I'd
    const row_id = $(this).data("id");

    // Get details
    getDetails(
        "/permissions",
        (data) => {
            setPermissionData(data.results, row_id);
            getAssignRole(row_id);
        },
        (error) => {

        }
    );
});

//Set the selected parent ID
function setSelectedData(data) {
    $("#targeted_form #row_id").val(data['id']);
    $("#targeted_form #name").val(data['name']);
    $("#targeted_form #details").val(data['details']);
    $("#targeted_form #is_permanent").prop("checked", data['is_permanent'] == 1);
    $("#targeted_form #is_admin").prop("checked", data['is_permanent'] == 1);
}

// Attach click event handler to the delete link
$(document).on("click", ".update_row", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    //Get I'd
    const row_id = $(this).data("id");
    // Get details
    getDetails(
        "/roles/" + row_id,
        (data) => {
            console.log(data.results);
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
        '/roles/' + row_id,
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
    // Load the selected details and submit the form
    const data = {
        name: $("#targeted_form #name").val(),
        details: $("#targeted_form #details").val(),
        is_permanent: $("#targeted_form #is_permanent").prop("checked") ? '1' : '0',
        is_admin: $("#targeted_form #is_admin").prop("checked") ? '1' : '0',
    };
    console.log(data);
    // Submit the form
    submitForm(data, id);
});


// Function to handle form submission
function submitForm(formData, selectedId = "") {
    saveAction(
        selectedId.trim() !== "" ? "update" : "store",
        "/roles",
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
        `/roles/lists`,
        [
            generateColumn('name', null, 'name'),
            generateColumn('details', null, 'details'),
            generateColumn('is_permanent', null, 'is_permanent'),
            generateColumn('is_admin', null, 'is_admin'),
            generateColumn('created_at', null, 'created_at'),
            generateColumn('action', (data, type, row) => linkableActions(row.id, '', row.is_admin, row.is_permanent), 'name'),
        ]
    );
}

//Generates linkable text for data.
function linkableActions(id, text, is_admin, is_permanent) {
    let actions = [];

    actions.push(
        is_permanent === 1 && is_admin === 0
            ? `
                <a class="btn btn-sm btn-dark show_permissions" data-id="${id}" data-coreui-toggle="modal" data-coreui-target="#roleModalXl" title="Assign">Assign</a>
                <a class="update_row btn btn-sm btn-info" data-id="${id}" title="Update">Update</a>`
            : ''
    );

    actions.push(
        is_permanent !== 1 && is_admin !== 1
            ? `
                <a class="btn btn-sm btn-dark show_permissions" data-id="${id}" data-coreui-toggle="modal" data-coreui-target="#roleModalXl" title="Assign">Assign</a>
                <a class="update_row btn btn-sm btn-info" data-id="${id}" title="Update">Update</a>
                <a class="delete_row btn btn-sm btn-danger" data-id="${id}" title="Delete">Delete</a>`
            : ''
    );

    return actions.join(''); // Join the actions into a single string
}
