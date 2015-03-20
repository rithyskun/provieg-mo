<h1>List of language</h1>
<fly:block name="list">
	<table id="table">
		<tr class="header">
			<td>Language</td>
	        <td>Language code</td>
			<td>Country code</td>
			<td>Visible</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<fly:list name="language">
			<tr onmouseover="jQuery(this).addClass('over');" onmouseout="jQuery(this).removeClass('over');">
				<td><a href="<fly:variable name='url_file' />"><fly:variable name='language_name' /></a></td>
				<td><a href="<fly:variable name='url_file' />"><fly:variable name='language_code' /></a></td>
				<td><a href="<fly:variable name='url_file' />"><fly:variable name='country_code' /></a></td>
				<td><a href="<fly:variable name='url_file' />"><fly:variable name='visible' /></a></td>
			</tr>
		</fly:list>
	</table>
</fly:block>
<fly:block name="nothing">
    No language to display.
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