<fly:include name="detail" />
<form action="upload_fichier_suppr.php?id=<fly:variable name='id_fichier' />" method="post">
	<fieldset>
		<legend>Removing a resource type</legend>	
		<dl class="table-display">									
			<dt>Please enter your password to confirm the deletion</dt>
			<dd>
				<input type="password" name="pass" class="champ"/>
				<input type="submit" name="submit" value="Remove" class="bouton" />
			</dd>
		</dl>
	</fieldset>
</form>