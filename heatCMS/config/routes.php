<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['404_override'] = '';
// if heatCMS isn't configured, redirect to setup
if($GLOBALS['heat_config']['status'] !== true){
	$route['default_controller'] = "setup";
}else{
	$route['default_controller'] = "base";
}
$route['scaffolding_trigger'] = "";

// get all controllers and make a route so if the uri request doesn't match an
// existing controller, route it to the base controller, which will handle
// the request from there (loading page from db, or displaying 404 .etc)
if ($handle = opendir('heatCMS/controllers')) {
	$controllers = '';
    while (false !== ($file = readdir($handle))) {
        if (
			$file != "."
			&& $file != ".."
			&& $file != "index.html"
			&& $file != "base.php"
		) {
            $controllers .= "$file|";
        }
    }
    closedir($handle);
}
$controllers = str_replace('.php', '', substr($controllers, 0, -1));
$controllers = "^(?!$controllers|error).*$";
$route[$controllers] = "base/index/$0";


/* End of file routes.php */
/* Location: ./application/config/routes.php */