const fileInput = document.getElementById("file-upload");
const currentCoverPhoto = document.getElementById("current-cover-photo");
const saveButton = document.getElementById("upload-cover-photo-btn");
const cancelButton = document.getElementById("cancel-button");
const editProfile = document.getElementById("edit-profile");
const editLabel = document.getElementById("edit-label");
let groupCoverPhoto = "";

editLabel.style.cursor = "pointer"; // Set cursor style explicitly

fileInput.addEventListener("change", function () {
    const img = fileInput.files[0];
    let reader = new FileReader();

    reader.onloadend = function () {
        currentCoverPhoto.src = reader.result;
        groupCoverPhoto = reader.result;

        // Show the "Save" button
        saveButton.style.display = "block";
        cancelButton.style.display = "block";
        editProfile.style.display = "none";
    }

    reader.readAsDataURL(img);
});

$(document).on("click", "#upload-cover-photo-btn", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    const formData = new FormData();
    formData.append('cover_photo', groupCoverPhoto);

    saveAction(
        'update',
        "/upload-group-cover-photo",
        formData,
        $('#group_id').val(),
        (data) => {
            saveButton.style.display = "none";
            cancelButton.style.display = "none";
            editProfile.style.display = "block";
            toastrSuccessMessage('Change Cover Photo Successfully!');
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );

});

$(document).ready(function () {
    $('#cancel-button').click(function () {
        currentCoverPhoto.src = 'http://alumni.tyrosolution.com/default_img/cover_photo.png';
        saveButton.style.display = "none";
        cancelButton.style.display = "none";
        editProfile.style.display = "block";
    });
});
