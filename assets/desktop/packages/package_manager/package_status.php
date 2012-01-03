<?php
switch($action){
    case 'enable':
        $enable = $this->db->query("INSERT INTO `heat_packages` (`name`) VALUES('".$package."')");
        if($enable){
            echo 'true';
        }else{
            echo 'false';
        }
    break;
    case 'disable':
        $disable = $this->db->query("DELETE FROM `heat_packages` WHERE(`name`='".$package."')");
        if($disable){
            echo 'true';
        }else{
            echo 'false';
        }
    break;
}
?>
