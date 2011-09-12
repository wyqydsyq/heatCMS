<?php
/*
 * base.php
 * 
 * Basically a catching page for any requests, unless the request is for an
 * existing controller, the system flows here, which will attempt to get
 * the requested page from the database or give a 404 if nothing was found.
 */
class Base extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index($page='home') {
        // Search the db for a page matching the request.
        $query = $this->db->query("SELECT * FROM `heat_content` WHERE `id`='$page'");
        $result = $query->result_array();

        if (empty($result)) {
            // No page found, give a 404 Not Found.
            $this->Heat->error(404, uri_string());
        } else {
            // Page found! Give a 200 OK and build the page.
            $result[0]['from_db'] = true;
            $this->output->set_status_header('200');
            $this->Page->build($result[0], $page);
        }
    }

}