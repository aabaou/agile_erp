jQuery.noConflict();
(function( $ ) {
  $(document).ready(function () {
    var html = '';
    $('#edit-field-metier-s-cible-s-').find('optgroup').each(function(){
      var content = '';
      $(this).find('option').each(function(){
        var checkd = '';
        if($(this).attr('selected')){
          checkd = 'checked';
        }
        content = content + '' +
        '<div class="js-form-item form-item js-form-type-checkbox form-type-checkbox js-form-item-field-modalites-pedagogiques-164 form-item-field-modalites-pedagogiques-164">'+
        '<input type="checkbox" id="'+$(this).html()+'" value="'+$(this).attr('value')+'" class="form-checkbox special-field" '+checkd+'>' +
        '<label class="option">'+$(this).html()+'</label>'+
        '</div>';
      });
      html = html + '<details class="required-fields js-form-wrapper form-wrapper" id="edit-group-metier-'+$(this).attr('label')+'">' +
      '<summary role="button" aria-pressed="false">'+$(this).attr('label')+'</summary>' +
      '<div class="details-wrapper">'+content+'</div>' +
      '</details>';
    });
    $(".field--name-field-metier-s-cible-s-").append(html);
    $("input.special-field").click(function(){
      $('#edit-field-metier-s-cible-s- option[value="'+$(this).attr('value')+'"]').prop('selected', true);
    });

    $("select#edit-field-metier-s-cible-s-target-id option").each(function(){
      var str = $(this).html();
      if(str.substr(0, 1) != "-" && str.substr(0, 2) != "- "){
        $(this).attr("disabled","disabled");
      }
    });
  });
})( jQuery );