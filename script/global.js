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

function isNumeric(sText) {
   var ValidChars = "0123456789";
   var IsNumber=true;
   var Char;
 
   for (var i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;
   
 }  
	
$(document).ready(function() {
    $(this)
        .find('form')
            .submit(function() { // validation des champs obligatoires
                var nb_error = 0;
                $(this)
                    .find('.oblig')
                        .each(function() {
                        	var data = $(this).val();
                        
                            if($.isBlank(data)) { // champ vide
                            
                                $(this)
                                    .addClass('error')
                                    .focus(function() { $(this).removeClass('error'); });   
                                nb_error++;
                            }
                        })
                    .end();
                if(nb_error != 0) {
                    alert('Please, fill all information to be completed.');
                    
                    scrollTo(0,0);
                    return false;
                }
                return true;
            })
        .end();
    /*	
     *  $.isBlank(" ") //true
	 *  $.isBlank("") //true
	 * 	$.isBlank("\n") //true
	 *  $.isBlank("a") //false
	 *  $.isBlank(null) //true
	 *  $.isBlank(undefined) //true
	 *  $.isBlank(false) //true
	 *  $.isBlank([]) //true
     */    
    $.isBlank = function(obj){
    	return(!obj || $.trim(obj) === '');
	};
});

/**********************************************************************************
 * To remove all accent characters, replace space by hiphen and return small letter  
 **********************************************************************************/
function removeAccents(str) {
	
	str = str.toLowerCase();

	str = str.replace(/[\u00E0\u00E1\u00E2\u00E3\u00E4\u00E5]/g,'a');
	str = str.replace(/[\u00E7]/g,'c');
	str = str.replace(/[\u00E8\u00E9\u00EA\u00EB]/g,'e');
	str = str.replace(/[\u00EC\u00ED\u00EE\u00EF]/g,'i');
	str = str.replace(/[\u00F2\u00F3\u00F4\u00F5\u00F6\u00F8]/g,'o');
	str = str.replace(/[\u00F9\u00FA\u00FB\u00FC]/g,'u');
	str = str.replace(/[\u00FD\u00FF]/g,'y');
	str = str.replace(/[\u00F1]/g,'n');
	str = str.replace(/[\u0153]/g,'oe');
	str = str.replace(/[\u00E6]/g,'ae');
	str = str.replace(/[\u00DF]/g,'ss');

	str = str.replace(/[^a-z0-9_\s\'\:\/\[\]-]/g,'');
	str = str.replace(/[\s\'\:\/\[\]-]+/g,' ');
	str = str.replace(/[ ]/g,'-');

	return str;
	
}