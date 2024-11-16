function initialSelect2(select_table, placeholder) {
    $(`.selectpicker[data-table="${select_table}"]`).select2({
        dropdownParent: $("#parent_" + select_table),
        placeholder: placeholder
    });
}

/**
 * Reusable function to handle appending select2 options if an object exists
 *
 * @param selector
 * @param object
 */
function appendSelect2Option(selector, object) {
    // Clear previous options
    $(selector).empty();
    console.log(selector, object);

    if (object != null && object.id != null) {
        select2InitSelection(selector, object.name, object.id);
    }
}

/**
 * Select2 Initial Selection
 *
 * @param selector
 * @param value
 * @param key
 */
function select2InitSelection(selector, value, key) {
    // Create a DOM Option and pre-select by default~
    let newOption = new Option(value, key, true, true);
    // Append it to the select

    // $(selector).select2('destroy');
    $(selector).append(newOption).trigger('change.select2');
}

/**
 * Select 2 Initialize
 *
 * @param route
 * @param data_table
 */
function select2Initialize(route, select_table, placeholder = "Please select", isTag= false) {
    // Select the elements with the class "selectpicker" and the specified data-table attribute

    $(`.selectpicker[data-table="${select_table}"]`).select2({
        dropdownParent: $("#parent_" + select_table),
        placeholder: placeholder,
        allowClear: true,
        tags: isTag,
        width: '100%', // Add the width style here
        ajax: {
            url: route, // Set the URL for the AJAX request
            delay: 250, // Delay in milliseconds before the AJAX request is sent
            dataType: 'json', // Expected data type for the response
            transport: function (params, success, failure) {
                let query = {
                    search: params.data.q || '', // Get the search query parameter or use an empty string
                    page: params.data.page || 1 // Get the page number or use 1 as the default value
                };

                // Perform an AJAX request to the specified URL with the query parameters
                $.ajax({
                    url: route,
                    data: query
                })
                    .done(function (data) {
                        // Extract the necessary information from the response data
                        let results = null;

                        if (data.results && data.results.data && data.results.data.length > 0) {
                            results = data.results.data.map(detail => ({
                                label: detail.id,
                                text: detail.name,
                                id: detail.id
                            }));
                        }

                        // Call the success callback with the formatted results and pagination information
                        success({
                            results: results,
                            pagination: {
                                more: data.results.next_page_url !== null // Check if there are more pages of data
                            }
                        });

                        // Increment the page number for the next request
                        params.data.page = params.data.page || 1;
                        params.data.page++;
                    })
                    .fail(failure); // Call the failure callback if the AJAX request fails
            }
        }
    });
}
