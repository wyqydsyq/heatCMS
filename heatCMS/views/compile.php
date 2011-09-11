<?php
/*
 * compile.php
 * 
 * Retrieves the selected theme's xml file, and retrieves all the resources for it.
 * this is the file that compiles the entire front-end aspect of all pages.
 * 
 * THIS IS NOT a theme's template file, they are located in
 * /assets/themes/YOURTHEME, this file fills a theme's template with data and
 * inserts the compressed assets (js/cs).
 */

// Get the current theme and load its xml file
$theme = array();
$theme['name'] = $this->Database->get_config('theme');
$theme['xml'] = file_get_contents(str_replace('//','/',dirname(__FILE__).'/').'../../assets/themes/'.$theme['name'].'/'.$theme['name'].'.xml');
$theme['raw'] = xml2ary($theme['xml']);
$theme['template'] = $theme['raw']['theme']['_c']['resources']['_c']['php']['_c']['file']['_c']['src']['_v'];

// retrieve the js/css assets from the xml
$theme['assets']['css'] = @$theme['raw']['theme']['_c']['resources']['_c']['css']['_c'];
$theme['assets']['js'] = @$theme['raw']['theme']['_c']['resources']['_c']['js']['_c'];

$css = array();
$js = array();

// convert each asset entry from xml data to an array entry
foreach($theme['assets'] as $type => $files){
    $files = $files['file'];
    if(!empty($files)){
        foreach($files as $file){
            if(!empty($file['_c'])){$file = $file['_c'];}
            $asset_title = $file['title']['_v'];
            $src = 'themes/' . $theme['name'] . '/'. $type .'/' . $file['src']['_v'];
            $src_type = &$$type;
            $src_type[$asset_title] = $src;
        }
    }
}

// get the theme defined variables
foreach($theme['raw']['theme']['_c'] as $key => $c){
    if($key == 'var'){
        foreach($c as $var){
            $vars[$var['_a']['name']] = $var['_v'];
        }
    }
}
$vars['$SITEURL'] = base_url();

// tidy up the resource lists and vars for storing in a url
if(!empty($css)){$css = urlencode(implode(',', $css));}
if(!empty($js)){$js = urlencode(implode(',', $js));}
if(!empty($vars)){$vars = urlencode(serialize($vars));}

// set theme strings
// the css
$theme_css = '<link type="text/css" rel="stylesheet" href="'.$this->Heat->conf('site_url').'assets/stylesheet.css?theme='.$theme['name'].'&amp;stylesheets='.@$css.'&amp;vars='.$vars.'" />';
$theme_css .= '<link type="text/css" rel="stylesheet" href="'.$this->Heat->conf('site_url').'assets/stylesheet.css?theme='.$theme['name'].'&amp;stylesheets=themes/' . $theme['name'] . '/css/print.css&amp;vars='.$vars.'" media="print" />';
// the js
$theme_js = '<script type="text/javascript" src="'.$this->Heat->conf('site_url').'assets/javascript.js?theme='.$theme['name'].'&amp;scripts='.@$js.'&amp;vars='.$vars.'"></script>';


// and away we go!
include(str_replace('//','/',dirname(__FILE__).'/').'../../assets/themes/'.$theme['name'].'/php/'.$theme['template']);
