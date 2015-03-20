<h3>Attach product to photos</h3>
<form action="<fly:variable name='url_action' />" method="post">
	<fieldset>
		<dl class="table-display">
			<dt><label for="debut_fichier">Search photos</label></dt>				
			<dd>
				<input type="text" name="debut_fichier" id="debut_fichier" maxlength="255" size="50">
				<input type="hidden" name="product_id" id="product_id" value="<fly:variable name='product_id' />">
				<input type="submit" name="add_photos" value="Attach" class="bouton" />
			</dd>
			<dd>
				<select name="id_fichier" id="id_fichier" size="13" class="oblig"></select>
				<span id="image"></span>
				<input type="hidden" name="ajax_file" id="ajax_file" value="<fly:variable name='ajax_file' />">			
				<input type="hidden" name="ajax_file_image" id="ajax_file_image" value="<fly:variable name='ajax_file_image' />">
			</dd>
		</dl>
	</fieldset>
</form>