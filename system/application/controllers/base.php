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
<<<<<<< HEAD
				$data['title'] = lang('error_404');
				$data['content'] = lang('error_404_msg', current_url());
				$this->output->set_status_header('404');
				$this->Page->build($data);
=======
				$this->Heat->error(404, uri_string());
>>>>>>> 8e57b208f208e8e7f024426d95f2e8d074a76770
			}else{
				$this->output->set_status_header('200');
				$this->Page->build($result[0], $page);
			}
		}
	}

/* End of file welcome.php */
/* Location: ./system/application/controllers/examples.php */