<fly:include name="detail" />			
<form action="admin_fichier_suppr.php?id=<fly:variable name='id_fichier' />" method="post">
	<fieldset>
		<legend>Confirm delete</legend>
		<dl class="table-display">
			<dt>Please enter your password to confirm delete</dt>
			<dd>
				<input type="password" name="pass" class="oblig" />
				<input type="submit" name="submit" value="Delete !" class="bouton" />
			</dd>					
		</dl>
	</fieldset>	
</form>