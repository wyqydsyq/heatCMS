<?php 
	
	// let's set it up to get the selected theme, then pass it on to css.php(stylesheets.css) to load the theme files!
		
		// get theme from db
		$get_theme = $this->Database->get_config('theme');
		if(($theme = $get_theme) === false){
			$theme = 'heat_default';
		}
		
		// add on the requested files from the extras param in Page->build();
		foreach($header_extras as $type=>$key){
			foreach($key as $key=>$val){
				if(empty($$type)){$$type = false;}
				$$type .= $val.",";
			}
		}
		// clip the last ampersand off
		$css = substr($css, 0, strlen($css)-1);
		
		// and away we go!
		echo'<link type="text/css" rel="stylesheet" href="'.$this->Page->heat_conf('site_url').'assets/css/stylesheet.css?stylesheets='.$css.'&amp;theme='.$theme.'" />';
	?>