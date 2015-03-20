<fly:include name="include_repertoire_mime_ajout" />
<h3>Types MIME autorisés pour ce répertoire</h3>
<fly:include name="include_pagination" />
<fly:block name="liste">
<table>				
	<thead>
		<tr>
			<td>Nom du type MIME</td>
			<td>Type MIME</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
		<fly:list name="mime">
		<tr class="<fly:variable name='type_ligne' />"
                     onmouseover="jQuery(this).addClass('over');"
                     onmouseout="jQuery(this).removeClass('over');">
			<td><fly:variable name='type_fichier' /></td>
			<td><fly:variable name='type_mime' /></td>
			<td class="droite"><fly:variable name='url_suppr' /></td>
		</tr>
		</fly:list>
	</tbody>
</table>
</fly:block>
<fly:block name="aucun">
	Aucun type MIME pour ce répertoire
</fly:block>