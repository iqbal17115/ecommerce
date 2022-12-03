<script>
    $(document).ready(function() {

        $('#ads_type').on('change', function() {
            var ads_style = $('#ads_style').val();
            $('#ads_content').empty();
            var ads_content = "";
            if (ads_style == 1 && this.value==2) {
                ads_content += "<div class='col-md-6'><div class='form-group'><label for='ads_type'>Image1</label><input type='file' name='images[]' id='images[]' class='form-control'></div></div><div class='col-md-6'><div class='form-group'><label for='ads_type'>URL1</label><input type='text' name='urls[]' id='images[]' class='form-control' placeholder='e.g. http://zainsoft.com'></div></div>";
            } else if (ads_style == 2 && this.value==2) {
                ads_content += "<div class='col-md-6'><div class='form-group'><label for='ads_type'>Image1</label><input type='file' name='images[]' id='images[]' class='form-control'></div></div><div class='col-md-6'><div class='form-group'><label for='ads_type'>URL1</label><input type='text' name='urls[]' id='images[]' class='form-control' placeholder='e.g. http://zainsoft.com'></div></div><div class='col-md-6'><div class='form-group'><label for='ads_type'>Image2</label><input type='file' name='images[]' id='images[]' class='form-control'></div></div><div class='col-md-6'><div class='form-group'><label for='ads_type'>URL2</label><input type='text' name='urls[]' id='images[]' class='form-control' placeholder='e.g. http://zainsoft.com'></div></div>";
            } else if (ads_style == 3 && this.value==2) {
                ads_content += "<div class='col-md-6'><div class='form-group'><label for='ads_type'>Image1</label><input type='file' name='images[]' id='images[]' class='form-control'></div></div><div class='col-md-6'><div class='form-group'><label for='ads_type'>URL1</label><input type='text' name='urls[]' id='images[]' class='form-control' placeholder='e.g. http://zainsoft.com'></div></div><div class='col-md-6'><div class='form-group'><label for='ads_type'>Image2</label><input type='file' name='images[]' id='images[]' class='form-control'></div></div><div class='col-md-6'><div class='form-group'><label for='ads_type'>URL2</label><input type='text' name='urls[]' id='images[]' class='form-control' placeholder='e.g. http://zainsoft.com'></div></div><div class='col-md-6'><div class='form-group'><label for='ads_type'>Image3</label><input type='file' name='images[]' id='images[]' class='form-control'></div></div><div class='col-md-6'><div class='form-group'><label for='ads_type'>URL3</label><input type='text' name='urls[]' id='images[]' class='form-control' placeholder='e.g. http://zainsoft.com'></div></div>";
            } else if (ads_style == 1 && this.value==1) {
                ads_content += "<div class='col-md-12'><div class='form-group'><label for='ads_type'>Embed Code1</label><textarea name='embed_code[]' id='embed_code[]' class='form-control' placeholder='Embed Code'></textarea></div></div>";
            } else if (ads_style == 2 && this.value==1) {
                ads_content += "<div class='col-md-12'><div class='form-group'><label for='ads_type'>Embed Code1</label><textarea name='embed_code[]' id='embed_code[]' class='form-control' placeholder='Embed Code'></textarea></div></div><div class='col-md-12'><div class='form-group'><label for='ads_type'>Embed Code2</label><textarea name='embed_code[]' id='embed_code[]' class='form-control' placeholder='Embed Code'></textarea></div></div>";
            } else if (ads_style == 3 && this.value==1) {
                ads_content += "<div class='col-md-12'><div class='form-group'><label for='ads_type'>Embed Code1</label><textarea name='embed_code[]' id='embed_code[]' class='form-control' placeholder='Embed Code'></textarea></div></div><div class='col-md-12'><div class='form-group'><label for='ads_type'>Embed Code2</label><textarea name='embed_code[]' id='embed_code[]' class='form-control' placeholder='Embed Code'></textarea></div></div><div class='col-md-12'><div class='form-group'><label for='ads_type'>Embed Code3</label><textarea name='embed_code[]' id='embed_code[]' class='form-control' placeholder='Embed Code'></textarea></div></div>";
            }
            ads_content += "</div>";
            $("#ads_content").append(ads_content);
        });

    });
</script>