jQuery.fn.Infobulle = function(options) {

	var oThis = this;
             
	options = jQuery.extend({
	   
    }, options);
    	
    this.show = function() {
        $(options.bulle).fadeIn();
    };
    
    this.hide = function() {
        $(options.bulle).fadeOut("slow");
    };
    
    if(options.type == 'img'){
        $(options.bulle)
        .css({
            position: 'absolute',
            zIndex: '5'
        })
        .hide();
    }
    else{
    $(options.bulle)
        .css({
            position: 'absolute',
            background: 'white',
            border: '1px solid black',
            padding: '5px',
            zIndex: '5'
        })
        .hide();       
    }
    var timer = null;
    $(this)
        /*.click(function(e) {
            //alert($(document).scrollTop());
            //var documentOffset = $(document).offset();
            //alert('documentOffset.top: '+ documentOffset.top);
            
            var documentHeight = $(document).innerHeight();
            var documentWidth = $(document).innerWidth();
            alert('documentHeight: '+ documentHeight);
            
            var top = e.pageY+5;
            var left = e.pageX+5;
            alert('top: '+ top);
            
            var height = $(this).outerHeight();
            var width = $(this).outerWidth();
            alert('height: '+ height);
            
            var verticalLimit = top + height;
            var horizontalLimit = left + width;
            alert('verticalLimit: '+ verticalLimit);
            
            if(verticalLimit > documentHeight) {
                alert("trop bas");
            }
            else {
                alert("hauteur ok");
            }
            
            if(horizontalLimit > documentWidth) {
                alert("trop a droite");
            }
            else {
                alert("largeur ok");
            }
        
        })*/
        .mousemove(function(e) {
            $(options.bulle).css({
                top: e.pageY+5,
                left: e.pageX+5
            });
        })
        .mouseover(function(e) {   
            oThis.show();
            $(options.bulle).css({
                top: e.pageY,
                left: e.pageX
            });
            if(timer)
                clearTimeout(timer);
        })
        .mouseout(function() {  
            timer = setTimeout(function(){oThis.hide();}, 200);
        });
    
	return this;
};
