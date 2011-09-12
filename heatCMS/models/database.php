<?php

class Database extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // config queries
    function update_config($arr) { // $arr should be an array like $arr[<column>]=<value>
        foreach ($arr as $key => $val) {
            $result = $this->db->query("REPLACE INTO heat_config (name, content) VALUES('" . $key . "', '" . $val . "') WHERE name='" . $key . "'");
            return $result;
        }
    }

    function get_config($field=false) {
        if (empty($field)) {
            $result = $this->db->query("SELECT * FROM heat_config");
            foreach ($result->result_array() as $item) {
                $return[$item['name']] = $item['content'];
            }
            return $return;
        }
        $result = $this->db->query("SELECT * FROM heat_config WHERE `name`='" . $field . "'");
        $result = $result->row_array();
        return $result['content'];
    }

    function get_enabled_desklets() {
        $result = $this->db->query("SELECT * FROM heat_desklets");
        foreach ($result->result_array() as $item) {
            $return[$item['name']] = array();
        }
        return $return;
    }

}

?>