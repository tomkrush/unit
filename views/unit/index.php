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
		<div class="header toolbar">		
			<h1>Unit Tests</h1>
		</div>
		<div class="cases_wrapper">
			<div class="cases">
				<?php if ( is_array($cases) ): foreach($cases as $case): ?>
					<div class="case" rel="<?=$case['name']?>" data-passed="<?=$case['total_passed']?>" data-failed="<?=$case['total_failed']?>">
						<h3><span><?=$case['name']?></span></h3>
						<?php foreach($case['assertions'] as $assertion): ?>
							<div class="assertion <?=$assertion['pass']?>">
								<div class="<?=$assertion['pass']?>"><?=$assertion['pass']?></div>
								<div class="message"><?=$assertion['message']?></div>
								<div class="time"><?=$assertion['execution_time']?></div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endforeach; endif; ?>
			</div>
		</div>
		<div class="footer toolbar">
			<ul class="navigation left">
				<li><a class="top button passed" href="#"><span><?=$passed?></span> Passed</a></li>
				<li><a class="top button failed" href="#"><span><?=$failed?></span> Failed</a></li>
			</ul>	
			<ul class="navigation right">
				<li class="filter"><a class="top button" href="#">Filter</a>
					<div class="popover">
						<ul class="list"></ul>
					</div>
				</li>
			</ul>		
		</div>
		<script src="<?=site_url('unit/javascript/jquery-1.6.2.min.js')?>"></script>
		<script src="<?=site_url('unit/javascript/app.js')?>"></script>
	</body>
</html>