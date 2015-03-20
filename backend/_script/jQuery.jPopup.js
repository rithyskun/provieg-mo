/**
 * Transforme un formulaire en système de vote
 *
 * @example jQuery.jPopup.show(titre du popup, contenu, largeur, hauteur);
 * @example jQuery.jPopup.remove();
 *
 * @name jPopup
 * @type jQuery
 * @param Object	
 *  
 * @return jQuery
 * @cat Plugins/jPopup
 * @author Antoine Marcadet
 */
(function($) {
    $.extend({
        jPopup: {
            show: function(caption, divContent, width, height, oCss) {//function called when the user clicks on a thickbox link
            	if(typeof document.body.style.maxHeight === "undefined") {//if IE 6
            		$("body","html").css({height: "100%", width: "100%"});
            		$("html").css("overflow","hidden");
            		if(document.getElementById("TB_HideSelect") === null) {//iframe to hide select elements in ie6
            			$("body").append("<iframe id='TB_HideSelect'></iframe><div id='TB_overlay'></div><div id='TB_window'></div>");
            			$("#TB_overlay").click(this.remove);
            		}
            	}
                else {//all others
            		if(document.getElementById("TB_overlay") === null){
            			$("body").append("<div id='TB_overlay'></div><div id='TB_window'>");
            			$("#TB_overlay").click(this.remove);
            		}
            	}
            	
            	TB_WIDTH = width + 30 || 630;
            	TB_HEIGHT = height + 40 || 440;
            	ajaxContentW = TB_WIDTH - 30;
            	ajaxContentH = TB_HEIGHT - 45;
            	this.update();
            	
            	$("#TB_window").append("<div id='TB_caption'>"+caption+"</div>"+
                                        "<div id='TB_closeWindow'><a href='#' id='TB_closeWindowButton' title='Fermer'>Fermer</a> ou touche Echap</div>"+
                                        "<div id='TB_ajaxContent' class='TB_modal' style='width:"+ajaxContentW+"px;height:"+ajaxContentH+"px;'></div>");
                $("#TB_ajaxContent").append(divContent);			
            	$("#TB_window").fadeIn('slow');
                $("#TB_closeWindowButton").click(this.remove);
            	
            	document.onkeyup = function(e){ 	
            		if(e == null) { // ie
            			keycode = event.keyCode;
            		} else { // mozilla
            			keycode = e.which;
            		}
            		if(keycode == 27){ // close
            			this.remove();
            		}	
            	};
            },
            remove: function() {
             	$("#TB_imageOff").unbind("click");
            	$("#TB_overlay").unbind("click");
            	$("#TB_closeWindowButton").unbind("click");
            	$("#TB_window").fadeOut("slow",function(){$('#TB_window,#TB_overlay,#TB_HideSelect').remove();});
            	if(typeof document.body.style.maxHeight == "undefined") { //if IE 6
            		$("body","html").css({height: "auto", width: "auto"});
            		$("html").css("overflow","");
            	}
            	document.onkeydown = "";
            	return false;
            },
            update: function() {
                $("#TB_window").css({marginLeft: '-' + parseInt((TB_WIDTH / 2),10) + 'px', width: TB_WIDTH + 'px'});
            	$("#TB_window").css({marginTop: '-' + parseInt((TB_HEIGHT / 2),10) + 'px'});
            }
        }
    });
    
})(jQuery);
