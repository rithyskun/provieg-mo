jQuery.fn.Editor = function(options) {

	var oThis = this;
	options = jQuery.extend({
        img: '_images/editor/',
		width: '505px',
		viewerHeight: '400px',
		viewerWidth: '610px'
    }, options);
	
	
	$(this).attr('id', '__editor_textarea');
	
	this.addText = function(txt) {
		var obj = window.document.getElementById('__editor_textarea');
    	obj.focus();
    	if(document.selection && document.selection.createRange) {
    		sel = document.selection.createRange();
    		if (sel.parentElement()==obj)//si sel est dans obj
    		sel.text = sel.text+txt;
    	}
    	else if(String(typeof obj.selectionStart)!="undefined") {
    	    // position du scroll
            oldPos = obj.scrollTop;        
            oldHght = obj.scrollHeight;
            
            // position du curseur
            pos = obj.selectionEnd + txt.length; 
            
    		sel = obj.selectionStart;
    		obj.value = (obj.value).substring(0,sel) + txt + (obj.value).substring(sel,obj.value.length);
            
            // repositionnement cuseur apr�s la balise fermante
            // peut �tre grandemant am�lior� ;-)
            obj.selectionStart = pos; 
            obj.selectionEnd = pos;   
            
            // calcul et application de la nouvelle bonne postion du scroll
            newHght = obj.scrollHeight - oldHght; 
            obj.scrollTop = oldPos + newHght;
    	}
    	else 
    		obj.value+=txt;
    	obj.focus();
    	oThis.refresh();
    }

    this.addTag = function(Tag, fTag) {
		var obj = window.document.getElementById('__editor_textarea');
    	obj.focus();
    	if(document.selection && document.selection.createRange){//if ie
    		sel = document.selection.createRange();
    		if(sel.parentElement()==obj)//si sel est dans obj
    			sel.text = Tag+sel.text+fTag;
    	}
    	else if(String(typeof obj.selectionStart)!="undefined") {
    	    // position du scroll
            oldPos = obj.scrollTop;        
            oldHght = obj.scrollHeight;
            
            // position du curseur
            pos = obj.selectionEnd + Tag.length + fTag.length; 
    	
    		var longueur= parseInt(obj.textLength);
    		var selStart = obj.selectionStart;
    		var selEnd = obj.selectionEnd;
    		if (selEnd == 2 || selEnd == 1) selEnd = longueur;
    		obj.value = (obj.value).substring(0,selStart) +
                		Tag +
                		(obj.value).substring(selStart,selEnd) +
                		fTag +
                		(obj.value).substring(selEnd,longueur);
            
            // repositionnement cuseur apr�s la balise fermante
            // peut �tre grandemant am�lior� ;-)
            obj.selectionStart = pos; 
            obj.selectionEnd = pos;   
            
            // calcul et application de la nouvelle bonne postion du scroll
            newHght = obj.scrollHeight - oldHght; 
            obj.scrollTop = oldPos + newHght;
    	}
    	else obj.value+=Tag+fTag;
    	obj.focus();
    	oThis.refresh();
    }
    
    this.getSelectedText = function() {
		var obj = window.document.getElementById('__editor_textarea');
    	obj.focus();
    	if(document.selection && document.selection.createRange){//if ie
    		sel = document.selection.createRange();
    		return sel.text;
    	}
    	else if(String(typeof obj.selectionStart)!="undefined") {
    		var longueur= parseInt(obj.textLength);
    		var selStart = obj.selectionStart;
    		var selEnd = obj.selectionEnd;
    		if (selEnd == 2 || selEnd == 1) selEnd = longueur;
        	return (obj.value).substring(selStart,selEnd);
    	}
    	else 
    	   return '';
    }
    
    this.removeSelectedText = function() {
		var obj = window.document.getElementById('__editor_textarea');
    	obj.focus();
    	if(document.selection && document.selection.createRange){//if ie
    		sel = document.selection.createRange();
    		if(sel.parentElement()==obj)//si sel est dans obj
    			sel.text = '';
    	}
    	else if(String(typeof obj.selectionStart)!="undefined") {
    		var longueur= parseInt(obj.textLength);
    		var selStart = obj.selectionStart;
    		var selEnd = obj.selectionEnd;
    		if (selEnd == 2 || selEnd == 1) selEnd = longueur;
    		obj.value = (obj.value).substring(0,selStart) + (obj.value).substring(selEnd,longueur);
    	}
    	obj.focus();
    	oThis.refresh();
    }
    
    this.replaceSelectedText = function(replacement) {
		var obj = window.document.getElementById('__editor_textarea');
    	obj.focus();
    	if(document.selection && document.selection.createRange){//if ie
    		sel = document.selection.createRange();
    		if(sel.parentElement()==obj)//si sel est dans obj
    			sel.text = replacement;
    	}
    	else if(String(typeof obj.selectionStart)!="undefined") {
    	    // position du scroll
            oldPos = obj.scrollTop;        
            oldHght = obj.scrollHeight;
            
            // position du curseur
            pos = obj.selectionEnd + replacement.length; 
            
    		var longueur= parseInt(obj.textLength);
    		var selStart = obj.selectionStart;
    		var selEnd = obj.selectionEnd;
    		if (selEnd == 2 || selEnd == 1) selEnd = longueur;
    		obj.value = (obj.value).substring(0,selStart) + replacement + (obj.value).substring(selEnd,longueur);
            
            // repositionnement cuseur apr�s la balise fermante
            // peut �tre grandemant am�lior� ;-)
            obj.selectionStart = pos; 
            obj.selectionEnd = pos;   
            
            // calcul et application de la nouvelle bonne postion du scroll
            newHght = obj.scrollHeight - oldHght; 
            obj.scrollTop = oldPos + newHght;
    	}
    	obj.focus();
    	oThis.refresh();
    }
    
    this.tabCallbackImage = new Array();
    this.callbackImage = function() {
        if(arguments[1] == '')
            return '';
        if(oThis.tabCallbackImage[arguments[1]]) {
            var data = oThis.tabCallbackImage[arguments[1]];
        }
        else {
            var data = eval('(' + $.ajax({
                type: "POST",
                url: '../_ajax/content/content_page_image_url.php',
                data: 'nom='+arguments[1],
                async: false
            }).responseText + ')');
            if(data.status == 0)
                return 'image introuvable';
            oThis.tabCallbackImage[arguments[1]] = data;
        }
        return '<img src="'+data.url+'" height="'+data.height+'" width="'+data.width+'"/>';
    };
    
	this.refresh = function() {
		
		$(iFrameDocument.body).css("background","none");
		var contenu = $(this).val();
		contenu = contenu.replace(/</g, '&lt;');
		contenu = contenu.replace(/>/g, '&gt;');
		contenu = contenu.replace(/&lt;title1&gt;([\s\S]*?)&lt;\/title1&gt;(\s)?/g, '<h1><span>$1</span></h1>');
		contenu = contenu.replace(/&lt;title2&gt;([\s\S]*?)&lt;\/title2&gt;(\s)?/g, '<h2>$1</h2>');
		contenu = contenu.replace(/&lt;title3&gt;([\s\S]*?)&lt;\/title3&gt;(\s)?/g, '<h3>$1</h3>');
		
		contenu = contenu.replace(/&lt;bold&gt;([\s\S]*?)&lt;\/bold&gt;/g, '<b>$1</b>');
		contenu = contenu.replace(/&lt;underline&gt;([\s\S]*?)&lt;\/underline&gt;/g, '<u>$1</u>');
		contenu = contenu.replace(/&lt;italic&gt;([\s\S]*?)&lt;\/italic&gt;/g, '<i>$1</i>');
		
		contenu = contenu.replace(/&lt;left&gt;([\s\S]*?)&lt;\/left&gt;(\s)?/g, '<div class="gauche">$1</div>');
		contenu = contenu.replace(/&lt;center&gt;([\s\S]*?)&lt;\/center&gt;(\s)?/g, '<div class="centre">$1</div>');
		contenu = contenu.replace(/&lt;right&gt;([\s\S]*?)&lt;\/right&gt;(\s)?/g, '<div class="droite">$1</div>');
		contenu = contenu.replace(/&lt;justify&gt;([\s\S]*?)&lt;\/justify&gt;(\s)?/g, '<div class="justifie">$1</div>');
		
		contenu = contenu.replace(/&lt;image-left&gt;([\s\S]*?)&lt;\/image-left&gt;?/g, '<div class="fgauche">$1</div>');
		contenu = contenu.replace(/&lt;image-right&gt;([\s\S]*?)&lt;\/image-right&gt;?/g, '<div class="fdroite">$1</div>');

		contenu = contenu.replace(/&lt;bullet&gt;/g, '<span class="puce">&#149;</span>');
        contenu = contenu.replace(/&lt;bouton-devis sujet="([\s\S]*?)"&gt;([\s\S]*?)&lt;\/bouton-devis&gt;/g, '<a href="javascript:;" class="ed_bouton">$2</a>');
        
        contenu = contenu.replace(/&lt;url address="([\s\S]*?)"(?: title="([\s\S]*?)")?&gt;([\s\S]*?)&lt;\/url&gt;/g, '<a href="javascript:;" title="$2">$3</a>');
        //contenu = contenu.replace(/&lt;mailto address="([\s\S]*?)"(?: subject="([\s\S]*?)")?&gt;([\s\S]*?)&lt;\/mailto&gt;/g, '<a href="javascript:;">$3</a>'); //'<a href="javascript:;">$3</a>');

 contenu = contenu.replace(/&lt;mailto&gt;/g, '<a href="javascript:;">contact@lanternesdumonde.com</a>'); //'<a href="javascript:;">$3</a>');
		contenu = contenu.replace(/&lt;image&gt;([\s\S]*?)&lt;\/image&gt;/g, oThis.callbackImage);
		
		contenu = contenu.replace(/\n/g, '<br />');
		
		iFrameDocument.body.innerHTML = contenu;
		
		$(iFrameDocument.body).wrapInner('<div name="zone-content" id="zone-content"></div>');
		$(iFrameDocument.body.childNodes[0]).css("left","0");//set zone-content left=0, to remove scroll
		
		return this;
	}
	
	/** CONSTRUCTION et COMPORTEMENT
	***********************************************************************************************************************/
	var oEditor = $(this).parent().append('<div id="__editor"></div>').find('#__editor');
	
	var divBtn = oEditor
        .append('<div id="__editor_div_btn"></div>')
        .find('#__editor_div_btn')
            .append('<select id="__editor_titre" class="__editor_bouton"></select>')
        		.find('#__editor_titre')
        		    .append('<option value="0" disabled="true">Title choice</option><option value="1">Title level 1</option><option value="2">Title level 2</option><option value="3">Title level 3</option>')
                    .change(function() {
        			    oThis.addTag('<title'+$(this).val()+'>', '</title'+$(this).val()+'>');
        			    $(this).val(0);
                    })
                    .val(0)
                .end()
            .append('<img src="'+options.img+'separator.gif" />')
            .append('<img src="'+options.img+'gras.gif" id="__editor_gras" class="__editor_bouton" title="Bold" />')
        		.find('#__editor_gras')
            		.click(function() {
            			oThis.addTag('<bold>', '</bold>');
            		})
            	.end()
            .append('<img src="'+options.img+'italique.gif" id="__editor_italique" class="__editor_bouton" title="Italic" />')
        		.find('#__editor_italique')
        			.click(function() {
        				oThis.addTag('<italic>', '</italic>');
        			})
        		.end()
            .append('<img src="'+options.img+'souligne.gif" id="__editor_souligne" class="__editor_bouton" title="Underline" />')
        		.find('#__editor_souligne')
        		    .click(function() {
        				oThis.addTag('<underline>', '</underline>');
        			})
        		.end()
            .append('<img src="'+options.img+'separator.gif" />')
            .append('<img src="'+options.img+'gauche.gif" id="__editor_gauche" class="__editor_bouton" title="Align left" />')
    			.find('#__editor_gauche')
    				.click(function() {
    					oThis.addTag('<left>', '</left>');
    				})
    			.end()
            .append('<img src="'+options.img+'centre.gif" id="__editor_centre" class="__editor_bouton" title="Center" />')
    			.find('#__editor_centre')
        			.click(function() {
        				oThis.addTag('<center>', '</center>');
        			})
        		.end()   
            .append('<img src="'+options.img+'droite.gif" id="__editor_droite" class="__editor_bouton" title="Align right" />')
    			.find('#__editor_droite')
    				.click(function() {
    					oThis.addTag('<right>', '</right>');
    				})
    			.end()
            .append('<img src="'+options.img+'justifie.gif" id="__editor_justifie" class="__editor_bouton" title="Justify" />')
    			.find('#__editor_justifie')
        			.click(function() {
        				oThis.addTag('<justify>', '</justify>');
        			})
        		.end()
            .append('<img src="'+options.img+'separator.gif" />')
            /*.append('<img src="'+options.img+'liste-numero.gif" id="__editor_liste_num" class="__editor_bouton" />')
    			.find('#__editor_liste_num')
    				.click(function() {
    					oThis.addTag('<liste-numero><puce>', '</puce></liste-numero>');
    				})
    			.end()*/
            .append('<img src="'+options.img+'liste-puce.gif" id="__editor_liste_puce" title="bullet" class="__editor_bouton" />')
    			.find('#__editor_liste_puce')
        			.click(function() {
        				oThis.addText('<bullet>');
        			})
        		.end()
            .append('<img src="'+options.img+'separator.gif" />')
            .append('<img src="'+options.img+'image-gauche.gif" id="__editor_image_gauche" class="__editor_bouton" title="Set an image to the left of the text" />')
    			.find('#__editor_image_gauche')
        			.click(function() {
        				oThis.addTag('<image-left>', '</image-left>');
        			})
                .end()
            .append('<img src="'+options.img+'image-droite.gif" id="__editor_image_droite" class="__editor_bouton" title="Set an image to the right of the text" />')
				.find('#__editor_image_droite')
    				.click(function() {
    					oThis.addTag('<image-right>', '</image-right>');
    				})
    			.end()
            .append('<img src="'+options.img+'separator.gif" />')
            .append('<img src="'+options.img+'image.gif" id="__editor_image" class="__editor_bouton" title="Insert image" />')
				.find('#__editor_image')
    				.click(function() {
    					var div = '<div>'+
                                  '<form method="post" id="__editor_upload_form">'+
                                  '<fieldset>' +
                                  '<dl class="table-display">' +
                                  '<dt>Search</dt>'+
                                  '<dd><input type="text" name="debut_nom_serveur" id="__editor_upload_input" size="40" /></dd>'+
                                  '<dt>Images</dt>'+
                                  '<dd><select id="__editor_upload_select" size="8"></select></dd>'+
                                  '<div id="view_photo"><span id="image"></span></div>' +// view photo
                                  '</dl>'+
                                  '<input type="button" id="__editor_upload_insert" value="Insert" class="bouton" />'+
                                  '</fieldset>' +
                                  '</form>'+
                                  '</div>';
                        $.jPopup.show("Rechercher un fichier envoy�", div, 500, 250);
                        $('#__editor_upload_select').AjaxSelect({
                            file: '../_ajax/upload/upload_fichier_nom_serveur_liste.php',
                            input: '#__editor_upload_input',
                            select: ['#__editor_upload_select_type']
                        }).click(function(){//click view photo***************************photo
							$('#image').html('<image src='+$('#__editor_upload_select').val()+'/>');
						}).keypress(function(event){
							  switch (event.keyCode) {
							  	case 38://up
								  $('#image').html('<image src='+$('#__editor_upload_select').val()+'/>');
								  break;
								case 40://down
								  $('#image').html('<image src='+$('#__editor_upload_select').val()+'/>');
								  break;
								default:
								break;
							  }
							});
						//end ********************************************************
                        $('#__editor_upload_insert').click(function() {
                            var nom_serveur = ($('#__editor_upload_select').val()).substring(($('#__editor_upload_select').val()).lastIndexOf('/')+1 ,($('#__editor_upload_select').val()).length) ;
							oThis.addText('<image>'+nom_serveur+'</image>');
                            $.jPopup.remove();
                        });
    				})
    			.end()           
            .append('<img src="'+options.img+'lien.gif" id="__editor_lien" class="__editor_bouton" title="Inserer un lien vers une page" />')
				.find('#__editor_lien')
    				.click(function() {
	    					var div = '<div>'+
	                                  '<form method="post" id="__editor_url_form">'+
		                                  '<fieldset>' +
		                                  '<dl class="table-display">' +
			                                  '<dt>Tab</dt>'+
			                                  '<dd class="big_width"><select id="__editor_tab_select" name="__editor_tab_select" size="1" style="width: 229px;"><option>Loading</option></select></dd>'+
			                                  '<dt>Search</dt>'+
			                                  '<dd class="big_width"><input type="text" name="debut_url" id="debut_url" size="40" /></dd>'+
			                                  '<dt>Url</dt>'+
			                                  '<dd class="big_width"><select id="__editor_url_select" size="8" style="width: 360px;"><option>Loading</option></select></dd>'+
		                                  '</dl>'+
		                                  '<input type="button" id="__editor_url_insert" value="Insert" class="bouton" />'+
		                                  '</fieldset>' +
		                                  '</form>'+
	                                  '</div>';
	                        $.jPopup.show("Rechercher un fichier envoye", div, 500, 250);
	                         $.ajax({
							   type: "POST",
							   data: "id=0",
							   	url: '../_ajax/webrank/webrank_url_tab_liste.php',
							   success: function(data_responed){
							   	 $('#__editor_tab_select').text('');
							     $('#__editor_tab_select').append(data_responed);
							     $('#__editor_url_select').AjaxSelect({
		                            file: '../_ajax/webrank/webrank_url_liste.php',
		                            input: '#debut_url',
		                            select: ['#__editor_tab_select'],
		                            width_select: 360
		                        })
							   }
							 });
							$("#__editor_url_select").css('width','360px');
							$("#__editor_url_select").css('width','360px');
							$("#__editor_url_select").ajaxComplete(function(request, settings){
								$(this).css('width','360px');
							});														
							
	    					$('#__editor_url_insert').click(function() {
	                            var nom_serveur = ($('#__editor_url_select').val()).substring(($('#__editor_url_select').val()).lastIndexOf('/')+1 ,($('#__editor_url_select').val()).length) ;
								
	                            oThis.addText('<url address="'+$('#__editor_url_select').val()+'" title="">'+nom_serveur+'</url>');
	                            $.jPopup.remove();
	                        })
                     })
    			.end()
            .append('<img src="'+options.img+'url.gif" id="__editor_url" class="__editor_bouton" title="Insert a link to another site" />')
				.find('#__editor_url')
    				.click(function() {
    					//oThis.addTag('<url>', '</url>');
    					var selected = oThis.getSelectedText();
    					
                        if(selected) 
                            oThis.replaceSelectedText('<url address="http://" title="" target="_blank">'+selected+'</url>');
                        else
                            oThis.replaceSelectedText('<url address="http://" title="" target="_blank">Link</url>');
    				})
    			.end()
            .append('<img src="'+options.img+'separator.gif" />')
            //.append('<img src="'+options.img+'devis.gif" id="__editor_btn_devis" class="__editor_bouton" title="Ins�rer un bouton de demande de devis" />')
//				.find('#__editor_btn_devis')
//    				.click(function() {
//    					oThis.addText('<bouton-devis sujet="Demander un devis pour '+$('#nom_categorie').val()+'">Demander un devis</bouton-devis>');
//    				})
//    			.end()
            .append('<img src="'+options.img+'mailto.gif" id="__editor_mailto" class="__editor_bouton" title="Insert a mailto link" />')
				.find('#__editor_mailto')
    				.click(function() {
    					//oThis.addText('<mailto mail="" sujet="">Envoyez un email</mailto>');
                        var selected = oThis.getSelectedText();
                        var mail;
                        if(selected) 
                            oThis.replaceSelectedText('<mailto>'+selected+'</mailto>');
                        else
                            oThis.replaceSelectedText('<mailto>');
    				})
    			.end();
    
    oEditor.append(this);
	
	
    //****** IFRAME APERCU *****//
	//var divApercu = oEditor.append('<div id="__editor_apercu"></div>').find('#__editor_apercu');
	var divApercu = oEditor.append('<iframe id="__editor_apercu"></iframe>').find('#__editor_apercu');
	var iFrame = divApercu.get(0); 
	//alert(typeof iFrame);
	
    if($.browser.ie) {
		var iFrameWindow = frames['__editor_apercu'];
		var iFrameDocument = frames['__editor_apercu'].document;
	}
	else {
		var iFrameWindow = document.getElementById('__editor_apercu').contentWindow;
		var iFrameDocument = document.getElementById('__editor_apercu').contentDocument;
	}
	
	
	// mise en �dition de l'iFrame
    //alert(iFrameDocument);
	//alert('test');
    iFrameDocument.open();
	//alert('test');
    iFrameDocument.close();
//**************************************************	
	var link = document.createElement('link');
	link.href = '../../style/editor.css';
	link.type = 'text/css';
	link.rel  = 'stylesheet';
	iFrameDocument.body.parentNode.firstChild.appendChild(link);
	
	var link2 = document.createElement('link');
	link2.href = '../../style/common.css';
	link2.type = 'text/css';
	link2.rel  = 'stylesheet';
	iFrameDocument.body.parentNode.firstChild.appendChild(link2);
	
	var link3 = document.createElement('link');
	link3.href = '../../style/style.css';
	link3.type = 'text/css';
	link3.rel  = 'stylesheet';
	iFrameDocument.body.parentNode.firstChild.appendChild(link3);
	
	var link4 = document.createElement('link');
	link4.href = '../../style/background.css';
	link4.type = 'text/css';
	link4.rel  = 'stylesheet';
	iFrameDocument.body.parentNode.firstChild.appendChild(link4);
//*****************************************************	
	
	$(this).keyup(function() {
		oThis.refresh();		
	});
	
	/** MISE EN FORME
	***********************************************************************************************************************/
	// style des boutons
	$('.__editor_bouton')
        .css({
            margin: '0 2px 0 2px',
            border: '1px solid #d9f09a',
            cursor: 'pointer'
        })
    	.mouseover(function() { 
            $(this).css({
                border: '1px solid #719512',
            }); 
        })
        .mouseout(function() { $(this).css('border', '1px solid #d9f09a'); });
    $('#__editor_titre').css({
        position: 'relative',
        top: '-5px'
    });
	// style de la div contenant les boutons
	divBtn.css({
		background: '#d9f09a',
		border: '1px solid #719512',
		padding: '3px',
		height: '22px'
	});
	// style de la texterea 
   	$(this).css({
   	    height: options.viewerHeight,
		margin: '0px',
		border: '1px solid #719512',
		position: 'relative',
		top: '-2px',
		zIndex: '1'
	});
	// style de la div d'apercu
    divApercu.css({
		border: '1px dashed #719512',
		height: oThis.height(), /*.viewerHeight,*/
		position: 'relative',
		top: '-1px',
		overflow: 'auto'
	});
	
	if(options.width) {
		$(this).css('width', options.width);
		divApercu.css('width', options.viewerWidth);
		divBtn.css('width', this.outerWidth()-8);
	}

	
    this.refresh();
    
    
	return this;
};

/*
http://www.4claverie.com/forums/index.php?showtopic=3904
http://www.siteduzero.com/tuto-3-1982-1-creation-d-un-bbcode-et-apercu-en-direct.html
http://actuel.fr.selfhtml.org/articles/javascript/bbcode/index.htm
http://www.vulgarisation-informatique.com/source-24--editeur-wysiwyg-avec-coloration-syntaxique.php
*/
