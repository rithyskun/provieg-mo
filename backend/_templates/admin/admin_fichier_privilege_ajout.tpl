<h3>Attach right access</h3>
<form action="<fly:variable name='url_action' />" method="post">		
	<fieldset>
		<dl class="table-display">
			<dt><label for="id_type_privilege">Filter by type :</label></dt>
			<dd>
				<select name="id_type_privilege" id="id_type_privilege">
					<fly:list name="type_privilege">
						<option value="<fly:variable name='id_type_privilege'/>"><fly:variable name='lib_type_privilege'/></option>
					</fly:list>
				</select>
			</dd>					
			<dt><label for="debut_privilege">Search</label></dt>					
			<dd>
				<input type="text" name="debut_privilege" id="debut_privilege" maxlength="255" size="50" />
				<input type="hidden" name="id_fichier" id="id_fichier" value="<fly:variable name='id_fichier' />" />
				<input type="submit" value="Attach" class="bouton" name="submit" />
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
            select: ['#id_type_privilege']
        });
    });
</script>