<h1>Step 1 : File name</h1>
<form action="<fly:variable name='url_action' />" method="post">
	<fieldset>
		<dl class="table-display">
			<dt><label for="nom_fichier">File name *</label></dt>
			<dd><input type="text" name="nom_fichier" id="nom_fichier" value="<fly:variable name='nom_fichier' />" maxlength="255" size="50" class="oblig" />.php</dd>

        	<dt><label for="description_fichier">Short description of technical content *</label></dt>
			<dd><textarea name="description_fichier" id="description_fichier" cols="47" rows="8" class="oblig"><fly:variable name='description_fichier' /></textarea></dd>

        	<dt><label for="intitule_fichier">Menu Label *</label></dt>
			<dd><input type="text" name="intitule_fichier" id="intitule_fichier" value="<fly:variable name='intitule_fichier' />" maxlength="255" size="50" class="oblig" /></dd>

        	<dt><label for="id_dossier">Folder (on server)</label></dt>
			<dd>
                <select name="id_dossier">
				    <fly:list name="list_dossier">
				    <option value="<fly:variable name='id_dossier' />" <fly:variable name='selected_dossier' />><fly:variable name='url_dossier' /></option>
				    </fly:list>
			    </select>
			</dd>

        	<dt><label for="id_type_fichier">File type</label></dt>
			<dd>
                <select name="id_type_fichier">
                    <fly:list name="list_type_fichier">
				    <option value="<fly:variable name='id_type_fichier' />" <fly:variable name='selected_type_fichier' />><fly:variable name='lib_type_fichier' /></option>
				    </fly:list>
			    </select>
			</dd>
		</dl>
        <input type="submit" value="Next Step" name="etape2" class="bouton" />
	</fieldset>
</form>