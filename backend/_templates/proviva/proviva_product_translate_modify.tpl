<form action="proviva_product_translate_modify.php" method="post">
	<fieldset>
		<legend>Modify translate for product</legend>
		<dl class="table-display">
			<dt>Language</dt>
			<dd><fly:variable name='language' /></dd>
		
			<dt><label for="name">Title *</label></dt>
			<dd><input tabindex="2" type="text" id="title" name="title"  value="<fly:variable name='title' />" placeholder="Text" onchange="try{setCustomValidity('')}catch(e){}" required size="53"></dd>
			
			<dt><label for="desc">Description *</label></dt>
			<dd><textarea id="desc" name="desc"><fly:variable name='desc' /></textarea></dd>
			
			<dt>
				<input type="hidden" id="product_id" name="product_id" value="<fly:variable name='product_id' />">
				<input type="hidden" id="language_code" name="language_code" value="<fly:variable name='language_code' />">
			</dt>
			<dd class="bouton"><input type="submit" name="modify" value="Modify" class="bouton" /></dd>
		</dl>
	</fieldset>
</form>