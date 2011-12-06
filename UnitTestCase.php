<?php

abstract class UnitTestCase
{
	private $passed, $failed, $total;
	private $time_start;
	private $last_time;
	
	public $assertions = array();
	
	function __get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}	
	
	public function passed()
	{
		return $this->passed;
	}
	
	public function failed()
	{
		return $this->failed ? $this->failed : '0';
	}
	
	public function total()
	{
		return $this->total;
	}
	
	public function setup() {}
	
	public function teardown() {}
	
	private function stop_timer()
	{
		$time_stop = _unit_micro_time();
		$time_overall = bcsub($time_stop, $this->time_start, 6);
						
		$this->last_time = $time_overall;	
	}
		
	public function assertion($test, $message)
	{
		$pass = !!$test;		
		$this->total++;
		
		if ( $pass ) $this->passed++;
		else $this->failed++;
		
		$this->log($pass, $message);		
	}
	
	public function assertTrue($test, $message)
	{	
		$this->stop_timer();
		
		echo $this->value($test);

		$backtrace = debug_backtrace();
		$message = $backtrace[1]['function'].' "<strong>'.$message.'</strong>"';
			
		$this->assertion($test, $message);
	}
	
	public function assertFalse($test, $message)
	{
		$this->stop_timer();
		
		echo $this->value($test);
		
		$backtrace = debug_backtrace();
		$message = $backtrace[1]['function'].' "<strong>'.$message.'</strong>"';
				
		return $this->assertion(!$test, $message);
	}
	
	public function assertEquals($expected, $actual, $message)
	{	
		$this->stop_timer();
		
		echo 'expected:'.$this->value($expected)."\n";
		echo 'actual:'.$this->value($actual)."\n";

		$result = $expected == $actual;
		
		$backtrace = debug_backtrace();
		$message = $backtrace[1]['function'].' "<strong>'.$message.'</strong>"';
		
		$message = $result ? $message : $message;
		
		return $this->assertion($result, $message);
	}
	
	public function assertSame($expected, $actual, $message)
	{	
		$this->stop_timer();
		
		echo 'expected:'.$this->value($expected)."\n";
		echo 'actual:'.$this->value($actual)."\n";

		$result = $expected === $actual;
		
		$backtrace = debug_backtrace();
		$message = $backtrace[1]['function'].' "<strong>'.$message.'</strong>"';
		
		$message = $result ? $message : $message;
		
		return $this->assertion($result, $message);
	}
	
	private function value($value)
	{
		if ( is_string($value) )
		{
			return $value;
		}
		
		if ( is_array($value) )
		{						
			return print_r($value, TRUE);
		}

		return $value;
	}
	
	public function assertNotEquals($expected, $actual, $message)
	{
		$this->stop_timer();
		
		echo 'expected:'.$this->value($expected)."\n";
		echo 'actual:'.$this->value($actual)."\n";
	
		$result = $expected == $actual;

		$backtrace = debug_backtrace();
		$message = $backtrace[1]['function'].' "<strong>'.$message.'</strong>"';
		
		$message = !$result ? $message : $message;
		
		return $this->assertion(!$result, $message);
	}
	
	protected function log($pass, $message)
	{
		$console = $this->end_console();
		
		$this->assertions[] = array(
			'pass' => $pass ? 'pass' : 'fail',
			'message' => $message,
			'execution_time' => $this->last_time,
			'console' => strlen($console) ? $console : FALSE
		);
		
		$this->time_start = _unit_micro_time();
		$this->start_console();
	}
	
	protected function start_console()
	{
		ob_start();
	}
	
	protected function end_console()
	{
		$console = ob_get_contents();
		ob_end_clean();
		return $console;
	}
	
	public function run()
	{
		$array = get_class_methods($this);
		
		$array = array_filter($array, array($this, 'is_test'));
		
		foreach($array as $test)
		{
			$this->start_console();
			$this->setup();
			
			$this->time_start = _unit_micro_time();
			$this->$test();
			
			$this->teardown();
		}
	}
	
	protected static function is_test($value)
	{
		return substr($value, 0, 4) == 'test';
	}
}