<form method="post" enctype="multipart/form-data" id="form_upload_fichier_ajout">
	<fieldset>
	    <legend>File Upload</legend>
		<dl class="table-display">						
			<dt><label for="file" title="">File path *</label></dt>
			<dd>
                <input type="file" name="files[]" accept="image/gif, image/jpeg, image/png" multiple class="oblig">
                <input type="hidden" name="MAX_FILE_SIZE" value="6000000" />
            </dd>
			<dt><label for="id_repertoire">Type *</label></dt>
			<dd>
				<select name="id_repertoire" id="id_repertoire" class="oblig">
					<option value=""  disabled="disabled" selected="selected">-- Please, select directory --</option>
					<fly:list name="repertoire">
						<option value="<fly:variable name='id_repertoire' />"><fly:variable name="nom_repertoire" /></option>
					</fly:list>
				</select>							
			</dd>
            <dt>Repertoire *</dt>
			<dd><span id="repertoire"></span></dd>
			<dd class="bouton"><input type="submit" name="submit" value="Send file" class="bouton" /></dd>
		</dl>
	</fieldset>
</form>
<script type="text/javascript">
    function upload_type() {
		return $.ajax({
			type: "POST",
			url: "<fly:variable name='root_ajax' />upload_type.php",
			data: $('#form_upload_fichier_ajout').formSerialize(),						
			async: false
		}).responseText;
	}
    $(document).ready(function() {
		$('#id_repertoire').change(function() {
				$('#repertoire').html(upload_type());
			});
		$('#repertoire').html(upload_type());
	});
</script>