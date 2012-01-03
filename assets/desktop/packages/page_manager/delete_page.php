<?php
// deletes $page and echoes true or false depending on the result
$query = $this->db->query("DELETE FROM `heat_content` WHERE (`id`='" . $page . "')");
if ($query) {
    echo 'true';
} else {
    echo 'false';
}
?>
