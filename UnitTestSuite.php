<?php

class UnitTestSuite
{
	private $cases = array();
	
	public function addTestCase($className)
	{
		$this->cases[] = $className;
	}
	
	public function run()
	{	
		$passed = 0;
		$failed = 0;
		$total = 0;
		
		ob_start();
		
		foreach($this->cases as $testCase)
		{
			ob_start();
			$time_start = _unit_micro_time();			

			$testCaseObject = new $testCase;
			@$testCaseObject->run();

			$time_stop = _unit_micro_time();
			$time_overall = bcsub($time_stop, $time_start, 6);
			$contents = ob_get_contents();
			ob_end_clean();

			$passed += $testCaseObject->passed();
			$failed += $testCaseObject->failed();
			$total += $testCaseObject->total();

			$has_fails = $testCaseObject->failed() ? 'has_fails' : '';
			$has_passes = $testCaseObject->passed() ? 'has_passes' : '';
			

			echo '<div class="file '.$has_fails.' '.$has_passes.'">';
			echo '<h3>'.$testCase.'</h3>';

			echo '<ul class="results">';
			echo '<li class="passed">passed: <strong>'.$testCaseObject->passed().'</strong></li>';
			echo '<li class="failed">failed: <strong>'.$testCaseObject->failed().'</strong></li>';
			echo '<li class="total">total: <strong>'.$testCaseObject->total().'</strong></li>';
			echo '</ul>';
			echo '<div class="clear"></div>';
			echo $contents;

			echo "<div class=\"overall\"><strong>$time_overall</strong> Seconds</div>";
			echo '</div>';
		}
		
		$tests = ob_get_contents();
		ob_end_clean();
		
				
		
		echo '<!DOCTYPE html>';
		echo '<html>';
		echo '<head>';
		echo '<meta charset="utf-8"/>';
		echo '<title>Unit Tests</title>';
		echo '<script>

		</script>';
		
		echo '<style>';
		echo '
		
		body {
			margin: 0;
			padding: 0;
			font-family: 14px;
			line-height: 1;
			font-family: "Helvetica-Neue", Helvetica, Arial, Sans-Serif;
		}
		
		.clear {
			clear: both;
		}
		
		#header {
			background: #606c88; /* Old browsers */
			background: -moz-linear-gradient(top, #606c88 0%, #3f4c6b 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#606c88), color-stop(100%,#3f4c6b)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top, #606c88 0%,#3f4c6b 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top, #606c88 0%,#3f4c6b 100%); /* Opera11.10+ */
			background: -ms-linear-gradient(top, #606c88 0%,#3f4c6b 100%); /* IE10+ */
			background: linear-gradient(top, #606c88 0%,#3f4c6b 100%); /* W3C */

			width: 100%;
			height: 44px;
			
			margin-bottom: 1px;
		} 
		
		#header h1 {
			text-align: center;
			margin: 0;
			padding: 0;
			font-weight: bold;
			color: #000;
			font-size: 20px;
			padding: 12px;
			color: white;
			text-shadow: 0 -1px 0 rgba(0,0,0,.8);
		}
		
		.navigation {
			margin: 0;
			padding: 0;
			position: absolute;
			top: 0;
			list-style: none;
		}
		
		.navigation li {
			margin: 0;
			padding: 9px 0;
			position: relative;
			float: left;
		}
		
		.navigation.left {
			left: 0;
		}
		
		.navigation.right {
			right: 0;
		}
		
		.navigation.left li {
			padding-left: 10px;
		}

		.navigation.right li {
			padding-right: 10px;
		}

		.navigation li a {
			display: block;
			color: white;
			text-decoration: none;
			text-shadow: 0 -1px 0 #5e42af;
			font-size: 13px;
			padding: 6px 20px 7px;
			line-height: 1;
			text-transform: lowercase;
			font-weight: bold;

			background: #7081a8; /* Old browsers */
			background: -moz-linear-gradient(top, #7081a8 0%, #4b5468 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#7081a8), color-stop(100%,#4b5468)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top, #7081a8 0%,#4b5468 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top, #7081a8 0%,#4b5468 100%); /* Opera11.10+ */
			background: -ms-linear-gradient(top, #7081a8 0%,#4b5468 100%); /* IE10+ */
			background: linear-gradient(top, #7081a8 0%,#4b5468 100%); /* W3C */

			border-radius: 5px;

			box-shadow: 0 -1px 0 #3D4454, inset 0 -1px #59647A;
		}

		.navigation li a:active {
			background: #7081A8; /* Old browsers */
		}
		
		.top {
			position:relative;
		}
		
		#container {

		}
		
		#container h3 {
			margin: 0;
			padding: 0;
			font-size: 24px;
			font-weight: normal;
			padding: 10px 7px;

			text-shadow: 0 1px 0 white; 
			float: left;
		}
		
		.wrapper {
			position:absolute;
			display: none;
		} 
		
		.top:hover .wrapper {
			display: block;
			background:#ddd;
			border:1px solid black; 
			padding: 10px;
		}
		
		.row {
			border-bottom: 1px solid #fff;
			padding: 14px 7px;
			text-shadow: 0 1px 0 white;
		}
		
		.file {
			padding: 10px 0;
			margin-bottom: 10px;
		}
		
		.pass {
			background: #f3ffe7;
		}
		
		.fail {
			background: #ffd8cd;
		}
		
		.pass .title {
			color: green;
		}
		
		.fail .title {
			color: red;
		}
		
		.time {
			color: blue;
		}
		
		.overall {
			margin-top: 10px;
			padding: 0 7px;
		}
		
		.results {
			list-style: none;
			margin: 0;
			padding: 10px;
			float: left;
		}
		
		.results li {
			display: inline-block;
			margin-right: 10px;
		}
		
		.results strong {
			font-size: 20px;
		}
		
		.results .passed strong {
			color: green;
		}
		
		.results .failed strong {
			color: red;
		}
		
		';
		echo '</style>';
		echo '</head>';
		echo '<body>';
		echo '
		<div id="header">
			<h1>Unit Tests</h1>
			<!--<ul class="navigation left">
				<li><a class="top" href="#">choose tests</a></li>
			</ul>-->';
		if ( $failed ) {
		echo '
			<ul class="navigation right">
				<li><a class="top failed" href="#"><strong>'.$failed.'</strong> failed</a></li>
				<li><a class="top passed" href="#"><strong>'.$passed.'</strong> passed</a></li>
				<li><a class="top total" href="#"><strong>'.$total.'</strong> total</a></li>
			</ul>';
		}
			
		echo '</div>
		<div id="container">
		';
		
		echo '</ul>';

		echo $tests;
		
		echo '</div>';
		echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>';
		echo '<script>
		
		$(".navigation.right .passed").click(function() {
			$(".file.has_passes, .file .row.pass").show();
			$(".file.has_fails, .file .row.fail").hide();
			$(".file .results").hide();
		});

		$(".navigation.right .failed").click(function() {
			$(".file.has_passes, .file .row.pass").hide();
			$(".file.has_fails, .file .row.fail").show();
			$(".file .results").hide();
		});

		$(".navigation.right .total").click(function() {
			$(".file.has_passes, .file .row.pass").show();
			$(".file.has_fails, .file .row.fail").show();
			$(".file .results").show();
		});
		
		</script>';
		
		echo '</body>';
		echo '</html>';
	}
}