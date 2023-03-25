<script>
    $(document).ready(function() {
        $('#imgPreviewIcon').hide();
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
        $(document).on('change', '#icon', function(e) {
            $('#imgPreviewIcon').show();
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    console.log(event.target.result);
                    $('#imgPreviewIcon').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
        $("#search_string").on('keyup', function(e) {
            e.preventDefault();
            let search_string = $("#search_string").val();
            $.ajax({
                url: "{{route('search.category')}}",
                method: 'get',
                data: {
                    search_string: search_string
                },
                success: function(data) {
                    $('.category_content').html(data);
                    if (data.status == 'nothing_found') {
                        $('.category_content').html(
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
                url: '/pagination/category-pagination-data?page=' + page,
                success: function(data) {
                    $('.category_content').html(data);
                }
            })
        }
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            pagination(page);
        });
        $(document).on('click', '.delete_category', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Are you sure want to delete category?')) {
                $.ajax({
                    url: "{{route('delete.category')}}",
                    method: 'post',
                    data: {
                        id: id
                    },
                    enctype: 'multipart/form-data',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            $('.category_content').load(location.href + ' .category_content');
                            $('.paginate').load(location.href + ' .paginate');
                            Command: toastr["success"]("Category Deleted",
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
            $('#addCategory')[0].reset();
            $('#cu_id').val(-1);
            $('#imgPreviewIcon').hide();
            $('#imgPreview').hide();
        });

        $(document).on('click', '.update_form', function(e) {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let parent_category_id = $(this).data('parent_category_id');
            let top_menu = $(this).data('top_menu');
            let sidebar_menu = $(this).data('sidebar_menu');
            let position = $(this).data('position');
            let sidebar_menu_position = $(this).data('sidebar_menu_position');
            let icon = $(this).data('icon1');
            let image = $(this).data('image');
            let variation_type = $(this).data('variation_type');
            let vendor_commission_percentage = $(this).data('vendor_commission_percentage');
            let is_active = $(this).data('is_active');
            $('#cu_id').val(id);
            $('#id').val(id);
            $('#name').val(name);
            $('.category_id').val(parent_category_id).trigger("change");
            $('#top_menu').val(top_menu);
            $('#sidebar_menu').val(sidebar_menu);
            $('#position').val(position);
            $('#sidebar_menu_position').val(sidebar_menu_position);
            if (image) {
                $('#imgPreview').show();
                $('#imgPreview').attr("src", 'storage/' + image);
            }
            if (icon) {
                $('#imgPreviewIcon').show();
                $('#imgPreviewIcon').attr("src", 'storage/' + icon);
            }
            $('#variation_type').val(variation_type);
            $('.variation_type').val(variation_type).trigger("change");
            $('#vendor_commission_percentage').val(vendor_commission_percentage);
            $('#is_active').val(is_active);
            $(".variation_type").select2({
                dropdownParent: $("#categoryModal"),
                placeholder: 'Select An Option'
            });
            $(".category_id").select2({
                dropdownParent: $("#categoryModal"),
                placeholder: 'Select An Option'
            });
        });

        $(document).on('submit', '#addCategory', function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: "{{route('add.category')}}",
                method: 'post',
                data: new FormData(form),
                enctype: 'multipart/form-data',
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        Command: toastr["success"]("Category Added",
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

                        $('#categoryModal').modal('hide');
                        $('#addCategory')[0].reset();
                        $('.category_content').load(location.href + ' .category_content');
                        $('.category_load').load(location.href + ' .category_load');
                        $('.variation_load').load(location.href + ' .variation_load');
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