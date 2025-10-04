$(document).ready(function () {
    $("#clear-cache-btn").on("click", function () {
        let $btn = $(this);

        $btn.prop("disabled", true).text("Clearing...");

        saveAction(
            "store",
            "/system-cache/clear",
            {},
            "",
            (data) => {
                toastrSuccessMessage(data.message);
            },
            (error) => {
                const response = JSON.parse(error.responseText);
                toastrErrorMessage(response.message);
            }
        );

        setTimeout(() => {
            $btn.prop("disabled", false).text("Clear & Warm Cache");
        }, 1000);
    });
});
