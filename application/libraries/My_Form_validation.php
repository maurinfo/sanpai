<?php

/**
 * Extension_Form_validation short summary.
 * Extend the form validation
 *
 * @version 1.0
 * @author mcunanan19
 */
class MY_Form_validation extends CI_Form_validation {

    public function __construct($rules = array())
    {
        parent::__construct($rules);
    }

    public function valid_date($date,  $format = 'Y-m-d')
    {
        if(empty($date)) { return true; }
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

}
