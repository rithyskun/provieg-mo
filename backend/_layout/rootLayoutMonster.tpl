<div id="page">
	<div id="menu">
		<fly:include name="menu" />
		<div id="header">
			<fly:include name="header" />
    	</div>
		<fly:block name="message">
			<div id="message">
				<span class="<fly:variable name='class_message' />"><fly:variable name='message' /></span>
			</div>
		</fly:block>
	</div>
	<fly:include name="action" />
	<div id="body">
		<fly:include name="body" />
	</div>
	<div id="push"></div>
</div>
<div id="footer">
	<fly:include name="footer" />
</div>