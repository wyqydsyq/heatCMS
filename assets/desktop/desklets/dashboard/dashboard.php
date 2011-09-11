<?php
$config = $this->Database->get_config();
echo '<ul>';
echo '<li>Website Name: '.$config['site_name'].'</li>';
echo '<li>Current Theme: '.$config['theme'].'</li>';
echo '</ul>';
?>
