/**
 * Gestion des drag'n'drop
 *
 *
 * @name tDrag
 * @type jQuery
 * @param Object	
 *  
 * @return jQuery
 * @cat Plugins/tDrag
 * @author Antoine Marcadet
 */
(function($) {
    jQuery.extend({
        tDrag: {
            dragged: null,
            helper: null,
            build: function(e) {
                if(!this.helper) {
        			jQuery('body',document).append('<div id="tDragHelper"></div>');
        			this.helper = jQuery('#tDragHelper');
        			this.helper.css({
                        position: 'absolute',
            			display: 'none',
            			cursor: 'move',
            			listStyle: 'none',
            			overflow: 'hidden'
                    });
        			
        			if(window.ActiveXObject) {
        				this.helper.css('unselectable', 'on');
        			} else {
            			this.helper.css({
                            mozUserSelect: 'none',
                			userSelect: 'none',
                			KhtmlUserSelect: 'none'
                        });
        			}
        		}
                return this.each(function() {
                
                });
            },
            dragInit: function(e) {
            
            },
            dragStart: function(e) {
            
            },
            dragMove: function(e) {
                if(jQuery.iDrag.dragged == null)
                    return;
                
                
            },
            dragStop: function(e) {
            	jQuery(document)
        			.unbind('mousemove', this.dragMove)
        			.unbind('mouseup', this.dragStop);
        
        		this.dragged = null;
            },
            dragDestroy: function(e) {
            
            }
        }
    });
    
    jQuery.fn.extend({
        tDraggable: jQuery.tDrag.build
    });
    
})(jQuery);
