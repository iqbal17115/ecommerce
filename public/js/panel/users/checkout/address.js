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

    // address_id
    const selectedId = form.querySelector('input[name="address_id"]')?.value || null;

    // Create an object to hold the data
    const data = {
        address_id: selectedId,
        user_id: $('#user_id_val').val() || null,
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

    if(selectedId == null) {
        saveAction(
            "store",
            "/api/user-address",
            data,
            selectedId,
            (data) => {
                toastr.success(data.message);
                // Optionally reset the form
                $('#addressForm')[0].reset();
                document.getElementById('addressModal').classList.toggle('show');
            },
            (error) => {
            }
        );
    } else {
        saveAction(
            "store",
            "/api/update-user-address",
            data,
            selectedId,
            (data) => {
                toastr.success(data.message);
                // Optionally reset the form
                $('#addressForm')[0].reset();
                document.getElementById('addressModal').classList.toggle('show');
            },
            (error) => {
            }
        );
    }
}

function setAddressData(addresses) {
    const addressWrapper = document.getElementById('address-wrapper');
    const defaultAddressContent = document.getElementById('default_address_content');

    // Clear existing address content
    addressWrapper.innerHTML = '';
    defaultAddressContent.innerHTML = '';

    // Add header
    const headerHTML = `
    <div id="address-right-sidebar-wrapper">
        <div class="choose-address-wrapper">
            <div class="header">
                <span style="
                    font-size: 30px;
                    font-weight: bold;
                    color: #333;
                    display: inline-block;
                    height: 30px;
                    width: 30px;
                    text-align: center;
                    line-height: 30px;
                    border-radius: 50%;
                    background-color: #f1f1f1;
                    cursor: pointer;
                    transition: background-color 0.3s ease, transform 0.2s ease;
                " 
                onclick="toggleSidebar()"
                onmouseover="this.style.backgroundColor='#ddd'; this.style.transform='scale(1.1)';"
                onmouseout="this.style.backgroundColor='#f1f1f1'; this.style.transform='scale(1)';">
                    &times;
                </span>
            </div>
        </div>
    </div>`;

    addressWrapper.innerHTML = headerHTML;

    const chooseAddressWrapper = addressWrapper.querySelector('.choose-address-wrapper');

    // Loop through addresses to create cards
    addresses.forEach((address, index) => {
        const isDefault = address.is_default === 1 ? 'checked' : '';
        const defaultBadge = address.is_default === 1 ? `<span class="badge badge-info">Default Shipping Address</span>` : '';

        // Only add delete button for non-default addresses
        const deleteButton = address.is_default !== 1
            ? `<button class="btn btn-sm btn-outline-danger delete-address" data-id="${address.id}">Delete</button>`
            : '';

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
                        <button class="btn btn-sm btn-outline-primary edit-address" data-address_id="${address.id}" data-toggle="modal" data-target="#addressModal">Edit</button>
                        ${deleteButton}
                    </div>
                </div>
            </div>`;

        // Add all addresses to the sidebar
        chooseAddressWrapper.insertAdjacentHTML('beforeend', cardHTML);

        // Add the default address to the separate section with a unique design
        if (address.is_default === 1) {
            const defaultCardHTML = `
                    <div class="default-address-card p-3 border rounded bg-light">
                        <h6 class="font-weight-bold">${address.name}</h6>
                        <p class="mb-1 text-muted">Mobile: ${address.mobile}</p>
                        <p class="mb-1">Address: ${address.division}, ${address.district}, ${address.upazila || 'N/A'} - ${address.street_address}</p>
                        <p class="mb-1 text-info">Default Shipping Address</p>
                        <div class="actions">
                            <button class="btn btn-sm btn-outline-primary edit-address" id="default_address" data-address_id="${address.id}" data-toggle="modal" data-target="#addressModal">Edit</button>
                        </div>
                    </div>`;

            // Append the new HTML instead of replacing
            defaultAddressContent.insertAdjacentHTML('beforeend', defaultCardHTML);
        }
    });

    // Add event listeners for Edit and Delete buttons
    const editButtons = document.querySelectorAll('.edit-address');
    const deleteButtons = document.querySelectorAll('.delete-address');

    editButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            const addressId = event.target.dataset.address_id;
            // editAddress(addressId);
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
            console.log(data.results.data);
            setAddressData(data.results.data);
        },
        (error) => {

        }
    );
}

$(document).on("click", ".delete-address", function (event) {
    event.preventDefault(); // Prevent default behavior if necessary
    
    const address_id = $(this).data('id'); // Get the address ID from the button

    // Call deleteAction to perform the delete operation
    deleteAction(
        '/api/user-address/' + address_id,
        (data) => {
            const user_id = $('#user_id_val').val(); // Fetch the user ID
            loadUserAddress(user_id); // Reload the user address list
            toastr.success(data.message);
        },
        (error) => {
            // Handle error
            toastrErrorMessage(error.responseJSON.message); // Show error message using toastr
        }
    );
});

$(document).on("click", ".edit-address", function (event) {
    const address_id = $(this).data('address_id');

    // Get details
    getDetails(
        "/api/user-address/" + address_id,
        (data) => {
            const address = data.results;

            // Populate the modal fields with the retrieved address data
            $("#address_id").val(address.id);
            $("#name").val(address.name);
            $("#instruction").val(address.instruction);
            $("#mobile").val(address.mobile);
            $("#optional_mobile").val(address.optional_mobile);
            $("#street_address").val(address.street_address);
            $("#building_name").val(address.building_name);
            $("#nearest_landmark").val(address.nearest_landmark);
            $("#type").val(address.type);
            $("#country_id").val(address.country_id).change();

            // Load divisions, districts, and upazilas dynamically if available
            if (address.division_id) {
                loadDivisions(address.country_id); // Ensure divisions are loaded
                setTimeout(() => $("#division_id").val(address.division_id).change(), 500);
            }

            if (address.district_id) {
                loadDistricts(address.division_id); // Ensure districts are loaded
                setTimeout(() => $("#district_id").val(address.district_id).change(), 1000);
            }

            if (address.upazila_id) {
                loadUpazilas(address.district_id); // Ensure upazilas are loaded
                setTimeout(() => $("#upazila_id").val(address.upazila_id), 1500);
            }
        },
        (error) => {
            // Handle the error here
        }
    );
});

$(document).ready(function() {
    const user_id = $('#user_id_val').val();

    $('#addressForm').on('submit', async function(event) {
        event.preventDefault(); // Prevent default form submission

        try {
            console.log('Saving address...');
            
            // Wait for the address to be saved
            await saveAddress(event);  
            console.log('Address saved!');

            // Wait for the updated address list to load
            await loadUserAddress(user_id);  
            console.log('User addresses loaded!');
        } catch (error) {
            console.error("Error during save:", error);
        }
    });

    loadUserAddress(user_id); // Initial load of addresses
});

