// Load table data
function loadDataTable() {
    initializeDataTable(
        `/shipping-charges`,
        [
            generateColumn('division_name', null, 'division_name'),
            generateColumn('district_name', null, 'district_name'),
            generateColumn('upazila_name', null, 'upazila_name'),
            generateColumn('min_qty', null, 'min_qty'),
            generateColumn('max_qty', null, 'max_qty'),
            generateColumn('min_order_amount', null, 'min_order_amount'),
            generateColumn('max_order_amount', null, 'max_order_amount'),
            generateColumn('charge_amount', null, 'charge_amount'),
            generateColumn('is_active', (data, type, row) => changeStatus(row.id, row.is_active), 'status'),
            generateColumn('action', (data, type, row) => linkableActions(row.id), 'action'),
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

// Generates linkable text for a company with an ID and text
function linkableActions(id, text) {
    return `
       <a class="update_row btn btn-info text-light btn-sm" data-id="${id}" title="Update"><i class="mdi mdi-pencil font-size-16"></i></a>
       <a class="delete_row btn btn-danger text-light btn-sm" data-id="${id}" title="Delete"> <i class="mdi mdi-trash-can font-size-16"></i></a>
    `;
}

$(document).on("click", ".change_status", function (event) {
    const row_id = $(this).data("id");
    const status = $(this).data("status");

    const form_data = {
        is_active: status
    };

    // Submit the form
    submitChangeStatus(form_data, row_id);
});

$(document).ready(function () {
    const modal = new bootstrap.Modal(document.getElementById('shippingChargeModal'));

    // Show modal to add new
    $('#add-new-btn').click(function () {
        $('#targeted_form')[0].reset();
        $('#row_id').val('');
        modal.show();
    });

    // Show modal to edit
    $(document).on('click', '.update_row', function (e) {
        e.preventDefault();
        const id = $(this).data('id');

        getDetails(`/shipping-charges/${id}`, (res) => {
            const charge = res.results;
            $('#row_id').val(charge.id);
            // Set division and load districts
            $('#division').val(charge.division_id);

            addressSelect.loadDistricts(charge.division_id, () => {
                $('#district').val(charge.district_id);

                addressSelect.loadThanas(charge.district_id, () => {
                    $('#thana').val(charge.upazila_id);
                });
            });


            $('#charge_amount').val(charge.charge_amount);
            $('#min_qty').val(charge.min_qty);
            $('#max_qty').val(charge.max_qty);
            $('#min_order_amount').val(charge.min_order_amount);
            $('#max_order_amount').val(charge.max_order_amount);
            // Set other fields similarly
            $('#is_active').prop('checked', charge.is_active);
            modal.show();
        }, (error) => {
            toastrErrorMessage(error.responseJSON.message || 'Failed to load details');
        });
    });

    // Submit form
    $('#targeted_form').submit(function (e) {
        e.preventDefault();

        const id = $('#row_id').val().trim();
        const formData = {
            division_id: $('#division').val(),
            district_id: $('#district').val(),
            upazila_id: $('#thana').val(),
            min_qty: $('#min_qty').val(),
            max_qty: $('#max_qty').val(),
            min_order_amount: $('#min_order_amount').val(),
            max_order_amount: $('#max_order_amount').val(),
            charge_amount: $('#charge_amount').val(),
            is_active: $('#is_active').is(':checked') ? 1 : 0,
        };

        saveAction(
            id ? 'update' : 'store',
            '/shipping-charges',
            formData,
            id,
            (data) => {
                toastrSuccessMessage(data.message);
                modal.hide();
                loadDataTable();
            },
            (error) => {
                toastrErrorMessage(error.responseJSON.message || 'Failed to save');
            }
        );
    });

    // Delete
    $(document).on('click', '.delete_row', function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        deleteAction(
            `/shipping-charges/${id}`,
            (data) => {
                toastrSuccessMessage(data.message);
                loadTable();
            },
            (error) => {
                toastrErrorMessage(error.responseJSON.message || 'Failed to delete');
            }
        );
    });
});
