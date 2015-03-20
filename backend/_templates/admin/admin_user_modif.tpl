<form action="admin_user_modif.php?id=<fly:variable name='id_user'/>" method="post">
    <fieldset>
        <legend>Modify user</legend>
	    <dl class="table-display">    			
			<dt><label for="login_user" >Login *</label></dt>
			<dd><input type="text" name="login_user" id="login_user" maxlength="255" value="<fly:variable name='login_donnee' />" class="oblig" /></dd>		
			<dt><label for="country" >Status</label></dt>
			<dd>
				<select name="status" id="status"> 
					<fly:list name="list_name_status">	
						<option value="<fly:variable name='id_status'/>"  <fly:variable name='selected'/>><fly:variable name='status'/></option>
					</fly:list>
				</select>
			</dd>
		</dl>
	</fieldset>
	<input type="submit" value="Modify" class="bouton" />				
</form>