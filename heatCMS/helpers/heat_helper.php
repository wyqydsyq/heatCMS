<?php
///////////////////////////////////////
///////////////////////////////////////
// General helper functions for heatCMS
///////////////////////////////////////

/*
	Searches haystack for needle and 
	returns an array of the key path if 
	it is found in the (multidimensional) 
	array, FALSE otherwise.
	
	@mixed array_searchRecursive ( mixed needle, 
	array haystack [, bool strict[, array path]] )
*/
 
function array_rsearch( $needle, $haystack, $strict=false, $path=array() )
{
    if( !is_array($haystack) ) {
        return false;
    }
 
    foreach( $haystack as $key => $val ) {
        if( is_array($val) && $subPath = array_rsearch($needle, $val, $strict, $path) ) {
            $path = array_merge($path, array($key), $subPath);
            return $path;
        } elseif( (!$strict && $val == $needle) || ($strict && $val === $needle) ) {
            $path[] = $key;
            return $path;
        }
    }
    return false;
}

/*
	Theme info
	Gets general info on the current theme from its .xml file and puts it into a nice array.
*/
function theme($return=false){
	$ci =& get_instance();
	$theme = array();
	$theme['name'] = $ci->Database->get_config['theme'];
	$theme['xml'] = file_get_contents('../../themes/'.$theme['name'].'/'.$theme['name'].'.xml', FILE_USE_INCLUDE_PATH);
	$theme['raw'] = xml2ary($theme['xml']);
	
	return $theme['raw'];
}
?>