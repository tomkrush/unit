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
		
		// $this->output->enable_profiler(TRUE);
		
		$suite = new UnitTestSuite;

		foreach(unit_test_cases() as $test_case)
		{			
			require_once($test_case['path']);
			$suite->addTestCase($test_case['class']);
		}

		$suite->run();
		
		$failed = value_for_key('total_failed', $suite->results, '0');
		$failed = $failed ? $failed : '0';
		
		
		$this->load->vars('passed', value_for_key('total_passed', $suite->results, '0'));	
		$this->load->vars('failed', $failed);							
		$this->load->vars('cases', value_for_key('cases', $suite->results));
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
}