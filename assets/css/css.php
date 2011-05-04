<?php
// load xml helper
require_once('../../system/application/helpers/MY_xml_helper.php');

// set include array
$g_include = $_GET['stylesheets'];
$g_include = explode(',', $g_include);

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

// add files to the array with your if/else clauses and what not.
// these will be included before the theme files and page-specific files.

$include[] = 'file/reset.css';

// loop over and add in all theme files
// these wil be included before page-specific files.
if(!empty($theme['css'])){
	foreach($theme['css']['files'] as $key=>$val){
		$include[$key] = '../themes/'.$theme['name'].'/css/'.$val;
	}
}

// add page-specific files, or any files retrieved from the $_GET
$include = array_merge($include, (array)$g_include);

// set variables (key will = value)
$vars = array(
<<<<<<< HEAD
	'~colour1' => '#ffffff',
	'~colour2' => '#F60'
=======
	'#colour1' => '#ffffff',
	'#colour2' => '#F60',
	'#colour3' => '#333'
>>>>>>> 8e57b208f208e8e7f024426d95f2e8d074a76770
);

// set header type to css just so browsers don't spew
header('Content-type: text/css');

// include css files
foreach($include as $key => $file){
	$the_file = $file;
	if(file_exists($the_file) && filesize($the_file) > 0){
		$fh = fopen($the_file, 'r');
		$data = fread($fh, filesize($the_file));
		fclose($fh);
			
<<<<<<< HEAD
			foreach($vars as $key=>$val){
				$data = str_replace($key, $val, $data);
			}	
=======
		foreach($vars as $key=>$val){
			$data = str_replace($key, $val, $data);
		}	
>>>>>>> 8e57b208f208e8e7f024426d95f2e8d074a76770
					
		echo $data;
	}
}

?>