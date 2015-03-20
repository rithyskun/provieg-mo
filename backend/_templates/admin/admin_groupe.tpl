<h1>Groups list</h1>
<table id="table">
    <colgroup><col style="width: 250px;" /><col /></colgroup>
	<tr class="header">
		<td>Nom</td>
		<td>Description</td>
	</tr>
	<fly:list name="groupe">
	<tr onclick="document.location='<fly:variable name='url_groupe' />'" 
        onmouseover="jQuery(this).addClass('over');"
        onmouseout="jQuery(this).removeClass('over');">
		<td><a href="<fly:variable name='url_groupe' />"><fly:variable name='intitule_groupe' /></a></td>
		<td><a href="<fly:variable name='url_groupe' />"><fly:variable name='description_groupe' /></a></td>
	</tr>
	</fly:list>
</table>
<script type="text/javascript">
   $(document).ready(function() {
       $('#table').tableFilter({ 
           imagePath: '<fly:variable name="rep_img" />',
           sortOnLoad: 0,
           stripeClass: 'impair',
           pageLength: 20
       });
   });
</script>