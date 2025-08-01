(function () {
    const addressSelect = {
        init: function () {
            this.bindEvents();
            this.loadDivisions();
        },

        bindEvents: function () {
            const divisionSelect = document.getElementById('division');
            const districtSelect = document.getElementById('district');

            if (divisionSelect) {
                divisionSelect.addEventListener('change', function () {
                    addressSelect.clearSelect('district');
                    addressSelect.clearSelect('thana');

                    if (this.value) {
                        addressSelect.loadDistricts(this.value);
                    }
                });
            }

            if (districtSelect) {
                districtSelect.addEventListener('change', function () {
                    addressSelect.clearSelect('thana');

                    if (this.value) {
                        addressSelect.loadThanas(this.value);
                    }
                });
            }
        },

        loadDivisions: function () {
            getDetails('/divisions-select/lists', function (data) {
                addressSelect.populateSelect('division', data.results, 'Select Division');
            }, addressSelect.handleError);
        },

        loadDistricts: function (divisionId) {
            getDetails(`/districts-select/lists?division_id=${divisionId}`, function (data) {
                addressSelect.populateSelect('district', data.results, 'Select District');
            }, addressSelect.handleError);
        },

        loadThanas: function (districtId) {
            getDetails(`/areas-select/lists?district_id=${districtId}`, function (data) {
                addressSelect.populateSelect('thana', data.results, 'Select Thana');
            }, addressSelect.handleError);
        },

        populateSelect: function (elementId, items, placeholder = 'Select') {
            const select = document.getElementById(elementId);
            if (!select) return;

            let options = `<option value="">${placeholder}</option>`;
            items.forEach(item => {
                options += `<option value="${item.id}">${item.name}</option>`;
            });
            select.innerHTML = options;
        },

        clearSelect: function (elementId) {
            const select = document.getElementById(elementId);
            if (select) {
                select.innerHTML = '<option value="">Select</option>';
            }
        },

        handleError: function (error) {
            if (error.responseJSON && error.responseJSON.message) {
                toastrErrorMessage(error.responseJSON.message);
            } else {
                toastrErrorMessage("An error occurred");
            }
        }
    };

    // Auto-init if loaded in the page
    window.addEventListener('DOMContentLoaded', function () {
        addressSelect.init();
    });

    // Expose to global scope if needed elsewhere
    window.addressSelect = addressSelect;
})();
