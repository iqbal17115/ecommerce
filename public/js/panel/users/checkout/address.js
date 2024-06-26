$(document).on("change", "#division_id", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately
    const division_id = $("#division_id").val();
    // Get details
    getDetails(
        "/api/districts-select/lists?division_id=" + division_id,
        (data) => {
            setDistrictData(data.results.data);
        },
        (error) => {

        }
    );
});


$(document).on("change", "#country_id", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately
    const country_id = $("#country_id").val();
    // Get details
    getDetails(
        "/api/divisions-select/lists?country_id=" + country_id,
        (data) => {
            setDivisionData(data.results.data);
        },
        (error) => {

        }
    );
});

$(document).on("click", ".address_modal", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    // Get details
    getDetails(
        "/api/countries-select/lists",
        (data) => {
            setCountryData(data.results.data);
        },
        (error) => {

        }
    );
});

$(document).on("click", "#set_as_default_address", function (event) {
    const address_id = $(this).data('address_id');
    const user_id = $("#user_id_val").val();
    const data = {
        address_id: address_id,
        user_id: user_id
    };
    confirmAction('Default Address', 'Are You want to set as default address?', () => {
        saveAction(
            "store",
            "/api/user-address/default",
            data,
            address_id,
            (data) => {
                userAddress();
            },
            (error) => {

            }
        );
    });

});
$(document).on("click", "#remove_address", function (event) {
    const address_id = $(this).data('address_id');
    //Delete
    deleteAction(
        '/api/user-address/' + address_id,
        (data) => {
            userAddress();
        },
        (error) => {
            // Error callback
            toastrErrorMessage(error.responseJSON.message);
        }
    );
});

function setEditData(data) {
    // Set 'row_id'
    $('#row_id').val(data.id);

    // Set 'user_id'
    $('#user_id').val(data.user_id);

    // Set 'name'
    $('#name').val(data.name);

    // Set 'mobile'
    $('#mobile').val(data.mobile);

    // Set 'optional_mobile'
    $('#optional_mobile').val(data.optional_mobile);

    // Set 'street_address'
    $('#street_address').val(data.street_address);

    // Set 'building_name'
    $('#building_name').val(data.building_name);

    // Set 'nearest_landmark'
    $('#nearest_landmark').val(data.nearest_landmark);

    // Set 'type' (assuming 'type' is a radio button)
    if (data.type === 'home') {
        $('#home').prop('checked', true);
    } else if (data.type === 'office') {
        $('#office').prop('checked', true);
    }
    var defaultOption = document.createElement('option');
    defaultOption.text = 'Select';

    var countrySelector = document.getElementById('country_id');
    var divisionSelector = document.getElementById('division_id');
    var districtSelector = document.getElementById('district_id');


    var countries = data.countries;
    var divisions = data.divisions;
    var districts = data.districts;


    countrySelector.innerHTML = '';
    divisionSelector.innerHTML = '';
    districtSelector.innerHTML = '';


    // Add a default option with no specific value
    countrySelector.appendChild(defaultOption);
    divisionSelector.appendChild(defaultOption);
    districtSelector.appendChild(defaultOption);

    // Populate options based on country data
    countries.forEach(function (country) {
        var option = document.createElement('option');
        option.value = country.id;
        option.text = country.name;
        countrySelector.appendChild(option);

        // Select the option with the specified division_id
        if (country.id == data.country_id) {
            option.selected = true;
        }
    });

    // Populate options based on division data
    divisions.forEach(function (division) {
        var option = document.createElement('option');
        option.value = division.id;
        option.text = division.name;
        divisionSelector.appendChild(option);

        // Select the option with the specified division_id
        if (division.id == data.division_id) {
            option.selected = true;
        }
    });

    // Populate options based on district data
    districts.forEach(function (district) {
        var option = document.createElement('option');
        option.value = district.id;
        option.text = district.name;
        districtSelector.appendChild(option);

        // Select the option with the specified district_id
        if (district.id == data.district_id) {
            option.selected = true;
        }
    });
}

