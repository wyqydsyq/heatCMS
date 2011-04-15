<?php
function get_base_url() {
	$pageURL = 'http';
	if (!empty($_SERVER["HTTPS"])) {$pageURL .= "s";}
		$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	$pageURL = str_replace(uri_string(), '', $pageURL);
	return $pageURL;
}
function get_domain() {
	return $_SERVER['SERVER_NAME'];
}
function base_url_check() {
	if (base_url() != get_base_url()){
		redirect('error/bad_domain',302);
	}
}
?>