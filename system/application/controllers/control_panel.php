<?php

	class Control_panel extends Controller {
	
		function __construct()
		{
			parent::Controller();
			
			$this->Heat->user_auth('administrator');
		}
		function index(){
			redirect('control_panel/dashboard');
		}
		function check_credidentials($username, $password){
				$password = hash('sha256', $password);
				$check = $this->db->query("SELECT `username` FROM `heat_users` WHERE `username`='$username' AND `password`='$password'");
				if($check->num_rows() > 0){}else{
					$this->form_validation->set_message('check_credidentials', lang('login_incorrect'));
					return false;
				}
		}
		function login(){
			$this->load->library('form_validation');
			
			$check_username = $this->form_validation->set_rules('username', 'lang:setup_dialogue_username' ,'callback_check_credidentials['.$this->input->post('password').']');
			
			if($this->form_validation->run() == false){
				$data['title'] = lang('heat_control_panel_login_title', array(lang('page_control_panel')));
				$data['zone'] = 'footer';	
				
				$data['content'] = '
					<div class="form_errors">
						'.validation_errors().'
					</div>
					'.form_open('control_panel/login').'
					<fieldset>
						<legend>'.lang("page_login").'</legend>
						<ol>
							<li>
								'.form_label(lang("setup_dialogue_username")).'
								'.form_input("username",set_value("username")).'
							</li>
							<li>
								'.form_label(lang("setup_dialogue_password")).'
								'.form_password("password",set_value("password")).'
							</li>
						</ol>
					<input type="submit" value="'.lang("setup_button_next").'" class="form_submit" />
					</fieldset>
					'.form_close().'
				';
				$this->Page->build($data);
			}else{
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$key = hash('sha256', $username.'heat'.hash('sha256', $password));
				$cookie = array(
					'name'   => 'login_key',
					'value'  => $key,
					'expire' => time()+(60 * 60),
					'domain' => '.'.get_domain(),
					'path'   => '/',
					'prefix' => '',
				);
				set_cookie($cookie); 
				redirect('control_panel');
			}
		}
		function dashboard(){
			$data['title'] = lang('heat_control_panel_title', array(lang('page_dashboard')));
			$data['zone'] = 'control_panel';
			$data['content'] = 'CONGRATS! YOU\'RE A HOMO!';
			$this->Page->build($data);
		}
	}

/* End of file welcome.php */
/* Location: ./system/application/controllers/examples.php */