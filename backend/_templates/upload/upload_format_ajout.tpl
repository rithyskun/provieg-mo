<form method="post">
	<fieldset>
		<legend>Creating a format resize</legend>
		<dl class="table-display">
			<dt><label for="nom_format">Format name *</label></dt>
			<dd><input type="text" name="nom_format" id="nom_format" maxlength="255" size="40" class="oblig" value="<fly:variable name='nom_format' />" /></dd>
			
			<dt><label for="url_format">Directory *</label></dt>
			<dd><input type="text" name="url_format" id="url_format" maxlength="255" size="40" class="oblig" value="<fly:variable name='url_format' />" /></dd>
			
			<dt><label for="largeur">Width *</label></dt>
			<dd><input type="text" name="largeur" id="largeur" maxlength="255" size="10" class="oblig" value="<fly:variable name='largeur' />" /></dd>
			
            <dt><label for="hauteur">Hight *</label></dt>
			<dd><input type="text" name="hauteur" id="hauteur" maxlength="255" size="10" class="oblig" value="<fly:variable name='hauteur' />" /></dd>
				
			<dd class="bouton"><input type="submit" name="submit" value="Create format" class="bouton" /></dd>
		</dl>
	</fieldset>
</form>