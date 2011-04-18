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
		function check_credentials($username, $password){
				$password = hash('sha256', $password);
				$check = $this->db->query("SELECT `username` FROM `heat_users` WHERE `username`='$username' AND `password`='$password'");
				if($check->num_rows() > 0){}else{
					$this->form_validation->set_message('check_credidentials', lang('login_incorrect'));
					return false;
				}
		}
		// TODO: login() should really be it's own controller and it should get the form via a view
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
                /*
                 * Control panel pages from here
                 */
                // Dashboard
		function dashboard(){
			$data['title'] = lang('heat_control_panel_title', array(lang('page_dashboard')));
			$data['zone'] = 'control_panel';
			$data['content'] = '"dashboard" content here';
			$this->Page->build($data, false, 'system');
		}
                // Pages and page manipulation (add/edit/delete etc.)
		function pages($action='list',$page=NULL){
		    switch($action){
			// List pages
			case 'list':
			    $data['title'] = lang('heat_control_panel_title', array(lang('page_pages_list')));
			    $data['zone'] = 'control_panel';
			    
			    // loop through all pages and collect them
			    $query = $this->db->query("SELECT * FROM `heat_content`");
			    if ($query->num_rows() > 0) {
				$i = 0;
				foreach ($query->result() as $page) {
				    $data['pages'][$i]['title'] = $page->title;
				    $data['pages'][$i]['path'] = $page->path;
				    $data['pages'][$i]['timestamp'] = $page->timestamp;
				    $i++;
				}
			    }
			    
			    // send collected pages to this view
			    $this->Page->build($data, 'control_panel/list', 'system');
			break;
                        
                        default:
                            redirect('/error/404');
                        break;
		    }
		}

	}

/* End of file control_panel.php */
/* Location: ./system/application/controllers/control_panel.php */