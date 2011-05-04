
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
		<?php 
		$get_theme = $this->Database->get_config('theme');
		if(($theme = $get_theme) === false){
			$theme = 'heat_default';
		}
		
		foreach($footer_extras as $type=>$key){
					foreach($key as $key=>$val){
						if(empty($$type)){$$type = false;}
						$$type .= $val.",";
					}
				}
				$js = substr($js, 0, strlen($js)-1);
				echo '<script type="text/javascript" src="'.$this->Page->heat_conf('site_url').'assets/js/javascript.js?scripts='.$js.'&amp;theme='.$theme.'"></script>';
		 ?>
	</body>
</html>