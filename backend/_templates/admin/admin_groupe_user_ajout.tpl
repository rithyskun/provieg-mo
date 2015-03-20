<h3>Attach user(s)</h3>
<form action="<fly:variable name='url_action' />" method="post">
	<fieldset>
		<dl class="table-display">
			<dt><label for="debut_login">Search</label></dt>
			<dd>
				<input type="text" name="debut_login" id="debut_login" maxlength="255" size="50" class="loader" />
				<input type="hidden" name="id_groupe" id="id_groupe" value="<fly:variable name='id_groupe' />" />
				<input type="submit" name="submit" value="Ajouter" class="bouton" /> 
			</dd>
			<dd>
				<select name="id_user[]" id="id_user" size="6" multiple></select>
			</dd>
		</dl> 
	</fieldset>
</form>
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
          $('#id_user').AjaxSelect({
              file: '<fly:variable name="ajax_file" />',
              input: '#debut_login'
          });
      });
</script>