<form action="admin_privilege_modif.php?id=<fly:variable name='id_privilege' />" method="post">
	<fieldset>
		<legend>Modify access right</legend>
		<dl class='table-display'>
			<dt><label for="intitule_privilege">Name *</label></dt>
			<dd><input type="text" name="intitule_privilege" id="intitule_privilege" value="<fly:variable name='intitule_privilege_donnee' />" maxlength="255" size="50" class="oblig" /></dd>
			<dt><label for="type_privilege">Type</label></dt>
			<dd>
				<select name="type_privilege" id="type_privilege">
					<fly:list name='option_privilege'>
					<option value="<fly:variable name='id_type_privilege' />" <fly:variable name='selected' />><fly:variable name='lib_type_privilege' /></option>
					</fly:list>
				</select>
			</dd>
		</dl>	
	</fieldset>		
	<input type="submit" value="Save" class="bouton" />
</form>