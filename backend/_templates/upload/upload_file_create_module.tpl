<form  action="<fly:variable name='url_action' />" method="post" enctype="multipart/form-data" id="form_upload_fichier_ajout">
	<fieldset>
	    <legend>File Upload</legend>
		<dl class="table-display">						
			<dt><label for="file" title="">File path *</label></dt>
			<dd>
                <input type="file" name="file" id="file" class="oblig" />
                <input type="hidden" name="MAX_FILE_SIZE" value="6000000" />
            </dd>
			
			<dt><label for="id_repertoire">Type *</label></dt>
			<dd>
				<select name="id_repertoire" id="id_repertoire">
					<fly:list name="repertoire">
					<option value="<fly:variable name='id_repertoire' />" <fly:variable name="selected"/>><fly:variable name="nom_repertoire" /></option>
					</fly:list>
				</select>							
			</dd>
			
            <dt>Repertoire *</dt>
			<dd><span id="repertoire"></span></dd>
			
            <dt><label for="nom_serveur" title="Filename on the server">Filename on the server *</label></dt>
			<dd><input id="nom_serveur" type="text" name="nom_serveur" value="<fly:variable name='nom_serveur' />" class="oblig" size="50" /><span id="extension_s"></span></dd>
			
            <dt><label for="nom_telechargement" title="File name to download">File name to download</label></dt>
			<dd><input id="nom_telechargement" type="text" name="nom_telechargement" value="<fly:variable name='nom_telechargement' />" size="50"/><span id="extension_t"></span></dd>
			
            <dt><label for="balise_alt" title="Balise alt">Balise alt</label></dt>
			<dd><input id="balise_alt" type="text" name="balise_alt" size="50" value="<fly:variable name='balise_alt' />" /></dd>
			
			<dd class="bouton"><input type="submit" name="upload_file" value="Send file" class="bouton" /></dd>
		</dl>
	</fieldset>
</form>
<script language="JavaScript" type="text/javascript">
    function recup_extension(){
        chaine = $('input[name="file"]').val();
        maReg = new RegExp("\.[a-zA-Z]*$");
        ret = maReg.exec(chaine);
        return ret[0];            
    }
    
    function upload_type() {
		return $.ajax({
			type: "POST",
			url: "<fly:variable name='root_ajax' />upload_type.php",
			data: $('#form_upload_fichier_ajout').formSerialize(),						
			async: false
		}).responseText;
	}
	
    $(document).ready(function() {
		$('#id_repertoire')
			.change(function() {
				$('#repertoire').html(upload_type());
			});
			
		$('#repertoire')
			.html(upload_type());
			
		$('input[name="file"]')
		   .change(function(){
                $('#extension_s').html(recup_extension());
                $('#extension_t').html(recup_extension());
           });
	});
</script>