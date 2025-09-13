$(document).ready(function () {
    // Show edit form
    $('#edit-address-btn').click(function () {
        $('#address-view').hide();
        $('#address-edit').show();
    });

    // Cancel edit
    $('#cancel-address-btn').click(function () {
        $('#address-edit').hide();
        $('#address-view').show();
    });

    // Save
    $('#save-address-btn').click(function () {
        let formData = {
            street: $('#street_address_input').val(),
            district: $('#district_input').val(),
            name: $('#user_name_input').val(),
            mobile: $('#mobile_input').val(),
            optional_mobile: $('#optional_mobile_input').val()
        };
console.log(formData);
        let orderId = $('#orderId').val();

        saveAction(
            "update",
            "/orders/edit-address",  // route without ID
            formData,
            orderId,
            function (response) {
                toastr.success(response.message);

                // Update display
                $('#street_address_display').text(formData.street);
                $('#district_display').text(formData.district);
                $('#user_name_display').text(formData.name + (formData.mobile ? ', ' + formData.mobile : '') + (formData.optional_mobile ? ', ' + formData.optional_mobile : ''));

                // Toggle back to view
                $('#address-edit').hide();
                $('#address-view').show();
            },
            function (error) {
                toastr.error(error.responseJSON?.message || 'Something went wrong');
            }
        );
    });
});
