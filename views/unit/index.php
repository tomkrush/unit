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
	<body data-passed="<?=$passed?>" data-failed="<?=$failed?>">
		<div class="header">		
			<h1>Unit Tests</h1>
			<div class="tools">
				<div class="stats total">Total: <strong><?=$passed + $failed?></strong></div>
				<div class="stats passed">Passed: <strong><?=$passed?></strong></div>
				<div class="stats failed">Failed: <strong><?=$failed?></strong></div>
				
				<div class="filter">
					<?=form_dropdown('cases', array(0=>'Show All')+$all_cases)?>
				</div>
			</div>
		</div>
		<div class="cases">
			<?php if ( is_array($cases) ): foreach($cases as $case): ?>
				<?php $this->load->view('unit/case', array('case'=>$case)); ?>
			<?php endforeach; endif; ?>
		</div>
		<script src="<?=site_url('unit/javascript/jquery-1.6.2.min.js')?>"></script>
		<script src="<?=site_url('unit/javascript/app.js')?>"></script>
	</body>
</html>