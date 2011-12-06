<?php

require_once APPPATH."third_party/unit/unit.php";

class Unit extends CI_Controller 
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->helper('unit');
		$this->load->helper('form');
				
		$suite = new UnitTestSuite;

		foreach(unit_test_cases() as $test_case)
		{			
			require_once($test_case['path']);
			$suite->addTestCase($test_case['class']);
		}

		$suite->run();
		
		$failed = array_key_exists('total_failed', $suite->results) ? $suite->results['total_failed'] : 0;
		$failed = $failed ? $failed : '0';

		
		$passed = array_key_exists('total_passed', $suite->results) ? $suite->results['total_passed'] : 0;
		$passed = $passed ? $passed : '0';

		$cases = array_key_exists('cases', $suite->results) ? $suite->results['cases'] : 0;
		$cases = $cases ? $cases : array();	
		
		$this->load->helper('unit');
		
		$all_cases = array();
		foreach(unit_test_cases() as $case)
		{
			$all_cases[$case['class']] = $case['class'];
		}
		
		$this->load->vars('passed', $passed);							
		$this->load->vars('failed', $failed);							
		$this->load->vars('cases', $cases);	
		$this->load->vars('all_cases', $all_cases);						
		$this->load->view('unit/index');
	}

	public function images($file)
	{
		$this->load->helper('file');
		$path = APPPATH.'third_party/unit/images/'.$file;
		$this->output->set_content_type(get_mime_by_extension($path));
		$this->output->set_output(file_get_contents($path));	
	}
	
	public function stylesheets($file)
	{
		$this->output->set_content_type('text/css');
		$this->output->set_output(file_get_contents(APPPATH.'third_party/unit/stylesheets/'.$file));	
	}
	
	public function javascript($file)
	{
		$this->output->set_content_type('text/javascript');		
		$this->output->set_output(file_get_contents(APPPATH.'third_party/unit/javascript/'.$file));	
	}
	
	public function api_refresh()
	{
		$this->load->helper('unit');
		$case = $this->input->get('case');
				
		$suite = new UnitTestSuite;

		foreach(unit_test_cases() as $test_case)
		{			
			if ( $case == $test_case['class'] ) {
				require_once($test_case['path']);
				$suite->addTestCase($test_case['class']);
				break;
			}
		}

		$suite->run();
	
		$cases = array_key_exists('cases', $suite->results) ? $suite->results['cases'] : 0;
		$case = $cases ? $cases[0] : array();	


		$this->load->vars('case', $case);	
		$this->load->view('unit/case');
	}
	
	public function api_all_cases()
	{
		$this->load->helper('unit');
		
		$cases = array();
		
		foreach(unit_test_cases() as $case)
		{
			$cases[] = $case['class'];
		}
				
		$this->output->set_content_type('text/json');		
		$this->output->set_output(json_encode($cases));
	}
}