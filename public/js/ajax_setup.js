$(document).ajaxStart(function () {
    $('#loader-overlay').show();
});

$(document).ajaxStop(function () {
    $('#loader-overlay').hide();
});
