
jQuery.fn.goCollapse = function(zone, visible) {
    if(visible) {
        $(this).prepend('<span class="collapse_moins">');
    }
    else {
        $(this).prepend('<span class="collapse_plus">');
        zone.hide();
    }
    
    $(this)
        .find('span')
            .click(function() {
                $(this).toggleClass('collapse_moins').toggleClass('collapse_plus');
                zone.toggle();
            });
};

jQuery.fn.goEditable = function(settings) {
    settings = jQuery.extend({
        text: 'Cliquez ici pour ajouter du contenu'
    }, settings);
    
    if($(this).val() != '') {
        var val = $(this).val();
        $(this)
            .css('border', '1px solid white')
            .mouseover(function() { $(this).css({ border: '1px solid silver', background: '#edfebe' }); })
            .mouseout(function() { $(this).css({ border: '1px solid white', background: 'white' }); })
            .click(function() { $(this).css({ border: '1px solid silver', background: 'white' }).unbind(); });
    }
    else {
        var html = $(this).parent().html();
        $(this).parent().html('<a href="#">'+settings.text+'</a>').find('a').click(function() { $(this).parent().html(html); });
    }
};

String.prototype.trim = function() {
a = this.replace(/^\s+/, '');
return a.replace(/\s+$/, '');
};
/*
$(document).ready(function() {
    $(this)
        .find('form')
            .submit(function() { // validation des champs obligatoires
                var nb_error = 0;
                $(this)
                    .find('.oblig')
                        .each(function() {
                            var data = $(this).val();
                            if(data.trim() == '') { // champ vide
                            
                                $(this)
                                    .addClass('error')
                                    .focus(function() { $(this).removeClass('error'); });   
                                nb_error++;
                            }
                        })
                    .end();
                if(nb_error != 0) {
                    alert('Veuillez remplir le(les) champ(s) indiqué(s)');
                    scrollTo(0,0);
                    return false;
                }
                return true;
            })
        .end();
}); 
*/