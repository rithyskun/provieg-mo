<h3>Attach file</h3>
<form action="<fly:variable name='url_action' />" method="post">
	<fieldset>
		<dl class="table-display">
			<dt><label for="debut_fichier">Search file</label></dt>				
			<dd>
				<input type="text" name="debut_fichier" id="debut_fichier" maxlength="255" size="50"/>
				<input type="hidden" name="id_privilege" id="id_privilege" value="<fly:variable name='id_privilege' />" />
				<input type="submit" name="submit" value="Attach" class="bouton" />
			</dd>
			<dd>
				<select name="id_fichier[]" id="id_fichier" size="10" multiple></select>
			</dd>
		</dl>
	</fieldset>	
</form>
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
       $('#id_fichier').AjaxSelect({
           file: '<fly:variable name="ajax_file" />',
           input: '#debut_fichier'
       });
   });
</script>