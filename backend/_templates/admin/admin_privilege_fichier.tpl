<fly:include name="include_privilege_fichier_ajout" />
<h3>Give access right to :</h3>
<fly:include name="include_pagination" />			
<fly:block name="liste">
<table>	
	<thead>
		<tr>
			<td style="width: 200px;">File name</td>
			<td>Description</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
		<fly:list name="fichier">
		<tr class="<fly:variable name='type_ligne' />" onclick="document.location='<fly:variable name='url_fichier' />'"
			onmouseover="this.className='over'; this.style.cursor='hand'" onmouseout="this.className = '<fly:variable name='type_ligne' />'">
			<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='nom_fichier' /></a>.php</td>
			<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='description_fichier' /></a></td>
			<td class="droite"><fly:variable name='supprimer' /></td>
		</tr>
		</fly:list>
	</tbody>
</table>
</fly:block>
<fly:block name="nothing">
	No file for this access right
</fly:block>