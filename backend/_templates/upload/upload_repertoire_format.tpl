<fly:include name="include_repertoire_format_ajout" />
<h3>Formats de ce répertoire</h3>
<fly:include name="include_pagination" />
<fly:block name="liste">
<table>				
	<thead>
		<tr>
			<td>Nom du format</td>
			<td>Répertoire</td>
			<td>Largeur</td>
			<td>Hauteur</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
		<fly:list name="format">
		<tr class="<fly:variable name='type_ligne' />" 
               onclick="document.location='<fly:variable name='url_detail' />'" 
               onmouseover="jQuery(this).addClass('over');"
               onmouseout="jQuery(this).removeClass('over');">
			<td><a href="<fly:variable name='url_detail' />"><fly:variable name='nom_format' /></a></td>
			<td><a href="<fly:variable name='url_detail' />"><fly:variable name='url_format' /></a></td>
			<td><a href="<fly:variable name='url_detail' />"><fly:variable name='largeur' /></a></td>
			<td><a href="<fly:variable name='url_detail' />"><fly:variable name='hauteur' /></a></td>
			<td class="droite"><fly:variable name='url_recreate' /> <fly:variable name='url_suppr' /></td>
		</tr>
		</fly:list>
	</tbody>
</table>
</fly:block>
<fly:block name="aucun">
	Aucun format pour ce répertoire
</fly:block>