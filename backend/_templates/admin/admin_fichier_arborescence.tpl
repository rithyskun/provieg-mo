<fly:include name="include_ajout"/>
<div style="float: left; width: 48%;">
	<h3>Father of file</h3>
	<fly:block name="liste_pere">
		<table>	
			<col style="width: 200px;" />
			<thead>								
				<tr>
					<td>Name</td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<fly:list name="pere">
				<tr class="<fly:variable name='type_ligne_pere' />" onclick="document.location='<fly:variable name='url_fichier' />'"
					onmouseover="this.className='over'; this.style.cursor='hand'" onmouseout="this.className = '<fly:variable name='type_ligne_pere' />'">
					<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='nom_fichier_pere' />.php</a></td>
					<td class="droite"><fly:variable name='supprimer_pere' /></td>
				</tr>
				</fly:list>
			</tbody>
		</table>
	</fly:block>
	<fly:block name="aucun_pere">
		No father for this file
	</fly:block>
</div>				
<div style="float: right; width: 48%;">
	<h3>Children of file</h3>
	
	<fly:block name="liste_fils">
	<table>	
		<col style="width: 200px;" />
		<thead>							
			<tr>
				<td>Name</td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<fly:list name="fils">
			<tr class="<fly:variable name='type_ligne_fils' />" onclick="document.location='<fly:variable name='url_fichier' />'"
					onmouseover="this.className='over'; this.style.cursor='hand'" onmouseout="this.className = '<fly:variable name='type_ligne_fils' />'">
					<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='nom_fichier_fils' />.php</a></td>
				<td class="droite"><fly:variable name='supprimer_fils' /></td>
			</tr>
			</fly:list>
		</tbody>
	</table>
	</fly:block>
	<fly:block name="aucun_fils">
		No child for this file
	</fly:block>
</div>
<p class="clear"></p>