<fly:include name="groupe_detail" />
<form action="admin_groupe_suppr.php?id=<fly:variable name='id_groupe' />" method="post">
	<fieldset>
		<legend>Delete group</legend>	
		<dl class="table-display">									
			<dt>Please enter your password to confirm delete</dt>
			<dd>
				<input type="password" name="pass" class="oblig"/>
				<input type="submit" name="submit" value="Delete !" class="bouton" />
			</dd>
		</dl>
	</fieldset>
</form>