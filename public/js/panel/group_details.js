//Set the selected parent ID
function showGroupDetail(group) {
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
                                                <input type="text" class="form-control" id="search_input" onkeyup="loadPosts()" placeholder="Search...">
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>`;
                    $("#search_box").html(inputTag);
    }

    if (group.results.data.length == 0) {
        postsContainer.append('<div class="no-feed-message">No feed exists</div>');
    } else {
        group.results.data.forEach(post => {
            const postHtml = `
        <div class="post card rounded mb-2">
            <div class="tb">
                <a href="/admin/member/${post.user_id}" class="td p-p-pic"><img src="https://imagizer.imageshack.com/img923/2452/zifFKH.jpg" alt="${post.user_name}'s profile pic"></a>
                <div class="td p-r-hdr">
                    <div class="p-u-info">
                        <a href="/admin/member/${post.user_id}">${post.user_name}</a>
                    </div>
                    <div class="p-dt">
                        <span>${post.created_at}</span>
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
function loadGroupDetailsView(group_id) {
    var search_value = $("#search_input").val() ?? '';
    getDetails(
        "/group-posts/" + group_id + "/lists?page=1&search=" + search_value,
        (data) => {
            showGroupDetail(data);
        },
        (error) => {

        }
    );
}