function setAddressInstructionData(data) {

    $('input[name="property"]').each(function () {

        if ($(this).attr('id') == data.property_type) {
            $(this).prop('checked', true);
        } else {
            $(this).prop('checked', false);
        }
    });

    $("#" + data['package_leave_address']).prop("checked", true);
    $("#description").val(data['description']);

    // Parse the closed_day_for_delivery JSON
    const deliveryDays = JSON.parse(data.closed_day_for_delivery);

    // Set the radio inputs for each day
    for (const day in deliveryDays) {
        if (deliveryDays.hasOwnProperty(day)) {
            const value = deliveryDays[day];
            const formattedDay = day.charAt(0).toLowerCase() + day.slice(1);
            $(`input[name="${formattedDay}"][value="${value}"]`).prop('checked', true);
        }
    }
}

function getAddresInstruction(address_id) {
    // Get details
    getDetails(
        "/api/user-address-instruction/" + address_id,
        (data) => {
            setAddressInstructionData(data.results);
        },
        (error) => {

        }
    );
}

$(document).on("click", "#instruction_modal", function (event) {
    const address_id = $(this).data('id');
    $('#address_id').val(address_id);
    $('#instruction_form input[type="radio"]').prop('checked', false);
    $('#instruction_form input[name="package_leave_address"]').prop('checked', false);
    $('#description').val('');

    getAddresInstruction(address_id);
});


