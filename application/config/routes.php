<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['sale'] = 'sale/index';
$route['sale/(:num)'] = 'sale/index/$1';
$route['manifest'] = 'manifest/index';
$route['manifest/(:num)'] = 'manifest/index/$1';
$route['permit/(:num)/(:num)'] = 'permit/index/$1/$1';
$route['recyclefirm'] = 'recyclefirm/index';
$route['recyclefirm/(:num)'] = 'recyclefirm/index/$1';
$route['forwarder'] = 'forwarder/index';
$route['forwarder/(:num)'] = 'forwarder/index/$1';
$route['supplier'] = 'supplier/index';
$route['supplier/(:num)'] = 'supplier/index/$1';
$route['customer'] = 'customer/index';
$route['customer/(:num)'] = 'customer/index/$1';
$route['contractor'] = 'contractor/index';
$route['contractor/(:num)'] = 'contractor/index/$1';
$route['contractorbranch'] = 'contractorbranch/index';
$route['contractorbranch/(:num)'] = 'contractorbranch/index/$1';
$route['employee/save'] = 'employee/save';
$route['employee/input'] = 'employee/input';
$route['employee'] = 'employee/index';
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
