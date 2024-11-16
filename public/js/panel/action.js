/**
 * Function to fetch details using AJAX request
 */
function getDetails(route, successCallback, errorCallback) {
    requestParamsUrl(route)
        .done(function (data) {
            // Check if successCallback is defined and a function
            if (successCallback && typeof successCallback === 'function') {
                // Invoke the successCallback function with the results
                successCallback(data);
            }
        })
        .fail(function (error) {
            // Check if errorCallback is defined and a function
            if (errorCallback && typeof errorCallback === 'function') {
                // Invoke the errorCallback function with the error
                errorCallback(error);
            }
        });
}

/**
 * Save Action
 */
function saveAction(action, route, formData, id = "", successCallback, errorCallback) {
    // Set the URL based on the action and page
    let url = (action === "update") ? route + "/" + id : route;

    // Determine the HTTP method based on the action
    let method = (action === "update") ? "PUT" : "POST";

    // Make the request with the appropriate HTTP method
    formRequest(url, method, formData)
        .done(function (data) {
            // Check if successCallback is defined and a function
            if (successCallback && typeof successCallback === 'function') {
                // Invoke the successCallback function with the results
                successCallback(data);
            }
        })
        .fail(function (error) {
            // Check if errorCallback is defined and a function
            if (errorCallback && typeof errorCallback === 'function') {
                // Invoke the errorCallback function with the error
                errorCallback(error);
            }
        })
}

/**
 * Delete Action
 */
function deleteAction(route, successCallback, errorCallback, title = "Delete", text = "Are you sure you want to delete this record?") {
    confirmAction(title, text, () => {
        // Make a DELETE request
        requestParamsUrl(route, "DELETE")
            .done(function (data) {
                // Check if successCallback is defined and a function
                if (successCallback && typeof successCallback === 'function') {
                    // Invoke the successCallback function with the results
                    successCallback(data);
                }
            })
            .fail(function (error) {
                // Check if errorCallback is defined and a function
                if (errorCallback && typeof errorCallback === 'function') {
                    // Invoke the errorCallback function with the error
                    errorCallback(error);
                }
            });
    });
}
