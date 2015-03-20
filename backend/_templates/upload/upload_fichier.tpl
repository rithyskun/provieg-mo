<h1>List files</h1>
<fly:block name="liste">
<table id="table">	
    <colgroup>
    	<col style="width: 15px;" />
    	<col style="width: 50px;" />
    	<col style="width: 50px;" />
    	<col style="width: 200px;" />
    	<col style="width: 200px;" />
    	<col style="width: 150px;" />
    	<col style="width: 200px;" />
    </colgroup>
	<tr class="header">
		<td>Image</td>
		<td>Date</td>
		<td>User</td>
		<td>Repertoire</td>
		<td>Name on server</td>
		<td>Name initial</td>
		<td>Type MIME</td>
	</tr>
	<fly:list name="fichier">
	<tr onclick="document.location='<fly:variable name='url_fichier' />'" 
        onmouseover="jQuery(this).addClass('over');"
        onmouseout="jQuery(this).removeClass('over');">
    	<td><a rel="<fly:variable name='preview_admin' />" onclick="document.location='<fly:variable name='url_fichier' />'" class="preview"><img src="<fly:variable name='min_admin' />" /></a></td>
		<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='date_upload' /></a></td>
		<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='login_createur' /></a></td>
		<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='url_repertoire' /></a></td>
		<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='nom_serveur' /></a></td>    			
		<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='nom_initial' /></a></td>
		<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='type_mime' /></a></td>
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
    No files have been send online
</fly:block>