<?php
/*
 * page.php
 * 
 * This model is basically the interface between controllers and the final
 * result. See build() for more.
 */
class Page extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*
     * build() builds pages!
     * 
     * $data	: Variables to send to that page, or to the template.
     * $page	: View to load if a page matching $data['id'] could not
     *                be found in DB. If neither are supplied then the user
     *                will get a 404.
     * $type	: Is this a different type of page from the default?.
     * $assets	: Are there any special assets (css/js) we need to load?
     */

    function build($data, $page=false, $type=false, $assets=array()) {

        $this->load->model('database');

        /* 
         * select a theme to use, if we're on a specific page that requires
         * a particular theme, enter it here, otherwise the user selected theme
         * is used. If no user selected theme is found, use the default
         */
        // get theme from db
        $get_theme = Database::get_config('theme');
        if (($theme = $get_theme) === false) {
            // if no theme found, use the default
            $theme = 'heat_default';
        }

        $css = NULL;
        $js = NULL;
        // add on the requested files from the $assets array
        if (!empty($assets)) {
            foreach ($assets as $type => $key) {
                foreach ($key as $key => $val) {
                    if (empty($$type)) {
                        $$type = false;
                    }
                    $$type .= $val . ",";
                }
                // snip the last ampersand off
                $$type = substr($$type, 0, strlen($$type) - 1);
            }
        }

        // check to see if the page exists in the database, if so, turn it into a page
        // $query = $this->db->query("SELECT `id` FROM `heat_content` WHERE '" . @$data['id'] . "'=`id`");
        // if ($query->num_rows() != 0) {
        if(!empty($data['from_db'])){
            $output = $this->load->view('compile', $data, true);
            $this->output->set_output($output);
        }
        // otherwise load the template page with the $data provided,
        // which will be a 404 error message if no $data was provided at the
        // start of this script.
        else {
            if (!empty($page)) {
                $data['content'] = $this->load->view($page, $data, true);
            }
            $data['path'] = str_replace('/', '-', uri_string());
            $output = $this->load->view('compile', $data, true);
            $this->output->set_output($output);
        }
    }

    /*
     * generate_nav, fairly straightforward, generates a navigation, each
     * item in <li> tags (customizable) and returns it for printing.
     * Best echoed in a template (/assets/themes) file
     * 
     * $zone        : Allows custom menus for different parts of the site
     * $list        : Will wrap the menu links in <li> tags if true
     */

    function generate_nav($zone='', $list=true) {
        $return = '';
        if ($list === true) {
            $li_o = "<li>";
            $li_c = "</li>\n";
        }

        $query = $this->db->query("SELECT `path`,`title` FROM `heat_content` ORDER BY `order` ASC");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $return .= @$li_o . anchor($row->path, $row->title) . @$li_c;
            }
        }
        return $return;
    }

}
