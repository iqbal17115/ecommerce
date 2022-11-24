<script type="text/javascript">
    
$("body").on("click", "#DeleteRow", function() {
    $(this).parents("#DeleteVariantRow").remove();
});
$("#variant-row-add").click(function() {
    newRowAdd =
        '<tr id="DeleteVariantRow"><td>Large</td><td>Green</td><td>1150Tk</td><td><button class="btn btn-danger" id="DeleteRow" type="button"><i class="mdi mdi-delete"></i></td></tr>';

    $('#variant_area').append(newRowAdd);
});

$('#condition_note').summernote({
    height: 120
});
$('#product_description').summernote({
    height: 120
});
$('#warranty_description').summernote({
    height: 120
});
// Code By Webdevtrick ( https://webdevtrick.com )
function readFile(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var htmlPreview =
                '<img width="200" src="' + e.target.result + '" />' +
                '<p>' + input.files[0].name + '</p>';
            var wrapperZone = $(input).parent();
            var previewZone = $(input).parent().parent().find('.preview-zone');
            var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

            wrapperZone.removeClass('dragover');
            previewZone.removeClass('hidden');
            boxZone.empty();
            boxZone.append(htmlPreview);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function reset(e) {
    e.wrap('<form>').closest('form').get(0).reset();
    e.unwrap();
}

$(".dropzone").change(function() {
    readFile(this);
});

$('.dropzone-wrapper').on('dragover', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).addClass('dragover');
});

$('.dropzone-wrapper').on('dragleave', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).removeClass('dragover');
});

$('.remove-preview').on('click', function() {
    var boxZone = $(this).parents('.preview-zone').find('.box-body');
    var previewZone = $(this).parents('.preview-zone');
    var dropzone = $(this).parents('.form-group').find('.dropzone');
    boxZone.empty();
    previewZone.addClass('hidden');
    reset(dropzone);
});
$("#rowAdder").click(function() {
    newRowAdd =
        '<div id="row"> <div class="input-group m-3">' +
        '<div class="input-group-prepend">' +
        '<button class="btn btn-danger" id="DeleteRow" type="button">' +
        '<i class="mdi mdi-delete"></i></button> </div>' +
        '<input type="text" class="form-control m-input"> </div> </div>';

    $('#newinput').append(newRowAdd);
});

$("body").on("click", "#DeleteRow", function() {
    $(this).parents("#row").remove();
})
</script>