function setAddressData(data) {
    // Initialize an empty variable to store the card HTML
    let cardHTML = '';
    let default_address_content = '';
    let count_default = 0;

    if (data.length !== 0) {
        // Loop through the dataArray
        data.forEach((data, index) => {
            const address = data.is_default === 1 ? 'Default' : '';
            const set_as_default_address = data.is_default === 0 ? `<span class="mx-1">|</span><a href="javascript:void(0);" class="text-sm set_default_address" id="set_as_default_address" data-address_id="${data.id}">Set As Default</a>` : '';
            const remove_address = data.is_default === 0 ? `<span class="mx-1">|</span><a href="javascript:void(0);" class="text-sm remove_address" data-address_id="${data.id}">Remove</a>` : '';

            const radioChecked = data.is_default === 1 ? 'checked' : ''; // Check the radio button if it's the default address

            const selectedClass = data.is_default === 1 ? 'selected-card' : ''; // Add a class for the selected card

            if (data.is_default == 1) {
                count_default = count_default + 1;
                default_address_content += `
            <div class="col-md-4" id="default_address" data-default_address="${data.id}"><strong class="text-dark">${count_default}. Shipping address</strong></div>
            <div class="col-md-8">
                <p class="shipping-address">
                    <span class="shipping_name text-dark">${data.name}</span><br>
                    <span class="shipping_address text-dark">${data.street_address}, ${data.building_name}</span><br>
                    <span class="shipping_area text-dark">${data.division}, ${data.district}, ${data.upazila}</span><br>
                    <span class="shipping-info text-dark">${data.mobile}</span>
                </p>
                <p class="text-dark" style="font-size: 12px;">
                    Collect your parcel from the nearest Aladdinne Pick-up Point with a reduced shipping fee <a href="">Check Pick-up Points</a>
                </p>
            </div>
            `;
            }

            cardHTML += `
                <div class="col-md-4 p-1 m-0 ${selectedClass}">
                    <input type="radio" name="addressRadio" ${radioChecked} class="hidden-radio" id="address_${data.id}" data-address_id="${data.id}" hidden>
                    <label for="address_${data.id}" style="display: inline;">
                        <div class="card p-0 m-0 bg-light" style="height: 100%;">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <span class="mr-3">Address</span>
                                    <span class="mx-auto">${address}</span>
                                    <span class="ml-auto">${data.type}</span>
                                </div>
                            </div>

                            <div class="card-body">
                                <h4 class="card-title">${data.name}</h4>
                                <div class="card-text">${data.street_address}</div>
                                <div class="card-text">${data.building_name}</div>
                                <div class="card-text">${data.nearest_landmark}</div>
                                <div class="card-text">${data.district}, ${data.division}</div>
                                <div class="card-text">${data.country}</div>
                                <div class="card-text">Phone No: ${data.mobile}</div>
                                <div class="card-text">Additional No: ${data.optional_mobile}</div>
                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0);" class="text-sm edit_address" data-address_id="${data.id}">Edit</a>
                                ${remove_address}
                                ${set_as_default_address}
                            </div>
                        </div>
                    </label>
                </div>
            `;
        });

        $("#address_content").html(cardHTML);

        // Add click event to update the selected card
        $(".hidden-radio").on("change", function () {
            $(".selected-card").removeClass("selected-card");
            $(this).closest(".col-md-4").addClass("selected-card");
        });

        var modalFooterHTML = `
            <button type="button" class="btn btn-sm" id="add_another_address">
                <i class="fas fa-plus brand_text_color"></i> Add New Address
            </button>
            <button type="button" class="btn btn-sm brand_color" data-dismiss="modal">Close</button>`;

        $('#default_address_content').html(default_address_content);
        $('#address_footer').html(modalFooterHTML);
    } else {
        loadAddressForm();
    }
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

function getDayStatus(index) {
    var radioClosed = document.getElementById('weekday_' + index + '_closed');
    var radioOpen = document.getElementById('weekday_' + index + '_open');

    if (radioClosed && radioClosed.checked) {
        return "closed";
    } else if (radioOpen && radioOpen.checked) {
        return "open";
    }

    return null;
}


// Function to handle form submission
function submitInstructions(formData, selectedId = "") {
    saveAction(
        "store",
        "/api/user-address-instruction",
        formData,
        '',
        (data) => {
            document.getElementById('instruction_close_button').click();
        },
        (error) => {

        }
    );
}

$("#instruction_form").submit(function (event) {
    event.preventDefault();
    var selectedPropertyElement = document.querySelector('input[name="property"]:checked');
    var selectedPropertyName = selectedPropertyElement ? selectedPropertyElement.nextElementSibling.textContent : null;
    const address_id = $("#instruction_form #address_id").val();
    const description = $("#instruction_form #description").val();

    var selectedPackageLeaveAddressId = '';
    var checkedPackageLeaveAddress = $('input[name="package_leave_address"]:checked');

    // Check if any radio input is checked
    if (checkedPackageLeaveAddress.length > 0) {
        selectedPackageLeaveAddressId = checkedPackageLeaveAddress.attr('id');
    }

    var formData = {
        address_id: address_id,
        propertyName: selectedPropertyName,
        deliveryDays: {},
        package_leave_address: selectedPackageLeaveAddressId,
        description: description
    };

    formData.deliveryDays['Sunday'] = getDayStatus('sunday');
    formData.deliveryDays['Monday'] = getDayStatus('monday');
    formData.deliveryDays['Tuesday'] = getDayStatus('tuesday');
    formData.deliveryDays['Wednesday'] = getDayStatus('wednesday');
    formData.deliveryDays['Thursday'] = getDayStatus('thursday');
    formData.deliveryDays['Friday'] = getDayStatus('friday');
    formData.deliveryDays['Saturday'] = getDayStatus('saturday');


    submitInstructions(formData, address_id);
});
// Attach event listener for form submission
$("#targeted_form").submit(function (event) {
    event.preventDefault();
    //get id
    const id = $("#targeted_form #row_id").val();

    // Load the selected details and submit the form
    const data = {
        user_id: $("#targeted_form #user_id").val(),
        name: $("#targeted_form #name").val(),
        mobile: $("#targeted_form #mobile").val(),
        optional_mobile: $("#targeted_form #optional_mobile").val(),
        country_id: $("#targeted_form #country_id").val(),
        division_id: $("#targeted_form #division_id").val(),
        district_id: $("#targeted_form #district_id").val(),
        street_address: $("#targeted_form #street_address").val(),
        building_name: $("#targeted_form #building_name").val(),
        nearest_landmark: $("#targeted_form #nearest_landmark").val(),
        type: $("input[name='type']:checked").val(),
        is_default: 0
    };

    // Submit the form
    submitForm(data, id);
});

// Function to handle form submission
function submitForm(formData, selectedId = "") {
    saveAction(
        selectedId.trim() !== "" ? "update" : "store",
        "/api/user-address",
        formData,
        selectedId,
        (data) => {
            document.getElementById('close_button').click();
            userAddress();
        },
        (error) => {

        }
    );
}

function setDistrictData(data) {
    const selectElement = document.getElementById('district_id');

    selectElement.innerHTML = '';

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.text = 'Select a District';
    defaultOption.setAttribute('selected', 'selected');

    selectElement.appendChild(defaultOption);

    data.forEach((item) => {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = item.name;

        selectElement.appendChild(option);
    });
}

function setDivisionData(data) {
    const selectElement = document.getElementById('division_id');

    selectElement.innerHTML = '';

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.text = 'Select a Division';
    defaultOption.setAttribute('selected', 'selected');

    selectElement.appendChild(defaultOption);

    data.forEach((item) => {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = item.name;

        selectElement.appendChild(option);
    });
}

function setCountryData(data) {
    const selectElement = document.getElementById('country_id');

    selectElement.innerHTML = '';

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.text = 'Select a Country';
    defaultOption.setAttribute('selected', 'selected');

    selectElement.appendChild(defaultOption);

    data.forEach((item) => {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = item.name;

        selectElement.appendChild(option);
    });
}

function editAddressForm() {
    var formHTML = `
        <input name="row_id" id="row_id" value="" hidden />
        <div class="row">
        <div class="col-md-12">
            <label for="country_id">Country</label>
            <select class="form-control form-control-sm country_id" id="country_id" name="country_id"
                required>
            </select>
        </div>
        <div class="col-md-12">
            <label for="mobile">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                placeholder="Enter mobile number" value="" required>
        </div>
        <div class="col-md-12">
            <label for="mobile">Mobile</label>
            <input type="text" class="form-control" id="mobile" name="mobile"
                placeholder="Enter name" required>
        </div>
        <div class="col-md-12">
            <label for "optional_mobile">Optional Mobile</label>
            <input type="text" class="form-control" id="optional_mobile" name="optional_mobile"
                placeholder="Enter optional mobile number">
        </div>
        <div class="col-md-12">
            <label for="division_id">City/Province</label>
            <select class="form-control form-control-sm" id="division_id" name="division_id" required>
                <option> -- Select --</option>
            </select>
        </div>
        <div class="col-md-12">
            <label for="district_id">District/Area</label>
            <select class="form-control form-control-sm" id="district_id" name="district_id" required>
                <option> -- Select --</option>
            </select>
        </div>
        <div class="col-md-12">
            <label for="street_address">Street Address</label>
            <input type="text" class="form-control" id="street_address" name="street_address"
                placeholder="Enter street address" required>
        </div>
        <div class="col-md-12">
            <label for="building_name">Building Name</label>
            <input type="text" class="form-control" id="building_name" name="building_name"
                placeholder="Enter building name" required>
        </div>
        <div class="col-md-12">
            <label for="nearest_landmark">Nearest Landmark</label>
            <input type="text" class="form-control" id="nearest_landmark" name="nearest_landmark"
                placeholder="Enter nearest landmark">
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="home" name="type"
                            value="home" checked>
                        <label class="form-check-label ml-2" for="home"> Home</label>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="office" name="type"
                        value="office">
                    <label class="form-check-label ml-2" for="office"> Office</label>
                </div>
            </div>
        </div>
        </div>`;

    var modalFooterHTML = `
    <button type="button" class="btn btn-sm address_lists">
       <i class="fas fa-list-ul"></i>
    </button>
    <button type="submit" class="btn btn-sm brand_color" id="add_address">Confirm</button>`;

    $('#address_content').html(formHTML);
    $('#address_footer').html(modalFooterHTML);
}

function addressForm(user) {
    var formHTML = `
        <input name="row_id" id="row_id" value="" hidden />
        <input name="user_id" id="user_id" value="${user.id}" hidden />
        <div class="row">
        <div class="col-md-12">
            <label for="country_id">Country</label>
            <select class="form-control form-control-sm country_id" id="country_id" name="country_id"
                required>
                <option> -- Select --</option>
            </select>
        </div>
        <div class="col-md-12">
            <label for="mobile">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                placeholder="Enter mobile number" value="${user.name}" required>
        </div>
        <div class="col-md-12">
            <label for="mobile">Mobile</label>
            <input type="text" class="form-control" id="mobile" name="mobile"
                placeholder="Enter name" required>
        </div>
        <div class="col-md-12">
            <label for "optional_mobile">Optional Mobile</label>
            <input type="text" class="form-control" id="optional_mobile" name="optional_mobile"
                placeholder="Enter optional mobile number">
        </div>
        <div class="col-md-12">
            <label for="division_id">City/Province</label>
            <select class="form-control form-control-sm" id="division_id" name="division_id" required>
                <option> -- Select --</option>
            </select>
        </div>
        <div class="col-md-12">
            <label for="district_id">District/Area</label>
            <select class="form-control form-control-sm" id="district_id" name="district_id" required>
                <option> -- Select --</option>
            </select>
        </div>
        <div class="col-md-12">
            <label for="street_address">Street Address</label>
            <input type="text" class="form-control" id="street_address" name="street_address"
                placeholder="Enter street address" required>
        </div>
        <div class="col-md-12">
            <label for="building_name">Building Name</label>
            <input type="text" class="form-control" id="building_name" name="building_name"
                placeholder="Enter building name" required>
        </div>
        <div class="col-md-12">
            <label for="nearest_landmark">Nearest Landmark</label>
            <input type="text" class="form-control" id="nearest_landmark" name="nearest_landmark"
                placeholder="Enter nearest landmark">
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="home" name="type"
                            value="home" checked>
                        <label class="form-check-label ml-2" for="home"> Home</label>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="office" name="type"
                        value="office">
                    <label class="form-check-label ml-2" for="office"> Office</label>
                </div>
            </div>
        </div>
        </div>`;

    var modalFooterHTML = `
    <button type="button" class="btn btn-sm address_lists">
       <i class="fas fa-list-ul"></i>
    </button>
    <button type="submit" class="btn btn-sm brand_color" id="add_address">Confirm</button>`;

    $('#address_content').html(formHTML);
    $('#address_footer').html(modalFooterHTML);

    setCountry();
}

$(document).on("change", "#division_id", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately
    const division_id = $("#division_id").val();
    // Get details
    getDetails(
        "/api/districts-select/lists?division_id=" + division_id,
        (data) => {
            setDistrictData(data.results.data);
        },
        (error) => {

        }
    );
});


