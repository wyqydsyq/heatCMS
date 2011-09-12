<?php
switch($action){
    case 'enable':
        $enable = $this->db->query("INSERT INTO `heat_desklets` (`name`) VALUES('".$desklet."')");
        if($enable){
            echo 'true';
        }else{
            echo 'false';
        }
    break;
    case 'disable':
        $disable = $this->db->query("DELETE FROM `heat_desklets` WHERE(`name`='".$desklet."')");
        if($disable){
            echo 'true';
        }else{
            echo 'false';
        }
    break;
}
?>
