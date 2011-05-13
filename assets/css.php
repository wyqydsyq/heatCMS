<?php
/*
 * css.php
 * 
 * This file handles all our css needs, retrieving and compressing the requested
 * files, then outputting as a single file to reduce browser http requests.
 */
$css = explode(',', $_GET['stylesheets']);
$vars = unserialize($_GET['vars']);
$vars['$THEME'] = $_GET['theme'];

header('Content-type: text/css');
ob_start("compress");

function compress($buffer) {
    /* remove comments */
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    /* remove tabs, spaces, newlines, etc. */
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}

/* bring on the assets! */
$i = 0;
if(empty($css)){die('// no stylesheets found for this theme');}
foreach($css as $file){
    if(file_exists($file)){
        $$i = file_get_contents($file);
        foreach($vars as $var => $val){
            $$i = str_replace($var, $val, $$i);
        }
        echo $$i;
        $i++;
    }else{
        echo '// file "'.$file.'" not found'."\n";
    }
}
ob_end_flush();
?>
