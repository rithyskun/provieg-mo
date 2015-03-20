<h3>Attach access rights</h3>
<form action="<fly:variable name='url_action' />" method="post">
	<fieldset>					
		<dl class="table-display">
			<dt><label for="type_privilege">Filter by type :</label></dt>
			<dd>
				<select name="type_privilege" id="type_privilege" style="width: 150px;">
					<fly:list name='option_privilege'>
					<option value="<fly:variable name='id_type_privilege' />" <fly:variable name='selected_type'/> ><fly:variable name='lib_type_privilege' /></option>
					</fly:list>
				</select>
			</dd>
			<dt><label for="url_dossier">Filter by folder :</label></dt>
			<dd>
				<select name="url_dossier" id="url_dossier"	style="width: 150px;">
					<fly:list name='option_dossier'>
					<option value="<fly:variable name='id_dossier' />" <fly:variable name='selected_dossier' /> ><fly:variable name='url_dossier' /></option>
					</fly:list>
				</select>
			</dd>
			<dt><label for="debut_privilege">Search</label></dt>
			<dd>
				<input type="text" name="debut_privilege" id="debut_privilege" maxlength="255" value="<fly:variable name='debut_privilege' />" size="50" class="loader" />
				<input type="hidden" name="id_groupe" id="id_groupe" value="<fly:variable name='id_groupe' />" />
				<input type="submit" name="submit" value="Attach" class="bouton" />
			</dd>
			<dd>
				<select name="id_privilege[]" id="id_privilege" size="10" multiple></select>
			</dd>
		</dl>
	</fieldset>
</form>
<script language="JavaScript" type="text/javascript">
	$(document).ready(function() {
        $('#id_privilege').AjaxSelect({
            file: '<fly:variable name="ajax_file" />',
            input: '#debut_privilege',
            select: ['#type_privilege','#url_dossier']
        });
    });
</script>