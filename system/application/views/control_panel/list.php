<table>
    <tr>
	<th>Title</th>
	<th>Path</th>
	<th>Last edited</th>
    </tr>
<?php
    foreach ($pages as $key => $page){
	echo '<tr class="add_context_menu">';
	    echo '<td><a href="'.site_url('control_panel/pages/edit/'.urlencode($page['path'])).'">'.$page['title'].'</td></a>';
	    echo '<td>/'.$page['path'].'</td>';
	    echo '<td>'.date('Y/m/d, g:i a', $page['timestamp']).'</td>';
	echo '<tr>';
    }
?>
</table>