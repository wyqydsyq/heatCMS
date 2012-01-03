<?php
// get last page to see what order to make this
$q = $this->db->query("SELECT `order` FROM `heat_content` ORDER BY `order` DESC LIMIT 1");
$last = $q->row_array();
$last = $last['order'];

$order = $last + 1;


$meta = serialize(array('created' => time(), 'last_editor' => $this->Heat->user('username')));
$this->db->query("REPLACE INTO `heat_content`
                (`id`, `order`, `parent`, `title`, `content`, `meta`, `timestamp`)
                VALUES(
                    'new_page',
                    '{$order}',
                    '',
                    'New Page',
                    '',
                    '" . $meta . "',
                    '" . time() . "'
                )
            ");
?>
