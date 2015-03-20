jQuery.fn.AjaxSelect = function(options) {
    
    var oSelect = this;
    var timer = null;
	var timeout = null;
	var delay_search = 1000;
	
    options = jQuery.extend({
        input: '#debut',
        width_select: 0 
    }, options);
    
    if(options.width_select==0){ this.css('width', $(options.input).width()+4+'px');}
    else{ this.css('width', options.width_select+'px');}
    
    // le fichier php a utilisé n'a pas été spécifié
    if(options.file == null || options.file == '')
        return this;
        
    // si aucun id de formulaire n'a été passé en paramètre on prends le formulaire père du select
    if(options.form == null) 
        var oForm = this.parents('form');
    else // sinon on utilise l'id
        var oForm = $(options.form);
    
    // raffraichit la liste
    this.refreshSelect = function() {
        $(options.input).addClass('loader-on');
        var html = $.ajax({
                		type: "POST",
                		url: options.file,
                		data: oForm.formSerialize(),
                		async: false,
                		success: function(msg) {
                            $(options.input).removeClass('loader-on');
                        }
                	}).responseText;
        if(html) { 
            this.html(html);
            this.attr('disabled', false);
        }
        else { // si il n'y a aucun résultat, on desactive la liste et on met un message
            this.html('<option>No result</option>');
            this.attr('disabled', true);
        }
        // deselectionne les valeurs du select qui sont selectionnées
    	$('option', this).each(function() {
            this.selected = false;
        });
    };
    
    // bind le rafraichissement du select sur le champ input de saisie
      $(options.input)
        .keyup(function() {            
            if (timeout) clearTimeout(timeout);
				timeout = setTimeout(function(){
            		oSelect.refreshSelect();
            }, delay_search);
        })
        .addClass('loader');
    
    // bind le rafraichissement du select sur le changement des autres select
    if(options.select) {
        for(i in options.select) {
            $(options.select[i]).change(function() {
                oSelect.refreshSelect();
            });
        }
    }
    
    this.refreshSelect();
    
    return this;
    
};
