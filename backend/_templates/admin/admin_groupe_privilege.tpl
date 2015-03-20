<fly:include name="include_groupe_privilege_ajout" />
<h3>Acces rights for group</h3>
<fly:include name="pagination" />
<fly:block name="liste">
<table>	
	<col style="width: 150px;" />
	<col style="width: 300px;" />	
	<thead>			
		<tr>
			<td><a href ="<fly:variable name='url_page' /><fly:variable name='url_type' />">Type</a></td>
			<td><a href ="<fly:variable name='url_page' /><fly:variable name='url_intitule' />">Name</a></td>
			<td><a href ="<fly:variable name='url_page' /><fly:variable name='url_description' />">Description</a></td>
			<td></td>
		</tr>
	</thead>
	<tbody>
		<fly:list name="privilege">
		<tr class="<fly:variable name='type_ligne' />" 
               onclick="document.location='<fly:variable name='url_privilege' />'"
			onmouseover="this.className='over'; this.style.cursor='hand'" 
               onmouseout="this.className = '<fly:variable name='type_ligne' />'">
			<td><a href="<fly:variable name='url_privilege' />"><fly:variable name='lib_type_privilege' /></a></td>
			<td><a href="<fly:variable name='url_privilege' />"><fly:variable name='intitule_privilege' /></a></td>
			<td><a href="<fly:variable name='url_privilege' />"><fly:variable name='description_privilege' /></a></td>
			<td class="droite"><fly:variable name='url_suppr' /></td>
		</tr>
		</fly:list>
	</tbody>
</table>
</fly:block>
<fly:block name="aucun">
	No access right in this group
</fly:block>