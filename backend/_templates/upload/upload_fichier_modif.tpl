<form method="post">
	<fieldset>
	    <legend>File modification</legend>
		<dl class="table-display">
			<dt><label for="titre">Title</label></dt>
			<dd><input type="text" name="titre" id="titre" value="<fly:variable name='titre' />" size="60" /></dd>
			
			<dt><label for="balise_alt">Balise alt</label></dt>
			<dd><input type="text" name="balise_alt" id="balise_alt" value="<fly:variable name='balise_alt' />" size="60" /></dd>

			<dt><label for="description">Description</label></dt>
			<dd><textarea name="description" id="description" cols="57" rows="6"><fly:variable name='description' /></textarea></dd>
		</dl>
	</fieldset>
	<input type="submit" name="submit" value="Modify" class="bouton" />
</form>