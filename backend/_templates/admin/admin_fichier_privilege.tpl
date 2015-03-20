<fly:include name="include_ajout"/>
<h3>Access rights for file</h3>
<fly:block name="liste">
<table>	
	<col style="width: 150px;" />
	<col style="width: 250px;" />
	<thead>					
		<tr>
			<td>Type</td>
			<td>Name</td>
			<td>Description</td>
			<td class="droite"></td>
		</tr>
	</thead>
	<tbody>
		<fly:list name="privilege">
		<tr class="<fly:variable name='type_ligne' />" onclick="document.location='<fly:variable name='url_privilege' />'"
			onmouseover="this.className='over'; this.style.cursor='hand'" onmouseout="this.className = '<fly:variable name='type_ligne' />'">
			<td><a href="<fly:variable name='url_privilege' />"><fly:variable name='lib_type_privilege' /></a></td>
			<td><a href="<fly:variable name='url_privilege' />"><fly:variable name='intitule_privilege' /></a></td>	
			<td><a href="<fly:variable name='url_privilege' />"><fly:variable name='description_privilege' /></a></td>
			<td class="droite"><fly:variable name='supprimer' /></td>
		</tr>
		</fly:list>
	</tbody>
</table>
</fly:block>
<fly:block name="aucun">
	No access right for this file
</fly:block>