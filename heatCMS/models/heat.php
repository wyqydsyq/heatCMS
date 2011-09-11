<?php
class Heat extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    // return a key from heat.conf
    function conf($key){
            $str = $GLOBALS['heat_config'][$key];
            return $str;
    }
    
    // see if user is authorised to access this page
    function user_auth($auth_req='administrator') {
        $query_filters;
        switch ($auth_req) {
            case 'administrator':
                $query_filters = "`class`='administrator'";
                break;
            case 'user':
                $query_filters = "`class`='user' OR `class`='administrator'";
                break;
        }
        if (!strpos(uri_string(), 'login')) {
            // Check user login and verify they're allowed to be here
            $login_cookie = get_cookie('login_key');
            $match = false;
            $allowed_users = array();
            // get all allowed users and put them into an array
            $allowed_users_q = $this->db->query("SELECT * FROM `heat_users` WHERE $query_filters");
            foreach ($allowed_users_q->result() as $user) {
                $allowed_users[] = hash('sha256', $user->username . 'heat' . $user->password);
            }
            // see if any allowed users' keys match the login one
            foreach ($allowed_users as $key) {
                if ($key == $login_cookie) {
                    $match = true;
                }
            }

            // if match was not found, redirect to login. Otherwise refresh the cookie
            if ($match !== true) {
                redirect('login?from='.urlencode(uri_string()));
            } else {
                $cookie = array(
                    'name' => 'login_key',
                    'value' => get_cookie('login_key'),
                    'expire' => 60 * 60,
                    'domain' => '.' . get_domain(),
                    'path' => '/',
                    'prefix' => '',
                );
                set_cookie($cookie);
            }
        }
    }
    
    // return a value from user's database row
    function user($val){
        $key = $this->input->cookie('key');
        $query = $this->db->query("SELECT `$val` FROM `heat_users` WHERE `key`='$key'");
        $col = $query->result_array();
        if($query->num_rows() > 0){
            return $col[0][$val];
        }else{
            return false;
        }
    }
    function error($error, $page){
        redirect('/error/e/404/'.$page, 'location');
    }
    
    function returnDir($dir) {
        $files = array();
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    if (is_dir($dir . '/' . $file)) {
                        $dir2 = $dir . '/' . $file;
                        $files[] = getFilesFromDir($dir2);
                    } else {
                        $files[] = $dir . '/' . $file;
                    }
                }
            }
            closedir($handle);
        }

        return array_flat($files);
    }

    function array_flat($array) {

        foreach ($array as $a) {
            if (is_array($a)) {
                $tmp = array_merge($tmp, array_flat($a));
            } else {
                $tmp[] = $a;
            }
        }

        return $tmp;
    }

}
?>
