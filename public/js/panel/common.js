function disableSubmitButton() {
    $("#submit_button").prop("disabled", true);
}

function enableSubmitButton() {
    $("#submit_button").prop("disabled", false);
}
/**
 * Form Request
 */
function formRequest(url, method, data) {
    return $.ajax({
        url: url,
        type: method,
        contentType: 'application/json',
        data: JSON.stringify(data),
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
}

/**
 * Request Params Url
 */
function requestParamsUrl(url, method = "GET", config = {}) {
    return $.ajax({
        type: method,
        url: url,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            ...(config && config?.headers ? config.headers : {}),
        },
    });
}

/**
 * Confirm Action
 */
function confirmAction(title, content, confirmCallback = {}, cancelCallback = {}) {
    $.confirm({
        title: title,
        content: content,
        buttons: {
            confirm: function () {
                if (typeof confirmCallback === "function") confirmCallback();
            },
            cancel: function () {
                if (typeof cancelCallback === "function") cancelCallback();
            },
        },
    });
}


/**
 * Toastr Success Message
 */
function toastrSuccessMessage(message) {
    toastr.success(message, {timeOut: 1000});
}

/**
 * Toastr Error Message
 */
function toastrErrorMessage(message) {
    toastr.error(message, {timeOut: 1000});
}

//Redirect Url
function redirectUrl(url) {
    setTimeout(function () {
        window.location.href = url;
    }, 1000);
}


// Function to generate pagination HTML
function generatePagination(total, perPage, currentPage) {
    const totalPages = Math.ceil(total / perPage);
    let paginationHtml = '';

    if (totalPages > 1) {
        paginationHtml += '<ul class="pagination">';
        for (let i = 1; i <= totalPages; i++) {
            const activeClass = i == currentPage ? 'active' : '';
            paginationHtml += `<li class="page-item ${activeClass}"><a class="page-link pagination-link" href="#" data-page="${i}">${i}</a></li>`;
        }
        paginationHtml += '</ul>';
    }

    return paginationHtml;
}

let profileContainer = document.querySelector('.profile-container');

profileContainer.addEventListener('mouseover', function () {
    let menu = document.querySelector('.profile_menu');
    menu.classList.add('active');
});

profileContainer.addEventListener('mouseout', function (e) {
    let menu = document.querySelector('.profile_menu');
    // Check if the mouse is not over the menu itself before removing the 'active' class
    if (!menu.contains(e.relatedTarget)) {
        menu.classList.remove('active');
    }
});



