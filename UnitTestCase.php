<?php

abstract class UnitTestCase
{
	private $passed, $failed, $total;
	private $time_start;
	private $last_time;
	
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

		$backtrace = debug_backtrace();
		$message = 'Case: '.$backtrace[1]['function'].' "<strong>'.$message.'</strong>"';
			
		$this->assertion($test, $message);
	}
	
	public function assertFalse($test, $message)
	{
		$this->stop_timer();
		
		$backtrace = debug_backtrace();
		$message = 'Case: '.$backtrace[1]['function'].' "<strong>'.$message.'</strong>"';
				
		return $this->assertion(!$test, $message);
	}
	
	public function assertEquals($expected, $actual, $message)
	{
		$this->stop_timer();

		$result = $expected === $actual;
		
		$backtrace = debug_backtrace();
		$message = 'Case: '.$backtrace[1]['function'].' "<strong>'.$message.'</strong>"';
		
		$message = $result ? $message : $message.'(Expected: '.$this->value($expected).' / Actual: '.$this->value($actual).')';
		
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
			$html .= '<span class="top"><span style="color: blue">Array</span>';
			
			$html .= '<span class="wrapper"><pre>'.print_r($value, TRUE).'</pre></span>';
			
			$html .= '</span>';
			
			return $html;
		}
		
		return '<span style="color: #888">'.$value.'</span>';
	}
	
	public function assertNotEquals($expected, $actual, $message)
	{
		$this->stop_timer();
	
		$result = $expected == $actual;

		$backtrace = debug_backtrace();
		$message = 'Case: '.$backtrace[1]['function'].' "<strong>'.$message.'</strong>"';
		
		$message = !$result ? $message : $message.'(Expected: '.$this->value($expected).' / Actual: '.$this->value($actual).')';
		
		return $this->assertion(!$result, $message);
	}
	
	
	protected function log($pass, $message)
	{		
		$mode = '';
		$count = 0;
		
		if ( $pass )
		{
			$mode = 'pass';
			$count = $this->passed;
		}
		else
		{
			$mode = 'fail';
			$count = $this->failed;
		}
		
		$message = '<div class="row '.$mode.'"><strong class="title">'.$mode."</strong>: {$message} <small> <span class=\"time\">".$this->last_time."</span></small></div>";
		
		echo $message;
		$this->time_start = _unit_micro_time();
	}
	
	public function run()
	{
		$array = get_class_methods($this);
		
		$array = array_filter($array, array($this, 'is_test'));
		
		foreach($array as $test)
		{
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