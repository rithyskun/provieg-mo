<form action="proviva_product_translate_create.php" method="post">
	<fieldset>
		<legend>Create translate for product</legend>
		<dl class="table-display">
			<dt>Language</dt>
			<dd>
				<select name="language">
					<fly:list name="language">
						<option <fly:variable name='selected' /> value="<fly:variable name='language_code' />"><fly:variable name='language_name' /></option>
					</fly:list>
				</select>
			</dd>
		
			<dt><label for="name">Title *</label></dt>
			<dd><input tabindex="2" type="text" id="title" name="title"  value="<fly:variable name='title' />" placeholder="Text" onchange="try{setCustomValidity('')}catch(e){}" required size="53"></dd>
			
			<dt><label for="desc">Description *</label></dt>
			<dd><textarea id="desc" name="desc"><fly:variable name='desc' /></textarea></dd>
			
			<dt><input type="hidden" id="product_id" name="product_id" value="<fly:variable name='product_id' />"></dt>
			<dd class="bouton"><input type="submit" name="create" value="Create" class="bouton" /></dd>
		</dl>
	</fieldset>
</form>