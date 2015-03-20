<div class="container">
	<div id="iBanner" class="flexslider-container">
		<div class="flexslider">
			<ul class="slides">
				<li>
					<img src="/design/provieg-images/Momordica charantia slider.jpg">
					<div class="flex-infos visible-md visible-lg">
						<div class="first-title">Stop getting sick</div>
						<div class="first-desc">NATURALLY</div>
					</div>
				</li>
				<fly:list name='list'>
					<li>
						<img src="/<fly:variable name='url_image' />">
						<fly:block name='b-title'>
							<div class='flex-title visible-md visible-lg'>
								<fly:variable name='title' />
							</div>
						</fly:block>
						<fly:block name='b-desc'>
							<div class='flex-desc visible-md visible-lg'>
								<fly:variable name='description' />
							</div>
						</fly:block>
					</li>
				</fly:list>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$('.flexslider').flexslider({
			animation : "fade",            //String: Select your animation type, "fade" or "slide"
			controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		});
	});
</script>