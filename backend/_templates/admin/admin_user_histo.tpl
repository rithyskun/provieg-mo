<h3>Connexion history</h3>
<fly:block name="liste">
<table id="table">
	<colgroup><col style="width: 250px;" /><col /><col /></colgroup>
		<tr class="header">
			<td><a href="<fly:variable name='url_page' /><fly:variable name='url_date' />">Date</a></td>
			<td>Type</td>
			<td>Ip Adress</td>
		</tr>
		<fly:list name="histo">
		<tr class="<fly:variable name='type_ligne' />"	onmouseover="$(this).addClass('over');" onmouseout="$(this).removeClass('over');">
			<td><fly:variable name='date_connection' /></td>
			<td><fly:variable name='type_connection' /></td>
			<td><fly:variable name='ip_connection' /></td>
		</tr>
		</fly:list>
</table>
</fly:block>
<fly:block name="aucun">
No history for this user
</fly:block>
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