<h3>Nom fichier ( DATABASE )</h3>
<table id="table">
	<colgroup>
		<col style="width: 50px;" />
    </colgroup>
	<tr>
		<td>Nom fichier</td>
		<td>Nom ( *.php )</td>
		<td>Nom ( *.tpl )</td>
	</tr>
	<fly:list name="lfichier">
	<tr onclick="document.location='<fly:variable name='url_report' />'"
        onmouseover="jQuery(this).addClass('over');"
        onmouseout="jQuery(this).removeClass('over');"
		class="<fly:variable name='type_ligne' />" 
		onmouseover="this.className='over'; this.style.cursor='hand'" onmouseout="this.className = '<fly:variable name='type_ligne' />'">
		<td><fly:variable name='nom_fichier' /></td>
		<td>
			<fly:block name="php">
				<fly:variable name='delete_phpfile' />
			</fly:block>
		</td>
		<td>
			<fly:block name="tpl">
				<fly:variable name='delete_tplfile' />
			</fly:block>
		</td>
	</tr>
	</fly:list>
</table>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table').tableFilter({
            imagePath: '<fly:variable name="rep_img" />',
            sortOnLoad: 0,
            stripeClass: 'impair',
            pageLength: 20
        });
    });
</script>
<h3>Nom fichier ( PHYSICAL FILE )</h3>		
<fly:block name="lphysical">
<table>	
	<thead>
		<tr>
			<td style="width: 200px;">Nom fichier</td>
			<td>Directory</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
		<fly:list name="lfile">
		<tr class="<fly:variable name='type_ligne' />" 
			onclick="document.location='<fly:variable name='url_fichier' />'"
			onmouseover="this.className='over'; this.style.cursor='hand'" 
			onmouseout="this.className = '<fly:variable name='type_ligne' />'">
			<td><a href="<fly:variable name='url' />" target="_blank"><fly:variable name='filename' /></a></td>
			<td><a href="<fly:variable name='url' />" target="_blank"><fly:variable name='directory' /></a></td>
			<td><fly:variable name='delete' /></td>
		</tr>
		</fly:list>
	</tbody>
</table>
</fly:block>