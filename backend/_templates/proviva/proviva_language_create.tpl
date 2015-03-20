<form action="proviva_language_create.php" method="post">
	<fieldset>
		<legend>Create language</legend>
		<dl class="table-display">
		
			<dt><label for="visible">Visible</label></dt>
			<dd><input type="checkbox" name="visible" id="visible" class="radio" checked></dd>
			
			<dt><label for="language_name">Language name *</label></dt>
			<dd><input tabindex="1" type="text" id="language_name" name="language_name" value="<fly:variable name='language_name' />" placeholder="Text" title="This field is required." pattern="[a-zA-Z]{1,30}" required size="53"><fly:variable name="language_name" /></dd>
			
			<dt><label for="language_code">Language code *</label></dt>
			<dd><input tabindex="2" type="text" id="language_code" name="language_code"  value="<fly:variable name='language_code' />" placeholder="Text" title="Please, enter only 2 characters" pattern="[a-zA-Z]{2}" required size="53"><fly:variable name="language_code" /></dd>
			
			<dt><label for="country_code">Country code *</label></dt>
			<dd><input tabindex="2" type="text" id="country_code" name="country_code"  value="<fly:variable name='country_code' />" placeholder="Text" title="Please, enter only 2 characters." pattern="[a-zA-Z]{2}" required size="53"><fly:variable name="country_code" /></dd>
			
			<dt>&nbsp;</dt>
			<dd class="bouton"><input type="submit" name="create" value="Create" class="bouton" /></dd>
		</dl>
	</fieldset>
</form>