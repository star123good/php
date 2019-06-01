<?php

class Reminder {
    var $slug ;
    var $days;
    var $subject;
    var $body;
    var $last_check;

    public function __construct($data) {
        $this->slug          =$data['s_slug'];
        $this->days          = $data['i_days'];
        $this->subject      = $data['s_subject'];
        $this->body         = $data['s_body_content'];
        $this->last_check = $data['dt_last_check'];
    }
}
