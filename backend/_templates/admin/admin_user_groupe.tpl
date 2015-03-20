<fly:include name="include_link"/>
<h3>Groups of this user</h3>
<fly:block name="liste">
<table>
   <cols style="width: 250px;" />
   	<thead>
   		<tr>
   			<td>Name</td>
   			<td>Description</td>
   			<td></td>
   		</tr>
   	</thead>
   	<tbody>
   		<fly:list name="groupe">
   		<tr class="<fly:variable name='type_ligne' />" onclick="document.location='<fly:variable name='url_groupe' />'"
   			onmouseover="this.className='over'; this.style.cursor='hand'" onmouseout="this.className = '<fly:variable name='type_ligne' />'">
   			<td>
   				<a href="<fly:variable name='url_groupe' />"><fly:variable name='intitule_groupe' /></a>
   			</td>
   			<td>
   				<a href="<fly:variable name='url_groupe' />"><fly:variable name='description_groupe' /></a>
   			</td>
   			<td class="droite"><fly:variable name='delete' /></td>
   		</tr>
   		</fly:list>
   	</tbody>
</table>
</fly:block>
<fly:block name="aucun">
No group for this user
</fly:block>