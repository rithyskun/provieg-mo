<form action="admin_fichier_modif.php?id=<fly:variable name='id_fichier' />" method="post">
	<fieldset>
		<legend>Modify file</legend>
		<dl class="table-display">
			<dt><label for="nom_fichier">Name *</label></dt>
			<dd><input type="text" name="nom_fichier" id="nom_fichier" value="<fly:variable name='nom_fichier_donnee' />" maxlength="255" size="50" class="oblig"/>.php</dd>						
			<dt><label for="description_fichier">Short description of technical content *</label></dt>
			<dd><textarea name="description_fichier" id="description_fichier" rows="10" cols="47" class="oblig"><fly:variable name='description_fichier_donnee' /></textarea></dd>
			<dt><label for="intitule_fichier">Menu Label *</label></dt>
			<dd><input type="text" name="intitule_fichier" id="intitule_fichier" value="<fly:variable name='intitule_fichier_donnee' />"  maxlength="255" size="50" class="oblig" /></dd>
			<dt><label for="id_dossier">Folder (on server)</label></dt>
			<dd>
				<select name="id_dossier">
					<fly:list name='dossier'>
						<option value="<fly:variable name='id_dossier' />" <fly:variable name='selected_dossier' />><fly:variable name='url_dossier' /></option>
					</fly:list>
				</select>
			</dd>
			<dt><label for="id_type_fichier">File type</label></dt>
			<dd>
				<select name="id_type_fichier">
					<fly:list name='type_fichier'>
						<option value="<fly:variable name='id_type_fichier' />" <fly:variable name='selected_type_fichier' />><fly:variable name='lib_type_fichier' /></option>
					</fly:list>
				</select></dd>
		</dl>									
	</fieldset>
<input type="submit" value="Modify file" class="bouton" />	
</form>