<?php
/*
 * This is both an example template file and the default for heatCMS.
 * You can do just about anything you want in a template that you could normally
 * do on any other PHP script
 * 
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo @$title; ?></title>
        <?php echo @$theme_css; ?>
        <?php echo @$theme_js; ?>
    </head>
    <body<?php if (!empty($path)) { echo ' class="' . $path . '"'; } ?>>
        <div id="container" class="container">
            <div id="header" class="span-24">
                <h1><a href="<?php echo base_url(); ?>"><?php echo $this->Heat->conf('site_name'); ?></a></h1>
                <div class="clear"></div>
            </div>
            <div id="nav" class="span-24">
                <ul>
                    <?php echo $this->Page->generate_nav(@$zone); ?>
                </ul>
            </div>
            <div class="clear"></div>
            <div id="body" class="span-24">
                <div id="content" class="span-18">
                    <h1><?php echo @$title; ?></h1>
                    <?php echo @$content; ?>
                </div>
                <div id="sidebar" class="span-6 last">
                    <?php echo @$sidebar_content; ?>
                </div>
                <div class="clear"></div>
            </div>
            <div id="footer" class="span-24">
                <div class="footer-content">
                    <ul id="footer-nav">
                        <?php echo $this->Page->generate_nav(@$zone); ?>
                    </ul>
                    <a href="#header" class="backtotop"><?php echo $this->lang->line('page_back_to_top'); ?></a>
                    <div class="clear"></div>
                </div>
                <div class="footer-bottom">
                    <p>&copy; <?php echo $this->Heat->conf('site_name'); ?> <?php echo date("Y"); ?>.<span style="float: right;">Page generated in {elapsed_time}s | Powered by <a href="https://github.com/pyrokinetic/heatCMS">heatCMS</a> | <a href="<?php echo site_url('desktop'); ?>">Desktop</a></span></p>
                </div>
            </div>
        </div>
    </body>
</html>