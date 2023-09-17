//Set the selected parent ID
function showGroupMember(group) {
    const groupMembersContainer = $('#group_profile_members');
    groupMembersContainer.empty(); // Clear any previous content
    $("#search_box").hide();
    if (!document.getElementById('search_input') && group.results.data.length > 10) {
        var inputTag = `
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-search-plus"></i></span>
                                            <input type="text" class="form-control" id="search_input" onkeyup="loadMembers()" placeholder="Search...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
        $("#search_box").html(inputTag);
        $("#search_box").show();
    }

    group.results.data.forEach(member => {
        const memberHtml = `
        <li class="list-group-item col-md-6">
            <div class="d-flex align-items-center">
                <div>
                    <a href="/profile/${member.user_id}" class="td profile-pic mr-3">
                        <img src="https://imagizer.imageshack.com/img923/2452/zifFKH.jpg" style="border-radius: 8px;" alt="${member.user_name}'s profile pic">
                    </a>
                </div>
                <div class="text-center">
                    <h5>
                        <a href="/profile/${member.user_id}" class="text-dark" style="font-size: 1.0625rem; font-weight: bold; padding-left: 20px;">${member.name}</a>
                    </h5>
                </div>
            </div>
        </li>
                            `;

        // Append the member HTML to the container
        groupMembersContainer.append(memberHtml);
    });
    // Clear previous content and append the group details HTML
}

//Load Details View
function loadGroupMembersView(group_id, page = 1) {
    const searchQuery = $("#search_input").val() ?? '';
    const queryParams = new URLSearchParams({
        page,
        search: searchQuery
    });
    const url = `/group-members/${group_id}/lists?${queryParams.toString()}`;

    getDetails(
        url,
        (data) => {
            showGroupMember(data);
        },
        (error) => {

        }
    );
}
