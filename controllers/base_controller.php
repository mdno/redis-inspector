<?php

class BaseController {
	
	protected function __construct($args)
	{
		$this->start_time = microtime(true);
		$this->action = $args['action'];
	}
	public function run()
	{
		$this->{$this->action}();
	}
	
	public function getView()
	{
		foreach ($this->data as $data_key => $data_value)
		{
			$$data_key = $data_value;
		}
		
		$runtime = microtime(true) - $this->start_time;

		ob_start();
		require "views/{$this->controller}_{$this->action}.php";
		$content_for_layout = ob_get_contents();
		ob_end_clean();

		ob_start();		
		require "views/layout.php";
		$html = ob_get_contents();
		ob_end_clean();
		
		return $html;
	}	

	function error()
	{

	}
	
	function raiseError($message)
	{
		$this->data['error'] = $message; 
		$this->controller = 'base';
		$this->action = 'error';
	}
}