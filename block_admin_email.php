<?php

// Written at Louisiana State University

class block_admin_email extends block_list {
    function init() {
        $this->title = get_string('pluginname', 'block_admin_email');
    }

    function applicable_formats() {
        return array('site' => true, 'course' => false, 'my' => false);
    }

    function get_content() {
        global $OUTPUT, $USER;

        if($this->content !== NULL) {
            return $this->content;
        }

        $context = get_context_instance(CONTEXT_SYSTEM);

        if(!is_siteadmin($USER->id) and !has_capability('block/admin_email:send_email',$context, $USER->id, false)) {
            return $this->content;
        }

        $this->content = new stdclass;
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';

        $this->content->items[] = html_writer::link(new moodle_url('/blocks/admin_email/'), get_string('send_email', 'block_admin_email'));

        $this->content->icons[] =
            $OUTPUT->pix_icon('i/email', $send_email_str,
                'moodle', array('class' => 'icon'));

        return $this->content;
    }
}
