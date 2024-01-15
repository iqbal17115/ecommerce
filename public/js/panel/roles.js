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
        if (isChecked) {
            permissions.push(permissionId);
        }
    });

    // Load the selected details and submit the form
    const data = {
        permissions: permissions
    };

    submitRoleForm(data, $("#role_id").val());
});

$(document).on("click", ".add_new", function (event) {
    $("#targeted_form #row_id").val("");
    $("#targeted_form #name").val("");
    //$("#targeted_form #is_permanent").prop('checked', false);
    //$("#targeted_form #is_admin").prop('checked', false);
    $('#targetedModal').modal('show');
});

function setAssignRole(data) {

    data.forEach(item => {
        console.log(item);
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

function getAssignRole(role_id, data) {
    $.ajax({
        type: "GET",
        url: `/role-permissions/${role_id}`,
        dataType: "json",
        success: function (response) {
            setAssignRole(response.results);
            checkAssignRoleType(data);
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
    `;

    for (const key in data) {
        if (data.hasOwnProperty(key)) {
            const roleType = key.replace(/_/g, ' ').replace(/\w\S*/g, function (txt) {
                return txt.charAt(0).toUpperCase() + txt.substring(1).toLowerCase();
            });
            html += `
                <div class="col-md-6 mb-4">
                    <div class="card" style="height: 100%;">
                        <div class="card-header">
                            <input type="checkbox" class="role_type_all_check" data-target="col-${key}">
                            <span style="font-weight: bold; font-size: 18px;">${roleType}</span>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush list-group-lg col-${key}">
            `;

            data[key].forEach(permission => {
                html += `
                <div>
                    <div class="custom-control custom-checkbox custom-control-lg">
                        <input type="checkbox" class="custom-control-input permission_${key}" id="checkbox${permission.id}" name="permission_id[]" value="${permission.id}">
                        <label class="custom-control-label" for="checkbox${permission.id}">${permission.name}</label>
                    </div>
                </div>
                `;
            });

            html += `
                            </ul>
                        </div>
                    </div>
                </div>
            `;
        }
    }

    $('#assign_role').html(html);

}


// role_type_all_check manage
$(document).on('click', '.role_type_all_check', function () {
    const targetClass = $(this).data('target');
    const checkboxes = $(`.${targetClass} input[type="checkbox"]`);
    const isChecked = $(this).prop('checked');
    checkboxes.prop('checked', isChecked);
});

// Set permission for issue
function checkAssignRoleType(data) {
    for (const key in data) {
        const permissionCheckboxes = $(`.permission_${key}`);
        const roleTypeAllCheck = $(`.role_type_all_check[data-target="col-${key}"]`);
        const allChecked = permissionCheckboxes.length > 0 && permissionCheckboxes.filter(':checked').length == permissionCheckboxes.length;
        roleTypeAllCheck.prop('checked', allChecked);
    }
}

// Attach click event handler to the delete link
$(document).on("click", ".show_permissions", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately
    //Get I'd
    const row_id = $(this).data("id");
    $("#roleModalXl").modal("show");
    // Get details
    getDetails(
        "/permissions",
        (data) => {
            setPermissionData(data.results, row_id);
            getAssignRole(row_id, data.results);
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
   //$("#targeted_form #is_permanent").prop("checked", data['is_permanent'] == 1);
    //$("#targeted_form #is_admin").prop("checked", data['is_admin'] == 1);
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
        //is_permanent: $("#targeted_form #is_permanent").prop("checked") ? '1' : '0',
        //is_admin: $("#targeted_form #is_admin").prop("checked") ? '1' : '0',
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
            generateColumn('is_permanent', (data, type, row) => {
                return row.is_permanent == 1 ? 'Yes' : 'No';
            }, 'is_permanent'),
            generateColumn('is_admin', (data, type, row) => {
                return row.is_admin == 1 ? 'Yes' : 'No';
            }, 'is_admin'),
            generateColumn('is_registered', (data, type, row) => {
                return row.is_registered == 1 ? 'Yes' : 'No';
            }, 'is_registered'),
            generateColumn('created_at', null, 'created_at'),
            generateColumn('action', (data, type, row) => linkableActions(row.id, '', row.is_admin, row.is_permanent), 'name'),
        ]
    );
}

//Generates linkable text for data.
function linkableActions(id, text, is_admin, is_permanent) {
    let actions = [];

    actions.push(is_permanent == 1 && is_admin == 0 ? ` <a class="btn btn-sm btn-dark show_permissions" data-id="${id}" data-coreui-toggle="modal" data-coreui-target="#roleModalXl" title="Assign">Assign</a>` : '');

    actions.push(is_permanent != 1 && is_admin != 1
            ? `
                <a class="btn btn-sm btn-dark show_permissions" data-id="${id}" data-coreui-toggle="modal" data-coreui-target="#roleModalXl" title="Assign">Assign</a>
                <a class="update_row btn btn-sm btn-info" data-id="${id}" title="Update">Update</a>
                <a class="delete_row btn btn-sm btn-danger" data-id="${id}" title="Delete">Delete</a>`
            : ''
    );

    actions.push(is_permanent != 1
        ? `
            <a class="delete_row btn btn-sm btn-danger" data-id="${id}" title="Delete">Delete</a>`
        : ''
);

    return actions.join(''); // Join the actions into a single string
}
