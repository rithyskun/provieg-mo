<h1>Users list</h1>
<table id="table">
	<colgroup><col /><col /><col /><col /><col /></colgroup>
	<tr class="header">
		<td>Login</td>
		<td>Nickname</td>
		<td>Status</td>
		<td>Registration date</td>
		<td>Last connection</td>
	</tr>
	<fly:list name="user">
	<tr onclick="document.location='<fly:variable name='url_user' />'" 
        onmouseover="jQuery(this).addClass('over');"
        onmouseout="jQuery(this).removeClass('over');">
		<td><a href="<fly:variable name='url_user' />"><fly:variable name='login' /></a></td>
		<td><a href="<fly:variable name='url_user' />"><fly:variable name='nickname' /></a></td>
		<td><a href="<fly:variable name='url_user' />"><fly:variable name='lib_etat_user' /></a></td>
		<td><a href="<fly:variable name='url_user' />"><fly:variable name='date_inscription' /></a></td>
		<td><a href="<fly:variable name='url_user' />"><fly:variable name='date_connexion' /></a></td>
	</tr>
	</fly:list>
</table>
<script type="text/javascript">
  $(document).ready(function() {
      $('#table').tableFilter({ 
          imagePath: '<fly:variable name="rep_img" />',
          sortOnLoad: 2,
          stripeClass: 'impair',
          pageLength: 20
      });
  });
</script>