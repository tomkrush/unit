<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Unit</title>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]--> 
		<link rel="stylesheet" media="all" href="<?=site_url('unit/stylesheets/app.css')?>" /> 		
	</head>
	<body>
		<div class="header">
			<ul class="navigation left">
				<li><a class="top button passed" href="#"><?=$passed?> Passed</a></li>
				<li><a class="top button failed" href="#"><?=$failed?> Failed</a></li>
			</ul>			
			<h1>Unit Tests</h1>
			<ul class="navigation right">
<!--				<li><a class="top button" href="#">Settings</a></li>-->
			</ul>
		</div>
		<div class="cases_wrapper">
			<div class="cases">
				<?php foreach($cases as $case): ?>
					<div class="case">
						<h3><span><?=$case['name']?></span></h3>
						<?php foreach($case['assertions'] as $assertion): ?>
							<div class="assertion <?=$assertion['pass']?>">
								<div class="<?=$assertion['pass']?>"><?=$assertion['pass']?></div>
								<div class="message"><?=$assertion['message']?></div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="footer">
		
		</div>
		<script src="<?=site_url('unit/javascript/jquery-1.6.2.min.js')?>"></script>
		<script src="<?=site_url('unit/javascript/app.js')?>"></script>
	</body>
</html>