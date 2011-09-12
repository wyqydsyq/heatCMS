<?php
function lang($line_key = '', $args = '', $lang = '')
{
    $ci =& get_instance();

    if( ! is_array($args))
    {
        $args = array($args);
    }

    $line_key = $ci->lang->line($line_key, $lang);
    return vsprintf($line_key, $args);
}  
?>