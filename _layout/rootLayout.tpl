<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><fly:variable name="title" /></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="<fly:variable name='description' />">
        <meta name="author" content="<fly:variable name='author' />">
		<meta name="robots" content="<fly:variable name='index' />, <fly:variable name='follow' />">
		<link rel="canonical" href="http://<fly:variable name='canonical' />">
        <link rel="icon" type="image/png" href="/design/assets/favicon.png">
		<fly:list name="stylesheet">
			<link href="/<fly:variable name='style' />" rel="stylesheet">
		</fly:list>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	    <fly:list name="javascript-ie">
	      	<script src="/<fly:variable name='script-ie' />"></script>
	    </fly:list>
	    <![endif]-->
	   	<fly:list name="javascript">
			<script src="/<fly:variable name='script' />"></script>
		</fly:list>
		<fly:list name="javascript-live">
			<script src="<fly:variable name='script-live' />"></script>
		</fly:list>
	</head>
	<body>
		<fly:file name="content" />
		<div class="slide-out-tab-left hidden-xs">
	        <a class="handle" href="#">Content</a>
	        <div class="title">
	        	Be good to yourself<br>
	        	-try <span class="green">ProVie</span> G<br>
	        	today!
	        </div>
			<div class="text-center">
				<!-- ppal -->
				<form id="paypal" method="post" action="https://www.paypal.com/cgi-bin/webscr" target="paypal">
					<input type="hidden" value="_s-xclick" name="cmd">
					<input type="hidden" value="QAQGCQKBAHZP8" name="hosted_button_id">
					<table>
						<tbody>
							<tr>
								<td><input type="hidden" value="Provie G Products" name="on0"></td>
							</tr>
							<tr>
								<td style="display: none;">
									<select name="os0" class="black">
										<option value="60 Capsules per Bottle">60 Capsules per Bottle $75.00 USD</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
					<input type="hidden" value="USD" name="currency_code">
					<div class="push-1">&nbsp;</div>
	        		<a href="javascript:;" onclick="$('#paypal').submit();"><img width="160px" height="252px" src="/design/provieg-images/ProVieG.png"></a>
				</form>
			</div>
			<!-- ppal -->
	    </div>
	</body>
</html>