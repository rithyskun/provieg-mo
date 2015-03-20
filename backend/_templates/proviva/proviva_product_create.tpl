<form action="proviva_product_create.php" method="post">
	<fieldset>
		<legend>Create product</legend>
		<dl class="table-display">
			<dt><label for="visible">Visible</label></dt>
			<dd><input type="checkbox" name="visible" id="visible" class="radio" checked></dd>
			
			<dt><label for="price">Price *</label></dt>
			<dd><input tabindex="1" type="number" id="price" name="price" value="<fly:variable name='price' />" placeholder="Number" onchange="try{setCustomValidity('')}catch(e){}" min="0" required size="53"><fly:variable name="price" /></dd>
			
			<dt><label for="name">Title *</label></dt>
			<dd><input tabindex="2" type="text" id="title" name="title"  value="<fly:variable name='title' />" placeholder="Text" onchange="try{setCustomValidity('')}catch(e){}" required size="53"></dd>
			
			<dt><label for="desc">Description *</label></dt>
			<dd><textarea id="desc" name="desc"></textarea></dd>
			
			<dt>&nbsp;</dt>
			<dd class="bouton"><input type="submit" name="submit" value="Create" class="bouton" /></dd>
		</dl>
	</fieldset>
</form>