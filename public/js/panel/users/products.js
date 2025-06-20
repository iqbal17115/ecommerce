$(document).ready(function () {
    loadProducts();

    function loadProducts(page = 1, filters = {}) {
        const url = `/products?page=${page}`;

        getDetails(
            url,
            (response) => {
                console.log(response.results);
                renderProducts(response.results.data);
                renderSmartPagination(response.results, loadProducts); // ✅ Call reusable pagination
            },
            (error) => {
                console.error("Failed to load products", error);
            }
        );
    }

    function renderProducts(products) {
        const container = $('#product-container');
        container.empty();

        if (products.length === 0) {
            container.html('<p>No products found.</p>');
            return;
        }

        products.forEach(product => {
            const productUrl = `/product/${product.id}`; // Adjust based on your route

            const html = `
            <div class="col-xl-3 col-lg-4 col-md-3 col-sm-4 col-6">
                <div class="product-default inner-quickview inner-icon" style="overflow:hidden;">
                    <figure>
                        <a href="${productUrl}">
                            <img class="lazy-load" data-src="${product.image_path}" width="239" height="239"">
                        </a>
                        ${product.is_on_sale ? `
                        <div class="label-group">
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
                            ${product.is_on_sale ? `
                                <span class="old-price">${product.currency} ${product.your_price}</span>` : ''}
                            <span class="product-price">${product.currency} ${product.is_on_sale ? product.sale_price : product.your_price}</span>
                        </div>
                    </div>
                    ${product.stock_qty <= 0 ? `<a class="sold_out" style="color: #fff;">Sold out</a>` : ''}
                </div>
            </div>
        `;

            container.append(html);

            // ✅ Call this again to re-register new images
            initLazyLoad();
        });
    }

    function setupPagination(data) {
        // Setup pagination controls if needed using data.current_page, data.last_page
    }

    // Optional: handle filter/search etc.
});
