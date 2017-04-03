jQuery.noConflict();
(function( $ ) {
    $(document).ready(function () {
        var value = $('#edit-field-categorie-d-organisme').val();
        if (value == 56 || value == "56") {
            $('#edit-group-caracteristique-entreprise').css('display','block');
            $('#edit-group-perimetre-adhesion').css('display','block');
        }
        else if(value == 63 || value == "63"){
            $('#edit-group-perimetre-adhesion').css('display','block');
            $('#edit-group-caracteristique-entreprise').css('display','none');
        }
        else {
            $('#edit-group-perimetre-adhesion').css('display','none');
            $('#edit-group-caracteristique-entreprise').css('display','none');
        }

        var type = $('#edit-field-type-d-organisme').val();
        if (type == 66 || type == "66") {
            $('#edit-group-clauses-engagement').css('display','none');
        }

        $('#edit-field-type-d-organisme').change(function () {
            if ($(this).val() == 66 || $(this).val() == "66") {
                $('#edit-group-clauses-engagement').css('display','none');
            }else{
                $('#edit-group-clauses-engagement').css('display','block');
            }
        });

        $('#edit-field-categorie-d-organisme').change(function () {
            if ($(this).val() == 56 || $(this).val() == "56") {
                $('#edit-group-caracteristique-entreprise').css('display','block');
                $('#edit-group-perimetre-adhesion').css('display','block');
            }
            else if($(this).val() == 63 || $(this).val() == "63"){
                $('#edit-group-perimetre-adhesion').css('display','block');
                $('#edit-group-caracteristique-entreprise').css('display','none');
            }
            else {
                $('#edit-group-perimetre-adhesion').css('display','none');
                $('#edit-group-caracteristique-entreprise').css('display','none');
            }
        });
    });
})( jQuery );