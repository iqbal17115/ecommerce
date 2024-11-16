<script>
        $(document).ready(function() {
  // Forcefully trigger the change event
  $('#card_feature').trigger('change');
});
function featureTypeCheck(feature_type) {
    feature_type_val = $("#" + feature_type.id).val();
    if(feature_type_val==1){
      $(".feature-menu").show();
    } else {
      $(".feature-menu").hide();
    }
}
// Start Remove Feature Category
$(document).ready(function() {
    $("body").on("click", ".remove-btn", function() {
        $(this).closest('tr').remove();
    });
});
// End Remove Feature Category
// Start Feature Setting
$(document).on('submit', '#add_feature_setting', function(e) {
    e.preventDefault();
    var form = this;
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
                window.location.href = "feature";
            }

        },
        error: (error) => {
            alert('Something went wrong to fetch datas...');
        }
    });
});
// End Feature Setting
$(document).ready(function() {
    // Hide the selected options div
    // $('#selected-options').hide();

    // Listen for changes in the select box
    $('#select-options').change(function() {
        // Get the selected option
        var selectedOption = $('#select-options').val();
        var selectedOptionText = $(this).find('option:selected').text();
        // If an option is selected, add it to the selected options div
        if (selectedOption) {
            var newStr = selectedOptionText.split('-').join('');
            $('#selected-options').append(
                '<tr><td class="text-danger"><input name="category_id[]" id="category_id"  class="form-control" value="' +
                selectedOption + '" hidden/>' + newStr +
                '</td><td><input name="position[]" id="position" class="form-control form-control-sm" placeholder="Position" required/></td><td><button type="button" class="btn btn-danger text-light btn-sm ml-1 p-1 remove-btn"><i class="mdi mdi-trash-can font-size-16"></i></button></td></tr>'
            );
            $('#selected-options').show();
        }
    });

});
</script>