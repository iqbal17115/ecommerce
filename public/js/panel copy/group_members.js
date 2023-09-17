$('#join_request_status_form').submit(function (event) {
    event.preventDefault(); // Prevent default form submission

    var formData = $(this).serialize();
    var join_request_id = $("#join_request_id").val();
    $.ajax({
        type: 'PUT',
        url: '/manage-group-members/join-request//' + join_request_id,
        data: formData,
        dataType: 'json',
        success: function (response) {
            $('#joinRequestModal').modal('hide');
            location.reload();
        },
        error: function (error) {
            console.error('AJAX error:', error);
        }
    });
});

function getUserDetails(joinRequestId, joinRequestStatus, user_id) {

    getDetails(
        `/user-info/${user_id}`,
        (data) => {
            console.log(data.results);
            // Populate and show the modal with appropriate content
            populateJoinRequestModal(joinRequestId, joinRequestStatus, data.results);
        },
        (error) => {

        }
    );
}

$(document).on("click", ".join-request-manage", function () {
    const joinRequestId = $(this).data("join_request_id");
    const joinRequestStatus = $(this).data("join_request_status");
    const user_id = $(this).data("user_id");
    getUserDetails(joinRequestId, joinRequestStatus, user_id);
});

//Load Data Tables
function loadGroupMembersDataTable(group_id, status) {
    initializeDataTable(
        `/manage-group-members/${group_id}/lists`,
        [
            generateColumn('SL', (data, type, row, meta) => meta.row + 1, null),
            generateColumn('name', null, 'name'),
            generateColumn('email', null, 'email'),
            generateColumn('phone', null, 'phone'),
            generateColumn('status', null, 'status'),
            generateColumn('action', (data, type, row) => linkableActions(row.id, row.user_id, status), 'name'),
        ],
        function () {
            return {
                status: status
            };
        }
    );
}

//Generates linkable text for a department with an ID and text.
function linkableActions(id, user_id, status) {
    return `<button class="btn btn-sm btn-secondary join-request-manage" data-join_request_id="${id}" data-join_request_status="${status}" data-user_id="${user_id}" type="button" data-coreui-toggle="modal" data-coreui-target="#exampleModalLive">
                Change Status
           </button>
           <a class="btn btn-sm btn-info" href="/admin/member/${user_id}" title="View">View</a>
           `;
}

// Function to populate the modal with content based on joinRequestId
function populateJoinRequestModal(join_request_id, joinRequestStatus, data) {
    console.log(data);
    const modalBody = $("#joinRequestModal .modal-body");
    modalBody.empty(); // Clear existing content

    const typeHtml = `
    <div class="mb-2">
        <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                    <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <img id="imageContainer" class="card-img-top" src="" style="height: 100px;" alt="Card image cap">
                    </div>
                    <div class="col-md-4"></div>
                    </div>
                    <div class="card-body">
                    <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td>${data.name}</td>
                        <td>${data.email}</td>
                      </tr>
                      <tr>
                      <td>${data.phone ?? 'Phone number not given'}</td>
                        <td>
                            <select class="form-control form-control-sm" id="status" name="status" required>
                                <option value="approved">Approved</option>
                                <option value="pending">Pending</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                    </div>
                    </div>
                </div>
        </div>
    </div>
`;

    modalBody.append(typeHtml);
    $("#status").val(joinRequestStatus);
    $("#join_request_id").val(join_request_id);

    // Show the modal
    $("#joinRequestModal").modal("show");
    console.log(data.profile_photo);
    if(data.profile_photo) {
        url_path = '/storage/' + data.results.profile_photo;
     } else {
        url_path = '/default_img/user_photo.png';
     }
    $('#imageContainer').attr("src", url_path);
}
