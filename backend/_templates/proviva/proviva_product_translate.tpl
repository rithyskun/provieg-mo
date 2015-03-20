<h3>Translation for product</h3>
<fly:include name="include_pagination" />
<fly:block name="list">
	<table id="table">
		<tr class="header">
			<td>Title</td>
			<td>Language</td>
			<td width="175"></td>
			<td width="175"></td>
			<td width="175"></td>
		</tr>
		<fly:list name="translate">
			<tr class="<fly:variable name='type_ligne' />" onmouseover="this.className='over'; this.style.cursor='hand'" onmouseout="this.className = '<fly:variable name='type_ligne' />'">
				<td>
					<a href="<fly:variable name='url_fichier' />"><fly:variable name='title' /></a>
				</td>
				<td>
					<a href="<fly:variable name='url_fichier' />"><fly:variable name='language' /></a>
				</td>
				<td>
					<fly:block name='blockDelete'>
						<a href="<fly:variable name='delete' />">Delete</a>
					</fly:block>
				</td>
				<td>
					<a href="<fly:variable name='modify' />">Modify</a>
				</td>
				<td>
					<fly:block name="bTranslate">
						<form action="proviva_product_translate_create.php" method="post">
							<select id="language" name="language">
								<fly:list name="lang">
									<option value="<fly:variable name='language_code' />"><fly:variable name='language_name' /></option>
								</fly:list>
							</select>
							<input type="hidden" id="product_id" name="product_id" value="<fly:variable name='product_id' />">
							<input type="hidden" id="language_code" name="language_code" value="<fly:variable name='language_code' />">
							<input type="submit" name="translate" value="Translate" class="bouton">
						</form>
					</fly:block>
				</td>
			</tr>
		</fly:list>
	</table>
</fly:block>
<fly:block name="nothing">
	No translate for this product
</fly:block>