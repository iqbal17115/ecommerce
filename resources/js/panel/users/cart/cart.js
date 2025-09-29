function updateCart(item) {
    const itemClass = `cart_${item.id}`;
    const cartContainer = document.getElementById('cart_container');

    // Check if an element with the specified class exists
    const elementWithClass = cartContainer.querySelector(`.${itemClass}`);

    if (elementWithClass) {
        $(".card_product_qty_" + item.id).text(item.quantity);
    } else {
        let cartCountElement = document.querySelector('.cart-count');
        let currentCount = parseInt(cartCountElement.textContent, 10);
        currentCount += 1;
        cartCountElement.textContent = currentCount;

        const productDiv = document.createElement('div');
        productDiv.className = `product cart_${item.id}`;
        productDiv.setAttribute('data-id', item.id);

        const productDetailsDiv = document.createElement('div');
        productDetailsDiv.className = 'product-details';

        const productTitle = document.createElement('h4');
        productTitle.className = 'product-title';
        productTitle.innerHTML = `<a href="#">${item.product_info.name}</a>`;

        const cartProductInfo = document.createElement('span');
        cartProductInfo.className = 'cart-product-info';
        cartProductInfo.innerHTML = `<span class="cart-product-qty card_product_qty_${item.id}">${item.quantity}</span> × ${item.product_info.product_price}`;

        productDetailsDiv.appendChild(productTitle);
        productDetailsDiv.appendChild(cartProductInfo);

        const productImageContainer = document.createElement('figure');
        productImageContainer.className = 'product-image-container';

        const productImage = document.createElement('a');
        productImage.className = 'product-image lazy-load';
        productImage.href = '';
        productImage.innerHTML = `<img src="${item.product_info.image_url}" alt="product" width="80" height="80">`;

        const removeButton = document.createElement('a');
        removeButton.className = 'btn-remove';
        removeButton.href = 'javascript:void(0);';
        removeButton.title = 'Remove Product';
        removeButton.innerHTML = `<span class="remove-from-cart" data-id="${item.id}">×</span>`;
        productImageContainer.appendChild(productImage);
        productImageContainer.appendChild(removeButton);

        productDiv.appendChild(productDetailsDiv);
        productDiv.appendChild(productImageContainer);

        cartContainer.appendChild(productDiv);
    }
}

$(document).ready(function () {
    // Detect if the page is loaded from the cache using the 'pageshow' event
    window.addEventListener('pageshow', function(event) {
        // Check if the page was loaded from cache (e.g., after back/forward navigation)
        if (event.persisted) {
            console.log('Page is loaded from cache!');
            
            // Fetch the latest cart data again if it's loaded from cache
            getCartItem();
        }
    });

    $(document).on('click', '.add_cart_item', function () {
        const product_id = $(this).data('product_id');
        const user_id = $("#temp_user_id").data('user_id');

        const formData = {
            user_id: user_id,
            product_id: product_id,
            quantity: 1,
        };

        if (user_id.trim() !== "") {
            // user_id is not an empty string
            submitAddItem(formData, "");
        } else {
            // user_id is an empty string
            window.location.href = '/customer-sign-in';
        }
    });

    function submitAddItem(formData, selectedId) {
        saveAction(
            "store",
            "/api/cart/add",
            formData,
            selectedId,
            (data) => {
                if (typeof data.results !== 'undefined') {
                    updateCart(data.results);
                    toastrSuccessMessage(data.message);
                } else {
                    window.location.href = '/customer-sign-in';
                }

            },
            (error) => {
                if (error.responseJSON && error.responseJSON.redirect) {
                    // Redirect to the specified URL
                    window.location.href = error.responseJSON.redirect;
                }
            }
        );
    }

    $('.update-cart').click(function () {
        // Implement the logic to update the cart
        // Send an AJAX PUT request to the cart API
    });

    $(document).on('click', '.remove-from-cart', function () {
        const row_id = $(this).data('id');
        const removeItem = $(this);

        // Delete the company
        deleteAction(
            '/api/cart-remove/' + row_id,
            (data) => {
                removeItem.closest('.product.cart_' + row_id).remove();
                let cartCountElement = document.querySelector('.cart-count');
                let currentCount = parseInt(cartCountElement.textContent, 10);
                currentCount -= 1;
                cartCountElement.textContent = currentCount;
                toastrSuccessMessage(data.message);
            },
            (error) => {
                // Error callback
                toastrErrorMessage(error.responseJSON.message);
            }
        );
    });
});
