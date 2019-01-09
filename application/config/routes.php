<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['manifest'] = 'manifest/index';
$route['recyclefirm'] = 'recyclefirm/index';
$route['forwarder'] = 'forwarder/index';
$route['contractor'] = 'contractor/index';
$route['contractorbranch'] = 'contractorbranch/index';
$route['employee/save'] = 'employee/save';
$route['employee/input'] = 'employee/input';
$route['employee'] = 'employee/index';
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
