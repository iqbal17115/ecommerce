<script type="text/javascript">
// Start Keyword Save
$(document).on('submit', '#keyword_save', function(e) {
    e.preventDefault();
    var form = this;
    $.ajax({
        url: "{{route('add.key_word')}}",
        method: 'post',
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        success: function(data) {
            console.log(data);
            if (data.status == 201) {
                Command: toastr["success"]("Keyword Saved Successfully",
                    "Success")
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        },
    });
});
// End Keyword Save


// Start Description Save
$(document).on('submit', '#description_save', function(e) {
    e.preventDefault();
    var form = this;
    $.ajax({
        url: "{{route('add.description')}}",
        method: 'post',
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        success: function(data) {
            console.log(data);
            if (data.status == 201) {
                Command: toastr["success"]("Description Saved Successfully",
                    "Success")
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        },
    });
});
// End Description Save



// Start Shipping & Delivery
$(document).on('submit', '#add_shipping_delivery', function(e) {
    e.preventDefault();
    var form = this;
    $.ajax({
        url: "{{route('add.shipping_and_delivery')}}",
        method: 'post',
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        success: function(data) {
            console.log(data);
            if (data.status == 201) {
                Command: toastr["success"]("Shipping & Delivery Saved Successfully",
                    "Success")
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        },
    });
});
// End Shipping & Delivery

// Start Status
$(document).on('submit', '#add_status', function(e) {
    e.preventDefault();
    var form = this;
    $.ajax({
        url: "{{route('add.status')}}",
        method: 'post',
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        success: function(data) {
            console.log(data);
            if (data.status == 201) {
                Command: toastr["success"]("Status Saved Successfully",
                    "Success")
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        },
    });
});
// End Status
// Start Return policy
$(document).on('submit', '#add_return_policy', function(e) {
    e.preventDefault();
    var form = this;
    $.ajax({
        url: "{{route('add.return_policy')}}",
        method: 'post',
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        success: function(data) {
            console.log(data);
            if (data.status == 201) {
                Command: toastr["success"]("Return Policy Saved Successfully",
                    "Success")
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        },
    });
});
// End Return policy
// Start Privacy policy
$(document).on('submit', '#add_privacy_policy', function(e) {
    e.preventDefault();
    var form = this;
    $.ajax({
        url: "{{route('add.privacy_policy')}}",
        method: 'post',
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        success: function(data) {
            console.log(data);
            if (data.status == 201) {
                Command: toastr["success"]("Privacy Policy Saved Successfully",
                    "Success")
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        },
    });
});
// End Privacy policy
// Start Terms & Condition
$(document).on('submit', '#add_term_condition', function(e) {
    e.preventDefault();
    var form = this;
    $.ajax({
        url: "{{route('add.terms_condition')}}",
        method: 'post',
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        success: function(data) {
            console.log(data);
            if (data.status == 201) {
                Command: toastr["success"]("Terms & Condition Saved Successfully",
                    "Success")
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        },
    });
});
// End Terms & Condition
// Start About us
$(document).on('submit', '#add_about_us', function(e) {
    e.preventDefault();
    var form = this;
    $.ajax({
        url: "{{route('add.about_us')}}",
        method: 'post',
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        success: function(data) {
            console.log(data);
            if (data.status == 201) {
                Command: toastr["success"]("About Us Saved Successfully",
                    "Success")
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        },
    });
});
// End About us
// Start Link
$(document).on('submit', '#add_link', function(e) {
    e.preventDefault();
    var form = this;
    $.ajax({
        url: "{{route('add.add_link')}}",
        method: 'post',
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        success: function(data) {
            console.log(data);
            if (data.status == 201) {
                Command: toastr["success"]("Link Saved Successfully",
                    "Success")
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        },
    });
});
// End Link

// Start Company Vital Info
$(document).on('submit', '#company_vital_info', function(e) {
    e.preventDefault();
    var form = this;
    $.ajax({
        url: "{{route('add.company_vital_info')}}",
        method: 'post',
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        success: function(data) {
            console.log(data);
            if (data.status == 201) {
                Command: toastr["success"]("Info Saved Successfully",
                    "Success")
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        },
    });
});
// End Company Vital Info
</script>
