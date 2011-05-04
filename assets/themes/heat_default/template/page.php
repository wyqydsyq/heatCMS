<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo @$title; ?></title>
	<?php echo $theme_css; ?>
</head>
	<body>
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
					<div id="content">
					<h1><?php echo @$title; ?></h1>
					<div class="box">
						<?php echo @$content; ?>
					</div>
				</div>
				<?php /*
				<div class="sidebar">
					<h4><?php echo @$sidebar_title; ?></h4>
					<div class="box">
						<?php echo @$sidebar_content; ?>
					</div>
				</div>
				*/ ?>
				
				<div class="clear"></div>
			</div>
			<div id="footer">
				<div class="footer-content">
					<span class="sitename"><?php echo $this->Page->heat_conf('site_name'); ?></span>
					<p class="footer-links">
						<?php echo $this->Page->generate_nav(@$zone, false); ?>
						<a href="#container" class="backtotop">Back to top</a>
					</p>
				</div>
				<div class="footer-bottom">
					<p>&copy; <?php echo $this->Page->heat_conf('site_name'); ?> <?php echo date("Y"); ?>.<span style="float: right;"><?php $gentime = substr(microtime(true)-$GLOBALS['request_time'],0,5); echo 'Page generated in '.$gentime.'s';?> | Powered by <a href="http://powerindesign.com/projects/heat">heatCMS</a></span></p>
				</div>
			</div>
		</div>
		<?php echo @$theme_js; ?>
	</body>
</html>