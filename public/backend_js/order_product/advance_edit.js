$(document).ready(function () {
    // Order Status Save
    $('#orderStatusSubmit').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(), // Serialize the form data
            success: function (response) {
                var status = response.data.status;
                var created_at = response.data.created_at;

                var listOrderTracking = $("<li class='list-group-item d-flex justify-content-between align-items-center'></li>");

                // Set the content of the list item
                listOrderTracking.html(status + '<span class="badge badge-primary badge-pill">' + created_at + '</span>');

                // Append the new list item to the list group
                $("#list-group-order-tracking").append(listOrderTracking);
                $("#order_status").val('');

                Swal.fire({
                    position: "top-end",
                    type: "success",
                    title: response.message,
                    showConfirmButton: !1,
                    timer: 1500
                });
            },
            error: function (xhr, status, error) {
                // Handle error, e.g., show an error message
                alert('An error occurred');
            }
        });
    });

    $('#orderPackageSubmit').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(), // Serialize the form data
            success: function (response) {
                Swal.fire({
                    position: "top-end",
                    type: "success",
                    title: "Package Info Saved!!",
                    showConfirmButton: !1,
                    timer: 1500
                });



                var anchorElement = document.getElementById('print_package_barcode');
                if (anchorElement) {
                    var href = anchorElement.getAttribute('href');

                    window.location.href = href;
                }
                // Get the anchor element by its ID
                var anchorElement = document.getElementById('myAnchor');

                if (anchorElement) {
                    // Get the href attribute
                    var href = anchorElement.getAttribute('href');

                    // Navigate to the URL using window.location
                    window.location.href = href;
                }

            },
            error: function (xhr, status, error) {
                // Handle error, e.g., show an error message
                alert('An error occurred');
            }
        });
    });
    $('#orderPaymentSubmit').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(), // Serialize the form data
            success: function (response) {
                Swal.fire({
                    position: "top-end",
                    type: "success",
                    title: response.message,
                    showConfirmButton: !1,
                    timer: 1500
                });
            },
            error: function (xhr, status, error) {
                // Handle error, e.g., show an error message
                alert('An error occurred');
            }
        });
    });

    $('#orderPaymentStatusSubmit').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(), // Serialize the form data
            success: function (response) {
                Swal.fire({
                    position: "top-end",
                    type: "success",
                    title: response.message,
                    showConfirmButton: !1,
                    timer: 1500
                });
            },
            error: function (xhr, status, error) {
                // Handle error, e.g., show an error message
                alert('An error occurred');
            }
        });
    });

    $('#orderFulfilmentNoteSubmit').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(), // Serialize the form data
            success: function (response) {
                var note = response.data.note;
                var noteType = response.data.note_type;
                $("#fulfilment_note").val(null);
                $("#order_fulfilment_note_type").val("");
                // Create a new list item
                var listItem = $("<li class='list-group-item d-flex justify-content-between align-items-center'></li>");

                // Set the content of the list item
                listItem.html(note + '<span class="badge badge-primary badge-pill">' + noteType + '</span>');

                // Append the new list item to the list group
                $("#list-group-payment-order-fulfilment-note").append(listItem);
            },
            error: function (xhr, status, error) {
                // Handle error, e.g., show an error message
                alert('An error occurred');
            }
        });
    });

    $('#orderPaymentNoteSubmit').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(), // Serialize the form data
            success: function (response) {
                var note = response.data.note;
                var noteType = response.data.note_type;
                $("#payment_note").val(null);
                $("#order_payment_note_type").val("");
                // Create a new list item
                var listItem = $("<li class='list-group-item d-flex justify-content-between align-items-center'></li>");

                // Set the content of the list item
                listItem.html(note + '<span class="badge badge-primary badge-pill">' + noteType + '</span>');

                // Append the new list item to the list group
                $("#list-group-payment-order-note").append(listItem);
            },
            error: function (xhr, status, error) {
                // Handle error, e.g., show an error message
                alert('An error occurred');
            }
        });
    });

    $('#orderNoteSubmit').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(), // Serialize the form data
            success: function (response) {
                var note = response.data.note;
                var noteType = response.data.note_type;
                $("#order_note").val(null);
                $("#order_note_type").val("");
                // Create a new list item
                var listItem = $("<li class='list-group-item d-flex justify-content-between align-items-center'></li>");

                // Set the content of the list item
                listItem.html(note + '<span class="badge badge-primary badge-pill">' + noteType + '</span>');

                // Append the new list item to the list group
                $("#list-group-order-note").append(listItem);
            },
            error: function (xhr, status, error) {
                // Handle error, e.g., show an error message
                alert('An error occurred');
            }
        });
    });

    $('#confirmOrderForm').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(), // Serialize the form data
            success: function (response) {
                $("#cancelOrderBtn").prop("disabled", false);
                $("#confirmOrderBtn").prop("disabled", true);
                $(".order_fulfilment_status").val(response.data.status);
                $(".order_fulfilment_status_show").text(response.data.status.charAt(0).toUpperCase() + response.data.status.slice(1).toLowerCase());
                Swal.fire({
                    position: "top-end",
                    type: "success",
                    title: response.message,
                    showConfirmButton: !1,
                    timer: 1500
                });
            },
            error: function (xhr, status, error) {
                // Handle error, e.g., show an error message
                alert('An error occurred');
            }
        });
    });

    $('#canceOrderlReason').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(), // Serialize the form data
            success: function (response) {
                $(".cancel-order").modal("hide");
                $("#cancelOrderBtn").prop("disabled", true);
                $("#confirmOrderBtn").prop("disabled", false);
                $(".order_fulfilment_status").val(response.data.status);
                $("#order_fulfilment_note").val(response.data.fulfilment_note);
                $(".order_fulfilment_status_show").text(response.data.status.charAt(0).toUpperCase() + response.data.status.slice(1).toLowerCase());
                Swal.fire({
                    position: "top-end",
                    type: "success",
                    title: response.message,
                    showConfirmButton: !1,
                    timer: 1500
                });
            },
            error: function (xhr, status, error) {
                // Handle error, e.g., show an error message
                alert('An error occurred');
            }
        });
    });
});
