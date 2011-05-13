# heatCMS #

## This version  
* Completely revised the page generation, including a LOT of optimization, now all non-content assets are called from the theme folder. This way the whole front-end aspect is completely plug-n-play with themes, there's no css or js included by default, it's all controlled by the current theme's .xml file.
* Revised the Base controller and Page model to reduce the database queries to 1 (from 2) as previously Base would get the page data from the DB if possible, then Page would double check to see if the page exists in the database. Instead, Base now flags the page data array with the key 'from_db' to indicate it's origin so Page doesn't have to double-check.
* CSS and JavaScript theme assets are now automatically compressed to decrease load times! (note: if you have colossal css/js files, page generation might take longer as the server may take a while to compress the assets, even then it should be balanced out by the client loading the page faster once generated)
* Updated to CodeIgniter 2.0.2
* Implemented basic page creation

## TODO for release
* Implement a WYSIWYG editor, either TinyMCE (looks good but is pretty bloated) or jwysiwyg (simple, fast and clean but possibly buggy due to being less used)
* Finish page manipulation (add/edit/delete) with chosen WYSIWYG editor
* Basic configuration options to the control_panel, to allow users to change themes .etc
