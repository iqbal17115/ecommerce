<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(".btn-add-cart").click(function () {
            let id = $(this).data("id");
            let your_price = $(this).data("your_price");
            let sale_price = $(this).data("sale_price");
            // ajax
            $.ajax({
                    url: "{{route('add-to-cart')}}",
                    method: 'get',
                    data: {
                        id: id,
                        your_price: your_price,
                        sale_price: sale_price
                    },
                    dataType: 'json',
                    success: function(data) {
                       alert(data);
                    },
                    error: function(err) {
                        let error = err.responseJSON;
                        console.log(error);
                    }
                });
        });
    });
</script>