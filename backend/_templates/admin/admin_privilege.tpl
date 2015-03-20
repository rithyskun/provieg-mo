<h1>Access rights list</h1>
<table id="table">
	<colgroup>
        <col style="width: 150px;" />
    	<col style="width: 350px;" />
        <col />
    </colgroup>
	<tr class="header">
		<td>Type</td>
		<td>Name</td>
	
	</tr>
	<fly:list name="privilege">
	<tr onclick="document.location='<fly:variable name='url_privilege' />'"
        onmouseover="jQuery(this).addClass('over');"
        onmouseout="jQuery(this).removeClass('over');">
		<td><a href="<fly:variable name='url_privilege' />"><fly:variable name='lib_type_privilege' /></a></td>
		<td><a href="<fly:variable name='url_privilege' />"><fly:variable name='intitule_privilege' /></a></td>
	
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