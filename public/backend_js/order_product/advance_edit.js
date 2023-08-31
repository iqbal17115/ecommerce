$(document).ready(function () {

        $('#canceOrderlReason').submit(function(event) {
            event.preventDefault(); // Prevent default form submission
            var form = $(this);
            var url = form.attr('action');
    
            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(), // Serialize the form data
                success: function(response) {
                    // Handle success, e.g., show a success message
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    // Handle error, e.g., show an error message
                    alert('An error occurred');
                }
            });
        });

    const cancelOrderBtn = document.getElementById("cancelOrderBtn");
    const cancelModal = document.getElementById("cancelModal");
    const cancelForm = document.getElementById("cancelForm");

    cancelOrderBtn.addEventListener("click", function () {
        cancelModal.style.display = "block";
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