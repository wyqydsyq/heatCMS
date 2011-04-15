<?php
class Page extends Model {

    function Page()
    {
        parent::Model();
    }
	// page building function
	/*
			$page		: The page to look for
			$vars		: Variables to send to that page, or to the template
			$type		: Is this a different type of page from the default?
			$assets		: Are there any special assets (css/js) we need to load for this page?
	*/
	function build($vars, $page=NULL, $type=false, $assets=array()){
		
		$this->load->model('database');
		
		// overwrite assets by page type
		switch($type){
			// system pages. Control panel .etc
			case 'system':
				$assets['css']['']='file/system.css';
				if(Database::get_config('theme') != 'heat_default'){$assets['css']['']='../themes/heat_default/css/stylesheet.css';}
			break;
		}
		
		// find the page
		$query = $this->db->query("SELECT * FROM `heat_content` WHERE `name`='$page'");
			
		// get theme from db
		$get_theme = Database::get_config('theme');
		if(($theme = $get_theme) === false){
			$theme = 'heat_default';
		}
		
		$css = NULL;
		$js = NULL;
		// add on the requested files from the $assets array
		if(!empty($assets)){
			foreach($assets as $type=>$key){
				foreach($key as $key=>$val){
					if(empty($$type)){$$type = false;}
					$$type .= $val.",";
				}
				// snip the last ampersand off
				$$type = substr($$type, 0, strlen($$type)-1);
			}
		}
		
		// set theme strings
		$data['theme_css'] = '<link type="text/css" rel="stylesheet" href="'.$this->heat_conf('site_url').'assets/css/stylesheet.css?stylesheets='.$css.'&amp;theme='.$theme.'" />';
		$data['theme_js'] = '<script type="text/javascript" src="'.$this->heat_conf('site_url').'assets/js/javascript.js?scripts='.$js.'&amp;theme='.$theme.'"></script>';
		
		// away we go!
		if($query->num_rows() != 0){
			$this->load->view('template', $data, true);
			$this->output->set_output($output);
		}else{
			$data = array_merge($data, $vars);
			if($page !== NULL){
				$data['content'] = $this->load->view($page, $data, true);	
			}
			$output = $this->load->view('template', $data, true);
			$this->output->set_output($output);
		}
		
	}
function generate_nav($zone='',$list=true){
		$return='';
		if($list === true){
			$li_o = "<li>";
			$li_c = "</li>\n";
		}
		
		switch($zone){		
			case 'control_panel':
				$return .= @$li_o.anchor('','Live Site').@$li_c;
				$return .= @$li_o.anchor('control_panel/dashboard','Dashboard').@$li_c;
			break;
			case 'footer':
				$return .= @$li_o.anchor('','Home').@$li_c;
			break;
			default:
				$query = $this->db->query("SELECT `id`,`name` FROM `heat_content`");
				
				if ($query->num_rows() > 0){
					foreach ($query->result() as $row){
						$return .= @$li_o.anchor($row->id, $row->name).@$li_c;
						echo $row->name;
					}
				}
			break;
			
		}
		return $return;
	}
	function heat_conf($key){
		$str = $GLOBALS['heat_config'][$key];
		return $str;
	}
}
?>