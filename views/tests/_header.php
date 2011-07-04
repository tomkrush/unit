<!DOCTYPE html> 
<html> 
	<head> 
		<meta charset="utf-8"/> 
		<title>Unit</title> 
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]--> 
		<link rel="stylesheet" media="all" href="application/third_party/unit/stylesheets/app.css"/> 
		<meta name="viewport" content="width=device-width, initial-scale=1"/> 
		<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ --> 
	</head>
	<body>
		<div id="header">
			<h1>Unit Tests</h1>
			<ul class="navigation right">
				<li><a class="top failed" href="#"><strong><?=$failed?></strong> failed</a></li>
				<li><a class="top failed" href="#"><strong><?=$passed?></strong> passed</a></li>
				<li><a class="top failed" href="#"><strong><?=$total?></strong> total</a></li>
			</ul>
		</div>