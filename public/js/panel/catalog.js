/**
 * Export Facebook Catalog
 */
function exportFacebookCatalog(successCallback, errorCallback) {
    saveAction(
        "create",                               // action
        "/export/facebook-catalog",             // route
        {},                                     // no formData
        "",                                     // no id
        (data) => {                             // success
            if (data.success && data.url) {
                // Trigger download
                let link = document.createElement('a');
                link.href = data.url;
                link.download = "facebook_catalog.csv";
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                if (successCallback && typeof successCallback === "function") {
                    successCallback(data);
                }
            }
        },
        (error) => {                            // error
            if (errorCallback && typeof errorCallback === "function") {
                errorCallback(error);
            }
        }
    );
}
