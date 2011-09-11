<?php
/*
 * javascript.php
 * 
 * This file handles all our js needs, retrieving and compressing the requested
 * files, then outputting as a single file to reduce browser http requests.
 */
$js = explode(',', $_GET['scripts']);
$vars = unserialize($_GET['vars']);
$vars['$THEME'] = $_GET['theme'];

header('Content-type: text/javascript');
ob_start("compress");

function compress($buffer) {
    /* remove comments */
    //$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    /* remove tabs, spaces, newlines, etc. */
    //$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}

/* bring on the assets! */
$i = 0;
if(empty($js)){die('// no scripts found for this theme');}
foreach($js as $file){
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
