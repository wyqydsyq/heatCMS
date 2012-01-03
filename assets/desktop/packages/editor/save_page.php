<?php
foreach($values as $key=>$val){
	$values[$key] = $this->db->escape($val);
}
echo $this->db->query("UPDATE `heat_content` SET `id`='".url_title($values['title'], 'underscore', TRUE)."', `title`={$values['title']}, `content`={$values['content']}, `timestamp`='".time()."' WHERE `id`='{$target_page}'");
?>
