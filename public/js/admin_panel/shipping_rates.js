let selectedZoneId = "";
let selectedZoneType = ""; // inside_outside | tiered

// Helpers to toggle form variants
function showInsideOutside() {
    $('#insideOutsideFields').removeClass('d-none');
    $('#tierFields').addClass('d-none');
}
function showTierFields() {
    $('#tierFields').removeClass('d-none');
    $('#insideOutsideFields').addClass('d-none');
}

// Load Shipping Zones into filter
function loadShippingZones() {
    getDetails('/admin/shipping-zones/select-lists',
        (res) => {
            const select = $('#shipping_zone_filter');
            let options = `<option value="">Select Zone</option>`;
            res.results.forEach(z => {
                options += `<option value="${z.id}" data-type="${z.type || ''}">${z.name}</option>`;
            });
            select.html(options);
        },
        (err) => toastrErrorMessage(err.responseJSON?.message || 'Failed to load zones')
    );
}

// DataTable loader
function loadDataTable() {
    initializeDataTable(
        `/admin/shipping-rates`,
        [
            generateColumn('shipping_zone_name', null, 'Shipping Zone'),
            generateColumn('min_amount', null, 'text-center'),
            generateColumn('max_amount', null, 'text-center'),
            generateColumn('min_weight', null, 'text-center'),
            generateColumn('max_weight', null, 'text-center'),
            generateColumn('min_qty', null, 'text-center'),
            generateColumn('max_qty', null, 'text-center'),
            generateColumn('rate', null, 'text-center'),
        ]
    );
}

function linkableActions(id) {
    return `
       <a class="update_row btn btn-info text-light btn-sm" data-id="${id}" title="Update">
          <i class="mdi mdi-pencil font-size-16"></i>
       </a>
       <a class="delete_row btn btn-danger text-light btn-sm" data-id="${id}" title="Delete">
          <i class="mdi mdi-trash-can font-size-16"></i>
       </a>
    `;
}

function setTierForm(rate) {
    $("#targeted_form #row_id").val(rate?.id || "");
    $("#targeted_form #min_amount").val(rate?.min_amount ?? "");
    $("#targeted_form #max_amount").val(rate?.max_amount ?? "");
    $("#targeted_form #min_weight").val(rate?.min_weight ?? "");
    $("#targeted_form #max_weight").val(rate?.max_weight ?? "");
    $("#targeted_form #rate").val(rate?.rate ?? "");
}

function setInsideOutsideForm(row) {
    $("#targeted_form #row_id").val(row?.id || "");
    $("#targeted_form #inside_rate").val(row?.inside_rate ?? "");
    $("#targeted_form #outside_rate").val(row?.outside_rate ?? "");
}