$(document).on("change", "#country_id", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately
    const country_id = $("#country_id").val();
    // Get details
    getDetails(
        "/api/divisions-select/lists?country_id=" + country_id,
        (data) => {
            setDivisionData(data.results.data);
        },
        (error) => {

        }
    );
});

function setCountry() {
    // Get details
    getDetails(
        "/api/countries-select/lists",
        (data) => {
            setCountryData(data.results.data);
        },
        (error) => {

        }
    );
}

function setDistrictData(data) {
    const selectElement = document.getElementById('district_id');

    selectElement.innerHTML = '';

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.text = 'Select a District';
    defaultOption.setAttribute('selected', 'selected');

    selectElement.appendChild(defaultOption);

    data.forEach((item) => {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = item.name;

        selectElement.appendChild(option);
    });
}

function setDivisionData(data) {
    const selectElement = document.getElementById('division_id');

    selectElement.innerHTML = '';

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.text = 'Select a Division';
    defaultOption.setAttribute('selected', 'selected');

    selectElement.appendChild(defaultOption);

    data.forEach((item) => {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = item.name;

        selectElement.appendChild(option);
    });
}

function setCountryData(data) {
    const selectElement = document.getElementById('country_id');

    selectElement.innerHTML = '';

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.text = 'Select a Country';
    defaultOption.setAttribute('selected', 'selected');

    selectElement.appendChild(defaultOption);

    data.forEach((item) => {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = item.name;

        selectElement.appendChild(option);
    });
}

