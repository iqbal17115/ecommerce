// Load zones
function loadDataTable() {
    initializeDataTable(
        `/admin/shipping-zones`,
        [
            generateColumn('name', (data, type, row) => `<a href="#" class="update_zone" data-id="${row.id}">${row.name}</a>`, 'name'),
            generateColumn('type', (data, type, row) => row.type.charAt(0).toUpperCase() + row.type.slice(1), 'type'),
            generateColumn('is_active', (data, type, row) => changeStatus(row.id, row.is_active), 'status'),
            generateColumn('action', (data, type, row) => linkableActions(row.id), 'action'),
        ]
    );
}

$(document).on("click", ".change_status", function (event) {
    const row_id = $(this).data("id");

    const form_data = {};

    // Submit the form
    submitChangeStatus(form_data, row_id);
});

function submitChangeStatus(formData, selectedId = "") {
    confirmAction('Change Status', 'Are you sure want to change status', () => {
        saveAction(
            "update",
            "/admin/shipping-zone-status",
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

// Generates linkable text for a company with an ID and text
function linkableActions(id, text) {
    return `
       <a class="update_row btn btn-info text-light btn-sm" data-id="${id}" title="Update"><i class="mdi mdi-pencil font-size-16"></i></a>
       <a class="delete_row btn btn-danger text-light btn-sm" data-id="${id}" title="Delete"> <i class="mdi mdi-trash-can font-size-16"></i></a>
    `;
}

// Show modal to edit
$(document).on('click', '.update_row', function () {
    const id = $(this).data('id');
    getDetails(`/admin/shipping-zones/${id}`, (res) => {
        $('#row_id').val(res.results.id);
        $('#zone_name').val(res.results.name);
        $('#zone_type').val(res.results.type);
        $('#is_active').prop('checked', res.results.is_active);
        $('#shippingChargeZone').modal('show');
    });
});

// Submit form
$('#shippingChargeZone').submit(function (e) {
    e.preventDefault();
    const id = $('#row_id').val();
    console.log(id);
    const data = {
        name: $('#zone_name').val(),
        type: $('#zone_type').val(),
        is_active: $('#is_active').is(':checked') ? 1 : 0
    };
    saveAction(id ? 'update' : 'store', '/admin/shipping-zones', data, id, (res) => {
        toastrSuccessMessage(res.message);
        $('#shippingChargeZone').modal('hide');
        loadDataTable();
    });
});

// Delete zone
$(document).on('click', '.delete_row', function () {
    const id = $(this).data('id');
    deleteAction(`/admin/shipping-zones/${id}`, (res) => {
        toastrSuccessMessage(res.message);
        loadDataTable();
    });
});
