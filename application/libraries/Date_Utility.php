<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Date_Utility
{
    public function format_date($date, $format = 'Y-m-d')
    {
        if (empty(trim($date))) {return null;}
        return (new DateTime($date))->format($format);
    }
}
