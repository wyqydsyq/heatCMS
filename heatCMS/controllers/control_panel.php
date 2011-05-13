<?php

	class Control_panel extends CI_Controller {
	
		function __construct()
		{
			parent::__construct();
			
			$this->Heat->user_auth('administrator');
		}
		public function index(){
			redirect('control_panel/dashboard');
		}
		
                /*
                 * Control panel pages from here
                 */
                // Dashboard
		public function dashboard(){
			$data['title'] = lang('cpnl_title', array(lang('dashboard')));
			$data['zone'] = 'control_panel';
			$data['content'] = '"dashboard" content here';
			$this->Page->build($data, false, 'system');
		}
                // Pages and page manipulation (add/edit/delete etc.)
		public function pages($action='list',$page=NULL){
		    switch($action){
			// List pages
			case 'list':
			    $data['title'] = lang('cpnl_title', array(lang('pages')));
			    $data['zone'] = 'control_panel';
			    
			    // loop through all pages and collect them
			    $query = $this->db->query("SELECT * FROM `heat_content` ORDER BY `order` ASC");
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
			    $this->Page->build($data, 'control_panel/pages/list', 'system');
			break;
                        case 'new':
                            $page_content = $this->input->post('page_content');
                            $page_order = $this->input->post('page_order');
                            $page_path = $this->input->post('page_path');
                            $page_title = $this->input->post('page_name');
                            $meta = serialize(array(
                                'last_editor' => $this->Heat->user('username')
                            ));
                            
                            if(empty($page_content)){
                                // if form hasn't been submitted, show the form
                                $data['title'] = lang('cpnl_title', array(lang('cpnl_new_page_title')));
                                $data['zone'] = 'control_panel';
                                $this->Page->build($data, 'control_panel/pages/new', 'system');
                            } else {
                                // otherwise submit form data and create the page
                                $insert = $this->db->query("INSERT INTO `heat_content` 
                                    (`id`,`order`,`path`,`title`,`content`,`meta`,`timestamp`) 
                                    VALUES(
                                        '".url_title($page_title, 'underscore', true)."',
                                        '".$page_order."',
                                        '".url_title($page_path, 'underscore', true)."',
                                        '".$page_title."',
                                        '".$page_content."',
                                        '".$meta."',
                                        '".time()."'
                                )");
                                redirect('control_panel/pages?message='.urlencode(lang('page_created', array($page_title))));
                            }
                        break;
                        case 'delete':
                            if(!empty($page)){
                                $query = $this->db->query('"DELETE FROM `content` WHERE `id`="'.$page.'"');
                            }
                        break;
                        default:
                            $this->Heat->error(404, uri_string());
                        break;
		    }
		}
	}

/* End of file control_panel.php */
/* Location: ./system/application/controllers/control_panel.php */