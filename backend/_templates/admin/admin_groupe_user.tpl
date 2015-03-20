<fly:include name="include_groupe_user_ajout" />
<h3>Group members</h3>
<fly:include name="include_pagination" />
<fly:block name="liste">
<table>				
	<thead>
		<tr>
			<td><a href ="<fly:variable name='url_page' /><fly:variable name='url_login' />">User login</a></td>
			<td></td>
		</tr>
	</thead>
	<tbody>
		<fly:list name="user">
		<tr class="<fly:variable name='type_ligne' />" onclick="document.location='<fly:variable name='url_user' />'"
			onmouseover="this.className='over'; this.style.cursor='hand'" onmouseout="this.className='<fly:variable name='type_ligne' />'">
			<td>
				<a href="<fly:variable name='url_user' />"><fly:variable name='login' /></a>
			</td>
			<td class="droite"><fly:variable name='url_suppr' /></td>
		</tr>
		</fly:list>
	</tbody>
</table>
</fly:block>
<fly:block name="aucun">
No user in this group
</fly:block>