const CartDrawer = (() => {
    const cartContainerId = 'cart_container';
    const cartCountClass = 'cart-count';
    let isLoaded = false; // To avoid multiple reloads if not necessary

    function load(forceReload = false) {
        if (isLoaded && !forceReload) return;

        getDetails(
            'cart-drawer/list',
            (data) => {
                renderCart(data.results);
                isLoaded = true;
            },
            (error) => {
                console.error("Error fetching cart drawer:", error);
            }
        );
    }

    function renderCart(data) {
        let totalQty = 0;
        const cartContainer = document.getElementById(cartContainerId);
        cartContainer.innerHTML = '';

        data.forEach(item => {
            totalQty += parseInt(item.quantity);

            const productDiv = document.createElement('div');
            productDiv.className = `product cart_${item.id}`;
            productDiv.dataset.id = item.id;

            const productDetailsDiv = document.createElement('div');
            productDetailsDiv.className = 'product-details';

            productDetailsDiv.innerHTML = `
                <h4 class="product-title">
                    <a href="#">${item.product_info.name}</a>
                </h4>
                <span class="cart-product-info">
                    <span class="cart-product-qty card_product_qty_${item.id}">${item.quantity}</span> ×  
                    <span class="brand_text_design">${item.active_currency}</span>
                    <span class="brand_text_design">${item.product_info.product_price}</span>
                </span>
            `;

            const productImageContainer = document.createElement('figure');
            productImageContainer.className = 'product-image-container';

            productImageContainer.innerHTML = `
                <a href="#" class="product-image">
                    <img src="${item.product_info.image_url}" alt="product" width="80" height="80">
                </a>
                <a href="javascript:void(0);" class="btn-remove" title="Remove Product">
                    <span class="remove-from-cart" data-id="${item.id}">×</span>
                </a>
            `;

            productDiv.appendChild(productDetailsDiv);
            productDiv.appendChild(productImageContainer);
            cartContainer.appendChild(productDiv);
        });

        updateCartCount(totalQty);
    }

    function updateCartCount(count) {
        document.querySelectorAll(`.${cartCountClass}`).forEach(el => {
            el.textContent = count;
        });
    }

    function loadCartCount() {
        getDetails(
            '/cart-drawer/count',
            (data) => {
                const count = data.results.totalQty ?? 0;
                document.querySelectorAll('.cart-count').forEach(el => {
                    el.textContent = count;
                });
            },
            (error) => {
                console.error('Error loading cart count:', error);
            }
        );
    }    

    return {
        load,
        loadCartCount, // ✅ expose it so you can use it outside
    };    
})();
