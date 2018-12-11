<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['employee/save'] = 'employee/save';
$route['employee/input'] = 'employee/input';
$route['employee'] = 'employee/index';
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
