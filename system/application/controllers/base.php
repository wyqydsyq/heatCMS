<?php

	class Base extends Controller {
	
		function Base()
		{
			parent::Controller();
			
		}
		function __construct()
		{
			parent::Controller();
			
			base_url_check();
		}
		function index(){
			echo $this->config->item('base_url');
		}
	}

/* End of file welcome.php */
/* Location: ./system/application/controllers/examples.php */