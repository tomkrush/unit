<?php

class UnitTestSuite
{
	private $cases = array();
	
	public $results = array();
	
	public function addTestCase($className)
	{
		$this->cases[] = $className;
	}
	
	public function run()
	{	
		$passed = 0;
		$failed = 0;
		$total = 0;
		
		$this->results = array(
			'total_passed' => 0,
			'total_failed' => 0,
			'cases' => array()
		);
				
		foreach($this->cases as $testCase)
		{
			$time_start = _unit_micro_time();			

			$testCaseObject = new $testCase;
			@$testCaseObject->run();

			$time_stop = _unit_micro_time();
			$time_overall = bcsub($time_stop, $time_start, 6);

			$passed += $testCaseObject->passed();
			$failed += $testCaseObject->failed();
			$total += $testCaseObject->total();

			$has_fails = $testCaseObject->failed() ? 'has_fails' : '';
			$has_passes = $testCaseObject->passed() ? 'has_passes' : '';
			
			$this->results['cases'][] = array(
				'name' => $testCase,
				'execution_time' => $time_overall,
				'total_passed' => $passed,
				'total_failed' => $failed,
				'assertions' => $testCaseObject->assertions
			);
		}
		
		$this->results['total_passed'] += $passed;
		$this->results['total_failed'] += $failed;
	}
}