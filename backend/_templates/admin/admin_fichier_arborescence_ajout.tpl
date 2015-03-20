<form action="admin_fichier_detail.php?id=<fly:variable name='id_fichier'/>&choix=arborescence " method="post" id="form_admin_fichier_recursif_ajout">			
	<div style="float: left; width: 48%;">
		<fieldset>
			<legend>Attach a father to this file</legend>
			<dl class="table-display">
				<dt><label for="id_type_fichier_fils">Filter by file type :</label></dt>
                <dd>
                    <select name="id_type_fichier_pere" id="id_type_fichier_pere">
						<fly:list name="option_type_fichier_pere">
						<option value="<fly:variable name='id_type_fichier_pere' />" <fly:variable name='selected_type_fichier_pere' />><fly:variable name='lib_type_fichier_pere' /></option>
						</fly:list>
					</select>
				</dd>
                <dt><label for="debut_pere">Search</label></dt>
				<dd>
                    <input type="text" name="debut_pere" id="debut_pere" maxlength="255" size="50" />
                    <input type="hidden" name="id_fichier" id="id_fichier" value="<fly:variable name='id_fichier' />" />
                </dd>
				<dd><select name="id_fichier_pere[]" id="id_fichier_pere" size="8" multiple></select></dd>
			</dl>
			<input type="submit" name="add_pere" value="Attach file" class="bouton" />
		</fieldset>
	</div>	
	<div style="float: right; width: 48%;">
		<fieldset>
			<legend>Attach a child to this file</legend>
			<dl class="table-display">
				<dt><label for="id_type_fichier_fils">Filter by file type :</label></dt>
                <dd>
                    <select name="id_type_fichier_fils" id="id_type_fichier_fils">
						<fly:list name="option_type_fichier_fils">
						<option value="<fly:variable name='id_type_fichier_fils' />" <fly:variable name='selected_type_fichier_fils' />><fly:variable name='lib_type_fichier_fils' /></option>
						</fly:list>
					</select>
				</dd>
				<dt><label for="debut_fils">Search</label></dt>
				<dd>
                    <input type="text" name="debut_fils" id="debut_fils" maxlength="255" size="50" />
                    <input type="hidden" name="id_fichier" id="id_fichier" value="<fly:variable name='id_fichier' />" />
                </dd>
				<dd><select name="id_fichier_fils[]" id="id_fichier_fils" size="8" multiple></select></dd>
			</dl>
			<input type="submit" name="add_fils" value="Attach file" class="bouton" />
		</fieldset>
	</div>
	<p class="clear"></p>	
</form>
<script language="JavaScript" type="text/javascript">
	$(document).ready(function() {
        $('#id_fichier_pere').AjaxSelect({
            file: '<fly:variable name="ajax_file_pere" />',
            input: '#debut_pere',
            select: ['#id_type_fichier_pere']
        });
        
        $('#id_fichier_fils').AjaxSelect({
            file: '<fly:variable name="ajax_file_fils" />',
            input: '#debut_fils',
            select: ['#id_type_fichier_fils']
        });
    });
</script>