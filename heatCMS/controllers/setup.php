<?php

class Setup extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        // setup form validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('site_name', 'lang:setup_dialogue_name', 'required');
        $this->form_validation->set_rules('username', 'lang:setup_dialogue_username', 'required');
        $this->form_validation->set_rules('password', 'lang:setup_dialogue_password', 'required');
        $this->form_validation->set_rules('email', 'lang:setup_dialogue_email', 'required|valid_email');



        if ($this->form_validation->run() == false) {
            // if the form isn't validated successfully, create/alter the database and show the setup form.
            // content table
            $create_table['content'] = $this->db->query("CREATE TABLE IF NOT EXISTS `heat_content` (
                `id` TEXT PRIMARY KEY,
                `order` NUMERIC,
                `parent` TEXT,
                `title` TEXT,
                `content` TEXT,
                `meta` TEXT,
                `timestamp` TIMESTAMP CURRENT_TIMESTAMP
            )");

            // users table
            $create_table['users'] = $this->db->query("CREATE TABLE IF NOT EXISTS `heat_users` (
                `id` INTEGER PRIMARY KEY,
                `username` TEXT,
                `password` TEXT,
                `email` TEXT,
                `class` TEXT,
                `key` TEXT,
                `meta` TEXT
            )");

            // packages table
            $create_table['packages'] = $this->db->query("CREATE TABLE IF NOT EXISTS `heat_packages` (
                `name` TEXT PRIMARY KEY
            )");

            // config table
            $create_table['config'] = $this->db->query("CREATE TABLE IF NOT EXISTS `heat_config` (
                `name` TEXT PRIMARY KEY,
                `content` TEXT
            )");

            // set default theme
            $this->db->query("REPLACE INTO `heat_config` (`name`, `content`) VALUES('theme', 'heat_default')");

            // create default home page
            $meta = serialize(array('created' => time(), 'last_editor' => 'system'));
            $this->db->query("REPLACE INTO `heat_content`
                (`id`, `order`, `parent`, `title`, `content`, `meta`, `timestamp`)
                VALUES(
                    'home',
                    '1',
                    '',
                    'Home',
                    'Welcome to your new heatCMS installation!',
                    '" . $meta . "',
                    '" . time() . "'
                )
            ");

            // enable default packages
            $default_packages = array('dashboard', 'package_manager');
            foreach ($default_packages as $package) {
                $this->db->query("REPLACE INTO `heat_packages` (`name`) VALUES('" . $package . "')");
            }

            // find installed languages
            $languages = array();
            if ($handle = opendir('heatCMS/language')) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        $languages[$file] = $file;
                    }
                }
                closedir($handle);
            }

            // display setup form
            $data['title'] = lang('setup_title');
            $data['languages'] = $languages;
            $this->Page->build($data, 'setup/pre_setup', 'system');
        } else {
            // the form was validated, insert data to dbs and configure the install
            // insert data into heat.conf
            $fields = $_POST;
            $conf_arr = array('site_name' => $fields['site_name'], 'root_url' => $this->config->system_url(), 'status' => true);
            $conf_arr = serialize($conf_arr);
            $filename = "assets/heat.conf";
            $handle = fopen($filename, "w");
            $conf = fwrite($handle, $conf_arr);
            fclose($handle);

            // insert data into database
            $username = $fields['username'];
            $password = hash('sha256', $fields['password']);
            $email = $fields['email'];
            $class = 'administrator';
            $key = hash('sha256', $username . 'heat' . $password);
            $meta = array(
                'created' => time(),
                'last_ip' => $_SERVER['REMOTE_ADDR'],
            );
            $meta = serialize($meta);

            // create admin account
            $query_users = "REPLACE INTO `heat_users` (`username`, `password`, `email`, `class`, `key`, `meta`) VALUES('$username', '$password', '$email', '$class', '$key', '$meta')";


            // data to insert into the heat_config table
            $config_arr = array(
                'theme' => 'heat_default',
                'site_name' => $fields['site_name'],
                'created' => time(),
                'language' => $fields['language']
            );

            // insert into heat_config
            foreach ($config_arr as $key => $val) {
                $this->db->query("REPLACE INTO `heat_config` (`name`, `content`) VALUES('$key','$val')");
            }
            // insert admin to heat_users
            $this->db->query($query_users);

            redirect('setup/done', 'refresh');
        }
    }

    public function done() {
        $data = array();


        $data['title'] = lang('setup_complete_title');
        $data['content'] = lang('setup_complete_message');
        $this->Page->build($data, NULL, 'system');
    }

}

?>