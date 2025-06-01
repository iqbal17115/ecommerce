document.addEventListener("DOMContentLoaded", function () {
    fetchAddresses();
});

// Fetch all addresses and display in sidebar
function fetchAddresses() {
  getDetails('/user-address/lists', (data) => {
    const container = document.querySelector(".address-carousel");
    container.innerHTML = '';

    if (!data?.results?.data?.length) {
      container.innerHTML = '<p class="no-address">No saved addresses yet.</p>';
      return;
    }

    data.results.data.forEach((address) => {
      const isDefault = address.is_default == 1;

      const tile = document.createElement('div');
      tile.className = 'address-tile';

      tile.innerHTML = `
        <div class="address-info">
          <h4>${address.name} ${isDefault ? '<i class="fas fa-star address-default-icon"></i>' : ''}</h4>
          <p>${address.address}</p>
          <p>Phone: ${address.mobile}</p>
        </div>
        <div class="address-actions">
          ${!isDefault ? `<button title="Set Default" onclick="setDefaultAddress('${address.id}')"><i class="fas fa-check"></i>Set As Default</button>` : ''}
          <button title="Edit" onclick="editAddress('${address.id}')"><i class="fas fa-edit"></i></button>
          ${!isDefault ? `<button title="Delete" onclick="deleteAddress('${address.id}')"><i class="fas fa-trash"></i></button>` : ''}
        </div>
      `;
      container.appendChild(tile);
    });
  }, (error) => {
    console.error("Failed to load addresses:", error);
  });
}

function setDefaultAddress(id) {
    console.log(id);
    getDetails(`/user-address/set-default/${id}`, function (res) {
        toastrSuccessMessage("Default address set successfully.");
        fetchAddresses();
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
    fetchAddresses();
}

