var tError  = new Array();
var iGlobal = 0;
function recreateMiniature(i, id_repertoire, id_format, put_logo, overwrite) {
	var filename = $('#fichier_'+i).val();
	var rep_ajax = $('#rep_ajax').val();
	var nb_fichier = $('#nb_fichier').val();
	
	$.post(
		rep_ajax+'recreate_miniature.php',
	    {
			filename: filename,
			overwrite: overwrite,
			idRepertoire: id_repertoire,
			idFormat: id_format,
			putLogo: put_logo
		},
		function(data) {
		    iGlobal++;
		    var nbGlobal = $('#nb_global').html();
		    $('#progress_bar > div').css('width', (iGlobal*100/nbGlobal)+'%');
		    if(data.error) {
		        tError.push(data.filename);
		    	$('#output_error').append('<pre>'+data.msg+'</pre>');
		    }
		    $('#output').append('<pre>'+data.msg+'</pre>');
		    $('#nb_error').html((tError.length)?tError.length:'0');
		    $('#nb_traite').html(iGlobal);
		    if(++i != nb_fichier)
				recreateMiniature(i, id_repertoire, id_format, put_logo, overwrite);
			if(iGlobal == nbGlobal)
				$('#output_finish').ajaxStop(function() { $(this).show(); });
		}, 'json');
}
$(document).ready(function() {
    $('#create').click(function() {
        $('#output_finish').hide();
        $('#output_error').empty();
        $('#output').empty();
        $('#nb_traite').html('0');
        $('#nb_error').html('0');
        $('#nb_global').html('0');
		$('#progress_bar > div').css('width', '0%');
		iGlobal = 0;
        tError = new Array();
        var tFormat = new Array();
        var tLogo = new Array();
		var nb_fichier = $('#nb_fichier').val();
		var nb_format = $('#nb_format').val();
		var overwrite = ($("input[name='overwrite'][@value=1]").attr('checked')?1:0);
		var id_repertoire = $('#id_repertoire').val();
		for(var i=0; i<nb_format; i++) {
			if($('#format_'+i).attr('checked')) {
			    tFormat.push($('#format_'+i).attr('name'));
				tLogo.push($('#put_logo_'+i).attr('checked')?true:false);
				
			}
		}
        $('#nb_global').html(tFormat.length * nb_fichier);
		for(i in tFormat) recreateMiniature(0, id_repertoire, tFormat[i],tLogo[i], overwrite);
    });	
    $('#deploy_output').click(function() { $('#output').toggle(); }).css('cursor', 'pointer');
    $('#deploy_error').click(function() { $('#output_error').toggle(); }).css('cursor', 'pointer');
    
	$('.format_check').click(function(){
		if($(this).attr('checked')==false){
			maReg = new RegExp("([0-9]+)");
			ret = maReg.exec(this.id);
			$('#put_logo_'+ret[0]).attr('checked',$(this).attr('checked'));
		}
	});
	$('.putlogo_check').click(function(){
		if($(this).attr('checked')==true){	
			maReg = new RegExp("([0-9]+)");
			ret = maReg.exec(this.id);
			$('#format_'+ret[0]).attr('checked',$(this).attr('checked'));
		}
	});
	$('.check_type').click(function(){
		var image_type = "";
		$.each($('.check_type'), function() {
			image_type += ($('#'+this.id).attr('checked')==true?this.id:'')+',';
	    });
		$.post($('#rep_ajax').val()+"upload_repertoire_recreate_by_image_type.php", { imageType: image_type, id: $('#id_repertoire').val() },
		  function(data){
		    $('#list_input').html(data);
		  });
	});
});