<fly:block name="block_menubar">
         <div id="menubar">
	<ul>
		<fly:list name="item_menubar">
			<li <fly:variable name="selected" />>
            	<a href="<fly:variable name='url_menubar' />"><fly:variable name="lib_menubar" /></a>
            </li>
		</fly:list>
	</ul>
</div>
<div id="include">
	<fly:include name="include" />
</div>
</fly:block>