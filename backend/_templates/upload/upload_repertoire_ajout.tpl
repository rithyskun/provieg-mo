<form method="post">
	<fieldset>
		<legend>Creation of an upload repertoire</legend>
		<dl class="table-display">
			<dt><label for="nom_repertoire">Name *</label></dt>
			<dd><input type="text" name="nom_repertoire" id="nom_repertoire" maxlength="255" size="60" class="oblig" value="<fly:variable name='nom_repertoire' />" /></dd>
			
			<dt><label for="url_repertoire">Path *</label></dt>
			<dd><input type="text" name="url_repertoire" id="url_repertoire" maxlength="255" size="60" class="oblig" value="<fly:variable name='url_repertoire' />" /></dd>
			 	
			<dd class="bouton"><input type="submit" name="submit" value="Create" class="bouton" /></dd>
		</dl>
	</fieldset>
</form>