<?php
// this file simply loads and returns all data from the requested page's database entry.
$page = $_GET['target_page'];
$query = $this->Database->get_pages($page);
$query[0]['theme'] = $this->Database->get_config('theme');
echo json_encode($query[0]);
?>
