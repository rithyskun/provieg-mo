<h1>List of products</h1>
<fly:block name="list">
<form action="proviva_product.php" method="post">
	<table id="table">
		<tr class="header">
			<td style="width: 70px;">Image</td>
	        <td>Name</td>
			<td>Price</td>
			<td>Visible</td>
			<td>Language</td>
			<td style="width: 220px;">Order</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>
				<div style="float: right;">
					<input type="submit" name="number_order" value="Order[NUM]" class="bouton">
					<input type="submit" name="alphabet_order" value="Order[A-Z]" class="bouton">
				</div>
			</td>
		</tr>
		<fly:list name="products">
			<tr onmouseover="jQuery(this).addClass('over');"
		        onmouseout="jQuery(this).removeClass('over');">
		        <td><a rel="<fly:variable name='preview_admin' />" onclick="document.location='<fly:variable name='url_fichier' />'" class="preview"><img src="<fly:variable name='mini_admin' />"></a></td>
				<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='title' /></a></td>
				<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='price' /></a></td>
				<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='visible' /></a></td>
				<td><a href="<fly:variable name='url_fichier' />"><fly:variable name='language' /></a></td>
				<td>
					<input type="number" name="<fly:variable name='id'/>" value="<fly:variable name='number'/>" title="Please, input number." onchange="try{setCustomValidity('')}catch(e){}" style="width: 50px;">
				</td>
			</tr>
		</fly:list>
	</table>
</form>
</fly:block>
<fly:block name="nothing">
    No product to display.
</fly:block>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table').tableFilter({ 
            imagePath: '<fly:variable name="rep_img" />',
            sortOnLoad: 2,
            stripeClass: 'impair',
            pageLength: 20
        });
    });
</script>