<form action="<fly:variable name='url_action' />" method="post" enctype="multipart/form-data" id="form_upload_file" >
	<fieldset>
	    <legend>File Upload</legend>
		<dl class="table-display">						
			<dt><label for="file" title="">File path *</label></dt>
			<dd>
                <input type="file" name="files[]" accept="image/gif, image/jpeg, image/png" multiple class="oblig">
                <input type="hidden" name="MAX_FILE_SIZE" value="6000000" />
            </dd>
			<dt><input type="hidden" name="id_repertoire" id="id_repertoire" value="<fly:variable name='id_repertoire' />"></dt>
			<dd class="bouton"><input type="submit" name="upload_file" value="Upload file" class="bouton"></dd>
		</dl>
	</fieldset>
</form>
<script type="text/javascript">
    function upload_type() {
		return $.ajax({
			type: "POST",
			url: "<fly:variable name='root_ajax' />upload_type.php",
			data: $('#form_upload_file').formSerialize(),						
			async: false
		}).responseText;
	}
    $(document).ready(function() {
		$('#id_repertoire')
			.change(function() {
				$('#repertoire').html(upload_type());
			});
			
		$('#repertoire').html(upload_type());
	});
</script>