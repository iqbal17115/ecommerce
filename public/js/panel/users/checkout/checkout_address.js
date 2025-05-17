document.addEventListener("DOMContentLoaded", function () {
    fetchAddresses();
    // setupAddressForm();
    fetchDefaultAddress();
});

function fetchDefaultAddress() {
    getDetails('/user-address-default', (data) => {
        showDefaultAddress(data.results);
    });
}

fetchDefaultAddress();

function showDefaultAddress(address) {
    const container = document.getElementById('defaultAddressBox');
    if (!container) return;

    container.innerHTML = '';

    if (!address) return;

    container.innerHTML = `
        <div>
            <strong>${address.name}</strong><br>
            ${address.address}<br>
            <small>Phone: ${address.mobile}</small>
        </div>
    `;
}

// Fetch all addresses and display in sidebar
function fetchAddresses() {
    getDetails('/user-address/lists', (data) => {
        const container = document.getElementById("addressSidebarBody");
        container.innerHTML = '';

        if (!data?.results?.data?.length) {
            container.innerHTML = '<p class="text-muted">No saved addresses found.</p>';
            return;
        }
        data.results.data.forEach((address) => {
            const div = document.createElement('div');
            div.className = 'card mb-3 shadow-sm border rounded';

            const isDefault = address.is_default == 1;
            const badge = isDefault
                ? `<span style="margin-left:auto; font-size: 1.2rem;" class="badge bg-success text-white">Default</span>`
                : '';

            const setDefaultBtn = !isDefault
                ? `<button class="btn btn-sm btn-outline-primary me-2" onclick="setDefaultAddress('${address.id}')">Set as Default</button>`
                : '';

            const deleteBtn = !isDefault
                ? `<button class="btn btn-sm btn-outline-danger" onclick="deleteAddress('${address.id}')" title="Delete">
                <i class="fas fa-trash-alt"></i> Delete
            </button>`
                : ''; // Default address can't be deleted

            div.innerHTML = `
        <div class="p-3">
            <div style="display: flex; align-items: center;" class="mb-1">
                <h6 style="margin: 0;">${address.name}</h6>
                ${badge}
            </div>
            <p class="mb-1">${address.address}</p>
            <p class="mb-2 text-muted small">Phone: ${address.mobile}</p>
            <div class="d-flex justify-content-start mt-2 flex-wrap gap-2">
                ${setDefaultBtn}
                <button class="btn btn-sm btn-outline-warning" onclick="editAddress('${address.id}')" title="Edit">
                    <i class="fas fa-edit"></i> Edit
                </button>
                ${deleteBtn}
            </div>
        </div>
    `;

            container.appendChild(div);
        });

    }, (error) => {
        console.error("Failed to load cart data:", error);
    });
}

function setDefaultAddress(id) {
    console.log(id);
    getDetails(`/user-address/set-default/${id}`, function (res) {
        toastrSuccessMessage("Default address set successfully.");
        fetchAddresses();
        fetchDefaultAddress();
    });
}

// Set address as default
function makeDefault(addressId) {
    fetch(`/user-address/set-default/${addressId}`, {
        method: "POST",
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
    })
        .then((res) => res.json())
        .then(() => fetchAddresses())
        .catch((err) => console.error("Set default failed", err));
}

// Open modal and fill data for editing
function editAddress(addressId) {
    getDetails(`/user-address/edit/${addressId}`, function (response) {
        if (!response.success) return alert("Address not found");

        const data = response.data;

        // Fill form fields
        document.getElementById("address_id").value = data.id;
        document.getElementById("full_name").value = data.full_name;
        document.getElementById("phone").value = data.phone;
        document.getElementById("address").value = data.address;
        document.getElementById("country").value = data.country_id;

        // Fetch divisions, districts, areas based on selected values
        loadDivision(data.country_id, data.division_id, () => {
            loadDistrict(data.division_id, data.district_id, () => {
                loadArea(data.district_id, data.area_id);
            });
        });

        showAddressModal();
    });
}

// Delete address
function deleteAddress(addressId) {
    deleteAction(
        `/user-address/${addressId}`,
        (data) => {
            fetchAddresses();
            fetchDefaultAddress();
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
}

// Helper: Open modal
function showAddressModal() {
    const modal = new bootstrap.Modal(document.getElementById('addressModal'));
    modal.show();
}

// Helper: Close modal
function hideAddressModal() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('addressModal'));
    modal.hide();
}

// Dropdown loaders
function loadDivision(countryId, selectedId = null, callback = () => { }) {
    getDetails(`/divisions-select/lists?country_id=${countryId}`, function (data) {
        const select = document.getElementById("division");
        populateSelect(select, data.data, selectedId);
        callback();
    });
}

function loadDistrict(divisionId, selectedId = null, callback = () => { }) {
    getDetails(`/districts-select/lists?division_id=${divisionId}`, function (data) {
        const select = document.getElementById("district");
        populateSelect(select, data.data, selectedId);
        callback();
    });
}

function loadArea(districtId, selectedId = null) {
    getDetails(`/areas-select/lists?district_id=${districtId}`, function (data) {
        const select = document.getElementById("area");
        populateSelect(select, data.data, selectedId);
    });
}

function populateSelect(select, items, selectedId = null) {
    select.innerHTML = `<option value="">Select</option>`;
    items.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = item.name;
        if (selectedId && item.id === selectedId) option.selected = true;
        select.appendChild(option);
    });
}

// Optional: Reset form on modal close
document.getElementById('addressModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById("addressForm").reset();
    document.getElementById("address_id").value = '';
});

function openSidebar() {
    document.getElementById('addressSidebarWrapper').classList.add('show');
    fetchAddresses();
}

function closeSidebar() {
    document.getElementById('addressSidebarWrapper').classList.remove('show');
}

