<?php

class Error extends Controller {

    function Error() {
        parent::Controller();
    }

    function e($error=404, $page) {
        $data['title'] = lang('error_' . $error);
        $data['content'] = lang('error_' . $error . '_msg', site_url($page));
        $this->output->set_status_header($error);
        $this->Page->build($data);
    }

}

?>
