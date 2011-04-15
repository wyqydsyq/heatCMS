<?php

	class Setup extends Controller {
	
		function Setup()
		{
			parent::Controller();
			
		}
		
		function index(){
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('site_name', 'lang:setup_dialogue_name' ,'required');
			$this->form_validation->set_rules('username', 'lang:setup_dialogue_username' ,'required');
			$this->form_validation->set_rules('password', 'lang:setup_dialogue_password' ,'required');
			$this->form_validation->set_rules('email', 'lang:setup_dialogue_email' ,'required|valid_email');
			
			if($this->form_validation->run() == false){
				
				
				$create_table['content'] = $this->db->query("CREATE TABLE IF NOT EXISTS `heat_content` (
					`id` TEXT PRIMARY KEY,
					`name` TEXT,
					`content` TEXT,
					`meta` TEXT,
					`timestamp` TIMESTAMP CURRENT_TIMESTAMP
				)");
				$create_table['users'] = $this->db->query("CREATE TABLE IF NOT EXISTS `heat_users` (
					`id` INTEGER PRIMARY KEY,
					`username` TEXT,
					`password` TEXT,
					`email` TEXT,
					`class` TEXT,
					`meta` TEXT
				)");
				$create_table['config'] = $this->db->query("CREATE TABLE IF NOT EXISTS `heat_config` (
					`name` TEXT PRIMARY KEY,
					`content` TEXT
				)");
				
				$this->db->query("REPLACE INTO `heat_config` (name, content) VALUES('theme', 'heat_default')");
				
				
				$data['title'] = lang('setup_title');
				$this->Page->build($data, 'setup/pre_setup', 'system');
				
			}else{
				$fields = $_POST;
				$conf_arr = array('site_name'=>$fields['site_name'], 'root_url'=>$this->config->system_url(), 'status'=>true);
				$conf_arr = serialize($conf_arr);
				$filename = "assets/heat.conf";
				$handle = fopen($filename, "w");
				$conf = fwrite($handle, $conf_arr);
				fclose($handle);
				
				$username = $fields['username'];
				$password = hash('sha256', $fields['password']);
				$email = $fields['email'];
				$class = 'administrator';
				$meta = array(
					'created'			=> time(),
					'last_ip'			=> $_SERVER['REMOTE_ADDR'],
					'key'				=> hash('sha256',$username.'heat'.$password),
				);
				$meta = serialize($meta);
				
				// this is where we insert the admin's account
				$query_users = "REPLACE INTO `heat_users` (username, password, email, class, meta) VALUES('$username', '$password', '$email', '$class', '$meta')";
				
				
				// all the stuff we wanna insert into the heat_config table
				$config_arr = array(
					'theme' 			=> 'heat_default',
					'site_url' 			=> $conf_arr['site_url'],
					'site_name' 		=> $conf_arr['site_name'],
					'root_url' 			=> $conf_arr['root_url'],
					'created' 			=> time(),
					'language'			=> $conf_arr['language']
				);
				
				// insert said stuff into heat_config
				foreach($config_arr as $key=>$val){
					$this->db->query("REPLACE INTO `heat_config` (name, content) VALUES('$key','$val')");
				}
				// insert admin to heat_users
				$this->db->query($query_users);
				
				redirect('setup/done', 'refresh');
			}
		}
		function done(){
			$data = array();
			
						
			$data['title'] = lang('setup_title');
			$data['content'] = '<h1>Setup Successful</h1><p>Setup completed successfully, '.anchor('control_panel','click here').' to log in to the control panel, or '.anchor('','click here').' to go to the homepage</p>';
			$this->Page->build('page/page_default', $data, 'system');
		}
	}
?>