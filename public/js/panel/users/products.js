$(document).ready(function () {

    function updateBrowserUrl(page = 1, filters = {}, search = '') {
        const params = new URLSearchParams({ page });

        // Append filters[...] params
        for (const [key, value] of Object.entries(filters)) {
            if (value !== '' && value !== null && value !== undefined) {
                params.append(`filters[${key}]`, value);
            }
        }

        // Append search as top-level param
        if (search) params.append('search', search);

        const newUrl = `${window.location.pathname}?${params.toString()}`;
        history.pushState(null, '', newUrl);
    }

    function getQueryParams() {
        const params = new URLSearchParams(window.location.search);
        const filters = {};

        for (const [key, value] of params.entries()) {
            const match = key.match(/^filters\[(.+)\]$/);
            if (match) filters[match[1]] = value;
        }

        return filters;
    }

    function getSearchParam() {
        const params = new URLSearchParams(window.location.search);
        return params.get('search') || '';
    }

    const initialFilters = getQueryParams();
    const initialSearch = getSearchParam();
    const initialPage = new URLSearchParams(window.location.search).get('page') || 1;

    loadProducts(initialPage, initialFilters, initialSearch);

    function loadProducts(page = 1, filters = {}, search = '') {
        // Always use fresh filters object
        const currentFilters = {};

        // Limit
        currentFilters.limit = $('#data_limit').val() || filters.limit || '';

        // Price
        const minPrice = $('#min_price').val();
        const maxPrice = $('#max_price').val();
        if (minPrice) currentFilters.min_price = minPrice;
        if (maxPrice) currentFilters.max_price = maxPrice;

        // Copy other filters (if any)
        if (filters) {
            for (const [key, value] of Object.entries(filters)) {
                if (!(key in currentFilters)) currentFilters[key] = value;
            }
        }

        // Build URL for AJAX
        const params = new URLSearchParams({ page });
        for (const [key, value] of Object.entries(currentFilters)) {
            if (value !== '' && value !== null && value !== undefined) {
                params.append(`filters[${key}]`, value);
            }
        }
        if (search) params.append('search', search);

        const url = `/products?${params.toString()}`;
        console.log('Fetching:', url);

        getDetails(url, (response) => {
            renderProducts(response.results.data);
            renderSmartPagination(response.results, (nextPage) => {
                loadProducts(nextPage, currentFilters, search);
                updateBrowserUrl(nextPage, currentFilters, search);
            });
        }, (error) => console.error('Failed to load products', error));
    }

    function renderProducts(products) {
    const container = $('#product-container');
    container.empty();

    if (!products.length) {
        container.html('<p>No products found.</p>');
        return;
    }

    let html = '';

    products.forEach(product => {
        const productUrl = `/product-details/${product.name}`;
        html += `
            <div class="col-xl-3 col-lg-4 col-md-3 col-sm-4 col-6">
                <div class="product-default inner-quickview inner-icon" style="overflow:hidden;">
                    <figure>
                        <a href="${productUrl}">
                            <img class="lazy-load" data-src="${product.image_path}" width="239" height="239">
                        </a>
                        ${product.is_on_sale ? `<div class="label-group">
                            <span class="product-label label-sale">-${product.offer_percentage}%</span>
                        </div>` : ''}
                        <div class="btn-icon-group">
                            <a href="javascript:void(0);" data-product_id="${product.id}" class="btn-icon add_cart_item product-type-simple">
                                <i class="icon-shopping-cart"></i>
                            </a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <a href="javascript:void(0);" class="btn-icon-wish" data-product_id="${product.id}">
                                <i class="icon-heart"></i>
                            </a>
                        </div>
                        <h3 class="product-title">
                            <a href="${productUrl}">${product.name}</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:${product.rating * 20}%"></span>
                                <span class="tooltiptext tooltip-top">${product.rating} / 5</span>
                            </div>
                        </div>
                        <div class="price-box">
                            ${product.is_on_sale ? `<span class="old-price">${product.currency} ${product.your_price}</span>` : ''}
                            <span class="product-price">${product.currency} ${product.is_on_sale ? product.sale_price : product.your_price}</span>
                        </div>
                    </div>
                    ${product.stock_qty <= 0 ? `<a class="sold_out" style="color: #fff;">Sold out</a>` : ''}
                </div>
            </div>`;
    });

    container.append(html); // ✅ Append only once
    initLazyLoad(); // ✅ Then initialize lazy load once
}

    // 🔹 Apply price filter
    $('#apply_price_filter').on('click', function () {
        const minPrice = $('#min_price').val();
        const maxPrice = $('#max_price').val();

        if (minPrice && maxPrice && parseFloat(minPrice) > parseFloat(maxPrice)) {
            alert('Minimum price cannot be greater than maximum price.');
            return;
        }

        const search = getSearchParam();

        const filters = {};
        if (minPrice) filters.min_price = minPrice;
        if (maxPrice) filters.max_price = maxPrice;
        filters.limit = $('#data_limit').val() || '';

        loadProducts(1, filters, search);
        updateBrowserUrl(1, filters, search);
    });

    // 🔹 Change limit
    $('#data_limit').on('change', function () {
        const search = getSearchParam();
        const filters = getQueryParams();
        loadProducts(1, filters, search);
        updateBrowserUrl(1, filters, search);
    });

});
