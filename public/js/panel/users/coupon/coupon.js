// Function to handle form submission
function submitForm(formData, selectedId = "") {
    saveAction(
        "store",
        "/api/coupon-apply",
        formData,
        selectedId,
        (data) => {
            $('#apply_coupon')[0].reset();
            if(data.message == "Coupon applied successfully") {
                toastrSuccessMessage(data.message);
            } else {
                toastrErrorMessage(data.message);
            }
        },
        (error) => {

        }
    );
}

$(document).ready(function () {
    $("#apply_coupon").submit(function (event) {
        event.preventDefault();

        const formData = {
            user_id: $("#temp_user_id").data('user_id'),
            coupon_code: $("#coupon_code").val()
        };

        submitForm(formData, '');
    });
});
