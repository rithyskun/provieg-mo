<h1>List of upload directories</h1>
<fly:block name="liste">
<table id="table">
    <colgroup><col /><col /><col /></colgroup>
	<tr class="header">
        <td>Name</td>
		<td>Path</td>
		<td>List MIME types accepted</td>
	</tr>
	<fly:list name="repertoire">
	<tr onclick="document.location='<fly:variable name='url_detail' />'" 
        onmouseover="jQuery(this).addClass('over');"
        onmouseout="jQuery(this).removeClass('over');">
		<td><a href="<fly:variable name='url_detail' />"><fly:variable name='nom_repertoire' /></a></td>
		<td><a href="<fly:variable name='url_detail' />"><fly:variable name='url_repertoire' /></a></td>
		<td><a href="<fly:variable name='url_detail' />"><fly:variable name='list_type_mime' /></a></td>
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
</fly:block>
<fly:block name="aucun">
    No directory has been created yet.
</fly:block>