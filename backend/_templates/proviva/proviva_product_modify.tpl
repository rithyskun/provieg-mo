<form action="proviva_product_modify.php?id=<fly:variable name='product_id' />" method="post">
<fieldset>
<legend>Modify product</legend>
	<dl class="table-display">
		<dt>Language</dt>
		<dd><fly:variable name='language'/></dd>
		
		<dt><label for="visible">Visible</label></dt>
		<dd><input type="checkbox" name="visible" id="visible" class="radio" <fly:variable name='checked_visible'/> ></dd>
		
		<dt><label for="price">Price *</label></dt>
		<dd><input tabindex="1" type="number" name="price" id="price" value="<fly:variable name='price' />" placeholder="Number" title="Please, input number" min="0" required size="53"></dd>

		<dt><label for="name">Title *</label></dt>
		<dd><input tabindex="2" type="text" name="title" id="title" value="<fly:variable name='title' />" placeholder="Text" title="Please, input text" required size="53"></dd>
		
		<dt><label for="description">Description *</label></dt>
		<dd><textarea tabindex="3" id="desc" name="desc"><fly:variable name="desc" /></textarea></dd>
		
		<dt><input type="hidden" name="product_id" value="<fly:variable name='product_id' />"></dt>
		<dd><input type="hidden" name="language_code" value="<fly:variable name='language_code' />"></dd>
		
		<dt>&nbsp;</dt>
		<dd><input type="submit" name="modify" value="Modify" class="bouton"></dd>
	</dl>									
</fieldset>
</form>