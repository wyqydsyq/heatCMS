<?php
// load xml helper
require_once('../../system/application/helpers/MY_xml_helper.php');

// set include array
$g_include = $_GET['scripts'];
$g_include = explode(',', $g_include);

// get theme
$theme = array();
$theme['name'] = $_GET['theme'];
$theme['xml'] = file_get_contents('../themes/'.$theme['name'].'/'.$theme['name'].'.xml', FILE_USE_INCLUDE_PATH);
$theme['raw'] = xml2ary($theme['xml']);
$theme['js'] = $theme['raw']['theme']['_c']['resources']['_c']['js']['_c'];
if(!empty($theme['js'])){
	foreach($theme['js']['file'] as $file){
		$file_title = $file['_c']['title']['_v'];
		$file_name = $file['_c']['src']['_v'];
		$theme['js']['files'][$file_title] = $file_name;
	}
}

// add files to the array with your if/else clauses and what not
$include[] = 'file/prototype.js';
//$include[] = 'file/scriptaculous/scriptacoulous.js';
//$include[] = 'file/livepipe/livepipe.js';
//$include[] = 'file/livevalidation_prototype.compressed.js';
$include[] = 'file/hotkeys-min.js';


// loop over and add in all theme files
if(!empty($theme['js'])){
	foreach($theme['js']['files'] as $key=>$val){
		$include[$key] = '../themes/'.$theme['name'].'/js/'.$val;
	}
}

// add files included from $_GET
$include = array_merge($include, (array)$g_include);

// set variables (key will = value)
$vars = array(
	'~base_url/' => $_GET['base_url'],
);
// set header type to javascript just so browsers don't spew
header('Content-type: text/javascript');

// include js files
foreach($include as $key => $file){
	$the_file = $file;
	if(file_exists($the_file) && filesize($the_file) > 0){
		$fh = fopen($the_file, 'r');
		$data = fread($fh, filesize($the_file));
		fclose($fh);
			
		foreach($vars as $key=>$val){
			$data = str_replace($key, $val, $data);
		}	
					
		echo $data;
	}
}

?>