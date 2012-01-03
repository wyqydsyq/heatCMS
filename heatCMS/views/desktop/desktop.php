<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $config['site_name']; ?> :: heatCMS Desktop</title>
        <link type="text/css" rel="stylesheet" href="<?php echo $this->Heat->conf('site_url').'assets/desktop/desktop.css'; ?>" />
        <link type="text/css" href="assets/desktop/jquery-ui-1.8.12.custom.css" rel="Stylesheet" />
        <link type="text/css" href="assets/desktop/jwysiwyg/jquery.wysiwyg.css" rel="Stylesheet" />
    </head>
    <body id="canvas">
        <div id="desktop">  
            <button id="do_button" type="button">Do</button>
            <div id="do_menu">
            </div>
            <div id="package_holder">
                 
            </div>
        </div>
        <script type="text/javascript" src="<?php echo $this->Heat->conf('site_url').'assets/desktop/jquery-1.6.1.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $this->Heat->conf('site_url').'assets/desktop/jquery-ui-1.8.12.custom.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $this->Heat->conf('site_url').'assets/desktop/jwysiwyg/jquery.wysiwyg.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $this->Heat->conf('site_url').'assets/desktop/desktop.js'; ?>"></script>
    </body>
</html>


