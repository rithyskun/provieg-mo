<h1>Stepe 2 : Access right to this file</h1>			
<form action="<fly:variable name='url_action' />" method="post">
	<div style="float: left; width: 48%;">
		<fieldset>
			<legend>Choose an existant access right</legend>
			<dl class="table-display">
				<dt><label for="id_type_privilege">Type of access right</label></dt>
				<dd>
                    <select name="id_type_privilege" id="id_type_privilege">
						<fly:list name="option_type_privilege">
						<option value="<fly:variable name='id_type_privilege' />"><fly:variable name='lib_type_privilege' /></option>
						</fly:list>
					</select>
				</dd>			    
                <dt><label for="debut_privilege">Search access right</label></dt>
				<dd>
                    <input type="text" name="debut_privilege" id="debut_privilege" maxlength="255" size="50" />
                    <input type="hidden" name="id_fichier" id="id_fichier" value="<fly:variable name='id_fichier' />">
                </dd>
				<dd><select name="id_privilege" id="id_privilege" size="9"></select></dd>
			</dl>
			<input type="submit" name="add_privilege" value="Attach this access right" class="bouton" />
		</fieldset>
	</div>
</form>
<form action="<fly:variable name='url_action' />" method="post">	
	<div style="float: right; width: 48%;">
		<fieldset>
			<legend>Create a new access right</legend>
			<dl class="table-display">
				<dt><label for="type_privilege_ajout">Type of the access right</label></dt>
				<dd>
                    <select name="type_privilege_ajout" id="type_privilege_ajout">
						<fly:list name="option_type_privilege">
						<option value="<fly:variable name='id_type_privilege' />"><fly:variable name='lib_type_privilege' /></option>
						</fly:list>
					</select>
				</dd>
				
				<dt><label for="intitule_privilege">Name</label></dt>
				<dd><input type="text" name="intitule_privilege" id="intitule_privilege" maxlength="255" size="48" class="oblig" /></dd>
	
			    <!--<dt><label for="description_privilege">Description</label></dt>
				<dd><textarea name="description_privilege" id="description_privilege" cols="47" rows="8"></textarea></dd>-->
			</dl>
			<input type="submit" name="new_privilege" value="Create and attach new access right" class="bouton" />	
		</fieldset>
	</div>
</form>	
<form action="<fly:variable name='url_action' />" method="post">
	<p class="clear"></p>
	<fly:list name="list_privilege">
	<table>	
		<thead>
			<tr>
				<td style="width: 150px;">Type</td>
				<td style="width: 250px;">Name</td>
				
				<td class="droite"></td>
			</tr>
		</thead>
		<tbody>
			<fly:list name="un_privilege">
			<tr class="<fly:variable name='type_ligne' />">
				<td><fly:variable name='type' /></td>
				<td><fly:variable name='intitule_privilege' /></td>	
				
				<td class="droite"><input type="submit" value="delete" name="<fly:variable name='input_suppr' />" class="bouton" /></td>
			</tr>
			</fly:list>
		</tbody>
	</table>
	</fly:list>
    <fly:block name="aucun_privilege">
	No access right for this file
	</fly:block>	
	<div style="text-align: right;">
		<input type="submit" value="Next Step" name="etape3" class="bouton" />
	</div>	
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