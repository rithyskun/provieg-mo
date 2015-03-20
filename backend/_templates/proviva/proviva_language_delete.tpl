<fly:include name="detail" />			
<form action="proviva_language_delete.php?id=<fly:variable name='id' />" method="post">
	<fieldset>
		<legend>Please confirm deletion</legend>
		<dl class="table-display">
			<dt>Thanks to enter your password to confirm deletion</dt>
			<dd>
				<input type="password" name="pass" class="oblig" />
				<input type="submit" name="submit" value="Delete" class="bouton" />
			</dd>					
		</dl>
	</fieldset>	
</form>