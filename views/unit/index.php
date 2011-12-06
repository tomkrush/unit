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
			<h1>Unit Tests</h1>
			<div class="tools">
				<div class="stats">Total: <strong><?=$passed + $failed?></strong></div>
				<div class="stats">Passed: <strong><?=$passed?></strong></div>
				<div class="stats">Failed: <strong><?=$failed?></strong></div>
<!--				
				<div class="filter">
					<?=form_dropdown('cases', $all_cases)?>
					<input type="submit" value="Run" />
				</div>-->
			</div>
		</div>
		<div class="cases">
			<?php if ( is_array($cases) ): foreach($cases as $case): ?>
				<div class="case">
					<h3><?=$case['name']?></h3>
					<?php foreach($case['assertions'] as $assertion): ?>
						<div class="assertion <?=$assertion['pass']?>">
							<div class="status <?=$assertion['pass']?>"><?=$assertion['pass']?></div>
							<div class="message"><?=$assertion['message']?></div>
							<?php if ( $assertion['console'] ): ?>
								<a href="#" class="console">Console</a>
							<?php endif; ?>
							<div class="time"><?=$assertion['execution_time']?></div>
						</div>
						<div class="buffer">
							<pre><?=$assertion['console']?></pre>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endforeach; endif; ?>
		</div>
		<script src="<?=site_url('unit/javascript/jquery-1.6.2.min.js')?>"></script>
		<script src="<?=site_url('unit/javascript/app.js')?>"></script>
	</body>
</html>