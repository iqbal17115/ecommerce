<script type="text/javascript">
$(document).ready(function() {
    // Decrease Product Qty
    $("body").on("click", ".bootstrap-touchspin-down", function(e) {
        var ele = $(this);
        id = ele.parents("tr").attr("data-id");
        quantity = $(".product-quantity-" + id).val();
        // ajax
        $.ajax({
            url: "decrease-product-qty",
            method: 'post',
            data: {
                id: id,
                quantity: quantity
            },
            dataType: 'json',
            success: function(data) {
                $('.subtotal-price-' + id).text(data['cart'][id]['quantity'] * data['cart'][
                    id
                ]['sale_price']);
                $('.card-product-qty-' + id).text(data['cart'][id]['quantity']);
                propertyNames = Object.values(data['cart']);
                price_qty = propertyNames.map(x => x['quantity'] * x['sale_price']);
                total = price_qty.reduce(function(curr, prev) {
                    return curr + prev;
                });
                $('.cart-total-price').text(total);
            },
            error: function(err) {
                var error = err.responseJSON;
                console.log(error);
            }
        });
    });
    // Increase Product Qty
    $("body").on("click", ".bootstrap-touchspin-up", function(e) {
        var ele = $(this);
        id = ele.parents("tr").attr("data-id");
        var quantity = $(".product-quantity-" + id).val();
        // ajax
        $.ajax({
            url: "increase-product-qty",
            method: 'post',
            data: {
                id: id,
                quantity: quantity
            },
            dataType: 'json',
            success: function(data) {
                $('.subtotal-price-' + id).text(data['cart'][id]['quantity'] * data['cart'][
                    id
                ]['sale_price']);
                $('.card-product-qty-' + id).text(data['cart'][id]['quantity']);
                propertyNames = Object.values(data['cart']);
                price_qty = propertyNames.map(x => x['quantity'] * x['sale_price']);
                total = price_qty.reduce(function(curr, prev) {
                    return curr + prev;
                });
                $('.cart-total-price').text(total);
            },
            error: function(err) {
                var error = err.responseJSON;
                console.log(error);
            }
        });
        // $(".horizontal-quantity").val(111);
    });
    // Remove From Cart Page
    $("body").on("click", ".remove-from-cart", function(e) {
        var ele = $(this);
        $.ajax({
            url: "remove-from-cart",
            method: "DELETE",
            data: {
                id: ele.parents("tr").attr("data-id")
            },
            success: function(data) {
                $('.cart-count').text(Object.keys(data['cart']).length);
                $(".cart-" + ele.parents("tr").attr("data-id")).remove();
                propertyNames = Object.values(data['cart']);
                price_qty = propertyNames.map(x => x['quantity'] * x['sale_price']);
                total = price_qty.reduce(function(curr, prev) {
                    return curr + prev;
                });
                $('.cart-total-price').text(total);
            }
        });

    });
    // Remove From Cart
    $("body").on("click", ".btn-remove", function(e) {

        var ele = $(this);
        alert(ele.parents("div").attr("data-id"));
        $.ajax({
            url: "{{route('remove-from-cart')}}",
            method: "DELETE",
            data: {
                id: ele.parents("div").attr("data-id")
            },
            success: function(data) {
                $('.cart-count').text(Object.keys(data['cart']).length);
                $(".cart-" + ele.parents("div").attr("data-id")).remove();
                propertyNames = Object.values(data['cart']);
                price_qty = propertyNames.map(x => x['quantity'] * x['sale_price']);
                total = 0;
                if (price_qty.length != 0) {
                    total = price_qty.reduce(function(curr, prev) {
                        return curr + prev;
                    });
                }
                $('.cart-total-price').text(total);
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
            url: "{{route('add-to-cart')}}",
            method: 'get',
            data: {
                id: id,
                name: name,
                your_price: your_price,
                sale_price: sale_price,
                image: image
            },
            dataType: 'json',
            success: function(data) {
                propertyNames = Object.values(data['cart']);
                price_qty = propertyNames.map(x => x['quantity'] * x['sale_price']);
                total = price_qty.reduce(function(curr, prev) {
                    return curr + prev;
                });
                $('.cart-total-price').text(total);
                if (data['new_product'].length != 0) {
                    var imageSrc = "{{ asset('storage/images/my-image.png') }}";
                    $('.cart-count').text(Object.keys(data['cart']).length);
                    $(".dropdown-cart-products").prepend('<div class="product cart-' + data[
                            'new_product']['id'] + '" data-id="' + data['new_product'][
                            'id'
                        ] + '">' +
                        ' <div class="product-details"><h4 class="product-title"><a class="product-unique-' +data['new_product']['id'] +'">' +
                        data['new_product']['name'] +
                        '</a></h4><span class="cart-product-info"><span class="cart-product-qty">' +
                        data['new_product']['quantity'] +
                        '</span>' + ' x ' + data['new_product']['sale_price'] +
                        '</span></div><figure class="product-image-container"><a class="product-image product-unique-' +data['new_product']['id'] +'"><img class="img-preview-' +
                        data['new_product']['id'] +
                        '" alt=""></a><a class="btn-remove" title="Remove Product"><span>×</span></a></figure></div>'
                    );
                    $('.img-preview-' + data['new_product']['id']).attr("src", '/storage/product_photo/' + data['new_product']['image']);
                        $('.product-unique-' + data['new_product']['id']).attr('href', "{{ route('product-detail', ['id' => ' ']) }}" + data['new_product']['id']);
                }
            },
            error: function(err) {
        alert(id);

                var error = err.responseJSON;
                console.log(error);
            }
        });

    });
});
</script>