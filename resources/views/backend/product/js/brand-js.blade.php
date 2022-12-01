<script>
$(document).ready(function() {
    $('#imgPreview').hide();
    $(document).on('change', '#image', function(e) {
        $('#imgPreview').show();
        const file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                console.log(event.target.result);
                $('#imgPreview').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
    $("#search_string").on('keyup', function(e) {
        e.preventDefault();
        let search_string = $("#search_string").val();
        $.ajax({
            url: "{{route('search.brand')}}",
            method: 'get',
            data: {
                search_string: search_string
            },
            success: function(data) {
                $('.brand_content').html(data);
                if (data.status == 'nothing_found') {
                    $('.brand_content').html(
                        '<div class="text-danger text-center h3 mt-3">Nothing Found!!</div>'
                        );
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

    function pagination(page) {
        $.ajax({
            url: '/pagination/brand-pagination-data?page=' + page,
            success: function(data) {
                $('.brand_content').html(data);
            }
        })
    }
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1]
        pagination(page);
    });
    $(document).on('click', '.delete_brand', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are you sure want to delete brand?')) {
            $.ajax({
                url: "{{route('delete.brand')}}",
                method: 'post',
                data: {
                    id: id
                },
                enctype: 'multipart/form-data',
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        $('.brand_content').load(location.href + ' .brand_content');
                        $('.paginate').load(location.href + ' .paginate');
                        Command: toastr["success"]("Brand Deleted",
                            "success")

                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    console.log(error);
                }
            });
        }

    });

    $(document).on('click', '.clean_form', function(e) {
        $('#addBrand')[0].reset();
        $('#cu_id').val(-1);
        $('#imgPreview').hide();
    });

    $(document).on('click', '.update_form', function(e) {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let image = $(this).data('image');
        let website = $(this).data('website');
        let is_active = $(this).data('is_active');

        $('#cu_id').val(id);
        $('#name').val(name);
        if(image) {
        $('#imgPreview').show();
        $('#imgPreview').attr("src", 'storage/'+image);
        }
        $('#website').val(website);
        $('#is_active').val(is_active);
    });

    $(document).on('submit', '#addBrand', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: "{{route('add.brand')}}",
            method: 'post',
            data: new FormData(form),
            enctype: 'multipart/form-data',
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(data) {
                if (data.status == 'success') {
                    Command: toastr["success"]("Brand Added",
                        "Success")

                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }

                    $('#brandModal').modal('hide');
                    $('#addBrand')[0].reset();
                    $('.brand_content').load(location.href + ' .brand_content');
                    $('.paginate').load(location.href + ' .paginate');
                    $('#cu_id').val(-1);

                }
            },
            error: function(err) {
                let error = err.responseJSON;
                $.each(error.errors, function(key, value) {
                    $('.err_' + key).html(value);
                });
            }
        });
    });

});
</script>