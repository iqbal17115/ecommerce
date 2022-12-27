<script type="text/javascript">
    function getAllVariant(type) {
        $.ajax({
            method: "GET",
            url: "{{ url('/get-variant/1') }}",
            success: (result) => {
                variant = '';
                Object.entries(result).forEach(([key, value]) => {
                    console.log(value['branch_id']);
                    variant += '<option value="' + value['id'] + '">' + value['name'] + '</option>';
                });
                $('.bottom_size_map').append(variant)
            },
            error: (error) => {
                alert('Something went wrong to fetch datas...');
            }
        });
    }

    function variationManage(variation_type, val) {
        var variation_menu = [];
        if (variation_type == 1) {
            var len = $("#variation_row").children().length;
            if (!variation_menu.includes(1)) {
                variation_menu.push(1);
            }
            if (len == 0) {
                variation_content = '<div class="col-md-12 per-row master_type_' + variation_type + '" style="display: flex;">';
                variation_content += '<div class="master_prev_1 master_prev text-center" style="width: 150px;">' + val + '</div>';
                variation_content += '<div class="gender_id" style="width: 150px;"><select class="select-form"><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
                variation_content += '<div style="width: 150px;"><input name="age_range" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form bottom_size_map"></select></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                variation_content += '</div>';
                $("#variation_row").append(variation_content);
                $("#variation_head").prepend('<div class="text-center" style="width: 150px; font-size: 12px;"><span style="width: 100%;">Size</span></div>');
            } else {
                var variation_type_len = $(".master_type_" + variation_type).length;
                if (variation_type_len != 0) {
                    variation_content = '<div class="col-md-12 per-row master_type_' + variation_type + '" style="display: flex;">';
                    variation_content += '<div class="master_prev_1 master_prev text-center" style="width: 150px;">' + val + '</div>';
                    variation_content += '<div class="gender_id" style="width: 150px;"><select class="select-form"><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="age_range" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form bottom_size_map"></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                    variation_content += '</div>';
                    $("#variation_row").append(variation_content);
                } else {
                    var already_1 = $(".already_1").length;
                    if (already_1 == 0) {
                        $('<div class="text-center already_1 available_class" style="width: 150px;">' + val + '</div>').insertBefore(".gender_id");
                        $(".master_prev_1").removeClass("master_prev");
                        $('<div class="text-center" style="width: 150px; font-size: 12px;"><span style="width: 100%;">Size</span></div>').insertBefore("#gender_header");
                    } else {

                        var variation_element = document.querySelectorAll(".per-row");
                        var variation_tags = '';
                        var cart_div = document.getElementById("variation_row");
                        var hidden_value_1 = $('#hidden_value_1').val();
                        if (hidden_value_1 == 0) {
                            var length = variation_element.length;
                            $('#hidden_value_1').val(length);
                        } else {
                            var length = hidden_value_1;
                        }
                        for (var i = 0; i < length; i++) {
                            cart_div.innerHTML += '<div class="col-md-12 per-row current_val" style="display: flex;">' + variation_element[i].innerHTML + '</div>';
                            $('.current_val .available_class').text(val);
                        }
                        $(".per-row").removeClass("current_val");
                        console.log(variation_tags);
                    }
                }
            }
        } else if (variation_type == 2) {
            var len = $("#variation_row").children().length;
            if (len == 0) {
                variation_content = '<div class="col-md-12 per-row master_type_' + variation_type + '" style="display: flex;">';
                variation_content += '<div class="text-center master_prev_2 master_prev" style="width: 150px;">' + val + '</div>';
                variation_content += '<div class="gender_id" style="width: 150px;"><select class="select-form"><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
                variation_content += '<div class="div_size" style="display: none; width: 150px;"><input name="age_range" class="input-form" /></div>';
                variation_content += '<div class="div_size" style="display: none; width: 150px;"><select class="select-form bottom_size_map"></select></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                variation_content += '</div>';
                $("#variation_row").append(variation_content);
                $("#variation_head").prepend('<div class="text-center" style="width: 150px; font-size: 12px;"><span style="width: 100%;">Color</span></div>');
            } else {
                var variation_type_len = $(".master_type_" + variation_type).length;
                if (variation_type_len != 0) {
                    variation_content = '<div class="col-md-12 per-row master_type_' + variation_type + '" style="display: flex;">';
                    variation_content += '<div class="text-center master_prev_2 master_prev" style="width: 150px;">' + val + '</div>';
                    variation_content += '<div class="gender_id" style="width: 150px;"><select class="select-form"><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
                    variation_content += '<div class="div_size" style="display: none;width: 150px;"><input name="age_range" class="input-form" /></div>';
                    variation_content += '<div class="div_size" style="display: none;width: 150px;"><select class="select-form bottom_size_map"></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                    variation_content += '</div>';
                    $("#variation_row").append(variation_content);
                } else {
                    var already_2 = $(".already_2").length;
                    if (already_2 == 0) {
                        $('<div class="text-center already_2 available_class" style="width: 150px;">' + val + '</div>').insertBefore(".gender_id");
                        $(".master_prev_2").removeClass("master_prev");
                        $('<div class="text-center" style="width: 150px; font-size: 12px;"><span style="width: 100%;">Color</span></div>').insertBefore("#gender_header");
                    } else {

                        var variation_element = document.querySelectorAll(".per-row");
                        var variation_tags = '';
                        var cart_div = document.getElementById("variation_row");
                        var hidden_value_2 = $('#hidden_value_2').val();
                        if (hidden_value_2 == 0) {
                            var length = variation_element.length;
                            $('#hidden_value_2').val(length);
                        } else {
                            var length = hidden_value_2;
                        }
                        for (var i = 0; i < length; i++) {
                            cart_div.innerHTML += '<div class="col-md-12 per-row current_val" style="display: flex;">' + variation_element[i].innerHTML + '</div>';
                            $('.current_val .available_class').text(val);
                        }
                        $(".per-row").removeClass("current_val");
                        console.log(variation_tags);
                    }
                }
            }
        } else if (variation_type == 3) {
            var len = $("#variation_row").children().length;
            if (len == 0) {
                variation_content = '<div class="col-md-12 per-row master_type_' + variation_type + '" style="display: flex;">';
                variation_content += '<div class="text-center master_prev_3 master_prev" style="width: 150px;">' + val + '</div>';
                variation_content += '<div class="gender_id" style="width: 150px;"><select class="select-form"><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
                variation_content += '<div class="div_size" style="display: none;width: 150px;"><input name="age_range" class="input-form" /></div>';
                variation_content += '<div class="div_size" style="display: none;width: 150px;"><select class="select-form bottom_size_map"></select></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                variation_content += '</div>';
                $("#variation_row").append(variation_content);
                $("#variation_head").prepend('<div class="text-center" style="width: 150px; font-size: 12px;"><span style="width: 100%;">P. Qty</span></div>');
            } else {
                var variation_type_len = $(".master_type_" + variation_type).length;
                if (variation_type_len != 0) {
                    variation_content = '<div class="col-md-12 per-row master_type_' + variation_type + '" style="display: flex;">';
                    variation_content += '<div class="text-center master_prev_3 master_prev" style="width: 150px;">' + val + '</div>';
                    variation_content += '<div class="gender_id" style="width: 150px;"><select class="select-form"><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
                    variation_content += '<div class="div_size" style="display: none;width: 150px;"><input name="age_range" class="input-form" /></div>';
                    variation_content += '<div class="div_size" style="display: none;width: 150px;"><select class="select-form bottom_size_map"></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                    variation_content += '</div>';
                    $("#variation_row").append(variation_content);
                } else {
                    var already_3 = $(".already_3").length;
                    if (already_3 == 0) {
                        $('<div class="text-center already_3 available_class_3" style="width: 150px;">' + val + '</div>').insertBefore(".gender_id");
                        $(".master_prev_3").removeClass("master_prev");
                        $('<div class="text-center" style="width: 150px; font-size: 12px;"><span style="width: 100%;">P. Qty</span></div>').insertBefore("#gender_header");
                    } else {

                        var variation_element = document.querySelectorAll(".per-row");
                        var variation_tags = '';
                        var cart_div = document.getElementById("variation_row");
                        var hidden_value_3 = $('#hidden_value_3').val();
                        if (hidden_value_3 == 0) {
                            var length = variation_element.length;
                            $('#hidden_value_3').val(length);
                        } else {
                            var length = hidden_value_3;
                        }
                        for (var i = 0; i < length; i++) {
                            cart_div.innerHTML += '<div class="col-md-12 per-row current_val" style="display: flex;">' + variation_element[i].innerHTML + '</div>';
                            $('.current_val .available_class_3').text(val);
                        }
                        $(".per-row").removeClass("current_val");
                        console.log(variation_tags);
                    }
                }
            }
        } else if (variation_type == 4) {
            var len = $("#variation_row").children().length;
            if (len == 0) {
                variation_content = '<div class="col-md-12 per-row master_type_' + variation_type + '" style="display: flex;">';
                variation_content += '<div class="text-center master_prev_4 master_prev" style="width: 150px;">' + val + '</div>';
                variation_content += '<div class="gender_id" style="width: 150px;"><select class="select-form"><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
                variation_content += '<div class="div_size" style="display: none;width: 150px;"><input name="age_range" class="input-form" /></div>';
                variation_content += '<div class="div_size" style="display: none;width: 150px;"><select class="select-form bottom_size_map"></select></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                variation_content += '</div>';
                $("#variation_row").append(variation_content);
                $("#variation_head").prepend('<div class="text-center" style="width: 150px; font-size: 12px;"><span style="width: 100%;">M. Type</span></div>');
            } else {
                var variation_type_len = $(".master_type_" + variation_type).length;
                if (variation_type_len != 0) {
                    variation_content = '<div class="col-md-12 per-row master_type_' + variation_type + '" style="display: flex;">';
                    variation_content += '<div class="text-center master_prev_4 master_prev" style="width: 150px;">' + val + '</div>';
                    variation_content += '<div class="gender_id" style="width: 150px;"><select class="select-form"><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
                    variation_content += '<div class="div_size" style="display: none;width: 150px;"><input name="age_range" class="input-form" /></div>';
                    variation_content += '<div class="div_size" style="display: none;width: 150px;"><select class="select-form bottom_size_map"></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                    variation_content += '</div>';
                    $("#variation_row").append(variation_content);
                } else {
                    var already_4 = $(".already_4").length;
                    if (already_4 == 0) {
                        $('<div class="text-center already_4 available_class_4" style="width: 150px;">' + val + '</div>').insertBefore(".gender_id");
                        $(".master_prev_4").removeClass("master_prev");
                        $('<div class="text-center" style="width: 150px; font-size: 12px;"><span style="width: 100%;">M. Type</span></div>').insertBefore("#gender_header");
                    } else {

                        var variation_element = document.querySelectorAll(".per-row");
                        var variation_tags = '';
                        var cart_div = document.getElementById("variation_row");
                        var hidden_value_4 = $('#hidden_value_4').val();
                        if (hidden_value_4 == 0) {
                            var length = variation_element.length;
                            $('#hidden_value_4').val(length);
                        } else {
                            var length = hidden_value_4;
                        }
                        for (var i = 0; i < length; i++) {
                            cart_div.innerHTML += '<div class="col-md-12 per-row current_val" style="display: flex;">' + variation_element[i].innerHTML + '</div>';
                            $('.current_val .available_class_4').text(val);
                        }
                        $(".per-row").removeClass("current_val");
                        console.log(variation_tags);
                    }
                }
            }
        } else if (variation_type == 5) {
            var len = $("#variation_row").children().length;
            if (len == 0) {
                variation_content = '<div class="col-md-12 per-row master_type_' + variation_type + '" style="display: flex;">';
                variation_content += '<div class="text-center master_prev_5 master_prev" style="width: 150px;">' + val + '</div>';
                variation_content += '<div class="gender_id" style="width: 150px;"><select class="select-form"><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
                variation_content += '<div class="div_size" style="display: none;width: 150px;"><input name="age_range" class="input-form" /></div>';
                variation_content += '<div class="div_size" style="display: none;width: 150px;"><select class="select-form bottom_size_map"></select></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                variation_content += '</div>';
                $("#variation_row").append(variation_content);
                $("#variation_head").prepend('<div class="text-center" style="width: 150px; font-size: 12px;"><span style="width: 100%;">Wattage</span></div>');
            } else {
                var variation_type_len = $(".master_type_" + variation_type).length;
                if (variation_type_len != 0) {
                    variation_content = '<div class="col-md-12 per-row master_type_' + variation_type + '" style="display: flex;">';
                    variation_content += '<div class="text-center master_prev_5 master_prev" style="width: 150px;">' + val + '</div>';
                    variation_content += '<div class="gender_id" style="width: 150px;"><select class="select-form"><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
                    variation_content += '<div class="div_size" style="display: none;width: 150px;"><input name="age_range" class="input-form" /></div>';
                    variation_content += '<div class="div_size" style="display: none;width: 150px;"><select class="select-form bottom_size_map"></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                    variation_content += '</div>';
                    $("#variation_row").append(variation_content);
                } else {
                    var already_5 = $(".already_5").length;
                    if (already_5 == 0) {
                        $('<div class="text-center already_5 available_class_5" style="width: 150px;">' + val + '</div>').insertBefore(".gender_id");
                        $(".master_prev_4").removeClass("master_prev");
                        $('<div class="text-center" style="width: 150px; font-size: 12px;"><span style="width: 100%;">Wattage</span></div>').insertBefore("#gender_header");
                    } else {

                        var variation_element = document.querySelectorAll(".per-row");
                        var variation_tags = '';
                        var cart_div = document.getElementById("variation_row");
                        var hidden_value_5 = $('#hidden_value_5').val();
                        if (hidden_value_5 == 0) {
                            var length = variation_element.length;
                            $('#hidden_value_5').val(length);
                        } else {
                            var length = hidden_value_5;
                        }
                        for (var i = 0; i < length; i++) {
                            cart_div.innerHTML += '<div class="col-md-12 per-row current_val" style="display: flex;">' + variation_element[i].innerHTML + '</div>';
                            $('.current_val .available_class_5').text(val);
                        }
                        $(".per-row").removeClass("current_val");
                        console.log(variation_tags);
                    }
                }
            }
        } else if (variation_type == 6) {
            var len = $("#variation_row").children().length;
            if (len == 0) {
                variation_content = '<div class="col-md-12 per-row master_type_' + variation_type + '" style="display: flex;">';
                variation_content += '<div class="text-center master_prev_6 master_prev" style="width: 150px;">' + val + '</div>';
                variation_content += '<div class="gender_id" style="width: 150px;"><select class="select-form"><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
                variation_content += '<div class="div_size" style="display: none;width: 150px;"><input name="age_range" class="input-form" /></div>';
                variation_content += '<div class="div_size" style="display: none;width: 150px;"><select class="select-form bottom_size_map"></select></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                variation_content += '</div>';
                $("#variation_row").append(variation_content);
                $("#variation_head").prepend('<div class="text-center" style="width: 150px; font-size: 12px;"><span style="width: 100%;">Items</span></div>');
            } else {
                var variation_type_len = $(".master_type_" + variation_type).length;
                if (variation_type_len != 0) {
                    variation_content = '<div class="col-md-12 per-row master_type_' + variation_type + '" style="display: flex;">';
                    variation_content += '<div class="text-center master_prev_6 master_prev" style="width: 150px;">' + val + '</div>';
                    variation_content += '<div class="gender_id" style="width: 150px;"><select class="select-form"><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
                    variation_content += '<div class="div_size" style="display: none;width: 150px;"><input name="age_range" class="input-form" /></div>';
                    variation_content += '<div class="div_size" style="display: none;width: 150px;"><select class="select-form bottom_size_map"></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                    variation_content += '</div>';
                    $("#variation_row").append(variation_content);
                } else {
                    var already_6 = $(".already_6").length;
                    if (already_6 == 0) {
                        $('<div class="text-center already_6 available_class_6" style="width: 150px;">' + val + '</div>').insertBefore(".gender_id");
                        $(".master_prev_4").removeClass("master_prev");
                        $('<div class="text-center" style="width: 150px; font-size: 12px;"><span style="width: 100%;">Items</span></div>').insertBefore("#gender_header");
                    } else {

                        var variation_element = document.querySelectorAll(".per-row");
                        var variation_tags = '';
                        var cart_div = document.getElementById("variation_row");
                        var hidden_value_6 = $('#hidden_value_6').val();
                        if (hidden_value_6 == 0) {
                            var length = variation_element.length;
                            $('#hidden_value_6').val(length);
                        } else {
                            var length = hidden_value_6;
                        }
                        for (var i = 0; i < length; i++) {
                            cart_div.innerHTML += '<div class="col-md-12 per-row current_val" style="display: flex;">' + variation_element[i].innerHTML + '</div>';
                            $('.current_val .available_class_6').text(val);
                        }
                        $(".per-row").removeClass("current_val");
                        console.log(variation_tags);
                    }
                }
            }
        } else if (variation_type == 7) {
            var len = $("#variation_row").children().length;
            if (len == 0) {
                variation_content = '<div class="col-md-12 per-row master_type_' + variation_type + '" style="display: flex;">';
                variation_content += '<div class="text-center master_prev_7 master_prev" style="width: 150px;">' + val + '</div>';
                variation_content += '<div class="gender_id" style="width: 150px;"><select class="select-form"><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
                variation_content += '<div class="div_size" style="display: none;width: 150px;"><input name="age_range" class="input-form" /></div>';
                variation_content += '<div class="div_size" style="display: none;width: 150px;"><select class="select-form bottom_size_map"></select></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
                variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                variation_content += '</div>';
                $("#variation_row").append(variation_content);
                $("#variation_head").prepend('<div class="text-center" style="width: 150px; font-size: 12px;"><span style="width: 100%;">Style</span></div>');
            } else {
                var variation_type_len = $(".master_type_" + variation_type).length;
                if (variation_type_len != 0) {
                    variation_content = '<div class="col-md-12 per-row master_type_' + variation_type + '" style="display: flex;">';
                    variation_content += '<div class="text-center master_prev_7 master_prev" style="width: 150px;">' + val + '</div>';
                    variation_content += '<div class="gender_id" style="width: 150px;"><select class="select-form"><option value="">-Select-</option><option value="Male">Male</option><option value="Female">Female</option><option value="Unisex">Unisex</option></select></div>';
                    variation_content += '<div class="div_size" style="display: none;width: 150px;"><input name="age_range" class="input-form" /></div>';
                    variation_content += '<div class="div_size" style="display: none;width: 150px;"><select class="select-form bottom_size_map"></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="color_map" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                    variation_content += '<div style="width: 150px;"><input name="your_price" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><input name="quantity" class="input-form" /></div>';
                    variation_content += '<div style="width: 150px;"><select class="select-form "><option value="">-Select-</option></select></div>';
                    variation_content += '</div>';
                    $("#variation_row").append(variation_content);
                } else {
                    var already_7 = $(".already_7").length;
                    if (already_7 == 0) {
                        $('<div class="text-center already_7 available_class_7" style="width: 150px;">' + val + '</div>').insertBefore(".gender_id");
                        $(".master_prev_4").removeClass("master_prev");
                        $('<div class="text-center" style="width: 150px; font-size: 12px;"><span style="width: 100%;">Style</span></div>').insertBefore("#gender_header");
                    } else {

                        var variation_element = document.querySelectorAll(".per-row");
                        var variation_tags = '';
                        var cart_div = document.getElementById("variation_row");
                        var hidden_value_7 = $('#hidden_value_7').val();
                        if (hidden_value_7 == 0) {
                            var length = variation_element.length;
                            $('#hidden_value_7').val(length);
                        } else {
                            var length = hidden_value_7;
                        }
                        for (var i = 0; i < length; i++) {
                            cart_div.innerHTML += '<div class="col-md-12 per-row current_val" style="display: flex;">' + variation_element[i].innerHTML + '</div>';
                            $('.current_val .available_class_7').text(val);
                        }
                        $(".per-row").removeClass("current_val");
                    }
                }
            }
        }
        if (variation_menu.includes(1)) {
            $(".div_size").css("display", "inline");
            getAllVariant(1);
        }
    }

    $("body").on("click", "#add_style_name", function() {
        let individual_style_name = $("#individual_style_name").val();

        if (individual_style_name != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' + individual_style_name + '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_color").append(badge);
            $("#individual_style_name").val(null);
            variationManage(6, individual_style_name);
        }
    });

    $("body").on("click", "#add_number_of_items", function() {
        let individual_number_of_items = $("#individual_number_of_items").val();

        if (individual_number_of_items != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' + individual_number_of_items + '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_color").append(badge);
            $("#individual_number_of_items").val(null);
            variationManage(6, individual_number_of_items);
        }
    });

    $("body").on("click", "#add_wattage", function() {
        let individual_wattage = $("#individual_wattage").val();

        if (individual_wattage != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' + individual_wattage + '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_color").append(badge);
            $("#individual_wattage").val(null);
            variationManage(5, individual_wattage);
        }
    });

    $("body").on("click", "#add_material_type", function() {
        let individual_material_type = $("#individual_material_type").val();

        if (individual_material_type != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' + individual_material_type + '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_color").append(badge);
            $("#individual_material_type").val(null);
            variationManage(4, individual_material_type);
        }
    });

    $("body").on("click", "#add_package_qty", function() {
        let individual_package_qty = $("#individual_package_qty").val();

        if (individual_package_qty != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' + individual_package_qty + '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_color").append(badge);
            $("#individual_package_qty").val(null);
            variationManage(3, individual_package_qty);
        }
    });

    $("body").on("click", "#add_individual_color", function() {
        let individual_color = $("#individual_color").val();

        if (individual_color != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' + individual_color + '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_color").append(badge);
            $("#individual_color").val(null);
            variationManage(2, individual_color);
        }
    });

    $("body").on("click", "#add_individual_size", function() {
        let individual_size = $("#individual_size").val();

        if (individual_size != "") {
            let badge = '<button type="button" class="btn btn-secondary position-relative m-2">' + individual_size + '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"><span class="visually-hidden">X</span></span></button>';
            $("#all_size").append(badge);
            $("#individual_size").val(null)
            variationManage(1, individual_size);
        }
    });

    $("body").on("click", ".variation_specify", function() {
        if (this.value == 1) {
            if ($(this).prop("checked") == true) {
                add_size = '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 18px;">Size </label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_size" placeholder="Size" aria-label="Size" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-success add_individual_size" id="add_individual_size">Add</button></div></div></div></div>';
                $("#add_size").append(add_size);
                $("#all_size").after('<div class="col-md-12 remove_sizer_hr"><hr></div>');
            } else if ($(this).prop("checked") == false) {
                $("#add_size").empty();
                $(".remove_size_hr").remove();
            }
        } else if (this.value == 2) {
            if ($(this).prop("checked") == true) {
                add_color = '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 18px;">Color </label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_color" placeholder="Color" aria-label="Size" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-success add_individual_color" id="add_individual_color">Add</button></div></div></div></div>';
                $("#add_color").append(add_color);
                $("#all_color").after('<div class="col-md-12 remove_color_hr"><hr></div>');
            } else if ($(this).prop("checked") == false) {
                $("#add_color").empty();
                $(".remove_color_hr").remove();
            }
        } else if (this.value == 3) {
            if ($(this).prop("checked") == true) {
                add_package_qty = '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 14px;">P. Qty </label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_package_qty" placeholder="Package Qty" aria-label="Package Qty" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-success add_individual_package_qty" id="add_individual_package_qty">Add</button></div></div></div></div>';
                $("#add_package_qty").append(add_package_qty);
                $("#all_package_qty").after('<div class="col-md-12 remove_package_qty_hr"><hr></div>');
            } else if ($(this).prop("checked") == false) {
                $("#add_package_qty").empty();
                $(".remove_package_qty_hr").remove();
            }
        } else if (this.value == 4) {
            if ($(this).prop("checked") == true) {
                add_material_type = '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 14px;">M. Type </label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_material_type" placeholder="Material Type" aria-label="Material Type" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-success add_individual_material_type" id="add_individual_material_type">Add</button></div></div></div></div>';
                $("#add_material_type").append(add_material_type);
                $("#all_material_type").after('<div class="col-md-12 remove_material_type_hr"><hr></div>');
            } else if ($(this).prop("checked") == false) {
                $("#add_material_type").empty();
                $(".remove_material_type_hr").remove();
            }
        } else if (this.value == 5) {
            if ($(this).prop("checked") == true) {
                add_wattage = '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 18px;">Wattage </label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_wattage" placeholder="Wattage" aria-label="Wattage" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-success add_individual_wattage" id="add_individual_wattage">Add</button></div></div></div></div>';
                $("#add_wattage").append(add_wattage);
                $("#all_wattage").after('<div class="col-md-12 remove_wattage_hr"><hr></div>');
            } else if ($(this).prop("checked") == false) {
                $("#add_wattage").empty();
                $(".remove_wattage_hr").remove();
            }
        } else if (this.value == 6) {
            if ($(this).prop("checked") == true) {
                add_number_of_items = '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 18px;">Number Of Items </label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_number_of_items" placeholder="Number Of Items" aria-label="Number Of Items" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-success add_individual_number_of_items" id="add_individual_number_of_items">Add</button></div></div></div></div>';
                $("#add_number_of_items").append(add_number_of_items);
                $("#all_number_of_items").after('<div class="col-md-12 remove_number_of_items_hr"><hr></div>');
            } else if ($(this).prop("checked") == false) {
                $("#add_number_of_items").empty();
                $(".remove_number_of_items_hr").remove();
            }
        } else if (this.value == 7) {
            if ($(this).prop("checked") == true) {
                add_style_name = '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 18px;">Style Name </label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_style_name" placeholder="Style Name" aria-label="Style Name" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-success add_individual_style_name" id="add_individual_style_name">Add</button></div></div></div></div>';
                $("#add_style_name").append(add_style_name);
                $("#all_style_name").after('<div class="col-md-12 remove_style_name_hr"><hr></div>');
            } else if ($(this).prop("checked") == false) {
                $("#add_style_name").empty();
                $(".remove_style_name_hr").remove();
            }
        }
    });

    $('#size').on('click', function(e) {
        if ($(this).prop("checked") == true) {
            add_size = '<div class="row mt-2"><div class="col-md-1"><label class="col-form-label" style="font-size: 18px;">Size</label></div><div class="col-md-6"><div class="input-group mb-3"><input type="text" class="form-control" id="individual_size" placeholder="Size" aria-label="Size" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-success add_individual_size" id="add_individual_size">Add</button></div></div></div></div>';
            $("#add_size").append(add_size);
            $("#all_size").after('<div class="col-md-12 remove_size_hr"><hr></div>');
        } else if ($(this).prop("checked") == false) {
            $("#add_size").empty();
            $(".remove_size_hr").remove();
        }
    });


    function variantByCategory(category) {
        let category_id = $("#" + category.id).val();
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: 'get-category/' + category_id,
            success: function(data) {
                const obj = JSON.parse(data['variation_type']);
                variation_option = '';

                variation_option += '<div class="col-md-4"><label class="float-md-right">Choose variation type</label></div>';
                for (const prop in obj) {
                    if (obj[prop] == 1) {
                        variation_option += '<div class="col-md-1"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="size" value="1" /><label class="form-check-label" for="size">Size</label></div></div>';
                    } else if (obj[prop] == 2) {
                        variation_option += '<div class="col-md-1"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="color" value="2" /><label class="form-check-label" for="color">Color</label></div></div>';
                    } else if (obj[prop] == 3) {
                        variation_option += '<div class="col-md-2"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="package_quantity" value="3" /><label class="form-check-label" for="package_quantity">Package Quantity</label></div></div>';
                    } else if (obj[prop] == 4) {
                        variation_option += '<div class="col-md-2"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="material_type" value="4" /><label class="form-check-label" for="material_type">Material Type</label></div></div>';
                    } else if (obj[prop] == 5) {
                        variation_option += '<div class="col-md-1"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="wattage" value="5" /><label class="form-check-label" for="wattage">Wattage</label></div></div>';
                    } else if (obj[prop] == 6) {
                        variation_option += '<div class="col-md-2"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="number_of_items" value="6" /><label class="form-check-label" for="number_of_items">Number Of Items</label></div></div>';
                    } else if (obj[prop] == 7) {
                        variation_option += '<div class="col-md-2"><div class="form-check form-check-inline"><input class="form-check-input mt-1 variation_specify" type="checkbox" id="style_name" value="7" /><label class="form-check-label" for="style_name">Style Name</label></div></div>';
                    }
                }
                $("#variation_type_content").empty();
                $("#variation_type_content").append(variation_option);
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
        const dropZoneElement = inputElement.closest(".drop-zone");

        dropZoneElement.addEventListener("click", (e) => {
            inputElement.click();
        });

        inputElement.addEventListener("change", (e) => {
            if (inputElement.files.length) {
                updateThumbnail(dropZoneElement, inputElement.files[0]);
            }
        });

        dropZoneElement.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropZoneElement.classList.add("drop-zone--over");
        });

        ["dragleave", "dragend"].forEach((type) => {
            dropZoneElement.addEventListener(type, (e) => {
                dropZoneElement.classList.remove("drop-zone--over");
            });
        });

        dropZoneElement.addEventListener("drop", (e) => {
            e.preventDefault();

            if (e.dataTransfer.files.length) {
                inputElement.files = e.dataTransfer.files;
                updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
            }

            dropZoneElement.classList.remove("drop-zone--over");
        });
    });

    /**
     * Updates the thumbnail on a drop zone element.
     *
     * @param {HTMLElement} dropZoneElement
     * @param {File} file
     */
    function updateThumbnail(dropZoneElement, file) {
        let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

        // First time - remove the prompt
        if (dropZoneElement.querySelector(".drop-zone__prompt")) {
            dropZoneElement.querySelector(".drop-zone__prompt").remove();
        }

        // First time - there is no thumbnail element, so lets create it
        if (!thumbnailElement) {
            thumbnailElement = document.createElement("div");
            thumbnailElement.classList.add("drop-zone__thumb");
            dropZoneElement.appendChild(thumbnailElement);
        }

        thumbnailElement.dataset.label = file.name;

        // Show thumbnail for image files
        if (file.type.startsWith("image/")) {
            const reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = () => {
                thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
            };
        } else {
            thumbnailElement.style.backgroundImage = null;
        }
    }

    function pro1(val) {
        document.getElementById(val).click();
    }

    $('#condition_note').summernote({
        height: 120
    });
    $('#product_description').summernote({
        height: 120
    });
    $('#warranty_description').summernote({
        height: 120
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