/**
 * Declare the DataTable instance outside the function for accessibility
 */
let table;
let filters = {};
let searchTimeout;

/**
 * Performs a search on the DataTable.
 *
 * @param {string} keyword - The search keyword.
 */
function datatableSearch(keyword) {
    table.search(keyword).draw();
}

/**
 * Clear search button click event handler with debouncing
 */
function searchingClearButton() {
    if ($('.datatable_search').val() != "") {
        $('.datatable_search').val('');
        datatableSearch('');
    }
}

/**
 * Search button click event handler
 */
function searchingButton() {
    datatableSearch($('.datatable_search').val());
}

/**
 * Initializes a DataTable with search functionality.

 * @param dataTableId
 * @param ajaxUrl
 * @param getFilters
 * @param columns
 * @param searchInputSelector
 * @returns {{filterDrawerClose: filterDrawerClose, datatableSearch: datatableSearch, reloadDataTable: reloadDataTable, table}}
 */
function initializeDataTable(
    ajaxUrl,
    columns,
    getFilters = {},
    className = '.custome-table-style',
    searchInputSelector = '.datatable_search',
) {
    /**
     * Get initial filters using the provided getFilters function
     */
    function updateFilters() {
        filters = typeof getFilters === 'function' ? getFilters() : getFilters;
    }

    /**
     * Reloads the DataTable data from the server with updated filters.
     */
    function reloadDataTable() {
        filters = getFilters();
        table.ajax.reload();
    }

    /**
     * Datatable initialize
     */
    var rowHeight = 0;
    function initializeTable() {
        if (table) {
            table.destroy(); // Destroy the DataTable instance if it exists
        }

        table = $(className).DataTable({
            autoWidth: false,
            processing: true,
            searching: true,
            fixedHeader: true,
            scrollX: true,
            deferRender: true,
            scrollY: 200,
            scrollCollapse: true,
            bDestroy: true,
            scroller: {
                displayBuffer: 3, // Increase the display buffer value as per your requirement
                boundaryScale: 0.90
            },
            serverSide: true, // Enable server-side processing
            buttons: [
                {extend: 'colvis', text: "Select Columns", className: 'btn btn-default'}
            ],
            dom: 'lfrt<"table-footer-section d-flex justify-content-between align-items-center"iB>',
            ajax: {
                url: ajaxUrl,
                data: function (data) {
                    // Modify the payload to include the necessary parameters for server-side pagination
                    data.start = data.start || 0; // Offset value
                    data.length = data.length || 40; // Number of records per page
                    data.filters = filters;
                    // Add additional parameters if required
                },
                dataSrc: function (response) {
                    // Process the response as needed
                    // You can access the total number of records using response.recordsTotal
                    // You can access the data array using response.data
                    return response.data;
                }
            },
            // order: [],
            columns: columns,
            initComplete: function () {
                this.api().row(1000).scrollTo();
                rowHeight = Number($(".dataTables_scrollBody .table tbody tr").height());

                var scrollableDiv = $('.dataTables_scrollBody');
                scrollableDiv.on('scroll', function () {
                    var info = table.page.info();
                    var start = Number(info.start) + 1;
                    var recordsTotal = info.recordsTotal;

                    var visibleHeight = Number($(this).height());
                    var visibleRows = Math.floor(visibleHeight / rowHeight);
                    var scrollPosition = $(this).scrollTop();
                    if (scrollPosition === 0) {
                        $(".dataTables_info").html(`Showing ${start} to ${visibleRows} of ${recordsTotal} entries`)
                    }
                });
            },
        });

        // Event listener for ColVis event
        table.on('column-visibility.dt', function (e, settings, column, state) {
            table.columns.adjust().draw(false);
        });
    }


    /**
     * Attach Event Handlers
     */

    var openFilterButton = document.querySelector(".trigger_filter_btn");
    var closeFilterButton = document.querySelector(".filter-close");
    var submitFilterForm = document.querySelector(".filter_click_btn");

    function attachEventHandlers() {
        /**
         * Search input keyup event handler with debouncing
         */
        $(document).on("keyup", searchInputSelector, debounce(function (event) {
            event.preventDefault();

            clearTimeout(searchTimeout); // Clear any existing timeout

            searchTimeout = setTimeout(function () {
                if (event.which !== 13) {
                    datatableSearch($(searchInputSelector).val());
                }
            }, 500); // Set a timeout of 500 milliseconds
        }));


        /**
         * Filter Drawer open Event
         */
        if (openFilterButton) {
            openFilterButton.addEventListener("click", function (event) {
                event.preventDefault();
                filterDrawerClose();
            });
        }

        /**
         * Filter Drawer Close Event
         */
        if (closeFilterButton) {
            closeFilterButton.addEventListener("click", function (event) {
                event.preventDefault();
                filterDrawerClose();
            });
        }


        /**
         * Filter form submit Event
         */
        if (submitFilterForm) {
            submitFilterForm.addEventListener("click", function (event) {
                event.preventDefault();
                reloadDataTable();
                filterDrawerClose();
            })
        }
    }

    /**
     * Filter Drawer Close
     */
    function filterDrawerClose() {
        $("#advance_filter_drawer").toggleClass('appeared').animate(1000);
        setTimeout(function () {
            $("#advance_filter_drawer").toggleClass('drawerFadeIn');
        }, 500);
    }

    /**
     * Initialize
     */
    function initialize() {
        updateFilters();
        initializeTable();
        attachEventHandlers();
    }

    initialize();

    return {
        table: table,
        datatableSearch: datatableSearch,
        reloadDataTable: reloadDataTable,
        filterDrawerClose: filterDrawerClose
    };
}

/**
 * Generate Columns
 *
 * @param dataField
 * @param renderFunction
 * @param name
 * @param sortable
 * @returns {{data, name, sortable: boolean, render}}
 */
function generateColumn(dataField, renderFunction, name, sortable = true) {
    return {data: dataField, render: renderFunction, name: name, sortable: sortable};
}

$(document).on("click", '.dt-button-collection .buttons-columnVisibility:not(.disabled)', function(){
    // return false;
    var activeItems = $(this).parent('.dropdown-menu').find('.buttons-columnVisibility.active').length;
    if(activeItems === 1){
        $('.dropdown-menu').find('.active').addClass('disabled');
    }else if(activeItems > 1){
        $('.dropdown-menu').find('.active').removeClass('disabled');
    }
});

$('.dataTables_scrollBody').on('scroll', function(e) {
    var pagingString = $(".dataTables_info").text();
    var test = pagingString.split(' ');
    var currentData = Number(test[1]);
    if (currentData === 0) {
        table.settings()[0].oFeatures.bProcessing = false;
        table.draw(false);
    }

    e.preventDefault();
    e.stopPropagation();
});

/**
 * Debounce
 *
 * @param {*} func
 * @param {*} wait
 * @param {*} immediate
 * @returns
 */
function debounce(func, wait, immediate) {
    var timeout;

    return function executedFunction() {
        var context = this;
        var args = arguments;

        var later = function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };

        var callNow = immediate && !timeout;

        clearTimeout(timeout);

        timeout = setTimeout(later, wait);

        if (callNow) func.apply(context, args);
    };
}
