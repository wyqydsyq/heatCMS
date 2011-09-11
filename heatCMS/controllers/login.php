<?php

/*
 * login.php
 * 
 * Handles the login process
 */

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function check_credentials($username) {
        $key = $username.'heat'.hash('sha256', $this->input->post('password'));
        $key = hash('sha256', $key);
        $check = $this->db->query("SELECT * FROM `heat_users` WHERE `key`='".$key."'");
        if ($check->num_rows() > 0) {
            $result = $check->result_array();
            $meta = unserialize($result['meta']);
            $meta['last_ip'] = $this->input->ip_address();
            $meta = serialize($meta);
            $this->db->query("UPDATE `heat_users` SET `meta`='".$meta."' WHERE `key`='".$key."'");
            return true;
        } else {
            $this->form_validation->set_message('check_credentials', 'Username or password invalid');
            return false;
        }
    }

    public function index() {
        $this->load->library('form_validation');
        $this->load->helper('form');

        $this->form_validation->set_rules('username', 'lang:setup_dialogue_username', 'callback_check_credentials');
        $this->form_validation->set_message('check_credidentials', lang('login_incorrect'));

        if ($this->form_validation->run() == false) {
            $data['title'] = lang('login');
            $this->Page->build($data, 'login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $key = hash('sha256', $username . 'heat' . hash('sha256', $password));
            $cookie = array(
                'name' => 'login_key',
                'value' => $key,
                'expire' => 60 * 60,
                'domain' => '.' . get_domain(),
                'path' => '/',
                'prefix' => '',
            );
            set_cookie($cookie);
            redirect($this->input->get('from'));
        }
    }

}
