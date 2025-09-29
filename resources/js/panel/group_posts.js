$(document).on("click", ".add-new", function () {
    $("#targetedModal .modal-body #description").summernote('code', '');
});

// Remove option on "Remove" button click
$(document).on("click", ".group-post-status", function () {
    group_post_id = $(this).data('group_post_id');
    group_post_status = $(this).data('group_post_status');
    
    // Reject group post
    const post = {
        status: group_post_status
    };

    changeGroupPostStatus(post, group_post_id);
});

function changeGroupPostStatus(formData, selectedId = "") {
    confirmAction('Update Status', 'Are you sure you want to update status?', () => {
        saveAction(
            'update',
            "/manage-group-posts/update-status",
            formData,
            selectedId,
            (data) => {
                toastrSuccessMessage(data.message);
                table.clear().draw();
            },
            (error) => {
                toastrErrorMessage(error.responseJSON.message);
            }
        );
    });
}

// Remove option on "Remove" button click
$(document).on("click", ".delete-group-post", function () {
    group_post = $(this).data('id');

    //Delete
    deleteAction(
        '/manage-group-posts/' + group_post,
        (data) => {
            table.clear().draw();
            // Success callback
            toastrSuccessMessage(data.message);
        },
        (error) => {
            // Error callback
            toastrErrorMessage(error.responseJSON.message);
        }
    );
});

$(document).on("click", ".edit-group-post", function () {
    const groupPostId = $(this).data("group_post_id");

    // Populate and show the modal with appropriate content
    groupPostModal(groupPostId);
});

// Function to populate the modal with content based on groupId
function groupPostModal(groupPostId) {
    getDetails(
        "/manage-group-posts/" + groupPostId,
        (data) => {
            $("#row_id").val(groupPostId);
            $("#targetedModal .modal-body #description").summernote('code', data.results.description);
            // Show the modal
            $("#targetedModal").modal("show");
        },
        (error) => {

        }
    );
}

function loadGroupPostsDataTable(group_id, status) {
    initializeDataTable(
        `/manage-group-posts/${group_id}/lists`,
        [
            generateColumn('description', limitDescription, 'description'),
            generateColumn('action', (data, type, row) => linkableActions(row.id, status), 'name'),
        ],
        function () {
            return {
                status: status
            };
        }
    );
}

function limitDescription(data, type, row) {
    if (typeof data === 'string' && data.length > 80) {
        return data.substring(0, 80) + '...';
    }
    return data;
}

function linkableActions(id, status) {
    let actions = '';

    if (status === 'approved') {
        actions += `
            <a class="group-post-status btn btn-sm btn-warning" data-group_post_id="${id}" data-group_post_status="rejected" data-coreui-toggle="modal" data-coreui-target="#exampleModalLive" title="Reject">Reject</a>
            <a class="edit-group-post btn btn-sm btn-info" data-group_post_id="${id}" data-coreui-toggle="modal" data-coreui-target="#exampleModalLive" title="Edit">Edit</a>
            <a class="delete-group-post btn btn-sm btn-danger" data-id="${id}" title="Delete">Delete</a>
        `;
    } else if (status === 'pending') {
        actions += `
            <a class="group-post-status btn btn-sm btn-success" data-group_post_id="${id}" data-group_post_status="approved" title="Approve">Approve</a>
            <a class="group-post-status btn btn-sm btn-warning" data-group_post_id="${id}" data-group_post_status="rejected" data-coreui-toggle="modal" data-coreui-target="#exampleModalLive" title="Reject">Reject</a>
            <a class="edit-group-post btn btn-sm btn-info" data-group_post_id="${id}" data-coreui-toggle="modal" data-coreui-target="#exampleModalLive" title="Edit">Edit</a>
            <a class="delete-group-post btn btn-sm btn-danger" data-id="${id}" title="Delete">Delete</a>
        `;
    } else if (status === 'rejected') {
        actions += `
            <a class="group-post-status btn btn-sm btn-success" data-group_post_id="${id}" data-group_post_status="approved" title="Approve">Approve</a>
            <a class="edit-group-post btn btn-sm btn-info" data-group_post_id="${id}" data-coreui-toggle="modal" data-coreui-target="#exampleModalLive" title="Edit">Edit</a>
            <a class="delete-group-post btn btn-sm btn-danger" data-id="${id}" title="Delete">Delete</a>
        `;
    }

    return actions;
}

$("#targeted_form").submit(function (event) {
    event.preventDefault();
    //get id
    const id = $("#targeted_form #row_id").val();

    // Load the selected details
    const data = {
        group_id: $("#targeted_form #group_id").val(),
        description: $("#targeted_form #description").val()
    };

    // Submit the form
    submitForm(data, id);
});



// Function to handle form submission
function submitForm(formData, selectedId = "") {
    saveAction(
        selectedId.trim() !== "" ? "update" : "store",
        "/manage-group-posts",
        formData,
        selectedId,
        (data) => {
            $('#targetedModal').modal('hide');
            toastrSuccessMessage(data.message);
            table.clear().draw();
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
}
