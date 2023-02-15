<script>
$(document).ready(function() {
    // Remove From Cart
    $(".btn-remove").click(function(e) {

        var ele = $(this);
        $.ajax({
            url: "remove-from-cart",
            method: "DELETE",
            data: {
                id: ele.parents("div").attr("data-id")
            },
            success: function(response) {
                $(".cart-" + ele.parents("div").attr("data-id")).remove();
            }
        });
    });
    // Add To cart
    $(".btn-add-cart").click(function() {
        let id = $(this).data("id");
        let name = $(this).data("name");
        let your_price = $(this).data("your_price");
        let sale_price = $(this).data("sale_price");
        let image = $(this).data("image");
        // ajax
        $.ajax({
            url: "add-to-cart",
            method: 'post',
            data: {
                id: id,
                name: name,
                your_price: your_price,
                sale_price: sale_price,
                image: image
            },
            dataType: 'json',
            success: function(data) {
                path="storage/product_photo";
                if (data['new_product'].length != 0) {
                    console.log(data['new_product']);
                    $(".dropdown-cart-products").prepend('<div class="product cart'+data['new_product']['id']+'">' +
                        ' <div class="product-details"><h4 class="product-title"><a href="#">' +
                        data['new_product']['name'] +
                        '</a></h4><span class="cart-product-info"><span class="cart-product-qty">' +
                        data['new_product']['quantity'] +
                        '</span>' + ' x ' + data['new_product']['sale_price'] +
                        '</span></div><figure class="product-image-container"><a href="#" class="product-image"><img src="{{ URL::asset('+path+') }}/abc.png"></a><a href="javascript:void(0);" class="btn-remove" title="Remove Product"><span>×</span></a></figure></div>');
                }
            },
            error: function(err) {
                var error = err.responseJSON;
                console.log(error);
            }
        });

    });
});
</script>