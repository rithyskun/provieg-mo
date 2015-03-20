<h1>Liste des formats de redimensionnement</h1>
<fly:block name="liste">
<table id="table">
    <colgroup><col /><col /><col /></colgroup>
	<tr class="header">
        <td>Nom format</td>
		<td>Répertoire</td>
		<td>Dimensions (LxH)</td>
	</tr>
	<fly:list name="format">
	<tr onclick="document.location='<fly:variable name='url_detail' />'" 
        onmouseover="jQuery(this).addClass('over');"
        onmouseout="jQuery(this).removeClass('over');">
		<td><a href="<fly:variable name='url_detail' />"><fly:variable name='nom_format' /></a></td>
		<td><a href="<fly:variable name='url_detail' />"><fly:variable name='url_format' /></a></td>
		<td><a href="<fly:variable name='url_detail' />"><fly:variable name='dimension' /></a></td>
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
    Aucun format d'images n'a encore été créé
</fly:block>