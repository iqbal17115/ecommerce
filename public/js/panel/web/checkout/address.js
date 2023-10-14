

$('.btn-toggle-fade').on('click', function () {
    if ($('.modal').hasClass('fade')) {
        $('.modal').removeClass('fade');
        $(this).removeClass('btn-success');
    } else {
        $('.modal').addClass('fade');
        $(this).addClass('btn-success');
    }
});

$(document).on("change", "#district_id", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately
    const district_id = $("#district_id").val();

    // Get details
    getDetails(
        "/api/areas-select/lists?district_id=" + district_id,
        (data) => {
            setUpazilaData(data.results.data);
        },
        (error) => {

        }
    );
});

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
            // console.log(data);
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
            alert(0);
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

    // $('#userAddressModal').modal('show');
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

$(document).on("click", ".edit_address", function (event) {
    const address_id = $(this).data('address_id');

    // Get details
    getDetails(
        "/api/user-address/" + address_id,
        (data) => {
            // Assuming that getDetails is an asynchronous function, you can add the event listener
            // after the data has been successfully fetched.
            document.getElementById('address_modal').addEventListener('click', function () {
                // Code to execute after the click event
                setEditData(data.results);

                setTimeout(function () {
                    $('.country_id').val(data.results.country_id);
                    $('.country_id').trigger('change');
                }, 1000);

                setTimeout(function () {
                    $('#division_id').val(data.results.division_id);
                    $('#division_id').trigger('change');
                }, 1500);

                setTimeout(function () {
                    $('#district_id').val(data.results.district_id);
                    $('#district_id').trigger('change');
                }, 2000);

                setTimeout(function () {
                    $('#upazila_id').val(data.results.upazila_id);
                    $('#upazila_id').trigger('change');
                }, 2500);

            });

            // Trigger the click event after adding the listener
            document.getElementById('address_modal').click();
        },
        (error) => {
            // Handle the error here
        }
    );

});
function setAddressData(data) {
    // Initialize an empty variable to store the card HTML
    let cardHTML = '';
    cardHTML += `
    <div class="col-md-3 mb-3">
    <div class="card text-center dashed-border-card address_modal" id="address_modal" data-toggle="modal"
        data-target="#userAddressModal">
        <div class="card-body">
            <i class="fas fa-plus-circle plus-icon"></i>
            <p class="card-text add-address-text">Add Address</p>
        </div>
    </div>
    </div>
`;
    // Loop through the dataArray
    data.forEach(data => {
        const address = data.is_default == 1 ? 'Default' : '';
        const set_as_default_address = data.is_default == 0 ? `<span class="mx-1">|</span><a href="javascript:void(0);" class="text-sm" id="set_as_default_address" data-address_id="${data.id}">Set As Default</a>` : '';
        const remove_address = data.is_default == 0 ? `<span class="mx-1">|</span><a href="javascript:void(0);" class="text-sm" id="remove_address" data-address_id="${data.id}">Remove</a>` : '';

        cardHTML += `
        <div class="col-md-3 mb-3">
        <div class="card bg-light mb-3">
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
                <a href="javascript:void(0);" id="instruction_modal" class="text-info mt-1 text-decoration-none" data-toggle="modal" data-id="${data.id}" data-target="#exampleModal">Add delivery instructions<a>
            </div>
            <div class="card-footer">
                <a href="javascript:void(0);" class="text-sm edit_address" id="edit_address" data-address_id="${data.id}">Edit</a>
                ${remove_address}
                ${set_as_default_address}
            </div>
        </div>
        </div>
    `;
    });
    cardHTML += ``;

    $("#address_content").html(cardHTML);
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
        upazila_id: $("#targeted_form #upazila_id").val(),
        street_address: $("#targeted_form #street_address").val(),
        building_name: $("#targeted_form #building_name").val(),
        nearest_landmark: $("#targeted_form #nearest_landmark").val(),
        type: $("input[name='type']:checked").val(),
        is_default: 0
    };
    console.log(data);

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
            // $('#targeted_form')[0].reset();
        },
        (error) => {

        }
    );
}

function setUpazilaData(data) {
    const selectElement = document.getElementById('upazila_id');

    selectElement.innerHTML = '';

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.text = 'Select a Upazila';
    defaultOption.setAttribute('selected', 'selected');

    selectElement.appendChild(defaultOption);

    data.forEach((item) => {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = item.name;

        selectElement.appendChild(option);
    });
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



