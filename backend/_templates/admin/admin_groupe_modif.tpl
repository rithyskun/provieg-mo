<form action="admin_groupe_modif.php?id=<fly:variable name='id_groupe' />" method="post">
	<fieldset>
		<legend>Modify group</legend>
		<dl class="table-display">
			<dt><label for="intitule_groupe">Name *</label></dt>
			<dd><input type="text" name="intitule_groupe" id="intitule_groupe" value="<fly:variable name='intitule_groupe_donnee' />" class="oblig" maxlength="255" size="50" class="champ" /></dd>					
			
            <dt><label for="description_groupe">Description *</label></dt>
			<dd><textarea name="description_groupe" id="description_groupe" rows="8" cols="47" class="oblig"><fly:variable name='description_groupe_donnee' /></textarea></dd>
			
			<dd class="bouton"><input type="submit" value="Modify group" class="bouton" /></dd>
		</dl>											
	</fieldset>
</form>