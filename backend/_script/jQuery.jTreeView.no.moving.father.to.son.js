/**
 * Gestion d'une arborescence
 * Prevented moving father to son
 *
 * @name tArbo
 * @type jQuery
 * @param Object	
 *  
 * @return jQuery
 * @cat Plugins/tArbo
 * @author Antoine Marcadet
 */ 
(function($) {

    var sortArrayObject = function (a, b) {
        if(a.name < b.name)
            return -1;
        if(a.name > b.name)
            return 1;
        return 0;
    };

    jQuery.fn.extend({
        swapClass: function(c1,c2) {
            return this.each(function(){
                var t = $(this);
                (!t.is('.'+c1)) ? t.addClass(c1).removeClass(c2) : t.addClass(c2).removeClass(c1);
            });
        },
        replaceClass: function(c1,c2) {
            return this.each(function(){
                var t = $(this);
                if(t.is('.'+c1))
                    t.removeClass(c1).addClass(c2);
            });
        },
        last: function() {
            return jQuery(this).eq(jQuery(this).size()-1);
        }
    });
    
})(jQuery);

/**
 * @TODO
 *      Suppression de la racine impossible
 *      Insertion d'un père dans son fils impossible  
 */
var permission=true;
var jTreeView = function(rootNode, object) {
    var oThis = this;
    this.rootNode = rootNode;
    
    this.build = function(tree, node) {
        var $ul = oThis.tree(node);
        for(var i=0, length=tree.length; i<length; i++)
            oThis.add(tree[i], $ul);
        oThis.update();
    };
        
    this.toggle = function(node) {
        if(!node.open)
        	oThis.open(node);
        else
        	oThis.close(node);
        
        oThis.update();
    };
        
    this.close = function(node) {
        node.open = false;
        jQuery(node).parent()
            .find('.textFolder:first').siblings('ul').hide().end().end()
            .filter('.collapsable').swapClass('collapsable', 'expandable').end()
            .filter('.lastCollapsable').swapClass('lastCollapsable', 'lastExpandable').end();
    };
    
    /**
     * Déploie le contenu d'un noeud
     * @param node : DOM Object du noeud
     */              
    this.open = function(node) {
        node.open = true;
        jQuery(node).parent()
            .find('.textFolder:first').siblings('ul').show().end().end()
            .filter('.expandable').swapClass('expandable', 'collapsable').end()
            .filter('.lastExpandable').swapClass('lastExpandable', 'lastCollapsable').end();
    };
    
    /**
    * set permission to link item
    */
    
    this.setPermission = function(val){
    	permission = val;    	
    };
    
    /**
     * Déplace un noeud
     * @param node : DOM Object du noeud déplacé
     * @param target : DOM Object de la cible
     */
     
    this.move = function(node, target) {
        var oldParent = node.parentNode;
        var newParent = target.parentNode;
        this.open(jQuery(target).siblings('.treeExpander'));
        
        /*jQuery(oldParent).css('border', '1px solid red');
        jQuery(newParent).css('border', '1px solid blue');
        alert('clear : ' + jQuery(oldParent).find(newParent).size());
        jQuery(oldParent).css('borderColor', 'transparent');
        jQuery(newParent).css('borderColor', 'transparent');
        if(jQuery(newParent, oldParent).size() != 0) {
            alert('Vous ne pouvez déplacer cet élément ici !');
            return false;
        }*/   
        
        // recupère le sous arbre où l'élément est ajouté
        var $ul = oThis.tree(newParent);
        
        // vérifie si il y a deja des fils dans le sous arbre
        if($ul.find('> li').size() > 0) {
            // il faut insérer à l'endroit correct alphabétiquement
            var textSource = jQuery(node).find('.textFolder').html();
            $ul
                .prepend(jQuery(node))
                .find('> li > .textFolder')
                    /*.filter(function() { return jQuery(this).html() < textSource; })*/
                    .last()
                        .parent()
                            .after(jQuery(node))
                            .replaceClass('lastExpandable', 'expandable')
                            .replaceClass('lastCollapsable', 'collapsable')
                            .replaceClass('lastItem', 'item');
        }
        else { // il n'y en a pas on se contente d'ajouter
            //alert('mech');
            $ul.append(jQuery(node));
        }
        
        // met à jour l'ancien parent
        var $li = jQuery('li', oldParent);
        if($li.size() == 0) { // plus de sous arborescence
            jQuery(oldParent)
                .parent()
                    .removeClass()
                    .addClass('treeItem item draggable')
                    .find('span.treeExpander').remove().end()
                .end()
                .remove();
        }
        
        oThis.update();
        return true;
    };
    
    /**
     * Supprime un noeud en mettant a jour sa sous arborescence
     * @param node : DOM Object du noeud
     */
    this.remove = function(node) {
        var parent = node.parentNode;
        var id = jQuery(node).attr('id');
        var level = id.substr(0,id.indexOf('+'));                                      
		if(level==1) return alert('You cannot do anything with page root!');
        var id_famille_arbo = id.substr(id.indexOf('-')+1, id.length);
        
        if(this.object.remove(id_famille_arbo)) {
            jQuery(node).remove();
            var $li = jQuery('li', parent);
            
            if($li.size() == 0) { // plus de sous arborescence
                jQuery(parent)
                    .parent()
                        .removeClass()
                        .addClass('treeItem item draggable')
                        .find('span.treeExpander').remove().end()
                    .end()
                    .remove();
            }
            oThis.update();
        }
    };
    
    /**
     * Renvoie le sous arbre d'un noeud, si jamais il n'y en a pas, on le créé
     * @param node : DOM Object du noeud
     */
    this.tree = function(node) {
        var $ul = jQuery(node).find('> ul.tree');
        
        if($ul.size() == 0) {
            $ul = jQuery(node)
                    .prepend('<span class="treeExpander">')
                    .find('span.treeExpander')
                        .unbind('click')
                        .click(function() {
                            this.open = true;
                            oThis.toggle(this);
                            jQuery(this)
                                .unbind('click')
                                .click(function() {
                                    oThis.toggle(this);
                                    
                                });
                        })
                    .end()
                    .append('<ul class="tree"></ul>').find('ul:last');
            if(jQuery(node).is('.treeItem'))
                jQuery(node)
                    .removeClass()
                    .addClass('treeItem collapsable draggable'); // ajoute le "-"
        }
        
        return $ul;
    };
    
    /**
     * Ajoute un noeud dans l'arbo
     * @param node : Object { id, name }
     * @param target : jQuery Object    
     */              
    this.add = function(node, target) {
        var $ul = target;
        
        ulNum = $('ul.tree').size();
        
        // il faut insérer à l'endroit correct alphabétiquement
        // création de l'élément             
        var $li = $('<li class="treeItem" id="'+ulNum+'+treeItem-'+node.id+'"><span class="treeExpander"></span><span class="imgFolder"></span><span class="textFolder">'+node.name+'</span></li>');
        if(node.array) {
            $li
                .addClass('expandable')
                .find('span.treeExpander')
                    .click(function() {
                        var $this = jQuery(this);
                        var id = $this.parent().attr('id');
                        var id_famille_arbo = id.substr(id.indexOf('-')+1, id.length);
                        
                        var array = oThis.object.read(id_famille_arbo);
                        oThis.build(array, this.parentNode);
                        oThis.open(this);
                        $this
                            .unbind('click')
                            .click(function() {
                                oThis.toggle(this);
                                //$(this).slideToggle('fast');
                            });
                    });
        }
        else {
            $li.addClass('item');
        }
        $li
            .addClass('draggable')
            .Draggable({
                revert : true,
                autoSize : true,
                ghosting : true,
                opacity: 0.5
            })
            .find('span.textFolder')
            	///New function by Rithy to hide its children for prevending move to its child\\\
            	.mousedown(function(event){
            		$(">ul",this.parentNode).hide();            		
	            	//currentClass =  jQuery(this.parentNode).attr("class").substr(jQuery(this.parentNode).attr("class").lastIndexOf(' '),jQuery(this.parentNode).attr("class").length);
	            	currentClass =  jQuery(this.parentNode).attr("class");
	            		            	
	            	if(currentClass=='treeItem draggable lastCollapsable'){	            	
	            		$(this.parentNode).removeClass('treeItem draggable lastCollapsable');
            			$(this.parentNode).addClass("treeItem draggable lastExpandable");
	            	}else 
	            	if(currentClass=='treeItem collapsable draggable'){	        	
	            		$(this.parentNode).removeClass('treeItem collapsable draggable');
            			$(this.parentNode).addClass("treeItem draggable expandable");
	            	}   
     			})
     			.mouseup(function(event){     			
     				//currentClass =  jQuery(this.parentNode).attr("class").substr(jQuery(this.parentNode).attr("class").lastIndexOf(' '),jQuery(this.parentNode).attr("class").length);
     				currentClass =  jQuery(this.parentNode).attr("class");
	            	
	            	if(currentClass=='treeItem draggable lastExpandable'){
	            		$(this.parentNode).removeClass('treeItem draggable lastExpandable');
	            		$(this.parentNode).addClass("treeItem draggable lastCollapsable");
	            	}else
	            	if(currentClass=='treeItem draggable expandable'){
	            		$(this.parentNode).removeClass('treeItem draggable expandable');
	            		$(this.parentNode).addClass("treeItem collapsable draggable");
	            	}
            		$(">ul",this.parentNode).show();    
     			})
     			//////////////////////////////////////////////////////////////////////
                .Droppable({
                    accept: 'draggable',
                    hoverclass: 'backDropOver',
                    activeclass: 'fakeClass',
                    tollerance: 'pointer',
                    onhover: function(dragged) {},
                    onout: function() {},
                    ondrop: function(dropped) {
                        if(this.parentNode == dropped)
                            return;                        
                        
                        var $dropped = jQuery(dropped);
                        if($dropped.is('.treeItem')) { // traitement des arborescences                        
                            if(oThis.move(dropped, this)) {
                                var id = jQuery(this).parent().attr('id');
                                var id_nouvelle_famille_arbo = id.substr(id.indexOf('-')+1, id.length);
                                
                                var id = $dropped.attr('id');
                                var id_famille_arbo_move = id.substr(id.indexOf('-')+1, id.length);
                                oThis.object.move(id_nouvelle_famille_arbo, id_famille_arbo_move);                                
                            }
                            return;
                        }
                        if($dropped.is('.fileItem')) { // ajout d'une famille dans une arbo
                        	
                            var id = jQuery(this).parent().attr('id');
                            var id_famille_arbo = id.substr(id.indexOf('-')+1, id.length);
                            
                            
                            var id = $dropped.attr('id');
                            var id_famille = id.substr(id.indexOf('-')+1, id.length);                            
                            /////////////////// NO add father to son \\\\\\\\\\\\\\\\\\\
                            if(id_famille_arbo=='None') return alert('Page root for this language is not exist!');
                            father = $("li .treeItem");
		                   
		                   /*// can use only if id of the list is id of item (id_page)
	                        jQuery.each(father,function() {
								fid = $(this).attr('id');
								fid = fid.substr(fid.indexOf('-')+1, fid.length);
								if(fid == id_famille){
									alert('No');
									oThis.setPermission(false);
									return false;
								}
								oThis.setPermission(true);
							});
							
							if(permission==false){
								alert('Cannot add father to son or to same page!');
								return;
							}
							*/
							///////////////////\\\\\\\\\\\\\\\\\\\
                            //if(id_famille_arbo != id_famille )/// Prevent father item is son item (effect only use direct id ,not id tree )
	                            //{	
		                            var id_arbo = oThis.object.link(id_famille_arbo, id_famille);
		                            var name = jQuery($dropped).html();
		                            var item = { id: id_arbo, name: name };
		                            var tree = oThis.tree(this.parentNode);
		                            oThis.add(item, tree);
		                            $('#debut').keyup();/// Refresh list item
	                            //}else alert('Can not add to same page!'); 
	                            
                            return;   
                        }
                    }
                })
            .end();
            
        var textSource = node.name;
        $ul
            .prepend($li)
            .find('> li > .textFolder')
                /*.filter(function() { return jQuery(this).html() < textSource; })*/
                .last()
                    .parent()
                        .after($li)
                        .replaceClass('lastExpandable', 'expandable')
                        .replaceClass('lastCollapsable', 'collapsable')
                        .replaceClass('lastItem', 'item');
        
        oThis.update();
    };
        
    this.update = function(node) {
        if(!node) node = oThis.rootNode;
        jQuery(node)
            .find('li.lastItem').swapClass('lastItem', 'item').end()
            .find('li:last-child')
                .filter('.expandable')
                    .swapClass('expandable', 'lastExpandable')
                .end()
                .filter('.collapsable')
                    .swapClass('collapsable', 'lastCollapsable')
                .end()
                .filter('.item')
                    .swapClass('item', 'lastItem');
    };

    this.object = object;
    this.build(this.object.init(), this.rootNode);
}