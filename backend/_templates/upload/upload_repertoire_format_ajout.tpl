<h3>Ajouter un/plusieurs formats d'image</h3>
<form action="<fly:variable name='url_action' />" method="post">
	<fieldset>
		<dl class="table-display">
			<dt><label for="debut_mime">Chercher un format</label></dt>
			<dd>
				<input type="text" name="debut_format" id="debut_format" maxlength="255" size="50" class="loader" />
				<input type="hidden" name="id_repertoire" id="id_repertoire" value="<fly:variable name='id_repertoire' />" />
				<input type="submit" name="submit" value="Ajouter" class="bouton" /> 
			</dd>
			<dd>
				<select name="id_format[]" id="id_format" size="6" multiple></select>
			</dd>
		</dl> 
	</fieldset>
</form>
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
                $('#id_format').AjaxSelect({
                    file: '<fly:variable name="ajax_file" />',
                    input: '#debut_format'
                });
            });
</script>