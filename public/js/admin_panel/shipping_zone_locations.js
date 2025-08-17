const addressSelect = {
    populateSelect: function (elementId, items, placeholder = 'Select') {
        const select = document.getElementById(elementId);
        if (!select) {
            console.warn(`Select #${elementId} not found`);
            return;
        }

        let options = `<option value="">${placeholder}</option>`;
        items.forEach(item => {
            options += `<option value="${item.id}">${item.name}</option>`;
        });
        select.innerHTML = options;
    },

    loadDivisions: function (elementId, callback) {
        getDetails('/divisions-select/lists', function (data) {
            addressSelect.populateSelect(elementId, data.results, 'Select Division');
            if (typeof callback === 'function') callback();
        });
    },

    loadDistricts: function (divisionId, elementId, callback) {
        getDetails(`/districts-select/lists?division_id=${divisionId}`, function (data) {
            addressSelect.populateSelect(elementId, data.results, 'Select District');
            if (typeof callback === 'function') callback();
        });
    },

    loadThanas: function (districtId, elementId, callback) {
        getDetails(`/areas-select/lists?district_id=${districtId}`, function (data) {
            addressSelect.populateSelect(elementId, data.results, 'Select Upazila');
            if (typeof callback === 'function') callback();
        });
    }
};

// Remove button handler
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-upazila')) {
        e.target.closest('tr').remove();
    }
});

// Select/Deselect all upazilas
$(document).on('change', '#checkAllUpazilas', function () {
    $('.upazila-checkbox').prop('checked', this.checked);
});

$(document).ready(function () {
    const modal = new bootstrap.Modal(document.getElementById('shippingZoneLocation'));

    // Generate one row of cascading selects
    function generateLocationRow(index = 0) {
        return `
            <div class="row mb-2 location-row" data-index="${index}">
                <div class="col-md-6">
                    <select name="locations[${index}][division_id]" 
                            id="division_${index}" 
                            class="form-select division-select" required>
                        <option value="">Select Division</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="locations[${index}][district_id]" 
                            id="district_${index}" 
                            class="form-select district-select" required>
                        <option value="">Select District</option>
                    </select>
                </div>
            </div>
        `;
    }

    // Load Shipping Zones in zone dropdown
    function loadShippingZones() {
        getDetails('/admin/shipping-zones/select-lists', function (data) {
            const select = document.getElementById('shipping_zone');
            if (!select) return;

            let options = `<option value="">Select Shipping Zone</option>`;
            data.results.forEach(item => {
                options += `<option value="${item.id}">${item.name}</option>`;
            });
            select.innerHTML = options;
        });
    }

    // When modal opens
    $('#shippingZoneLocation').on('show.bs.modal', function () {
        $('#location_rows').html(generateLocationRow(0));
        loadShippingZones();
        addressSelect.loadDivisions('division_0'); // ✅ এখানে id পাঠাচ্ছি
    });


    $(document).on('change', '.district-select', function () {
        const districtId = this.value;
        if (!districtId) return;
        shipping_zone_id = $('#shipping_zone').val();
        // get upazilas
        getDetails(`/upazila-select/lists?district_id=${districtId}&shipping_zone_id=${shipping_zone_id}`, function (data) {
            const tbody = document.querySelector("#upazilaTable tbody");
            tbody.innerHTML = "";

            data.results.forEach(upazila => {
                let checked = upazila.is_selected ? 'checked' : '';
                let row = `
                <tr data-id="${upazila.id}">
                    <td>
                        ${upazila.name}
                    </td>
                    <td>
                    <center>
                         <input type="checkbox" 
                               class="form-check-input upazila-checkbox" 
                               name="upazila_ids[]" 
                               value="${upazila.id}" ${checked}>
                    </center>
                    </td>
                </tr>
            `;
                tbody.insertAdjacentHTML('beforeend', row);
            });
        });
    });

    // Optional: Handle remove button
    $(document).on('click', '.remove-upazila', function () {
        $(this).closest('tr').remove();
    });

    // Add new row
    $('#add_location_row').click(function () {
        const index = $('#location_rows .location-row').length;
        $('#location_rows').append(generateLocationRow(index));
        addressSelect.loadDivisions(`division_${index}`); // ✅ এখানে সঠিক id
    });


    // Event delegation for cascading selects
    $(document).on('change', '.division-select', function () {
        const shippingZoneId = $('#shipping_zone').val();

        if (!shippingZoneId) {
            toastr.error("Please select a Shipping Zone first!");
            $(this).val(""); // reset division select
            return false;    // stop further execution
        }

        const row = $(this).closest('.location-row');
        const index = row.data('index');
        const divisionId = $(this).val();

        if (divisionId) {
            addressSelect.loadDistricts(divisionId, `district_${index}`, function () {
                addressSelect.populateSelect(`upazila_${index}`, [], 'Select Upazila'); // reset upazila
            });
        } else {
            addressSelect.populateSelect(`district_${index}`, [], 'Select District');
            addressSelect.populateSelect(`upazila_${index}`, [], 'Select Upazila');
        }
    });
});

// Initialize DataTable
function loadDataTable() {
    initializeDataTable(
        `/admin/shipping-zone-locations`,
        [
            generateColumn('shipping_zone_name', null, 'shipping_zone_name'),
            generateColumn('division_name', null, 'division'),
            generateColumn('district_name', null, 'district'),
            generateColumn('upazila_name', null, 'upazila'),
        ]
    );
}

// Submit batch add
$('#shipping_zone_location').submit(function (e) {
    e.preventDefault();

    const formData = $(this).serializeArray();
    const payload = {
        shipping_zone_id: $('#shipping_zone').val(),
        locations: []
    };

    // Parse division & district first
    let location = {};
    formData.forEach(item => {
        if (item.name.includes('division')) location.division_id = item.value;
        if (item.name.includes('district')) location.district_id = item.value;
    });

    // ✅ Collect all checked upazilas
    location.upazila_ids = [];
    $('.upazila-checkbox:checked').each(function () {
        location.upazila_ids.push($(this).val());
    });

    payload.locations.push(location);

    console.log(payload); // check what is going to server

    $.post('/admin/shipping-zone-locations/store', payload, function (res) {
        toastr.success(res.message);
        $('#shippingZoneLocation').modal('hide');

        // ✅ Form reset
        $('#shipping_zone_location')[0].reset();

        // ✅ Table এর body empty করে দিচ্ছি (যদি প্রয়োজন হয়)
        $('#upazilaTable tbody').empty();
        loadDataTable();
    }).fail(function (err) {
        toastr.error(err.responseJSON.message || 'Failed to save');
    });
});
