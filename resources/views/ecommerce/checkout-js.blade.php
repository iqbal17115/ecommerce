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
                union = '';
                union += '<option value="" selected="selected"></option>';
                Object.entries(data['union']).forEach(([key, value]) => {
                    union += '<option value='+value['id']+'>'+value['name']+'</option>';
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
                upazila = '';
                upazila += '<option value="" selected="selected"></option>';
                Object.entries(data['upazila']).forEach(([key, value]) => {
                    upazila += '<option value='+value['id']+'>'+value['name']+'</option>';
                });
                $("#upazila").html(upazila);
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
                district = '';
                district += '<option value="" selected="selected"></option>';
                Object.entries(data['district']).forEach(([key, value]) => {
                    district += '<option value='+value['id']+'>'+value['name']+'</option>';
                });
                $("#district").html(district);
            },
            error: function(err) {
                var error = err.responseJSON;
                console.log(error);
            }
        });
    });
});
</script>