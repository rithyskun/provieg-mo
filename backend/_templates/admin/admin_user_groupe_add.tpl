<h3>Attach groups</h3>
<form action="<fly:variable name='url_action' />" method="post">
	<fieldset>					
		<dl class="table-display">			
			<dt><label for="debut_group">Search</label></dt>
			<dd>
				<input type="text" name="debut_group" id="debut_group" maxlength="255" value="<fly:variable name='debut_group' />" size="50" class="loader" />
				<input type="hidden" name="id_user" id="id_user" value="<fly:variable name='id_user' />" />
				<input type="submit" name="submit" value="Attach" class="bouton" />
			</dd>
			<dd>
				<select name="id_group[]" id="id_group" size="10" multiple></select>
			</dd>
		</dl>
	</fieldset>
</form>
<script language="JavaScript" type="text/javascript">
	$(document).ready(function() {
        $('#id_group').AjaxSelect({
            file: '<fly:variable name="ajax_file" />',
            input: '#debut_group'
            //select: ['#type_privilege','#url_dossier']
        });
    });
</script>