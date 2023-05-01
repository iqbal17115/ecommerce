<script>
    // Start Feature Setting
$(document).on('submit', '#add_feature_setting', function(e) {
    e.preventDefault();
    var form = this;
    alert('Work Ongoing');
    $.ajax({
        url: "{{route('add.feature_setting')}}",
        method: 'post',
        data: new FormData(form),
        enctype: 'multipart/form-data',
        processData: false,
        dataType: 'json',
        contentType: false,
        success: function(data) {
            if (data.status == 201) {
            
            }
            console.log("OK");
        },
        error: (error) => {
            alert('Something went wrong to fetch datas...');
        }
    });
});
// End Feature Setting
$(document).ready(function() {
    // Hide the selected options div
    $('#selected-options').hide();

    // Listen for changes in the select box
    $('#select-options').change(function() {
        // Get the selected option
        var selectedOption = $('#select-options').val();
        var selectedOptionText = $(this).find('option:selected').text();
        // If an option is selected, add it to the selected options div
        if (selectedOption) {
            var newStr = selectedOptionText.split('-').join('');
            $('#selected-options').append('<tr><td class="text-danger"><input class="form-control" name="category_id" id="category_id" value="' + selectedOption + '" hidden/>' + newStr + '</td><td><input class="form-control form-control-sm" placeholder="Position"/></td><td><button type="button" class="btn btn-info text-light btn-sm"><i class="mdi mdi-pencil font-size-16"></i></button><button type="button" class="btn btn-danger text-light btn-sm ml-1"><i class="mdi mdi-trash-can font-size-16"></i></button></td></tr>');
            $('#selected-options').show();
        }
    });

});
</script>