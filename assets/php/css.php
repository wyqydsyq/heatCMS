<?php
// load xml helper
require_once('../../system/application/helpers/MY_xml_helper.php');

// get theme
$theme = array();
$theme['name'] = $_GET['theme'];
$theme['xml'] = file_get_contents('../themes/'.$theme['name'].'/'.$theme['name'].'.xml', FILE_USE_INCLUDE_PATH);
$theme['raw'] = xml2ary($theme['xml']);
$theme['css'] = $theme['raw']['theme']['_c']['resources']['_c']['css']['_c'];
if(!empty($theme['css'])){
	foreach($theme['css']['file'] as $file){
		$file_title = $file['_c']['title']['_v'];
		$file_name = $file['_c']['src']['_v'];
		$theme['css']['files'][$file_title] = $file_name;
	}
}



// loop over and add in all theme files
// these wil be included before page-specific files.
if(!empty($theme['php'])){
	foreach($theme['php']['files'] as $key=>$val){
		$include[$key] = '../themes/'.$theme['name'].'/php/'.$val;
	}
}

// include php files
foreach($include as $key => $file){
	if(file_exists($the_file) && filesize($the_file) > 0){
		include($file);
	}
}

?>