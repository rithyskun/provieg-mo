<h1>Proviva</h1>		
<div id="onglet_accueil">
    <fly:list name="onglet_menu">
        <a href="<fly:variable name='url_sousmenu' />"><fly:variable name="intitule_sousmenu" /></a>
    </fly:list>
</div>
<fly:block name="out_stock">
<h3>Out stock</h3>
<table id="table">
    <colgroup><col /><col /><col /></colgroup>
	<tr class="header">
        <td>name product</td>
		<td>price</td>
		<td>ref</td>
	</tr>
	<fly:list name="stock">
	<tr onclick="document.location='<fly:variable name='url_report' />'"
        onmouseover="jQuery(this).addClass('over');"
        onmouseout="jQuery(this).removeClass('over');">
		<td><a href="<fly:variable name='url_report' />"><fly:variable name='name_lantern' /></a></td>
		<td><a href="<fly:variable name='url_report' />"><fly:variable name='price' /></a></td>
		<td><a href="<fly:variable name='url_report' />"><fly:variable name='ref' /></a></td>
	</tr>
	</fly:list>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table').tableFilter({
            stripeClass: 'impair',
            pageLength: 20,
            sort: false,
            imagePath: '<fly:variable name="rep_img" />'
        });
    });
</script>
</fly:block>