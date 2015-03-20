<fly:block name="product">
	<fly:list name="list">
		<div class="push-1">&nbsp;</div>
		<div class="media" id="<fly:variable name='product_id' />">
			<a class="pull-<fly:variable name='style' />" href="/<fly:variable name='url_product' />">
				<img class="media-object img-responsive" src="/<fly:variable name='s_image' />">
			</a>
			<div class="clearfix-xs"></div>
			<div class="media-body">
				<div class="text-<fly:variable name='style' />">
					<h4 class="media-heading text-pad title white"><fly:variable name='title' /></h4>
					<div class="light-gray hyphenate"><fly:variable name='desc' /></div>
					<br>
					<a class="btn-green" href="/<fly:variable name='url_product' />"><fly:write name='global_read_more' /></a>
				</div>
			</div>
		</div> <!-- /media -->
		<div class="push-1">&nbsp;</div>
	</fly:list>
</fly:block>
<fly:block name="nothing">
	<div class="light-gray">
		<fly:write name='global_no_product' />
	</div>
</fly:block>