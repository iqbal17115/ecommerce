// Load Divisions based on selected Country
function loadDivisions(countryId) {
    if (countryId) {
        getDetails(
            "/api/divisions-select/lists?country_id=" + countryId,
            (data) => {
                let divisionSelect = $('#division_name');
                divisionSelect.empty().append('<option value="">Select Division</option>');

                data.results.data.forEach(division => {
                    divisionSelect.append(`<option value="${division.id}">${division.name}</option>`);
                });
                $('#district_name').empty().append('<option value="">Select District</option>');
                $('#upazila_name').empty().append('<option value="">Select Upazila</option>');
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
                let districtSelect = $('#district_name');
                districtSelect.empty().append('<option value="">Select District</option>');

                data.results.data.forEach(district => {
                    districtSelect.append(`<option value="${district.id}">${district.name}</option>`);
                });
                $('#upazila_name').empty().append('<option value="">Select Upazila</option>');
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
            `{{ route('districts.lists') }}?district_id=${districtId}`,
            (data) => {
                let upazilaSelect = $('#upazila_name');
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
