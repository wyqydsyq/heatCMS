<?php
$config = $this->Database->get_config();
$user_count = $this->db->query("SELECT * FROM `heat_users`");
$user_count = $user_count->num_rows();

$page_count = $this->db->query("SELECT * FROM `heat_content`");
$page_count = $page_count->num_rows();
echo '<ul>';
echo '<li>Website Name: '.$config['site_name'].'</li>';
echo '<li>Current Theme: '.$config['theme'].'</li>';
echo '<li># of Users: '.$user_count.'</li>';
echo '<li># of Pages: '.$page_count.'</li>';
echo '</ul>';
?>
