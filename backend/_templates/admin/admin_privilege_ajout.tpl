<form method="post">				
	<fieldset>
		<legend>Add a new access right</legend>	
		<dl class="table-display">					
			<dt><label for="intitule_privilege">Name *</label></dt>
			<dd>
				<input type="text" name="intitule_privilege" id="intitule_privilege" maxlength="255" size="50" class="oblig" />
				<input type="hidden" name="id_privilege" id="id_privilege" />
			</dd>
			
			<!--
<dt><label for="description_privilege">Description *</label></dt>
			<dd><textarea name="description_privilege" id="description_privilege" rows="10" cols="48" class="oblig"></textarea></dd>
-->
			
			<dt><label for="type_privilege">Type</label></dt>
			<dd>
				<select name="type_privilege" id="type_privilege">
					<fly:list name="option_privilege">
					<option value="<fly:variable name='id_type_privilege' />"><fly:variable name="lib_type_privilege" /></option>
					</fly:list>
				</select>
			</dd>
			<dd class="bouton"><input type="submit" name="submit" value="Create access right" class="bouton" /></dd>
	    </dl>
	</fieldset>		
</form>