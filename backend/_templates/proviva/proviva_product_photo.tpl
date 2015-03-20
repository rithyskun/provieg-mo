<h3>Photos for product</h3>
	<fly:include name="include_pagination" />			
<fly:block name="list">
	<table id="table">
		<tr class="header">
			<td style="width: 60px;">Image</td>
			<td>Name</td>
			<td width="80">Status</td>
			<td width="120"></td>
			<td width="80"></td>
		</tr>
		<fly:list name="listPhotos">
			<tr class="<fly:variable name='type_ligne' />" onclick="document.location='<fly:variable name='url_fichier' />'" onmouseover="this.className='over'; this.style.cursor='hand'" onmouseout="this.className = '<fly:variable name='type_ligne' />'">
				<td><a rel="<fly:variable name='preview_admin' />" onclick="document.location='<fly:variable name='url_fichier' />'" class="preview"><img src="<fly:variable name='mini_admin' />" /></a></td>
				<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='nom_serveur' /></a></td>
				<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='status' /></a></td>
				<td>
					<form method="post">
						<input type="hidden" name="id" name="id" value="<fly:variable name='id' />">
						<fly:block name="button_main">
							<input type='submit' name="main_photo" id="main_photo" value="Main picture" class="bouton">&nbsp;
						</fly:block>
					</form> 
				</td>
				<td><a href="<fly:variable name='delete' />">Delete</a></td>
			</tr>
		</fly:list>
	</table>
</fly:block>
<fly:block name="nothing">
	No photo for this product
</fly:block>
<fly:include name="include_proviva_product_photo_create" />
<fly:include name="include_proviva_product_photo_upload" />