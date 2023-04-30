<script>
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
            $('#selected-options').append('<tr><td class="text-danger"><input class="form-control" name="category_id" id="category_id" value="' + selectedOption + '" hidden/>' + newStr + '</td><td><input class="form-control" placeholder="Position"/></td></tr>');
            $('#selected-options').show();
        }
    });

});
</script>