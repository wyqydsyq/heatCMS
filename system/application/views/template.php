<?php
// all this file does is find the theme's template file from the theme's .xml file and include it.
	$theme = array();
	$theme['name'] = $this->Database->get_config('theme');
	$theme['xml'] = file_get_contents(str_replace('//','/',dirname(__FILE__).'/').'../../../assets/themes/'.$theme['name'].'/'.$theme['name'].'.xml');
	$theme['raw'] = xml2ary($theme['xml']);
	$theme['template'] = $theme['raw']['theme']['_c']['resources']['_c']['template']['_c']['file']['_c']['src']['_v'];
	include(str_replace('//','/',dirname(__FILE__).'/').'../../../assets/themes/'.$theme['name'].'/template/'.$theme['template']);
?>