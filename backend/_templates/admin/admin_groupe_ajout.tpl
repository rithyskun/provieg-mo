<form method="post">
	<fieldset>
		<legend>Add new group</legend>
		<dl class="table-display">
			<dt><label for="intitule_groupe">Name *</label></dt>
			<dd><input type="text" name="intitule_groupe" id="intitule_groupe" size="53" maxlength="255" class="oblig" /></dd>
			
            <dt><label for="description_groupe">Description *</label></dt>
			<dd><textarea name="description_groupe" id="description_groupe" rows="8" cols="50" class="oblig"></textarea></dd>
			
			<dd class="bouton"><input type="submit" value="Create group" class="bouton" /></dd>
		</dl>
	</fieldset>
</form>