// Attach event listener for form submission
$(document).on('submit', '#address_form', function (event) {
    event.preventDefault();
    //get id
    const selectedId = $("#address_form #row_id").val();
    // Load the selected details and submit the form
    const data = {
        user_id: $("#address_form #user_id").val(),
        name: $("#address_form #name").val(),
        mobile: $("#address_form #mobile").val(),
        optional_mobile: $("#address_form #optional_mobile").val(),
        country_id: $("#address_form #country_id").val(),
        division_id: $("#address_form #division_id").val(),
        district_id: $("#address_form #district_id").val(),
        street_address: $("#address_form #street_address").val(),
        building_name: $("#address_form #building_name").val(),
        nearest_landmark: $("#address_form #nearest_landmark").val(),
        type: $("input[name='type']:checked").val(),
        is_default: 0
    };

    // Submit the form
    submitAddressForm(data, selectedId);
});

// Function to handle form submission
function submitAddressForm(formData, selectedId = "") {
    saveAction(
        selectedId.trim() !== "" ? "update" : "store",
        "/api/user-address",
        formData,
        selectedId,
        (data) => {
            userAddress();
        },
        (error) => {

        }
    );
}

$(document).on("click", ".address_lists", function (event) {
    userAddress();
});

$(document).on("click", ".edit_address", function (event) {
    editAddressForm();
    const address_id = $(this).data('address_id');

    // Get details
    getDetails(
        "/api/user-address-details/" + address_id,
        (data) => {
            console.log(data.results);
            setEditData(data.results);
        },
        (error) => {
            // Handle the error here
        }
    );
});
