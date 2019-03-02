<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Utility
{
    public function multiply_param($param, $number)
    {
        $multiplied_params = [];

        for ($i=0; $i < $number ; $i++) { 
            $multiplied_params[] = $param;
        }

        return $multiplied_params;
    }
}