$(document).ready(function () {
    const modal = new bootstrap.Modal(document.getElementById('shippingRateModal'));

    // When modal opens
    $('#shippingRateModal').on('show.bs.modal', function () {
        loadShippingZones();
    });

    $('#shipping_zone_filter').on('change', function () {
        selectedZoneId = this.value;
        selectedZoneType = $('option:selected', this).data('type') || '';

        $('#zone_id').val(selectedZoneId);
        $('#zone_type').val(selectedZoneType);

        if (selectedZoneType == 'inside_outside') {
            showInsideOutside();
        } else {
            showTierFields();
        }

        loadDataTable();
    });

    $(document).on('click', '.add-new', function () {
        // if (!selectedZoneId) {
        //     toastrErrorMessage("Please select a Shipping Zone first.");
        //     return;
        // }
        if (selectedZoneType === 'inside_outside') {
            toastrErrorMessage("This zone is Inside/Outside type. Use Edit instead.");
            return;
        }

        $('#targeted_form')[0].reset();
        $('#row_id').val('');
        $('#zone_id').val(selectedZoneId);
        showTierFields();
        modal.show();
    });

    $(document).on('click', '.update_row', function (e) {
        e.preventDefault();
        if (!selectedZoneId) {
            toastrErrorMessage("Please select a Shipping Zone first.");
            return;
        }
        const id = $(this).data('id');
        if (selectedZoneType === 'inside_outside') {
            getDetails(`/admin/shipping-inside-outside?shipping_zone_id=${selectedZoneId}`,
                (res) => {
                    const row = res?.results || res?.data || null;
                    showInsideOutside();
                    setInsideOutsideForm(row);
                    $('#zone_id').val(selectedZoneId);
                    modal.show();
                },
                (err) => toastrErrorMessage(err.responseJSON?.message || 'Failed to load details')
            );
        } else {
            getDetails(`/admin/shipping-rates/${id}`,
                (res) => {
                    const rate = res?.results || res?.data || null;
                    showTierFields();
                    setTierForm(rate);
                    $('#zone_id').val(selectedZoneId);
                    modal.show();
                },
                (err) => toastrErrorMessage(err.responseJSON?.message || 'Failed to load details')
            );
        }
    });

    $(document).on('click', '.delete_row', function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        deleteAction(
            `/admin/shipping-rates/${id}`,
            (data) => {
                toastrSuccessMessage(data.message || 'Deleted');
                $('.dataTable').DataTable().ajax.reload(null, false);
            },
            (error) => toastrErrorMessage(error.responseJSON?.message || 'Delete failed')
        );
    });

    $("#targeted_form").submit(function (event) {
        event.preventDefault();

        const zoneId = $('#zone_id').val();
        const zoneType = $('#zone_type').val();
        const id = $("#row_id").val().trim();

        if (!zoneId) {
            toastrErrorMessage("Please select a Shipping Zone first.");
            return;
        }

        let url = "";
        let payload = {};

        if (zoneType === 'inside_outside') {
            url = id ? `/admin/shipping-inside-outside/${id}` : `/admin/shipping-inside-outside`;
            payload = {
                shipping_zone_id: zoneId,
                inside_rate: $('#inside_rate').val(),
                outside_rate: $('#outside_rate').val()
            };
        } else {
            url = id ? `/admin/shipping-rates/${id}` : `/admin/shipping-rates`;
            payload = {
                shipping_zone_id: zoneId,
                min_amount: $('#min_amount').val(),
                max_amount: $('#max_amount').val(),
                min_weight: $('#min_weight').val(),
                max_weight: $('#max_weight').val(),
                rate: $('#rate').val()
            };
        }

        const method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: method,
            data: payload,
            success: function (res) {
                toastrSuccessMessage(res.message || 'Saved');
                // ✅ Close modal
                $('#shippingRateModal').modal('hide');

                // ✅ Form reset
                $('#targeted_form')[0].reset();

                // ✅ Reload DataTable
                loadDataTable();
            },
            error: function (err) {
                toastrErrorMessage(err.responseJSON?.message || 'Failed to save');
            }
        });
    });

    // ✅ Shipping Zone Location batch add
    $('#shipping_zone_location').submit(function (e) {
        e.preventDefault();

        const formData = $(this).serializeArray();
        const payload = {
            shipping_zone_id: $('#shipping_zone').val(),
            locations: []
        };

        let location = {};
        formData.forEach(item => {
            if (item.name.includes('division')) location.division_id = item.value;
            if (item.name.includes('district')) location.district_id = item.value;
        });

        location.upazila_ids = [];
        $('.upazila-checkbox:checked').each(function () {
            location.upazila_ids.push($(this).val());
        });

        payload.locations.push(location);

        $.post('/admin/shipping-zone-locations/store', payload, function (res) {
            toastr.success(res.message);
            $('#shippingZoneLocation').modal('hide');
            $('#shipping_zone_location')[0].reset();
            $('#upazilaTable tbody').empty();
            $('#district_id').val('').trigger('change');
            $('#division_id').val('').trigger('change');
        }).fail(function (err) {
            toastr.error(err.responseJSON.message || 'Failed to save');
        });
    });
});
