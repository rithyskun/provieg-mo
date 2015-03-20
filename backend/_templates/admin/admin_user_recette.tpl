<h3>Les recettes</h3>
<fly:include name="pagination" />
<fly:block name="liste">
<table>
	<col style="width: 250px;" />
	<col />
	<col />
	<thead>
		<tr>
			<td>Date</td>
			<td>Nom de la recette</td>
			<td class="droite">Etat</td>
		</tr>
	</thead>
	<tbody>
		<fly:list name="recette">
		<tr class="<fly:variable name='type_ligne' />"
               onclick="window.location='<fly:variable name='url_recette' />';"
			onmouseover="$(this).addClass('over');"
               onmouseout="$(this).removeClass('over');">
			<td><a href="<fly:variable name='url_recette' />"><fly:variable name='date' /></a></td>
			<td><a href="<fly:variable name='url_recette' />"><fly:variable name='nom_recette' /></a></td>
			<td class="droite"><a href="<fly:variable name='url_recette' />"><fly:variable name='etat' /></a></td>
		</tr>
		</fly:list>
	</tbody>
</table>
</fly:block>
<fly:block name="aucun">
	Aucune recette pour cet utilisateur
</fly:block>