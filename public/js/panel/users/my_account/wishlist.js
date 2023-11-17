function showWishlistData(data) {
    console.log(data);
    let htmlWishlistContent;
    data.forEach((item) => {
        htmlWishlistContent += `
<tr class="product-row wishlist_row_${item.id}">
  <td>
    <figure class="product-image-container">
      <a class="product-image">
        <img src="${item.product_info.image_url}" alt="product">
      </a>
      <a href="javascript:void(0);" class="btn-remove icon-cancel remove-from-wishlist" data-id="${item.id}" title="Remove Product"></a>
    </figure>
  </td>
  <td>
    <h5 class="product-title">
      <a>${item.product_info.name}</a>
    </h5>
  </td>
  <td class="price-box">${item.product_info.product_price}</td>
  <td>
    <span class="stock-status">In stock</span>
  </td>
  <td class="action" id="wishlist_product_${item.product_info.id}">
  ${item.product_info.already_added
    ? `<span class="already-added-msg">Already Added</span>`
    : `<button href="javascript:void(0);" title="Add To Cart" class="btn btn-dark btn-add-cart product-type-simple btn-shop add_wishlist_to_cart_item" data-product_id="${item.product_info.id}">
        ADD TO CART
      </button>`
  }
  </td>
</tr>
`;
    });
    $('#wishlist_table_body').html(htmlWishlistContent);

}

$(document).on('click', '.remove-from-wishlist', function () {
    const row_id = $(this).data('id');

    // Delete the company
    deleteAction(
        '/api/wishlist-remove/' + row_id,
        (data) => {
            $('.wishlist_row_' + row_id).remove();
            toastrSuccessMessage(data.message);
        },
        (error) => {
            // Error callback
            toastrErrorMessage(error.responseJSON.message);
        }
    );
});

$(document).ready(function () {

    function getWishlist() {
        const user_id = $("#temp_user_id").data('user_id');
        getDetails(
            "/api/my-account/wishlist?user_id=" + user_id,
            (data) => {
                showWishlistData(data.results.data);
            },
            (error) => {

            }
        );
    }
    getWishlist();
});
$(document).on('click', '.add_wishlist_to_cart_item', function () {
    const product_id = $(this).data('product_id');
    const user_id = $("#temp_user_id").data('user_id');
    const formData = {
        user_id: user_id,
        product_id: product_id,
        quantity: 1,
    };

    submitWishlistToCart(formData, "");
});

function submitWishlistToCart(formData, selectedId = "") {
    saveAction(
        "store",
        "/api/cart/add",
        formData,
        selectedId,
        (data) => {
            toastrSuccessMessage(data.message);
            console.log(formData);
            $("#wishlist_product_"+formData.id).html(`<span class="already-added-msg">Already Added</span>`);
            getCartItem();
            //
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
}
