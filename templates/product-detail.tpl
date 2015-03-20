<div class="container">
	<div class="push-2">&nbsp;</div>
	<div class="row">
		<div id="product-detail" class="col-xs-12 col-sm-12 col-md-12">
			<fly:block name="product-tester">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<img class="media-object img-responsive" width="310" height="188" src="/design/provieg-images/Product-tester.jpg">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<h4 class="text-pad font-6 white">
							<fly:write name='provie_g_proprietary' />
						</h4>
						<div style="word-wrap: break-word;" class="light-gray">
							<fly:write name='the_active_ingredients' />
						</div>
					</div>
				</div>
			</fly:block>
			<fly:block name="product">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<img class="media-object img-responsive" src="/<fly:variable name='s_image' />">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<h4 class="text-pad font-6 white"><fly:variable name='title' /></h4>
						<div class="light-gray hyphenate"><fly:variable name='desc' /></div>
					</div>
				</div>
			</fly:block>
			<fly:block name="nothing">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 light-gray">
						<fly:write name='global_no_product' />
					</div>
				</div>
			</fly:block>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="push-2">&nbsp;</div>
					<a class="btn-green" onclick="javascript:History.back();"><fly:write name='global_back' /></a>
				</div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.row -->
	<div class="push-2">&nbsp;</div>
</div><!-- /.container -->
<style>
	p {
		margin: 0 auto;
	}
</style>