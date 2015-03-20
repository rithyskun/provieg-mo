<h1>Step 3 : Dependances</h1>
<form action="<fly:variable name='url_action' />" method="post" id="form_admin_fichier_recursif_ajout">			
	<div style="float: left; width: 48%;">
	<fieldset>
		<legend>Attach a father to this file</legend>
		<dl class="table-display">
			<dt><label for="id_type_fichier_fils">File type</label></dt>
               <dd>
                   <select name="id_type_fichier_pere" id="id_type_fichier_pere">
					<fly:list name="option_type_fichier_pere">
					<option value="<fly:variable name='id_type_fichier_pere' />" <fly:variable name='selected_type_fichier_pere' />><fly:variable name='lib_type_fichier_pere' /></option>
					</fly:list>
				</select>
			</dd>
               <dt><label for="debut_pere">Search file</label></dt>
			<dd>
                   <input type="text" name="debut_pere" id="debut_pere" maxlength="255" size="50" />
                   <input type="hidden" name="id_fichier" id="id_fichier" value="<fly:variable name='id_fichier' />" />
               </dd>
			<dd><select name="id_fichier_pere[]" id="id_fichier_pere" size="8" multiple></select></dd>
		</dl>
		<input type="submit" name="add_pere" value="Attach file" class="bouton" />
	</fieldset>
<fly:list name="list_pere">
<table>   
    <col style="width: 250px;" />
    <col />
	<thead>
		<tr>
			<td>File name</td>
			<td class="droite"></td>
		</tr>
	</thead>
	<tbody>
        <fly:list name="un_pere">
		<tr class="<fly:variable name='type_ligne_pere' />">
			<td><fly:variable name='nom_fichier_pere' /></td>	
			<td class="droite"><input type="submit" value="delete" name="<fly:variable name='input_suppr_pere' />" class="bouton" /></td>
		</tr>
		</fly:list>
	</tbody>
</table>
</fly:list>
<fly:block name="aucun_pere">
No father for this file
</fly:block>
</div>
<div style="float: right; width: 48%;">
		<fieldset>
			<legend>Attach a child to this file</legend>
			<dl class="table-display">
				<dt><label for="id_type_fichier_fils">File type</label></dt>
                <dd>
                    <select name="id_type_fichier_fils" id="id_type_fichier_fils">
						<fly:list name="option_type_fichier_fils">
						<option value="<fly:variable name='id_type_fichier_fils' />" <fly:variable name='selected_type_fichier_fils' />><fly:variable name='lib_type_fichier_fils' /></option>
						</fly:list>
					</select>
				</dd>
				<dt><label for="debut_fils">Search file</label></dt>
				<dd>
                    <input type="text" name="debut_fils" id="debut_fils" maxlength="255" size="50" />
                    <input type="hidden" name="id_fichier" id="id_fichier" value="<fly:variable name='id_fichier' />" />
                </dd>
				<dd><select name="id_fichier_fils[]" id="id_fichier_fils" size="8" multiple></select></dd>
			</dl>
			<input type="submit" name="add_fils" value="Attach file" class="bouton" />
		</fieldset>
		
		<fly:list name="list_fils">
		<table>
		    <col style="width: 250px;" />
		    <col />
			<thead>
				<tr>
					<td>File name</td>
					<td class="droite"></td>
				</tr>
			</thead>
			<tbody>
		        <fly:list name="un_fils">
				<tr class="<fly:variable name='type_ligne_fils' />">
					<td><fly:variable name='nom_fichier_fils' /></td>	
					<td class="droite"><input type="submit" value="delete" name="<fly:variable name='input_suppr_fils' />" class="bouton" /></td>
				</tr>
				</fly:list>
			</tbody>
		</table>
		</fly:list>
		<fly:block name="aucun_fils">
		No chil for this file
		</fly:block>
</div>

	<p class="clear"></p>
	<div style="text-align: right;">
		<input type="submit" value="Next Step" name="etape4" class="bouton" />
	</div>
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
