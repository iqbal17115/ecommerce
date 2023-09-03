$(document).ready(function () {
    $('#orderPackageSubmit').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
        var url = form.attr('action');

        var boxDetails = [];

        // Collect box details for each box
        var boxes = document.querySelectorAll('.box');

        boxes.forEach(function(box) {
            var boxNumber = box.getAttribute('data-box-number');
            var packageWeight = box.querySelector('input[name="package_weight[]"]').value;
            var weightUnit = box.querySelector('select[name="weight_unit[]"]').value;
            var packageLength = box.querySelector('input[name="length[]"]').value;
            var lengthUnit = box.querySelector('select[name="length_unit[]"]').value;
            var packageHeight = box.querySelector('input[name="height[]"]').value;
            var heightUnit = box.querySelector('select[name="height_unit[]"]').value;

            var boxProducts = [];

            var products = box.querySelectorAll('input[name="product_id[]"]');

            products.forEach(function(product) {
                var productId = product.value;
                var productName = product.getAttribute('data-product-name');
                var productExpectedQty = product.nextElementSibling.value;

                var productInfo = {
                    id: productId,
                    name: productName,
                    expected_qty: productExpectedQty
                };

                boxProducts.push(productInfo);
            });

            var boxInfo = {
                box_number: boxNumber,
                package_weight: packageWeight,
                weight_unit: weightUnit,
                package_length: packageLength,
                length_unit: lengthUnit,
                package_height: packageHeight,
                height_unit: heightUnit,
                products: boxProducts
            };

            boxDetails.push(boxInfo);
        });

        // Convert the box details to JSON format
        var boxDetailsJson = JSON.stringify(boxDetails);

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(), // Serialize the form data
            success: function (response) {
                console.log(response);
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

    cancelForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const selectedReason = document.getElementById("cancelReasonInput").value;
        if (selectedReason) {
            // Here you can perform further actions, like submitting the reason to the server
            console.log("Selected Reason:", selectedReason);
            // Close the modal
            cancelModal.style.display = "none";
        } else {
            alert("Please select a cancellation reason.");
        }
    });
});
