<?php

class Error extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function e($error=404, $page) {
        $data['title'] = lang('error_' . $error);
        $data['content'] = lang('error_' . $error . '_msg', site_url($page));
        $this->output->set_status_header($error);
        $this->Page->build($data);
    }

}

?>
