<fly:include name="infodoc" />
<h1>User details</h1>            
<form method="post" action="admin_user_pass.php?id=<fly:variable name='id_user' />"><h2>User login</h2>
<hr align="left" width="400" ><br />
	<dl class="detail">
		<dt>Login</dt>
		<dd><fly:variable name='login' /></dd>
		<fly:block name='block_pass'>
			<dt>Password</dt>						
			<dd><input type="submit" value="Clear" name="pass" class="bouton" /></dd>
		</fly:block>
		<dt>Status</dt>
		<dd><fly:variable name='lib_etat_user' /></dd>	
	</dl>
</form>
<fly:include name="admin_user_detail_nickname" />
<fly:include name="admin_user_detail_address" />
<fly:include name='menubar' />