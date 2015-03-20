<h3>Attach group</h3>
<form action="<fly:variable name='url_action' />" method="post">		
	<fieldset>
		<dl class="table-display">
			<dt><label for="debut_groupe">Search</label></dt>					
			<dd>
				<input type="text" name="debut_groupe" id="debut_groupe" maxlength="255" size="50" />
				<input type="hidden" name="id_privilege" id="id_privilege" value="<fly:variable name='id_privilege' />" />
				<input type="submit" value="Attach" class="bouton" name="submit" />
			</dd>
			<dd>
				<select name="id_groupe[]" id="id_groupe" size="10" multiple></select>
			</dd>
		</dl>
	</fieldset>
</form>
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
       $('#id_groupe').AjaxSelect({
           file: '<fly:variable name="ajax_file" />',
           input: '#debut_groupe',
           //select: ['#id_privilege']
       });
   });
</script>