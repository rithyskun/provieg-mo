<div class="container">
	<div class="push-2"></div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 hyphenate">
			<div class="media">
				<a class="pull-right" href="/<fly:variable name='language_code' />product-provieg-tester.html">
					<img class="media-object img-responsive" width="310" height="188" src="/design/provieg-images/Product-tester.jpg">
				</a>
				<div class="clearfix-xs"></div>
				<div class="media-body">
					<div class="text-left">
						<div class="media-heading text-pad title white">
							<fly:write name='provie_g_proprietary' />
						</div>
						<div class="push-1"></div>
						<div class="text-pad light-gray">
							<fly:write name='the_active_ingredients' />
						</div>
					</div>
				</div>
			</div><!-- /media -->
		</div>
	</div> <!-- / .row -->
	<div class="row">
		<div id="products" class="col-xs-12 col-sm-12 col-md-12">
			<fly:include name="product" />
		</div>
	</div> <!-- / .row -->
	<div class="push-2"></div>
</div> <!-- / .container -->