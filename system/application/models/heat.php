<?php
class Heat extends Model {

    function Heat()
    {
        parent::Model();
    }
	
	// see if user is authorised to access this page
	function user_auth($auth_req='administrator'){
		$query_filters;
		switch($auth_req){
			case 'administrator':
				$query_filters = "`class`='administrator'";
			break;
			case 'user':
				$query_filters = "`class`='user' OR `class`='administrator'";
			break;
		}
		if(!strpos(uri_string(), 'login')){
			// Check user login and verify they're allowed to be here
			$login_cookie = get_cookie('login_key');
			$match = false;
			$allowed_users = array();
			// get all allowed users and put them into an array
			$allowed_users_q = $this->db->query("SELECT * FROM `heat_users` WHERE `class`='administrator'");
			foreach($allowed_users_q->result() as $user){
				$allowed_users[] = hash('sha256', $user->username.'heat'.$user->password);
			}
			// see if any allowed users' keys match the login one
			foreach($allowed_users as $key){
				if($key == $login_cookie){$match = true;}
			}
			
			// if match was not found, redirect to login. Otherwise refresh the cookie
			if($match !== true){
				redirect('control_panel/login');
			}else{
				$cookie = array(
					'name'   => 'login_key',
					'value'  => get_cookie('login_key'),
					'expire' => time()+(60 * 60),
					'domain' => '.'.get_domain(),
					'path'   => '/',
					'prefix' => '',
				);
				set_cookie($cookie);	
			}
		}
	}
}
?>