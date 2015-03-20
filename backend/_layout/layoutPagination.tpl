<fly:block name="pagination">
<div id="pagination"> 
    Aller à la page : 
	<fly:list name="list_page">
	<a href="<fly:variable name='url_page' />" class="<fly:variable name='type_lien' />"><fly:variable name='lien_page' /></a>
	</fly:list>
</div>
</fly:block>
