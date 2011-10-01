<?php

if ( ! function_exists( 'unit_test_cases' ) )
{
	function unit_test_cases()
	{
		$CI =& get_instance();
		$CI->load->helper('directory');
		$CI->load->config('unit');
		
		$base_paths = $CI->config->item('test_paths');
		$paths = array();		
				
		foreach($base_paths as $path)
		{
			$path = APPPATH.$path.'/';
			$tests_path = $path.'order.php';
			
			if (file_exists($tests_path))
			{
				require $tests_path;
			}
			else
			{
				$order = directory_map($path);
			}
					
			if ( is_array($order) )
			{
				foreach($order as $file)
				{
					if ($file == 'tests.php') continue;

					$class = str_replace('.php', '', $file);
					
					$paths[] = array(
						'class' => $class,
						'path' => $path.$class.'.php'
					);
				}
			}
		}
		
		return $paths;
	}
}