<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><fly:variable name="title" /></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<meta http-equiv="Keywords" content="Google je t'aime<fly:variable name='keywords' />" />
		<meta http-equiv="Description" content="<fly:variable name='description' />" />
		<link rel="shortcut icon" type="image/png"  href="<fly:variable name='rep_img' />assets/favicon.png">
      	<fly:list name="stylesheet">
			<link href="<fly:variable name='style' />" rel="stylesheet">
		</fly:list>
		<!--[if lt IE 9]>
	    <fly:list name="javascript-ie">
	      	<script src="<fly:variable name='script-ie' />"></script>
	    </fly:list>
	    <![endif]-->
		<fly:list name="javascript">
			<script src="<fly:variable name='script' />"></script>
		</fly:list>
	</head>
	<body>
		<fly:file name="content" />
	</body>
</html>