function setAddressData(data) {
    // Initialize an empty variable to store the card HTML
    let cardHTML = '';
    cardHTML += `
    <div class="col-md-3 mb-3">
    <div class="card text-center dashed-border-card address_modal" data-toggle="modal"
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
        const address = data.is_default == 1 ? 'Default Address' : 'Address';
        cardHTML += `
        <div class="col-md-3 mb-3">
        <div class="card bg-light mb-3">
            <div class="card-header">${address}</div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="card-text">${data.street_address}</div>
                <div class="card-text">${data.building_name}</div>
                <div class="card-text">${data.nearest_landmark}</div>
                <div class="card-text">${data.district}, ${data.division}</div>
                <div class="card-text">${data.country}</div>
                <div class="card-text">Phone Number: ${data.mobile}</div>
                <div class="card-text">Phone Number(Option): ${data.optional_mobile}</div>
                <a href="" class="text-info mt-1 text-decoration-none">Add delivery instructions<a>
            </div>
            <div class="card-footer">
                <a class="text-sm">Edit</a>
                <span class="mx-1">|</span>
                <a class="text-sm">Remove</a>
                <span class="mx-1">|</span>
                <a class="text-sm">Set As Default</a>
            </div>
        </div>
        </div>
    `;
    });
    cardHTML += ``;
    console.log(cardHTML);

    $("#address_content").html(cardHTML);
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
// Attach event listener for form submission
$("#targeted_form").submit(function (event) {
    event.preventDefault();
    //get id
    const id = $("#targeted_form #row_id").val();

    // Load the selected details and submit the form
    const data = {
        user_id: $("#targeted_form #user_id").val(),
        country_id: $("#targeted_form #country_id").val(),
        mobile: $("#targeted_form #mobile").val(),
        optional_mobile: $("#targeted_form #optional_mobile").val(),
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
            window.location.reload();
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

$(document).on("change", "#division_id", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately
    const division_id = $("#division_id").val();
    // Get details
    getDetails(
        "/api/districts/lists?division_id=" + division_id,
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
        "/api/divisions/lists?country_id=" + country_id,
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
        "/api/countries/lists",
        (data) => {
            setCountryData(data.results.data);
        },
        (error) => {

        }
    );
});
