<?php

/**
 * desktop.php
 * 
 * This file is the controller for the whole desktop system, it loads the
 * desktop initially and provides the server-side of the desktop AJAX
 * functionality, as well as AJAX functionalities for desklets.
 */
class Desktop extends CI_Controller {

    // authorize the user before doing anything else
    function __construct() {
        parent::__construct();
        $this->Heat->user_auth('administrator');
    }

    public function index() {
        $data['config'] = $this->Database->get_config();
        $this->load->view('desktop/desktop', $data);
    }

    ////////////////////////////////////////////////////////////////////////////
    //  AJAX functions - not meant to be viewable pages
    ////////////////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////////////////
    // generates the do menu, filling it with all enabled desklets.
    public function do_menu() {
        // start the unordered list
        $output = '<ul>';

        // get an array of enabled desklets from the database
        $enabled_desklets = $this->Database->get_enabled_desklets();
        
        // load the launcher.json config file for each enabled desklet and
        // then decode it into an array
        foreach ($enabled_desklets as $desklet => $array) {
            $launcher_json = 'assets/desktop/desklets/'.$desklet.'/launcher.json';
            if(file_exists($launcher_json)){
                $handle = fopen($launcher_json, 'r');
                $json = fread($handle, filesize($launcher_json));
                fclose($handle);

                $desklets[$desklet] = json_decode($json, true);
            }else{
                log_message('error' ,'The desklet "'.$desklet.'" was marked as enabled, but its launcher.json could not be found in '.$launcher_json);
            }
        }

        // make a list item for each installed desklet
        foreach ($desklets as $desklet) {
            $output .= '<li><a href="' . site_url('assets/desktop/desklets/') . '/' . $desklet['name'] . '/" alt="' . $desklet['name'] . '" ><img src="' . site_url('assets/desktop/desklets') . '/' . $desklet['name'] . '/'.$desklet['icon'].'" width="48" height="48" alt="' . $desklet['title'] . '" title="' . $desklet['title'] . '"></a></li>';
        }

        // if no desklets are found/installed, tell the user
        if (empty($desklets)) {
            $output .= '<li>No desklets could be found.</li>';
        }

        // end the unordered list
        $output .= '</ul>';

        // echo the output
        echo $output;
    }

    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    // function for desklets to load php files as views (so desklets can access
    // the heatCMS database etc.)
    public function desklet_load($desklet) {
        $file = $_GET['file'];
        unset($_GET['file']);
        
        foreach($_GET as $key=>$val){
            $vars[$key] = $val;
        }
        
        $this->load->view('../../assets/desktop/desklets/'.$desklet.'/'.$file, @$vars);
    }

    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    // Pre-desktop stuff, not usable, will delete in future
    // when they're merged with the desktop system.
    // Dashboard
    public function dashboard() {
        $data['title'] = lang('cpnl_title', array(lang('dashboard')));
        $data['zone'] = 'control_panel';
        $data['content'] = '"dashboard" content here';
        $this->Page->build($data, false, 'system');
    }

    // Pages and page manipulation (add/edit/delete etc.)
    public function pages($action='list', $page=NULL) {
        switch ($action) {
            // List pages
            case 'list':
                $data['title'] = lang('cpnl_title', array(lang('pages')));
                $data['zone'] = 'control_panel';

                // loop through all pages and collect them
                $query = $this->db->query("SELECT * FROM `heat_content` ORDER BY `order` ASC");
                if ($query->num_rows() > 0) {
                    $i = 0;
                    foreach ($query->result() as $page) {
                        $data['pages'][$i]['title'] = $page->title;
                        $data['pages'][$i]['path'] = $page->path;
                        $data['pages'][$i]['order'] = $page->order;
                        $data['pages'][$i]['content'] = $page->content;
                        $data['pages'][$i]['timestamp'] = $page->timestamp;
                        $i++;
                    }
                }

                // send collected pages to this view
                $this->Page->build($data, 'control_panel/pages/list', 'system');
                break;
            case 'new':
                $page_content = $this->input->get('page_content');
                $page_order = $this->input->get('page_order');
                $page_path = $this->input->get('page_path');
                $page_title = $this->input->get('page_name');
                $meta = serialize(array(
                    'last_editor' => $this->Heat->user('username')
                        ));

                if (!empty($page_content) && !empty($page_order) && !empty($page_path) && !empty($page_title)) {
                    // submit form data and create the page, then return success message
                    $insert = $this->db->query("INSERT INTO `heat_content` 
                                    (`id`,`order`,`path`,`title`,`content`,`meta`,`timestamp`) 
                                    VALUES(
                                        '" . url_title($page_title, 'underscore', true) . "',
                                        '" . $page_order . "',
                                        '" . url_title($page_path, 'underscore', true) . "',
                                        '" . $page_title . "',
                                        '" . $page_content . "',
                                        '" . $meta . "',
                                        '" . time() . "'
                                )");
                    $return = json_encode(array(
                        'success' => 'true',
                        'page_content' => $page_content,
                        'page_order' => $page_order,
                        'page_title' => $page_title,
                        'created' => date('Y-m-d G:i', time())
                            ));
                    echo $return;
                    exit;
                } else {
                    $return = json_encode(array(
                        'success' => 'false',
                        'message' => 'An error occurred making the page.'
                            ));
                    echo $return;
                    exit;
                }
                break;
            case 'delete':
                $page = $this->input->get('page_path');
                if (!empty($page)) {
                    $query = $this->db->query('"DELETE FROM `content` WHERE `id`="' . $page . '"');
                    $return = json_encode(array(
                        'success' => 'true',
                        'message' => 'The page "' . $page . '" was deleted successfully.'
                            ));
                    echo $return;
                } else {
                    $return = json_encode(array(
                        'success' => 'false',
                        'message' => 'An error occurred deleting the page.'
                            ));
                    echo $return;
                }
                break;
            default:
                $this->Heat->error(404, uri_string());
                break;
        }
    }

}