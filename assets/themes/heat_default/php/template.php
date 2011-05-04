<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo @$title; ?></title>
	<?php echo $theme_css; ?>
</head>
<<<<<<< HEAD
	<body>
=======
	<body<?php echo ' class="'.@$path.'"'; ?>>
>>>>>>> 8e57b208f208e8e7f024426d95f2e8d074a76770
		<div id="container">
			<div id="header">
				<h1><a href="<?php echo base_url(); ?>"><?php echo $this->Page->heat_conf('site_name'); ?></a></h1>
				<div class="clear"></div>
			</div>
			<div id="nav">
				<ul>
					<?php echo $this->Page->generate_nav(@$zone); ?><li class="hidden"></li>
				</ul>
			</div>
			<div id="body">
<<<<<<< HEAD
				<div id="content">
=======
			    <div id="content">
>>>>>>> 8e57b208f208e8e7f024426d95f2e8d074a76770
					<h1><?php echo @$title; ?></h1>
					<?php echo @$content; ?>
				</div>
				<div class="clear"></div>
			</div>
			<div id="footer">
				<div class="footer-content">
					<ul>
						<?php echo $this->Page->generate_nav(@$zone); ?>
					</ul>
					<a href="#container" class="backtotop"><?php echo $this->lang->line('page_back_to_top'); ?></a>
					<div class="clear"></div>
				</div>
				<div class="footer-bottom">
					<p>&copy; <?php echo $this->Page->heat_conf('site_name'); ?> <?php echo date("Y"); ?>.<span style="float: right;">Page generated in {elapsed_time}s | Powered by <a href="http://powerindesign.com/projects/heat">heatCMS</a></span></p>
				</div>
			</div>
		</div>
		<?php echo @$theme_js; ?>
	</body>
</html>