document.addEventListener("DOMContentLoaded", function () {
    const country = document.getElementById('country');
    const division = document.getElementById('division');
    const district = document.getElementById('district');
    const area = document.getElementById('area');
    const form = document.getElementById('addressForm');
    const modal = new bootstrap.Modal(document.getElementById('addressModal'));

    function populateDropdown(select, items, placeholder = 'Select') {
        select.innerHTML = `<option value="">${placeholder}</option>`;
        items.results.forEach(item => {
            select.innerHTML += `<option value="${item.id}">${item.name}</option>`;
        });
    }

    function resetDependentDropdowns(fromLevel) {
        if (fromLevel <= 1) division.innerHTML = '<option value="">Select Division</option>';
        if (fromLevel <= 2) district.innerHTML = '<option value="">Select District</option>';
        if (fromLevel <= 3) area.innerHTML = '<option value="">Select Area</option>';
    }

    // Load countries on page load
    // getDetails('/countries-select/lists', data => populateDropdown(country, data, 'Select Country'));

    country.addEventListener('change', function () {
        resetDependentDropdowns(1);
        getDetails(`/divisions-select/lists?country_id=${this.value}`, data => populateDropdown(division, data, 'Select Division'));
    });

    division.addEventListener('change', function () {
        resetDependentDropdowns(2);
        getDetails(`/districts-select/lists?division_id=${this.value}`, data => populateDropdown(district, data, 'Select District'));
    });

    district.addEventListener('change', function () {
        resetDependentDropdowns(3);
        getDetails(`/areas-select/lists?district_id=${this.value}`, data => populateDropdown(area, data, 'Select Area'));
    });

    // Load address and populate modal for editing
    window.editAddress = function (id) {
        getDetails(
            `/user-address/${id}`,
            (data) => {
                data = data.data;
                document.getElementById('addressId').value = data.id;
                document.getElementById('full_name').value = data.full_name;
                document.getElementById('street_address').value = data.street_address;
                document.getElementById('building_name').value = data.building_name;
                document.getElementById('nearest_landmark').value = data.nearest_landmark;
                document.getElementById('note').value = data.note;
                document.getElementById('mobile').value = data.mobile;
                document.getElementById('optional_mobile').value = data.optional_mobile;
                document.getElementById('is_default').checked = data.is_default === 1;

                // Pre-select dropdowns (load parent first then select)
                getDetails('/countries-select/lists', countries => {
                    populateDropdown(country, countries, 'Select Country');
                    country.value = data.country_id;
                    getDetails(`/divisions-select/lists?country_id=${data.country_id}`, divisions => {
                        populateDropdown(division, divisions, 'Select Division');
                        division.value = data.division_id;
                        getDetails(`/districts-select/lists?division_id=${data.division_id}`, districts => {
                            populateDropdown(district, districts, 'Select District');
                            district.value = data.district_id;
                            getDetails(`/areas-select/lists?district_id=${data.district_id}`, areas => {
                                populateDropdown(area, areas, 'Select Area');
                                area.value = data.upazila_id || '';
                            });
                        });
                    });
                });

                document.getElementById('addressSidebarWrapper').classList.remove('show');
                modal.show();
            },
            (error) => {

            }
        );
    }

    // Form submission
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        fetch('/user-address/store-or-update', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
            .then(res => res.json())
            .then(res => {
                toastrSuccessMessage("Address saved successfully.");
                modal.hide();
                fetchDefaultAddress();
                fetchAddresses(); // reload sidebar list
            });
    });

    // Add address modal open (global access)
    window.openAddAddressModal = function (selectedCountryId = null) {
        if (!form) return;
        form.reset();

        const addressIdInput = document.getElementById('addressId');
        if (addressIdInput) {
            addressIdInput.value = '';
        }

        // Reset dependent dropdowns
        resetDependentDropdowns(1);

        // Reload countries and set selected
        getDetails('/countries-select/lists', data => {
            populateDropdown(country, data, 'Select Country');
              selectedCountryId = "9c617d63-544b-49f8-991f-63e9158b4b8d";
            if (selectedCountryId) {
                country.value = selectedCountryId;

                // Now load divisions for selected country
                getDetails(`/divisions-select/lists?country_id=${selectedCountryId}`, divData => {
                    populateDropdown(division, divData, 'Select Division');
                });
            }
        });

        // Show modal
        modal.show();
    }
});
