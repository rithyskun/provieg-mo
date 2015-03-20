<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="push-2">&nbsp;</div>
			<!-- sidebar fixed position -->
			<div class="right-sidebar hidden-xs">
				<div class="right-sidebar-top">
					<!-- <div class="text-pad title black">PRODUCTS</div> -->
				</div>
				<div id="sidebar-images" class="right-sidebar-container">
					<fly:list name='sizebar-image'>
						<a href="javascript:;" onclick="hashtag.togo(<fly:variable name='product_id' />);"><img src="/<fly:variable name='url_image' />" data-toggle="tooltip" title="<fly:variable name='title' />" class="curve-corner"></a>
					</fly:list>
				</div>
				<div class="right-sidebar-bottom">
					<a href="http://www.twitter.com" target="_blank"><img alt="" src="/design/provieg-images/Twister.png" /></a>
					<a href="http://www.facebook.com/provieg" target="_blank"><img alt="" src="/design/provieg-images/Facebook.png" /></a>
					<a href="http://www.youtube.com" target="_blank"><img alt="" src="/design/provieg-images/Youtube.png" /></a>
					<a href="http://www.google.com" target="_blank"><img alt="" src="/design/provieg-images/Google.png" /></a>
				</div>
			</div>
			<div class="row v-center">
				<div class="col-xs-6 col-sm-3 col-md-3">
					<div id="container">
						<div class="threesixty product-bottle-360">
					        <div class="spinner">
					          <span>0%</span>
					        </div>
					        <ol class="threesixty_images"></ol>
					    </div>
				    </div>
				</div>
				<div class="col-xs-6 col-sm-9 col-md-9">
					<div class="row">
						<div class="col-xs-12 col-sm-9 col-md-9">
							<div class="title-infos white">
								<fly:write name='be_good_to_yourself' />
							</div>
							<div class="push-1"></div>
							<ul class="hidden-xs">
								<li class="light-gray"><fly:write name='new_class_of' /></li>
								<li class="light-gray"><fly:write name='phytosynbiotics' /></li>
								<li class="light-gray"><fly:write name='synergistic' /></li>
							</ul>
						</div>
						<div class="col-xs-10 col-sm-6 col-md-9">
							<a href="javascript:;" class="btn-green" onclick="$('#paypal').submit();"><fly:write name='global_shop_now' /></a>
						</div>
					</div>
				</div>
			</div> <!-- /.row  -->
			<div class="push-4 hidde-xs"></div>
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-3">
					<div class="media-body">
						<div class="text-left">
							<div class="media-heading title white">ProVie G</div>
							<div class="text-pad light-gray">
								<fly:write name='provie_g_proprietary' />
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<ul class="visible-xs">
								<li class="light-gray"><fly:write name='new_class_of' /></li>
								<li class="light-gray"><fly:write name='phytosynbiotics' /></li>
								<li class="light-gray"><fly:write name='synergistic' /></li>
							</ul>
							<img class="img-responsive"  src="/design/provieg-images/bitter.png">
						</div>
					</div>
				</div>
			</div> <!-- /.row  -->
		</div> <!-- /.col -->
	</div> <!-- /.row -->
	<div class="push-2"></div>
	<div class="row">
		<div id="products" class="col-xs-12 col-sm-11 col-md-11">
			<fly:include name="product" />
		</div>
	</div> <!-- / 2st .row -->
	<div class="push-2"></div>
	<div class="row">
		<div class="col-xs-12 col-sm-11 col-md-11">
			<div class="white pull-right">
				<fly:write name='brochure' /> (*.pdf, ~1.4Mb)&nbsp;&nbsp;<a href="/docs/Brochure_ProVieG_KH.pdf" download="Brochure_ProVieG_KH.pdf">Khmer</a>,&nbsp;&nbsp;<a href="/docs/Brochure_ProVieG_EN.pdf" download="Brochure_ProVieG_EN.pdf">English</a>,&nbsp;&nbsp;<a href="/docs/Brochure_ProVieG_CH.pdf" download="Brochure_ProVieG_CH.pdf">Chinese</a>&nbsp;&nbsp;<img src="/design/pdf.png">
			</div>
		</div>
	</div>
	<div class="push-2"></div>
</div> <!-- / .container -->
<script type="text/javascript">
	$(function(){
		$('.product-bottle-360').ThreeSixty({
	        totalFrames: 35, // Total no. of image you have for 360 slider
	        endFrame: 35, // end frame for the auto spin animation
	        currentFrame: 1, // This the start frame for auto spin
	        imgList: '.threesixty_images', // selector for image list
	        progress: '.spinner', // selector to show the loading progress
	        imagePath:'/design/spritespin/', // path of the image assets
	        filePrefix: 'provie-g-', // file prefix if any
	        ext: '.png', // extention for the assets
	        zeroPadding: true,
	        height: 288,
	        width: 133,
	        navigation: false,
	        responsive: true,
	        autoplay: false
	    });
		$('[data-toggle="tooltip"]').tooltip({'placement': 'top'});
	});
</script>