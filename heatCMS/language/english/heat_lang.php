<?php
// login, control panel and forms
$lang['heat_button_next'] = 'Next &raquo;';
$lang['heat_button_back'] = '&laquo; Back';
$lang['cpnl_title'] = 'Control Panel &raquo; %s';
$lang['cpnl_login_title'] = 'Login &raquo; %s';
$lang['cpnl_new_page_title'] = 'New Page';
$lang['login_incorrect'] = 'Username or Password was incorrect.';
$lang['cpnl_new_page_description'] = 'Note that only pages with a top-level path will be displayed in the menu. <br />eg. \'categories\' will show in the menu, but \'categories\new\' will not.';
$lang['cpnl_new_page_legend'] = 'New Page';
$lang['page_created'] = 'The page \'%s\' was created successfully';

// pages
$lang['control_panel'] = 'Control Panel';
$lang['dashboard'] = 'Dashboard';
$lang['pages_list'] = 'Pages';
$lang['login'] = 'Login';
$lang['back_to_top'] = 'Back to top';

// common strings
$lang['name'] = 'Name';
$lang['path'] = 'Path';
$lang['content'] = 'Content';
$lang['save'] = 'Save';
$lang['order'] = 'Order';
$lang['pages'] = 'Pages';

// errors
$lang['error_404'] = 'Error 404 file not found';
$lang['error_404_msg'] = 'The file you requested (%s) was not found.';

// setup
$lang['setup_title'] = 'heatCMS &raquo; Setup';
$lang['setup_table_error'] = 'The database table "heat_%s" does not exist and could not be created';
$lang['setup_insert_admin_error'] = 'Error inserting administrator (%s) user into table `heat_users`.<br />';
$lang['setup_desc'] = 'Set up your website in 2 simple steps with heatCMS!';
$lang['setup_dialogue_fields_required'] = 'All fields are required.';
$lang['setup_dialogue_legend_system'] = 'System Basics';
$lang['setup_dialogue_legend_admin'] = 'Administrator Account';
$lang['setup_dialogue_name'] = 'Website Name';
$lang['setup_dialogue_url'] = 'Installation Address';
$lang['setup_dialogue_username'] = 'Username';
$lang['setup_dialogue_password'] = 'Password';
$lang['setup_dialogue_email'] = 'Email';
$lang['setup_button_next'] = 'Next &raquo;';
$lang['setup_complete_title'] = 'Setup Successful';
$lang['setup_complete_message'] = '<p>Setup completed successfully, ' . anchor('control_panel', 'click here') . ' to log in to the control panel, or ' . anchor('', 'click here') . ' to go to the homepage</p>';
?>
