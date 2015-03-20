<div id="menu_deroulant">
<ul class="sf-menu">
	<fly:list name="list_onglet">
		<li><a href="<fly:variable name='url_onglet' />"><fly:variable name='intitule_onglet' /></a>
			<fly:block name="sousmenu">				
					<ul>
    					<fly:list name="list_sousmenu">
    						<li><a href="<fly:variable name='url_sousmenu' />"><fly:variable name="intitule_sousmenu" /></a></li>
    					</fly:list>
    				</ul>
   			</fly:block>
		</li>
	</fly:list>
</ul>
</div>
<script type='text/javascript'>
   $(document).ready(function(){ 
       $("ul.sf-menu").supersubs({ 
            minWidth:    1,   // minimum width of sub-menus in em units 
            maxWidth:    14,   // maximum width of sub-menus in em units 
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
                               // due to slight rounding differences and font-family 
        }).superfish();  // call supersubs first, then superfish, so that subs are 
                         // not display:none when measuring. Call before initialising 
                         // containing tabs for same reason. 
    }); 
</script>