<h1>Menu order</h1>
<form action="admin_menu.php?id=<fly:variable name='id_onglet' />" method="post">
	<table>	
		<thead>
			<tr>
				<td style="width: 10px;">Order</td>
				<td style="width: 100px;"></td>
				<td style="width: 100px;">Folder</td>
				<td style="width: 200px;">Menu Label</td>
				<td>Description</td>
			</tr>					
		</thead>
		<tbody>
			<fly:list name="fichier">
			<tr class="<fly:variable name='type_ligne'/>"
				onmouseover="$(this).addClass('over');" 
				onmouseout="$(this).removeClass('over');">
				<td>
					<input type="text" name="<fly:variable name='id_fic'/>" value="<fly:variable name='ordre_donnee'/>" size="1"/>
				</td>
				<td></td>
				<td>
					<a href="<fly:variable name='url_fichier'/>"><fly:variable name='url_lib_dossier'/></a>
				</td>
				<td>
					<a href="<fly:variable name='url_fichier'/>"><fly:variable name='intitule_fichier'/></a>
				</td>
				<td>
					<a href="<fly:variable name='url_fichier'/>"><fly:variable name='description_fichier'/></a>
				</td>
			</tr>
			</fly:list>
		</tbody>
	</table>
	<input type="submit" name="onglet" value="Validate" class="bouton" /> 
</form>
<fly:block name="sous_menu">
<h1>Order submenu : <fly:variable name='nom_onglet'/></h1>
<form action="admin_menu.php?id=<fly:variable name='id_onglet'/>" method="post">
	<table>	
		<thead>
			<tr>
				<td style="width: 10px;">Order</td>
				<td style="width: 100px;"></td>
				<td style="width: 100px;">Folder</td>
				<td style="width: 200px;">Menu Label</td>
				<td>Description</td>
			</tr>					
		</thead>
		<tbody>
			<fly:list name="fichier_s">
			<tr class="<fly:variable name='type_ligne_s'/>" onmouseover="this.className='over'; this.style.cursor='hand'" onmouseout="this.className = '<fly:variable name='type_ligne_s'/>'">
				<td>
					<input type="text" name="<fly:variable name='id_fic_s'/>" value="<fly:variable name='ordre_donnee_s'/>" size="1"/>
				</t>
				<td></td>			
				<td>
					<a href="<fly:variable name='url_fichier'/>"><fly:variable name='url_lib_dossier_s'/></a>
				</td>
				<td>
					<a href="<fly:variable name='url_fichier'/>"><fly:variable name='intitule_fichier_s'/></a>
				</td>
				<td>
					<a href="<fly:variable name='url_fichier'/>"><fly:variable name='description_fichier_s'/></a>
				</td>
			</tr>
			</fly:list>
		</tbody>				
	</table>
<input type="submit" name="sous_menu" value="Validate" class="bouton" /> 
</form>
</fly:block>			
<fly:block name="menubar">
<h1>Order Menu Tab in page : <fly:variable name='nom_menu'/></h1>
<form action="admin_menu.php?id=<fly:variable name='id_onglet'/>&id_f=<fly:variable name='id_menu'/>" method="post">
	<table>	
		<thead>						
			<tr>
				<td style="width: 10px;">Order</td>
				<td style="width: 100px;"></td>
				<td style="width: 100px;">Folder</td>
				<td style="width: 200px;">Menu Label</td>
				<td>Description</td>
			</tr>					
		</thead>
		<tbody>
			<fly:list name="fichier_b">
			<tr class="<fly:variable name='type_ligne_b'/>" onmouseover="this.className='over'; this.style.cursor='hand'" onmouseout="this.className = '<fly:variable name='type_ligne_b'/>'">
				<td>
					<input type="text" name="<fly:variable name='id_fic_b'/>" value="<fly:variable name='ordre_donnee_b'/>" size="1"/>
				</td>
				<td></td>			
				<td>
					<fly:variable name='url_lib_dossier_b'/>
				</td>
				<td>
					<fly:variable name='intitule_fichier_b'/>
				</td>
				<td>
					<fly:variable name='description_fichier_b'/>
				</td>
			</tr>
			</fly:list>
		</tbody>				
	</table>
<input type="submit" name="menubar" value="Validate" class="bouton" /> 
</form>
</fly:block>