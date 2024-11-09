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

    // Create a FormData object from the form
    const formData = new FormData(form);
    saveAction(
        "store",
        `/api/user-address`, // dynamically determines store or update endpoint
        formData,
        null,
        (data) => {
            toastr.success(data.message);
        },
        (error) => {
        }
    );
}

$(document).ready(function() {
    $('#addressForm').on('submit', function(event) {
        saveAddress(event);  // Call saveAddress when the form is submitted
    });
});

