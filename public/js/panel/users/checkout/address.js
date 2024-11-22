// Load Divisions based on selected Country
function loadDivisions(countryId) {
    if (countryId) {
        getDetails(
            "/api/divisions-select/lists?country_id=" + countryId,
            (data) => {
                let divisionSelect = $('#division_id');
                divisionSelect.empty().append('<option value="">Select Division</option>');

                data.results.data.forEach(division => {
                    divisionSelect.append(`<option value="${division.id}">${division.name}</option>`);
                });
                $('#district_id').empty().append('<option value="">Select District</option>');
                $('#upazila_id').empty().append('<option value="">Select Upazila</option>');
            },
            (error) => {
                console.error("Error loading divisions:", error);
            }
        );
    }
}

// Load Districts based on selected Division
function loadDistricts(divisionId) {
    if (divisionId) {
        getDetails(
            "/api/districts-select/lists?division_id=" + divisionId,
            (data) => {
                let districtSelect = $('#district_id');
                districtSelect.empty().append('<option value="">Select District</option>');

                data.results.data.forEach(district => {
                    districtSelect.append(`<option value="${district.id}">${district.name}</option>`);
                });
                $('#upazila_id').empty().append('<option value="">Select Upazila</option>');
            },
            (error) => {
                console.error("Error loading districts:", error);
            }
        );
    }
}

// Load Upazilas based on selected District
function loadUpazilas(districtId) {
    if (districtId) {
        getDetails(
            "/api/areas-select/lists?district_id=" + districtId,
            (data) => {
                let upazilaSelect = $('#upazila_id');
                upazilaSelect.empty().append('<option value="">Select Upazila</option>');

                data.results.data.forEach(upazila => {
                    upazilaSelect.append(`<option value="${upazila.id}">${upazila.name}</option>`);
                });
            },
            (error) => {
                console.error("Error loading upazilas:", error);
            }
        );
    }
}

function saveAddress(event) {
    // Prevent form submission
    event.preventDefault();

    // Access the form element from the event object
    const form = event.target;  // `event.target` gives you the element that triggered the event (the form)

    // Create an object to hold the data
    const data = {
        address_id: form.querySelector('input[name="address_id"]')?.value || null,
        user_id: form.querySelector('input[name="user_id"]')?.value || null,
        country_id: form.querySelector('select[name="country_id"]')?.value || null,
        name: form.querySelector('input[name="name"]')?.value || null,
        mobile: form.querySelector('input[name="mobile"]')?.value || null,
        optional_mobile: form.querySelector('input[name="optional_mobile"]')?.value || null,
        division_id: form.querySelector('select[name="division_id"]')?.value || null,
        district_id: form.querySelector('select[name="district_id"]')?.value || null,
        upazila_id: form.querySelector('select[name="upazila_id"]')?.value || null,
        instruction: form.querySelector('input[name="instruction"]')?.value || null,
        street_address: form.querySelector('input[name="street_address"]')?.value || null,
        building_name: form.querySelector('input[name="building_name"]')?.value || null,
        nearest_landmark: form.querySelector('input[name="nearest_landmark"]')?.value || null,
        type: form.querySelector('select[name="type"]')?.value || null,
        // Uncomment and handle `is_default` if needed:
        // is_default: form.querySelector('input[name="is_default"]')?.checked ? 1 : 0,
    };

    saveAction(
        "store",
        `/api/user-address`, // dynamically determines store or update endpoint
        data,
        null,
        (data) => {
            toastr.success(data.message);
        },
        (error) => {
        }
    );
}

function setAddressData(addresses) {
    const addressWrapper = document.getElementById('address-wrapper');

    // Clear existing address content
    addressWrapper.innerHTML = '';

    // Add header
    const headerHTML = `
        <div id="address-right-sidebar-wrapper">
            <div class="choose-address-wrapper">
                <div class="header">
                    <h5 class="font-weight-bold mb-0">Shipping Address</h5>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#addressModal" class="text-primary font-weight-bold">Add New Address</a>
                </div>
            </div>
        </div>`;
    addressWrapper.innerHTML = headerHTML;

    const chooseAddressWrapper = addressWrapper.querySelector('.choose-address-wrapper');

    // Loop through addresses to create cards
    addresses.forEach((address, index) => {
        const isDefault = address.is_default === 1 ? 'checked' : '';
        const defaultBadge = address.is_default === 1 ? `<span class="badge badge-info">Default Shipping Address</span>` : '';

        const cardHTML = `
            <div class="address-card">
                <div class="card-header">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="address${index}" ${isDefault}>
                    </div>
                    <div>
                        <h6 class="mb-1 ml-5">${address.name} <span class="text-muted small">${address.mobile}</span></h6>
                        <span class="badge badge-secondary">${address.type.toUpperCase()}</span>
                        <p class="text-muted small mb-1">Region: ${address.division} - ${address.district} - ${address.upazila || 'N/A'}</p>
                        ${defaultBadge}
                    </div>
                    <div class="address-actions mt-2">
                        <button class="btn btn-sm btn-outline-primary edit-address" data-id="${address.id}" data-toggle="modal" data-target="#addressModal">Edit</button>
                        <button class="btn btn-sm btn-outline-danger delete-address" data-id="${address.id}">Delete</button>
                    </div>
                </div>
            </div>`;
        chooseAddressWrapper.insertAdjacentHTML('beforeend', cardHTML);
    });

    // Add action buttons
    const actionButtonsHTML = `
        <div class="action-buttons">
            <button type="button" class="btn btn-outline-secondary btn-sm">Cancel</button>
            <button type="button" class="btn btn-primary btn-sm">Save</button>
        </div>`;
    chooseAddressWrapper.insertAdjacentHTML('beforeend', actionButtonsHTML);

    // Add event listeners for Edit and Delete buttons
    const editButtons = document.querySelectorAll('.edit-address');
    const deleteButtons = document.querySelectorAll('.delete-address');

    editButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            const addressId = event.target.dataset.id;
            editAddress(addressId);
        });
    });

    deleteButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            const addressId = event.target.dataset.id;
            deleteAddress(addressId);
        });
    });
}

function loadUserAddress(user_id) {
    getDetails(
        "/api/user-address/lists?user_id=" + user_id,
        (data) => {
            setAddressData(data.results.data);
        },
        (error) => {

        }
    );
}

$(document).ready(function() {
    user_id = $('#user_id').val();

    $('#addressForm').on('submit', function(event) {
        saveAddress(event);  // Call saveAddress when the form is submitted
        loadUserAddress(user_id);
    });

    loadUserAddress(user_id);
});

