<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="row hidden-xs">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="mailto pull-right">
							<span class="glyphicon glyphicon-envelope white"></span>
							<span class="mail"><a href="mailto:sales@provivaglobal.com">sales@provivaglobal.com</a></span>
						</div>
					</div>
				</div>
				<div class="push-1"></div>
				<div class="row">
					<div class="col-xs-10 col-sm-10 col-md-10">
						<div class="row">
							<div class="col-xs-6 col-sm-4 col-md-4">
								<a class="logo" href="/<fly:variable name='language_code' />">
				       				<img class="img-responsive" src="/design/provieg-images/Logo.png">
				       			</a>
							</div>
						</div>
					</div>
					<div class="col-xs-2 col-sm-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
						  		<div class="bfh-selectbox bfh-languages pull-right" data-language="<fly:variable name='default-lang' />" data-available="<fly:variable name='multi-lang' />" data-flags="true" data-blank="false" data-mobile="true" data-force="false">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- / .col -->
		</div> <!-- / .row -->
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<fly:list name="nav">
					<li <fly:variable name='nav_active' />><a href="/<fly:variable name='nav_url' />"><fly:variable name='nav_title' /></a></li>
				</fly:list>
         	</ul>
		</div> <!--/.nav-collapse -->
	</div> <!-- /.container -->
</div> <!-- /.navbar -->
<script type="text/javascript">
	$(function() {
		$('.bfh-languages').on('change.bfhselectbox', function() {
			var lang = $(this).val().replace(/(\w+)_(\w+)/,'$1');
			//lang = /^en$/i.test(lang) ? '' : lang + '/';
			var url = '/' + lang + '/' + W.filename();
			//console.log('>>> ' + url);
			W.assign(url);
		});
	});
	
	var W = {
		// Sets or returns the anchor part (#) of a URL
		hash: function() {
			return window.location.hash;
		},
		// Sets or returns the hostname and port number of a URL
		host: function() {
			return window.location.host;
		},
		// Sets or returns the hostname of a URL
		hostname: function() {
			return window.location.hostname;
		},
		// Sets or returns the entire URL
		href: function() {
			return window.location.href;
		},
		// Returns the protocol, hostname and port number of a URL
		origin: function() {
			return window.location.origin;
		},
		// Sets or returns the path name of a URL
		pathname: function() {
			return window.location.pathname;
		},
		// Sets or returns the port number of a URL
		port: function() {
			return window.location.port;
		},
		// Sets or returns the protocol of a URL
		protocol: function() {
			return window.location.protocol;
		},
		// Sets or returns the querystring part of a URL
		search: function() {
			return window.location.search;
		},
		filename: function() {
			return W.pathname().substr(W.pathname().lastIndexOf('/')+1);
		},
		assign: function(url) {
			window.location.assign(url);
		}
	}
</script>