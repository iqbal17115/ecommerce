let selectedZoneId = "";
let selectedZoneType = ""; // inside_outside | tiered

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

function getRateRow(data = {}) {
    return `
    <div class="rate-row card mb-3 p-3 shadow-sm">
        <div class="row g-3 align-items-end">
            
            <input type="hidden" name="ids[]" value="${data.id || ''}">

            <div class="col-md-2">
                <label class="form-label small">Min Amount</label>
                <input type="number" class="form-control" 
                    name="min_amount[]" value="${data.min_amount || ''}">
            </div>

            <div class="col-md-2">
                <label class="form-label small">Max Amount</label>
                <input type="number" class="form-control" 
                    name="max_amount[]" value="${data.max_amount || ''}">
            </div>

            <div class="col-md-2">
                <label class="form-label small">Min Weight</label>
                <input type="number" class="form-control" 
                    name="min_weight[]" value="${data.min_weight || ''}">
            </div>

            <div class="col-md-2">
                <label class="form-label small">Max Weight</label>
                <input type="number" class="form-control" 
                    name="max_weight[]" value="${data.max_weight || ''}">
            </div>

            <div class="col-md-2">
                <label class="form-label small">Min Qty</label>
                <input type="number" class="form-control" 
                    name="min_qty[]" value="${data.min_qty || ''}" required>
            </div>

            <div class="col-md-2">
                <label class="form-label small">Max Qty</label>
                <input type="number" class="form-control" 
                    name="max_qty[]" value="${data.max_qty || ''}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label small">Rate</label>
                <div class="input-group">
                    <span class="input-group-text">৳</span>
                    <input type="number" class="form-control" 
                        name="rate[]" value="${data.rate || ''}" required>
                </div>
            </div>

            <div class="col-md-2 d-flex">
                <button type="button" class="btn btn-outline-danger ms-auto remove-rate-row" 
                        data-bs-toggle="tooltip" title="Remove this rate">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>
    </div>`;
}

function validateRates() {
    let isValid = true;
    let errorMessages = [];

    const rows = $('#rate-container .rate-row');

    // Loop through rows
    rows.each(function (index) {
        const row = $(this);

        const minWeight = parseInt(row.find('input[name="min_weight[]"]').val()) || 0;
        const maxWeight = row.find('input[name="max_weight[]"]').val();
        const minQty = parseInt(row.find('input[name="min_qty[]"]').val()) || 0;
        const maxQty = row.find('input[name="max_qty[]"]').val();
        const minAmount = parseFloat(row.find('input[name="min_amount[]"]').val()) || 0;
        const maxAmount = row.find('input[name="max_amount[]"]').val();
        const rate = parseFloat(row.find('input[name="rate[]"]').val());

        // Required Rate
        if (isNaN(rate) || rate <= 0) {
            isValid = false;
            errorMessages.push(`Row ${index + 1}: Rate must be greater than 0`);
        }

        // Max >= Min (when max is given)
        if (maxWeight && parseInt(maxWeight) < minWeight) {
            isValid = false;
            errorMessages.push(`Row ${index + 1}: Max Weight must be greater than or equal to Min Weight`);
        }
        if (maxQty && parseInt(maxQty) < minQty) {
            isValid = false;
            errorMessages.push(`Row ${index + 1}: Max Qty must be greater than or equal to Min Qty`);
        }
        if (maxAmount && parseFloat(maxAmount) < minAmount) {
            isValid = false;
            errorMessages.push(`Row ${index + 1}: Max Amount must be greater than or equal to Min Amount`);
        }

        // Check overlap with previous row
        if (index > 0) {
            const prevRow = $(rows[index - 1]);

            const prevMaxWeight = prevRow.find('input[name="max_weight[]"]').val();
            const prevMaxQty = prevRow.find('input[name="max_qty[]"]').val();
            const prevMaxAmount = prevRow.find('input[name="max_amount[]"]').val();

            // Weight continuity
            if (prevMaxWeight) {
                if (minWeight !== parseInt(prevMaxWeight) + 1) {
                    isValid = false;
                    errorMessages.push(`Row ${index + 1}: Min Weight should be ${parseInt(prevMaxWeight) + 1}`);
                }
            }

            // Qty continuity
            if (prevMaxQty) {
                if (minQty !== parseInt(prevMaxQty) + 1) {
                    isValid = false;
                    errorMessages.push(`Row ${index + 1}: Min Qty should be ${parseInt(prevMaxQty) + 1}`);
                }
            }

            // Amount continuity
            if (prevMaxAmount) {
                if (minAmount !== parseFloat(prevMaxAmount) + 1) {
                    isValid = false;
                    errorMessages.push(`Row ${index + 1}: Min Amount should be ${parseFloat(prevMaxAmount) + 1}`);
                }
            }
        }
    });

    // Show errors
    if (!isValid) {
        toastr.error(errorMessages.join('<br>'));
    }

    return isValid;
}

// Add new row
$(document).on('click', '#add-rate-row', function () {
    $('#rate-container').append(getRateRow());
});

// Remove row
$(document).on('click', '.remove-rate-row', function () {
    $(this).closest('.rate-row').remove();
});

// যখন Shipping Zone select হবে
$(document).on('change', '#shipping_zone_filter', function () {
    selectedZoneId = $(this).val();
    selectedZoneType = $(this).find(':selected').data('type'); // inside_outside | tiered

    if (!selectedZoneId) {
        $('#rate-container').html(getRateRow()); // default row
        return;
    }

    // Load existing rates for this zone
    getDetails(`/admin/shipping-rates/by-zone/${selectedZoneId}`,
        (res) => {
            let html = '';
            if (res.results.length > 0) {
                res.results.forEach(rate => {
                    html += getRateRow(rate);
                });
            } else {
                html = getRateRow(); // no data → default row
            }
            $('#rate-container').html(html);
        },
        (err) => {
            toastrErrorMessage(err.responseJSON?.message || 'Failed to load rates');
            $('#rate-container').html(getRateRow()); // fallback default row
        }
    );
});

$(document).ready(function () {
    const modal = new bootstrap.Modal(document.getElementById('shippingRateModal'));

    // When modal opens
    $('#shippingRateModal').on('show.bs.modal', function () {
        loadShippingZones();
    });

    $(document).on('click', '.add-new', function () {
        $('#targeted_form')[0].reset();
    });


    // Save all rates
    $('#targeted_form').submit(function (e) {
        e.preventDefault();
        // if (!validateRates()) {
        //     return; // Stop submit if not valid
        // }

        const shippingZoneId = $('#shipping_zone_filter').val();
        let rates = [];

        // প্রতিটি rate-row collect করা হচ্ছে
        $('#rate-container .rate-row').each(function () {
            const row = $(this);
            rates.push({
                id: row.find('input[name="rate_id[]"]').val() || null,
                min_amount: row.find('input[name="min_amount[]"]').val() || null,
                max_amount: row.find('input[name="max_amount[]"]').val() || null,
                min_weight: row.find('input[name="min_weight[]"]').val() || null,
                max_weight: row.find('input[name="max_weight[]"]').val() || null,
                min_qty: row.find('input[name="min_qty[]"]').val() || null,
                max_qty: row.find('input[name="max_qty[]"]').val() || null,
                rate: row.find('input[name="rate[]"]').val()
            });
        });

        const payload = {
            shipping_zone_id: shippingZoneId,
            rates: rates
        };

        saveAction('store', '/admin/shipping-rates', payload, null, (res) => {
            toastrSuccessMessage(res.message);
            $('#shippingRateModal').modal('hide');
            loadDataTable();
        });
    });
});
