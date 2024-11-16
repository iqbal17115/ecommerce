// Remove option on "Remove" button click
$(document).on("click", ".btn-group-post-delete", function () {
    group_post = $(this).data('group_post_id');
        //Delete
        deleteAction(
            '/group-post/' + group_post,
            (data) => {
                const group_id = $('#group_id').val();
                loadMyGroupFeedsView(group_id);
                toastrSuccessMessage('Post deleted successfully!');
            },
            (error) => {
                // Error callback
                toastrErrorMessage(error.responseJSON.message);
            }
        );

});

$('#group_post_form').submit(function (event) {
    event.preventDefault(); // Prevent default form submission
    var group_post_id = $('#group_post_id').val();

    $.ajax({
        type: 'PUT',
        url: '/group-post/' + group_post_id,
        data: $(this).serialize(),
        success: function (response) {
            console.log(response);
            $('#postModal').modal('hide');
            const group_id = $('#group_id').val();
            loadMyGroupFeedsView(group_id);
            toastrSuccessMessage('Post edited successfully!');
        },
        error: function (error) {
            console.error(error);
        }
    });
});

// Click for "edit"
$(document).on('click', '.btn-group-post-edit', function () {
    const groupPostId = $(this).data('group_post_id');
    
    getDetails(
        "/group-posts/" + groupPostId,
        (data) => {
            const modalBody = $("#editGroupPostModal .modal-body");

            $("#group_post_id").val(groupPostId);
            $("#postModal .modal-body #description").summernote('code', data.results.description);
            // Show the modal
            $("#postModal").modal("show");
        },
        (error) => {

        }
    );

});

//Set the selected parent ID
function showMyGroupFeedDetail(group) {
    const postsContainer = $('#post_container');
    postsContainer.empty(); // Clear any previous content
    
    if (!document.getElementById('search_input') && group.results.data.length > 10) {
        var inputTag = `
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search-plus"></i></span>
                                        <input type="text" class="form-control" id="search_input" onkeyup="loadMyGroupFeeds()" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    `;
        $("#search_box").html(inputTag);
    }

    if (group.results.data.length == 0) {
        postsContainer.append('<div class="no-feed-message">No feed exists</div>');
    } else {
        group.results.data.forEach(post => {
            const postHtml = `
            <div class="post card rounded mb-2">
                <div class="tb">
                    <a href="#" class="td p-p-pic"><img src="https://imagizer.imageshack.com/img923/2452/zifFKH.jpg" alt="${post.user_name}'s profile pic"></a>
                    <div class="td p-r-hdr">
                        <div class="p-u-info">
                            <a href="#">${post.user_name}</a>
                        </div>
                        <div class="p-dt">
                            <span>${post.created_at}</span>
                        </div>
                    </div>
                    <div class="td p-opt">
                    <div style="display: flex;">
                    <span class="btn-group-post-edit" data-group_post_id="${post.id}">
                        <i class="fas fa-edit text-info"></i>
                    </span> &nbsp;
                    <span class="btn-group-post-delete" data-group_post_id="${post.id}">
                        <i class="fas fa-trash-alt text-danger"></i>
                    </span>
                </div>
                    </div>
                </div>
                <div class="card-body">
                <p class="card-text">${post.description}</p>
            </div>
                </div>
            `;
            // Append the post HTML to the container
            postsContainer.append(postHtml);
        });
    }
}

//Load Details View
function loadMyGroupFeedsView(group_id) {
    var search_value = $("#search_input").val() ?? '';

    getDetails(
        "/my-group-feeds/" + group_id + "/lists?page=1&search=" + search_value,
        (data) => {
            showMyGroupFeedDetail(data);
        },
        (error) => {

        }
    );
}