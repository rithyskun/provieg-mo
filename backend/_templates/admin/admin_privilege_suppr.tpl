<fly:include name="detail" />		
<form action="admin_privilege_suppr.php?id=<fly:variable name='id_privilege' />" method="post">
	<fieldset>
 	<legend>Delete access right</legend>
		<dl class="table-display">
			<dt>Please enter your password to confirm delete</dt>
			<dd>
               <input type="password" name="pass" class="oblig" />
               <input type="submit" name="submit" value="Delete !" class="bouton" />
            </dd>
		</dl>
	</fieldset>
</form>