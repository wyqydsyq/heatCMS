<?php
class Database extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	// config queries
	function update_config($arr){ // $arr should be an array like $arr[<column>]=<value>
		foreach($arr as $key=>$val){
			$result = $this->db->query("REPLACE INTO heat_config (name, content) VALUES('".$key."', '".$val."')");
			return $result;
		}
	}
	function get_config($field){
		$result = $this->db->query("SELECT * FROM heat_config WHERE `name`='".$field."'");
		$result = $result->row();
		return $result->content;
	}
}
?>