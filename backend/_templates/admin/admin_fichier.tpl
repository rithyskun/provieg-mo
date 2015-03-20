<h1>Files list</h1>
<table id="table">
    <colgroup><col /><col /><col /><col /><col /></colgroup>
	<tr class="header">
        <td>Type</td>
		<td>Folder</td>
		<td>Name</td>
		<td>Menu Label</td>
		<td>Description</td>
	</tr>
	<fly:list name="fichier">
	<tr onclick="document.location='<fly:variable name='url_fichier' />'"
	    onmouseover="jQuery(this).addClass('over');"
        onmouseout="jQuery(this).removeClass('over');">
		<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='lib_type_fichier' /></a></td>
		<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='url_dossier' /></a></td>
		<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='nom_fichier' /></a>.php</td>
		<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='intitule_fichier' /></a></td>
		<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='description_fichier' /></a></td>
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