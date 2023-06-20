<script type="text/javascript">
$(document).ready(function() {
       // Get Union By Upazila
       $("body").on("change", "#upazila", function(e) {
        upazila_id = $(this).val();
        // Ajax
        $.ajax({
            url: "get-union",
            method: 'get',
            data: {
                upazila_id: upazila_id
            },
            dataType: 'json',
            success: function(data) {
                var union_value = $("[name='shipping_union_id']").val();
                union = '';
                union += '<option value="" selected="selected"></option>';
                Object.entries(data['union']).forEach(([key, value]) => {
                    union_selected = '';
                    if(union_value == value['id']) {
                        union_selected = 'selected';
                    }
                    union += '<option '+union_selected+' value='+value['id']+'>'+value['name']+'</option>';
                });
                $("#union").html(union);
            },
            error: function(err) {
                var error = err.responseJSON;
                console.log(error);
            }
        });
    });
    // Get Upazila By District
    $("body").on("change", "#district", function(e) {
        district_id = $(this).val();
        // Ajax
        $.ajax({
            url: "get-upazila",
            method: 'get',
            data: {
                district_id: district_id
            },
            dataType: 'json',
            success: function(data) {
                var upazila_value = $("[name='shipping_upazilla_id']").val();
                upazila = '';
                upazila += '<option value="" selected="selected"></option>';
                Object.entries(data['upazila']).forEach(([key, value]) => {
                    upazila_selected = '';
                    if(upazila_value == value['id']) {
                        upazila_selected = 'selected';
                    }
                    upazila += '<option '+upazila_selected+' value='+value['id']+'>'+value['name']+'</option>';
                });
                $("#upazila").html(upazila);
                $('#upazila').trigger('change');
            },
            error: function(err) {
                var error = err.responseJSON;
                console.log(error);
            }
        });
    });

    // Get District By Division
    $("body").on("change", "#division", function(e) {
        division_id = $(this).val();

        // Ajax
        $.ajax({
            url: "get-district",
            method: 'get',
            data: {
                division_id: division_id
            },
            dataType: 'json',
            success: function(data) {
                var dis_value = $("[name='shipping_district_id']").val();
                district = '';
                district += '<option value="" selected="selected"></option>';
                Object.entries(data['district']).forEach(([key, value]) => {
                    dis_selected = '';
                    if(dis_value == value['id']) {
                        dis_selected = 'selected';
                    }
                    district += '<option '+dis_selected+' value='+value['id']+'>'+value['name']+'</option>';
                });
                $("#district").html(district);
                $('#district').trigger('change');
            },
            error: function(err) {
                var error = err.responseJSON;
                console.log(error);
            }
        });
    });

    $('#division').trigger('change');

});
</script>
