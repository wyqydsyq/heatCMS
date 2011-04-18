<?php

	class Base extends Controller {
	
		function Base()
		{
			parent::Controller();
			
		}
		
		function index($page='home'){
			$query = $this->db->query("SELECT * FROM `heat_content` WHERE `id`='$page'");
			$result = $query->result_array();
			
			if(empty($result)){
				$this->Heat->error(404, uri_string());
			}else{
				$this->output->set_status_header('200');
				$this->Page->build($result[0], $page);
			}
		}
	}

/* End of file welcome.php */
/* Location: ./system/application/controllers/examples.php */